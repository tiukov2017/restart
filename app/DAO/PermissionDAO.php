<?php

namespace App\DAO;


class PermissionDAO extends BaseDao
{

    protected $table = 'permissions';
    protected $fillable = ['name'];


    function toEntity() {}

}