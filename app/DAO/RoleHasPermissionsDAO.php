<?php

namespace App\DAO;


class RoleHasPermissionsDAO extends BaseDao
{

    protected $table = 'role_has_permissions';
    protected $fillable = ['permission_id', 'role_id'];


    function toEntity() {}

}