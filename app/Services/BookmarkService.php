<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 15/05/16
 * Time: 16:35
 */

namespace App\Services;


use App\DAO\BookmarkDAO;
use App\DAO\Collections\EntityModelCollection;
use App\Entities\Bookmark;

class BookmarkService extends DbUpdateService
{

    /**
     * @param BookmarkDAO $bookmarkDAO
     */
    public function __construct(BookmarkDAO $bookmarkDAO)
    {
        $this->dao = $bookmarkDAO;
    }

    /**
     * @param $id
     * @return array
     */
    function getReportBookmarks($id){

        /** @var EntityModelCollection $bookmarks */
        $bookmarks = $this->dao->where('report_fk','=',$id)->get();
        return $bookmarks->toEntities();
    }

}