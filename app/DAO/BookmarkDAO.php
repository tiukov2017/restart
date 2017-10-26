<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 15/05/16
 * Time: 16:13
 */

namespace App\DAO;


use App\Entities\Bookmark;

class BookmarkDAO extends ReportRelatedDAO
{
  protected  $table = "bookmarks";

    function toEntity()
    {
        $entity = new Bookmark($this->report(),$this->title,$this->url);

        $entity->setId($this->id);

        return $entity;
    }

    function fillFromEntity(Bookmark $bookmark){

         $this->id = $bookmark->getId();

         $this->title = $bookmark->getTitle();

         $this->url = $bookmark->getUrl();

         $this->report_fk = $bookmark->getReport()->getId();

    }


}