<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 15/05/16
 * Time: 16:44
 */

namespace App\Services;


use App\Entities\IEntity;
use Exception;

class DbUpdateService
{
    protected $dao;

    /**
     * @param IEntity $entity
     * @return IEntity|string
     */
    public function create(IEntity $entity ){
        try{
            $this->dao->fillFromEntity($entity);
            $this->dao->save();
            $entity = $this->dao->toEntity();
            return $entity;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    /**
     * @param $id
     * @return bool|string
     */
    public function delete($id){

        try{
            $dao = $this->dao->findOrFail($id);
            $dao->delete();
            return true;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * @param IEntity $entity
     * @return bool|string
     */
    public function update(IEntity $entity ){

        try{
            $dao = $this->dao->findOrFail($entity->getId());
            $dao->fillFromEntity($entity);
            $dao->save();
            return true;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}