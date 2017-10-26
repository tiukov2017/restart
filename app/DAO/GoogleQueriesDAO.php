<?php

namespace App\DAO;


class GoogleQueriesDAO extends BaseDao
{
    protected $table = 'google_queries';
    protected $fillable = ['ids', 'params', 'templates'];


    function toEntity() {}
}