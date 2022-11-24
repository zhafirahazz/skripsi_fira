<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Cost;
use App\Models\CostItem;
use App\Models\User;

use function PHPSTORM_META\map;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->Cost = new Cost();
        $this->Benefit = new Benefit();
        $this->CostItem = new CostItem();
        $this->Category = new Category();
        $this->User = new User();
    }
    //

    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT category.category_display as display,
        (SELECT SUM(cost.quantity * (SELECT AVG(cost_item.quantity * cost_item.unit_price) FROM `cost_item` WHERE cost_item.cost_id = cost.id)) as price
        FROM `cost` WHERE cost.category_id = category.id) as total
        FROM `category` WHERE category.category_name IN ('procurement', 'startup', 'project_related', 'ongoing')")->getResult();

        $user_count = $db->query("SELECT COUNT(id) as count FROM user")->getResult();
        $teacher_count = $db->query("SELECT COUNT(id) as count FROM teacher")->getResult();
        $student_count = $db->query("SELECT COUNT(A.id) as count, B.class_name, B.class_display FROM student as A INNER JOIN class as B on A.class_id = B.id GROUP BY B.class_name;")->getResult();
        $student_pie = [
            "label" => array_map(function($element){
                return $element->class_display;
            }, $student_count),
            "values"=> array_map(function($element){
                return $element->count;
            }, $student_count)
        ];
        $cost_statistics = $db->query("SELECT sum(quantity * price) as total, A.category_id,B.category_name, B.category_display FROM (SELECT cost.id, cost.quantity,cost.category_id, (select avg(cost_item.quantity * cost_item.unit_price) from cost_item WHERE cost_item.cost_id = cost.id) as price from cost) as A JOIN category as B ON A.category_id = B.id GROUP BY A.category_id ORDER BY A.category_id")->getResult();

        $benefit_statistics = $db->query("SELECT SUM(A.quantity * A.unit_price) as total, B.category_display FROM benefit as A JOIN category as B ON A.category_id = B.id GROUP BY A.category_id;")->getResult();

        $cost_value_statistics = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $cost_chart = [
            "label"=>array_map(function($e){
                return $e->name_cost;
            }, $cost_value_statistics),
            "values"=>array_map(function($e){
                return $e->price;
            }, $cost_value_statistics)
        ];

        $benefit_value_statistics = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $benefit_chart = [
            "label"=>array_map(function($e){
                return $e->name_benefit;
            }, $benefit_value_statistics),
            "values"=>array_map(function($e){
                return $e->nominal;
            }, $benefit_value_statistics)
        ];

        return view('admin/dashboard', [
            "cost" => $query,
            "user_count" => $user_count,
            "teacher_count"=> $teacher_count,
            "student_count"=>$student_pie,
            "cost_stat"=>$cost_statistics,
            "benefit_stat"=>$benefit_statistics,
            "cost_chart"=>$cost_chart,
            "benefit_chart"=>$benefit_chart
        ]);
    }
}
