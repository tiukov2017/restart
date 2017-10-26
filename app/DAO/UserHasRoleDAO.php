<?php

namespace App\DAO;


class UserHasRoleDAO extends BaseDao
{

    protected $table = 'user_has_roles';
    protected $fillable = ['role_id', 'user_id'];


    function toEntity() {}

}