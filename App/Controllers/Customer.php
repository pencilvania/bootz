<?php

namespace App\Controllers;

use Core\Util;
use \Core\View;

/**
 * Customer controller
 *
 * PHP version 7.0
 */
class Customer extends \Core\Controller
{

    private $customerRepo;

    public function __construct($route_params)
    {
        parent::__construct($route_params);
        $this->customerRepo = parent::getCustomerRepo();

    }

    public function indexAction()
    {

        View::renderTemplate('addCustomer.html');
    }


    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'created_at' => trim($_POST['date'])
            ];

            if ($this->customerRepo->addCustomer($data)) {
                $util = new Util();
                $util->url();
                header("Location:" . $util->url() . "/../..");
                die();
            } else {
                die('Failed on add product');
            }

        } else {

            View::render('addCustomer.html');
        }
    }


}
