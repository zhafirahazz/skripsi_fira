<?php

namespace App\Controllers\Management;

use App\Controllers\BaseController;
use App\Models\Confirmation;
use App\Models\Role;
use App\Models\User;
use Exception;
use Ramsey\Uuid\Uuid;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
        $this->Role = new Role();
        $this->cfm = new Confirmation();
        $this->session = session();
    }

    public function index()
    {
        $users = $this->model
            ->select('user.*, role.role_display')
            ->orderBy('user.name', 'asc')
            ->join('role', 'user.role_id = role.id')
            ->findAll();

        return view('admin/user/index', ["users" => $users]);
    }

    public function create()
    {
        // TO DISPLAY CREATE USER VIEW
        $roles = $this->Role->find();
        return view('admin/user/create', ["roles" => $roles]);
    }

    public function store()
    {
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data = [
            "name" => $this->request->getPost('name'),
            "email" => $this->request->getPost('email'),
            "password" => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            "role_id" => $this->request->getPost('role'),
            "approved" => FALSE
        ];


        $this->model->insert($data);
        $user = $this->model->where('email', $data['email'])->first();
        $data = [
            "user_id" => $user["id"],
            "code" => Uuid::uuid4(),
            "valid_until" => (time() + 900),
            "job_type" => "VERIFY_USER"
        ];


        $this->cfm->save($data);

        $email = \Config\Services::email();
        $email->setTo($user["email"]);
        $email->setFrom('noreply@smaitabbskp.sch.id', 'Verifikasi Akun');

        $email->setSubject("Verifikasi Akun");
        $url = site_url(route_to('auth.verify', $data["code"]));
        $name = $user["name"];

        $email->setMessage("
        Hi $name,
        <br/>
        Selamat datang! Silahkan ikuti tautan berikut untuk memverifikasi akun anda :
         <br/>
         <br/>
         <a href='$url'>$url</a>
         <br/>
         <br/>
         Silahkan salin tautan tersebut dan tempelkan di peramban anda. 
         Harap diingat bahwa tautan tersebut hanya berlaku selama 15 menit. Terimakasih
         <br/>
        Tim
        ");
        if ($email->send()) {
            echo 'Email successfully sent';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }


        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = $this->model->where('id', $id)->first();
        return view('/admin/user/edit', ["user" => $user]);
    }

    public function update($id)
    {
        try {
            $user = $this->model->where('id', $id)->first();
            $data = [
                "name" => $this->request->getPost('name'),
                "email" => $this->request->getPost('email'),
                "new_password" => $this->request->getPost('new_password'),
                "c_password" => $this->request->getPost('c_password'),
                "role_id" => $this->request->getPost('role'),
            ];

            $user["name"] = $data["name"];
            $user["email"] = $data["email"];
            if (isset($data["new_password"])) {
                if ($data["new_password"] != $data["c_password"]) {
                    throw new Exception("Password dan konfirmasi password tidak sama!");
                }
                $user["password"] = password_hash($data["new_password"], PASSWORD_BCRYPT);
            }
            $this->model->save($user);

            $this->session->setFlashdata('alert_success', 'Berhasil merubah data pengguna');
            return redirect()->route('user.index');
        } catch (Exception $e) {
            $this->session->setFlashdata('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('user.index'));
    }

    public function verify($code)
    {
        $job = $this->cfm->where('code', $code)->first();

        if ($job == null) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($job["valid_until"] < time()) {
            throw PageNotFoundException::forPageNotFound("The page you are looking for already expired");
        }
        $user = $this->model->where('id', $job["user_id"])->first();

        if ($user == null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $user["approved"] = TRUE;
        $this->model->save($user);
        $this->cfm->delete($job["id"]);
        $this->cfm->where('valid_until', '<', time())->delete();


        return view('templates/auth/_header', ["title" => "Verifikasi Akun"])
            . view('auth/verify')
            . view('templates/auth/_footer');
    }

    public function requireVerification()
    {
        $uid = session()->get('uid');
        if ($uid == null) {
            return redirect()->to('/auth/login');
        }

        return view('templates/auth/_header', ["title" => "Verifikasi Akun"])
            . view('auth/verification', ['id' => $uid])
            . view('templates/auth/_footer');
    }

    public function sendVerificatin()
    {
        $this->response->setContentType('Content-Type: application/json');

        $user = $this->model->where('id', $this->request->getVar('id'))->first();

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
            "job_type" => "VERIFY_USER"
        ];

        $email = \Config\Services::email();
        // $email->setTo($user["email"]);
        $email->setTo('anang@divistant.com');
        $email->setFrom('noreply@smaitabbskp.sch.id', 'Verifikasi Akun');

        $email->setSubject("Verifikasi Akun");
        $url = site_url(route_to('auth.verify', $data["code"]));
        $name = $user["name"];

        $email->setMessage("
        Hi $name,
        <br/>
        Selamat datang! Silahkan ikuti tautan berikut untuk memverifikasi akun anda :
         <br/>
         <br/>
         <a href='$url'>$url</a>
         <br/>
         <br/>
         Silahkan salin tautan tersebut dan tempelkan di peramban anda. 
         Harap diingat bahwa tautan tersebut hanya berlaku selama 15 menit. Terimakasih
         <br/>
        Tim
        ");
        $this->cfm->save($data);

        $result = [
            "message" => "N/A"
        ];

        if ($email->send()) {
            $result = [
                "message" => "Email terkirim!"
            ];
        } else {
            $this->response->setStatusCode('500');
            return json_encode([
                "code" => 5001,
                "message" => "Error sending email, please contact admin!"
            ]);
        }

        return json_encode($result);
    }
}
