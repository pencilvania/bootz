<?php

namespace App\Controllers;

use \Core\View;
use App\Repositories\OrderInterface;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    private $orderRepo;
    private $customerRepo;
    public function __construct($route_params)
    {
        parent::__construct($route_params);
        $this->orderRepo = parent::getOrderRepo();
        $this->customerRepo = parent::getCustomerRepo();

    }

    public function indexAction()
    {
        $allOrder=$this->orderRepo->chartGenerator();
        $orderCount=$this->orderRepo->getOrderCount();
        $customerCount=$this->customerRepo->customerCount();
        $totalRevenue = $this->orderRepo->getTotalRevenue();
        View::renderTemplate('index.html',['allOrder'=>$allOrder,
            'count'=>$orderCount,
            'customerCount'=>$customerCount,
            'totalRevenue'=>$totalRevenue,
        ]);
    }

    public function filterDateAction()
    {
       $from=$_GET['from'];
       $to=$_GET['to'];
        $allOrder=$this->orderRepo->chartGenerator();
        $orderCount=$this->orderRepo->getOrderCount($from,$to);
        $customerCount=$this->customerRepo->customerCount($from,$to);
        $totalRevenue = $this->orderRepo->getTotalRevenue($from,$to);
        View::renderTemplate('index.html',['allOrder'=>$allOrder,
            'count'=>$orderCount,
            'customerCount'=>$customerCount,
            'totalRevenue'=>$totalRevenue,
        ]);
    }

}
