<?php
namespace App\DAO;


use App\DAO\Collections\EntityModelCollection;
use App\Entities\BaseEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class  BaseDao extends Model
{
    abstract function toEntity();

    /**
     * Create a new Eloquent Collection instance as an extended EntityModelCollection.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new EntityModelCollection($models);
    }

}