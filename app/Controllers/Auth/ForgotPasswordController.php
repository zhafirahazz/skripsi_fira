<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Confirmation;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use DateTime;
use Ramsey\Uuid\Uuid;
use CodeIgniter\Exceptions\PageNotFoundException;

class ForgotPasswordController extends BaseController
{
    use ResponseTrait;
    protected $model;
    protected $session;

    public function __construct()
    {
        $this->model = new User();
        $this->cfm = new Confirmation();
        $this->session = session();
    }

    public function index()
    {
        return view('templates/auth/_header', ["title" => "Reset Password"])
            . view('auth/forgotpassword')
            . view('templates/auth/_footer');
    }

    public function send()
    {
        $this->response->setContentType('Content-Type: application/json');

        $email = $this->request->getVar('email');
        $user = $this->model->where('email', $email)->first();

        if ($user == null) {
            $this->response->setStatusCode('400');
            return json_encode([
                "code" => 4003,
                "message" => "User not found!"
            ]);
        }

        $data = [
            "user_id" => $user["id"],
            "code" => Uuid::uuid4(),
            "valid_until" => (time() + 900),
            "job_type" => "RESET_PASSWORD"
        ];

        $email = \Config\Services::email();
        $email->setTo($user["email"]);
        $email->setFrom('noreply@smaitabbskp.sch.id', 'Reset Passoword');
        
        $email->setSubject("Permintaan perubahan password");
        $url = site_url(route_to('auth.forgot.reset',$data["code"]));
        $name = $user["name"];

        $email->setMessage("
        Hi $name,
        <br/>
        Kami menerima permintaan reset password untuk akun anda. Jika anda merasa tidak pernah melakukan
        permintaan perubahan password, silahkan abaikan surel ini. Jika anda hendak melakukan perubahan password 
        silahkan ikuti tautan berikut :
         <br/>
         <br/>
         <a href='$url'>$url</a>
         <br/>
         <br/>
         Silahkan salin tautan tersebut dan tempelkan di peramban anda kemudian silahkan ubah password anda. 
         Harap diingat bahwa tautan tersebut hanya berlaku selama 15 menit. Terimakasih
         <br/>
        Tim
        ");
        if ($email->send()) 
		{
            $result = [
                "message" => "Email terkirim!"
            ];
        } 
		else 
		{
            $this->response->setStatusCode('500');
            return json_encode([
                "code" => 5001,
                "message" => "Error sending email, please contact admin!"
            ]);
        }

        $this->cfm->save($data);

        return json_encode($result);
    }

    public function reset($code)
    {
        $job = $this->cfm->where('code', $code)->where('job_type', 'RESET_PASSWORD')->first();

        if ($job == null) {
            throw PageNotFoundException::forPageNotFound();
        }

        if($job["valid_until"] < time()){
            throw PageNotFoundException::forPageNotFound("The page you are looking for already expired");
        }

        return view('templates/auth/_header', ["title" => "Reset Password"])
            . view('auth/resetpassword', ["code" => $code])
            . view('templates/auth/_footer');
    }

    public function update()
    {
        $this->response->setContentType('Content-Type: application/json');
        $job = $this->cfm->where('code', $this->request->getVar('code'))->where('job_type', 'RESET_PASSWORD')->first();

        if ($job == null) {
            $this->response->setStatusCode('400');
            return json_encode([
                "code" => 4001,
                "message" => "Invalid code"
            ]);
        }

        if($job["valid_until"] < time()){
            $this->response->setStatusCode('400');
            return json_encode([
                "code"=>4002,
                "message" => "Expired code"
            ]);
        }

        $user = $this->model->where('id', $job["user_id"])->first();
        if ($user == null) {
            $this->response->setStatusCode('400');
            return json_encode([
                "code" => 4003,
                "message" => "User not found!"
            ]);
        }

        $user["password"] = password_hash($this->request->getVar('pwd'), PASSWORD_BCRYPT);
        $this->model->save($user);
        $this->cfm->delete($job["id"]);
        $this->cfm->where('valid_until', '<', time())->delete();

        return json_encode([
            "message" => "password updated"
        ]);
    }
}
