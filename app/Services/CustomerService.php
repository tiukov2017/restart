<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 11/07/16
 * Time: 11:55
 */

namespace App\Services;


use App\DAO\CustomerDAO;

class CustomerService extends DbUpdateService
{

    /**
     * @param CustomerDAO $customerDAO
     */
    public function __construct(CustomerDAO $customerDAO)
    {
        $this-> dao = $customerDAO;
    }

    public function getCustomerById($id){

        return $this->dao->where('account_id','=',$id)->get();
    }
}