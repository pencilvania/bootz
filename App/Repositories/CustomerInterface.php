<?php

namespace App\Repositories;


interface CustomerInterface
{
    public function customerCount($from = null,$to = null);
    public function addCustomer($data);
}