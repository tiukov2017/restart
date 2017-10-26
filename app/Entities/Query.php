<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 13/03/16
 * Time: 13:59
 */

namespace App\Entities;


use App\DAO\QueryDAO;

class Query
{
  /** @var  string */
  private $ids;
  /** @var  string */
  private $params;
  /** @var  string */
  private $templates;

  /**
   * Query constructor.
   * @param $id
   * @param $queryStr
   */
  public function __construct($ids, $params,$templates)
  {
    $this->ids = $ids;
    $this->params = $params;
    $this->templates = $templates;
  }

  /**
   * @return mixed
   */
  public function getIds()
  {
    return $this->ids;
  }

  /**
   * @param mixed $ids
   */
  public function setIds($ids)
  {
    $this->ids = $ids;
  }

  /**
   * @return mixed
   */
  public function getParams()
  {
    return $this->params;
  }

  /**
   * @param mixed $queryStr
   */
  public function setParams($params)
  {
    $this->params = $params;
  }

  public function getQueryById(QueryDAO $dao){
    $this->id=$dao->$dao["ids"];
    $this->params->$dao["params"];
  }

  /**
   * @return string
   */
  public function getTemplates()
  {
    return $this->templates;
  }

  /**
   * @param string $templates
   */
  public function setTemplates($templates)
  {
    $this->templates = $templates;
  }



}