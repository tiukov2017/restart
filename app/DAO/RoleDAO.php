<?php

namespace App\DAO;


class RoleDAO extends BaseDao
{

    protected $table = 'roles';
    protected $fillable = ['name'];


    function toEntity() {}

}