<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 10/07/16
 * Time: 13:26
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Services\CrmApiService;

class TestController extends Controller
{


    public function getCustomers(CrmApiService $service){

      return $service->getCustomers();

    }
    public function getUsers(CrmApiService $service){

        return $service->getUsers();
    }
    public function getOrders(CrmApiService $service){

         $service->getOrdersByStatus(1);
    }
}