<?php

namespace App\Controllers;

use \Core\View;
/**
 * Order controller
 *
 * PHP version 7.0
 */
class Orders extends \Core\Controller
{

    private $orderRepo;
    public function __construct($route_params)
    {
        parent::__construct($route_params);
        $this->orderRepo = parent::getOrderRepo();

    }

    public function indexAction()
    {
        $allOrder=$this->orderRepo->allOrder();
        View::renderTemplate('orders.html',['allOrder'=>$allOrder,
        ]);
    }


}
