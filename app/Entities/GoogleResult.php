<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 28/11/16
 * Time: 10:26
 */

namespace App\Entities;


class GoogleResult implements IEntity
{

    private $id;
    private $reportFk;
    private $query;
    private $title;
    private $url;
    private $description;
    private $summary;
    private $queryId;
    private $deleted;
    private $is_checked;
    private $user_comments;

    /**
     * @param $reportFk
     * @param $query
     * @param $title
     * @param $url
     * @param $description
     * @param $summary
     * @param null $query_fk
     */
    public function __construct($reportFk,$query,$title,$url,$description,$summary,$query_fk=null)
    {
        $this-> reportFk = $reportFk;
        $this-> query = $query;
        $this-> title = $title;
        $this-> url = $url;
        $this->description = $description;
        $this->summary = $summary;
        $this->queryId = $query_fk;
    }

    /**
     * @return mixed
     */
    public function getReportFk()
    {
        return $this->reportFk;
    }

    /**
     * @param mixed $reportFk
     */
    public function setReportFk($reportFk)
    {
        $this->reportFk = $reportFk;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param mixed $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getQueryId()
    {
        return $this->queryId;
    }

    /**
     * @param mixed $queryId
     */
    public function setQueryId($queryId)
    {
        $this->queryId = $queryId;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param $deleted
     * @return bool
     */
    public function setDeleted($deleted)
    {
        $this->deleted = is_null($deleted) ? 0 : 1;
    }

    /**
     * @return mixed
     */
    public function getIsChecked()
    {
        return $this->is_checked;
    }

    /**
     * @param mixed $is_checked
     */
    public function setIsChecked($is_checked)
    {
        $this->is_checked = $is_checked;
    }

    /**
     * @return mixed
     */
    public function getUserComments()
    {
        return $this->user_comments;
    }

    /**
     * @param mixed $user_comments
     */
    public function setUserComments($user_comments)
    {
        $this->user_comments = $user_comments;
    }

    /**
     * @return mixed
     */
    public function getIsDomainRestricted()
    {
        return $this->is_domain_restricted;
    }

    /**
     * @param mixed $is_domain_restricted
     */
    public function setIsDomainRestricted($is_domain_restricted)
    {
        $this->is_domain_restricted = $is_domain_restricted;
    }



    public function getShortenedUrl(){
        $pattern = '/\w+\..{2,3}(?:\..{2,3})?(?:$|(?=\/))/i';
        if (preg_match($pattern, $this->url, $matches) === 1) {
            return $matches[0];
        }
        else{
            return parse_url($this->url)['host'];
        }
    }

}