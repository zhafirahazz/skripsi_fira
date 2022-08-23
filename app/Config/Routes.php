<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group('auth', static function ($route) {
    $route->get('login', 'Auth\LoginController::index', ["as" => "login"]);
    $route->post('login', 'Auth\LoginController::login', ["as" => "do.login"]);
    $route->get('logout', 'Auth\LoginController::logout', ["as" => "logout"]);
});

$routes->group('admin', ['filter' => 'auth-filter'], static function ($route) {
    $route->get('', 'Admin\DashboardController::index', ["as" => "dashboard.index"]);
    $route->group('profile', static function ($profileRoute) {
        $profileRoute->get('', 'Management\ProfileController::index', ["as" => "profile.index"]);
        $profileRoute->get('(:num)/edit', 'Management\ProfileController::edit/$1', ["as" => "profile.edit"]);
        $profileRoute->post('(:num)/edit', 'Management\ProfileController::update/$1', ["as" => "profile.update"]);
        $profileRoute->post('(:num)/update', 'Management\ProfileController::updatePassword/$1', ["as" => "profile.update.pwd"]);
    });
    $route->group('user', static function ($userRoute) {
        $userRoute->get('', 'Management\UserController::index', ["as" => "user.index"]);
        $userRoute->get('new', 'Management\UserController::create', ["as" => "user.create"]);
        $userRoute->post('store', 'Management\UserController::store', ["as" => "user.store"]);
        $userRoute->post('(:num)/delete', 'Management\UserController::delete/$1', ["as" => "user.delete"]);
        $userRoute->get('(:num)/edit', 'Management\UserController::edit/$1', ["as" => "user.edit"]);
        $userRoute->post('(:num)', 'Management\UserController::update/$1', ["as" => "user.update"]);
    });
    $route->group('student', static function ($studentRoute) {
        $studentRoute->get('', 'Management\StudentController::index', ["as" => "student.index"]);
        $studentRoute->get('new', 'Management\StudentController::create', ["as" => "student.create"]);
        $studentRoute->post('store', 'Management\StudentController::store', ["as" => "student.store"]);
        $studentRoute->get('(:num)/edit', 'Management\StudentController::edit/$1', ["as" => "student.edit"]);
        $studentRoute->post('(:num)/edit', 'Management\StudentController::update/$1', ["as" => "student.update"]);
        $studentRoute->post('(:num)/delete', 'Management\StudentController::delete/$1', ["as" => "student.delete"]);
    });
    $route->group('teacher', static function ($teacherRoute) {
        $teacherRoute->get('', 'Management\TeacherController::index', ["as" => "teacher.index"]);
        $teacherRoute->get('new', 'Management\TeacherController::create', ["as" => "teacher.create"]);
        $teacherRoute->post('store', 'Management\TeacherController::store', ["as" => "teacher.store"]);
        $teacherRoute->get('(:num)/edit', 'Management\TeacherController::edit/$1', ["as" => "teacher.edit"]);
        $teacherRoute->post('(:num)/edit', 'Management\TeacherController::update/$1', ["as" => "teacher.update"]);
        $teacherRoute->post('(:num)/delete', 'Management\TeacherController::delete/$1', ["as" => "teacher.delete"]);
    });
    $route->group('cost', static function ($costRoute) {
        $costRoute->group('procurement', static function ($procRoute) {
            $procRoute->get('', 'Cost\ProcurementController::index', ["as" => "procurement.index"]);
            $procRoute->get('new', 'Cost\ProcurementController::create', ["as" => "procurement.create"]);
            $procRoute->post('store', 'Cost\ProcurementController::store', ["as" => "procurement.store"]);
            $procRoute->get('(:num)/edit', 'Cost\ProcurementController::edit/$1', ["as" => "procurement.edit"]);
            $procRoute->post('(:num)/edit', 'Cost\ProcurementController::update/$1', ["as" => "procurement.update"]);
            $procRoute->post('(:num)/delete', 'Cost\ProcurementController::delete/$1', ["as" => "procurement.delete"]);
            $procRoute->get('(:num)', 'Cost\ProcurementController::read/$1', ["as" => "procurement.read"]);
            $procRoute->get('(:num)/item/new', 'Cost\ProcurementController::itemCreate/$1', ["as" => "procurement.item.create"]);
            $procRoute->post('(:num)/item/store', 'Cost\ProcurementController::itemStore/$1', ["as" => "procurement.item.store"]);
            $procRoute->get('(:num)/item/(:num)/edit', 'Cost\ProcurementController::itemEdit/$1/$2', ["as" => "procurement.item.edit"]);
            $procRoute->post('(:num)/item/(:num)/edit', 'Cost\ProcurementController::itemUpdate/$1/$2', ["as" => "procurement.item.update"]);
            $procRoute->post('(:num)/item/(:num)/delete', 'Cost\ProcurementController::itemDelete/$1/$2', ["as" => "procurement.item.delete"]);
        });
        $costRoute->group('startup', static function ($startupRoute) {
            $startupRoute->get('', 'Cost\StartupController::index', ["as" => "startup.index"]);
            $startupRoute->get('new', 'Cost\StartupController::create', ["as" => "startup.create"]);
            $startupRoute->get('(:num)', 'Cost\StartupController::read/$1', ["as" => "startup.read"]);
            $startupRoute->post('store', 'Cost\StartupController::store', ["as" => "startup.store"]);
            $startupRoute->get('(:num)/edit', 'Cost\StartupController::edit/$1', ["as" => "startup.edit"]);
            $startupRoute->post('(:num)/edit', 'Cost\StartupController::update/$1', ["as" => "startup.update"]);
            $startupRoute->post('(:num)/delete', 'Cost\StartupController::delete/$1', ["as" => "startup.delete"]);
            $startupRoute->get('(:num)/item/new', 'Cost\StartupController::itemCreate/$1', ["as" => "startup.item.create"]);
            $startupRoute->post('(:num)/item/store', 'Cost\StartupController::itemStore/$1', ["as" => "startup.item.store"]);
            $startupRoute->get('(:num)/item/(:num)/edit', 'Cost\StartupController::itemEdit/$1/$2', ["as" => "startup.item.edit"]);
            $startupRoute->post('(:num)/item/(:num)/edit', 'Cost\StartupController::itemUpdate/$1/$2', ["as" => "startup.item.update"]);
            $startupRoute->post('(:num)/item/(:num)/delete', 'Cost\StartupController::itemDelete/$1/$2', ["as" => "startup.item.delete"]);
        });
        $costRoute->group('project_related', static function ($projectrelatedRoute) {
            $projectrelatedRoute->get('', 'Cost\ProjectRelatedController::index', ["as" => "projectrelated.index"]);
            $projectrelatedRoute->get('new', 'Cost\ProjectRelatedController::create', ["as" => "projectrelated.create"]);
            $projectrelatedRoute->get('(:num)', 'Cost\ProjectRelatedController::read/$1', ["as" => "projectrelated.read"]);
            $projectrelatedRoute->post('store', 'Cost\ProjectRelatedController::store', ["as" => "projectrelated.store"]);
            $projectrelatedRoute->get('(:num)/edit', 'Cost\ProjectRelatedController::edit/$1', ["as" => "projectrelated.edit"]);
            $projectrelatedRoute->post('(:num)/edit', 'Cost\ProjectRelatedController::update/$1', ["as" => "projectrelated.update"]);
            $projectrelatedRoute->post('(:num)/delete', 'Cost\ProjectRelatedController::delete/$1', ["as" => "projectrelated.delete"]);
            $projectrelatedRoute->get('(:num)/item/new', 'Cost\ProjectRelatedController::itemCreate/$1', ["as" => "projectrelated.item.create"]);
            $projectrelatedRoute->post('(:num)/item/store', 'Cost\ProjectRelatedController::itemStore/$1', ["as" => "projectrelated.item.store"]);
            $projectrelatedRoute->get('(:num)/item/(:num)/edit', 'Cost\ProjectRelatedController::itemEdit/$1/$2', ["as" => "projectrelated.item.edit"]);
            $projectrelatedRoute->post('(:num)/item/(:num)/edit', 'Cost\ProjectRelatedController::itemUpdate/$1/$2', ["as" => "projectrelated.item.update"]);
            $projectrelatedRoute->post('(:num)/item/(:num)/delete', 'Cost\ProjectRelatedController::itemDelete/$1/$2', ["as" => "projectrelated.item.delete"]);
        });
        $costRoute->group('ongoing', static function ($ongoingRoute) {
            $ongoingRoute->get('', 'Cost\OngoingController::index', ["as" => "ongoing.index"]);
            $ongoingRoute->get('new', 'Cost\OngoingController::create', ["as" => "ongoing.create"]);
            $ongoingRoute->get('(:num)', 'Cost\OngoingController::read/$1', ["as" => "ongoing.read"]);
            $ongoingRoute->post('store', 'Cost\OngoingController::store', ["as" => "ongoing.store"]);
            $ongoingRoute->get('(:num)/edit', 'Cost\OngoingController::edit/$1', ["as" => "ongoing.edit"]);
            $ongoingRoute->post('(:num)/edit', 'Cost\OngoingController::update/$1', ["as" => "ongoing.update"]);
            $ongoingRoute->post('(:num)/delete', 'Cost\OngoingController::delete/$1', ["as" => "ongoing.delete"]);
            $ongoingRoute->get('(:num)/item/new', 'Cost\OngoingController::itemCreate/$1', ["as" => "ongoing.item.create"]);
            $ongoingRoute->post('(:num)/item/store', 'Cost\OngoingController::itemStore/$1', ["as" => "ongoing.item.store"]);
            $ongoingRoute->get('(:num)/item/(:num)/edit', 'Cost\OngoingController::itemEdit/$1/$2', ["as" => "ongoing.item.edit"]);
            $ongoingRoute->post('(:num)/item/(:num)/edit', 'Cost\OngoingController::itemUpdate/$1/$2', ["as" => "ongoing.item.update"]);
            $ongoingRoute->post('(:num)/item/(:num)/delete', 'Cost\OngoingController::itemDelete/$1/$2', ["as" => "ongoing.item.delete"]);
        });
    });
    $route->group('benefit', static function ($benefitRoute) {
        $benefitRoute->group('tangible', static function ($tangibleRoute) {
            $tangibleRoute->get('', 'Benefit\TangibleController::index', ["as" => "tangible.index"]);
            $tangibleRoute->get('new', 'Benefit\TangibleController::create', ["as" => "tangible.create"]);
            $tangibleRoute->post('store', 'Benefit\TangibleController::store', ["as" => "tangible.store"]);
            $tangibleRoute->get('(:num)/edit', 'Benefit\TangibleController::edit/$1', ["as" => "tangible.edit"]);
            $tangibleRoute->post('(:num)/edit', 'Benefit\TangibleController::update/$1', ["as" => "tangible.update"]);
            $tangibleRoute->post('(:num)/delete', 'Benefit\TangibleController::delete/$1', ["as" => "tangible.delete"]);
        });
        $benefitRoute->group('intangible', static function ($intangibleRoute) {
            $intangibleRoute->get('', 'Benefit\IntangibleController::index', ["as" => "intangible.index"]);
            $intangibleRoute->get('new', 'Benefit\IntangibleController::create', ["as" => "intangible.create"]);
            $intangibleRoute->post('store', 'Benefit\IntangibleController::store', ["as" => "intangible.store"]);
            $intangibleRoute->get('(:num)/edit', 'Benefit\IntangibleController::edit/$1', ["as" => "intangible.edit"]);
            $intangibleRoute->post('(:num)/edit', 'Benefit\IntangibleController::update/$1', ["as" => "intangible.update"]);
            $intangibleRoute->post('(:num)/delete', 'Benefit\IntangibleController::delete/$1', ["as" => "intangible.delete"]);
        });
    });
    $route->group('benefit_value', static function ($benefitValueRoute) {
        $benefitValueRoute->get('', 'Value\BenefitValueController::index', ["as" => "benefit_value.index"]);
        $benefitValueRoute->get('new', 'Value\BenefitValueController::create', ["as" => "benefit_value.create"]);
        $benefitValueRoute->post('store', 'Value\BenefitValueController::store', ["as" => "benefit_value.store"]);
        $benefitValueRoute->get('(:num)/edit', 'Value\BenefitValueController::edit/$1', ["as" => "benefit_value.edit"]);
        $benefitValueRoute->post('(:num)/edit', 'Value\BenefitValueController::update/$1', ["as" => "benefit_value.update"]);
        $benefitValueRoute->post('(:num)/delete', 'Value\BenefitValueController::delete/$1', ["as" => "benefit_value.delete"]);
    });
    $route->group('cost_value', static function ($costValueRoute) {
        $costValueRoute->get('', 'Value\CostValueController::index', ["as" => "cost_value.index"]);
        $costValueRoute->get('new', 'Value\CostValueController::create', ["as" => "cost_value.create"]);
        $costValueRoute->post('store', 'Value\CostValueController::store', ["as" => "cost_value.store"]);
        $costValueRoute->get('(:num)/edit', 'Value\CostValueController::edit/$1', ["as" => "cost_value.edit"]);
        $costValueRoute->post('(:num)/edit', 'Value\CostValueController::update/$1', ["as" => "cost_value.update"]);
        $costValueRoute->post('(:num)/delete', 'Value\CostValueController::delete/$1', ["as" => "cost_value.delete"]);
    });
    $route->group('project_value', static function ($projectValueRoute) {
        $projectValueRoute->get('', 'Value\ProjectValueController::index', ["as" => "project_value.index"]);
    });
    $route->group('criteria', static function ($criteriaRoute) {
        $criteriaRoute->group('npv', static function ($npvRoute) {
            $npvRoute->get('', 'Calculator\NPV::index', ["as" => "npv.index"]);
            //$npvRoute->get('', 'Calculator\NPV::output', ["as" => "npv.output"]);
        });
        $criteriaRoute->group('bcr', static function ($bcrRoute) {
            $bcrRoute->get('', 'Calculator\BCR::index', ["as" => "bcr.index"]);
            //$bcrRoute->post('', 'Calculator\BCR::hitung', ["as" => "bcr.hitung"]);
            //$bcrRoute->get('', 'Calculator\BCR::output', ["as" => "bcr.output"]);
        });
        $criteriaRoute->group('irr', static function ($irrRoute) {
            $irrRoute->get('', 'Calculator\IRR::index', ["as" => "irr.index"]);
        });
        $criteriaRoute->group('pp', static function ($ppRoute) {
            $ppRoute->get('', 'Calculator\PP::index', ["as" => "pp.index"]);
        });
        $criteriaRoute->group('roi', static function ($roiRoute) {
            $roiRoute->get('', 'Calculator\ROI::index', ["as" => "roi.index"]);
            //$roiRoute->get('', 'Calculator\ROI::output', ["as" => "roi.output"]);
        });
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
