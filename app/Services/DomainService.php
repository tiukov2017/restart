<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 02/05/16
 * Time: 16:33
 */

namespace App\Services;


use App\DAO\Collections\EntityModelCollection;
use App\DAO\DomainDAO;
use App\Entities\Domain;
use Mockery\CountValidator\Exception;

class DomainService extends DbUpdateService
{
    /**
     * @param DomainDAO $domainDAO
     */
    public function __construct(DomainDAO $domainDAO)
    {
        $this->dao = $domainDAO;
    }

    /**
     * @return array
     */
    public function getDomainsArray(){

       $domains = $this->getAll();

        $domainsArr = array_map(function($filter) {
            return $filter->getDomain();

        }, $domains);
        return $domainsArr;
    }

    /**
     * @desc Return all the restricted domains
     * @return Domain[]
     */
    public function getAll(){

        /** @var EntityModelCollection $domains */
        $domains = $this->dao->all();
        return $domains->toEntities();

    }

}