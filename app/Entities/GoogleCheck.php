<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 10/03/16
 * Time: 11:18
 */

namespace App\Entities;


class GoogleCheck extends Check
{
  /** @var  array */
  private $queriesArr;

  /**
   * @param $url
   * @param $checkNumber
   * @param $field
   * @param $queries
   * @param $name
   * @param $location
   * @param $inputFields
   * @param $type
   * @param $guidelines
   */
  public function __construct($url,$checkNumber,$field,$queries,$name,$location,$inputFields,$type,$guidelines)
  {
    parent::__construct($url,$checkNumber,$field,$name,$location,$inputFields,$type,$guidelines);
    $this->queriesArr = $queries;
  }

  /**
   * @return mixed
   */
  public function getQueries()
  {
    return $this->queriesArr;
  }

  /**
   * @param mixed $queries
   */
  public function setQueries($queries)
  {
    $this->queriesArr = $queries;
  }


}