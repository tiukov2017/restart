<?php
namespace App\DAO\Collections;
class EntityModelCollection extends \Illuminate\Database\Eloquent\Collection
{

    /**
     * @desc Return array of the collection items after being converted to entities
     * @return array of entities
     */
    public function toEntities(){

        $entities = array();

        /** @var \App\DAO\BaseDao $item */
        foreach($this->items as $item){

            $entities[] = $item->toEntity();

        }

        return $entities;

    }

}