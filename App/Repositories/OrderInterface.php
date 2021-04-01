<?php

namespace App\Repositories;


interface OrderInterface
{
    public function allOrder();
    public function chartGenerator();
    public function getOrderCount($from = null,$to = null);
    public function getTotalRevenue($from = null,$to = null);

}