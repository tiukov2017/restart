<?php

namespace App\DAO;

use App\Entities\Report;

use Illuminate\Database\Eloquent\Model;

class ReportDAO extends BaseDao
{
   protected $table = 'reports';

    protected $visible = ['object_id','object_first_name','object_last_name','english_first_name','english_last_name','customer','comment','user','type','file',
    'phone_number','mobile_number','fax','email','nickname','secondary_name','secondary_email','secondary_phone','english_nickname','secondary_english_name'
    ];

   public function user(){

        $user = $this->hasOne('App\User','id','user_fk');

        return $user->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   public function references(){

        return $this->hasMany('App\DAO\ReferenceDAO',ReferenceDAO::REPORT_FK_FIELD);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files(){

        return $this->hasMany('App\DAO\ReportFileDAO',ReportFileDAO::REPORT_FK_FIELD);
    }

    public function googleResults(){

        return $this->hasMany('App\DAO\GoogleResultDAO',GoogleResultDAO::REPORT_FK_FIELD);
    }

    public function type(){

        $type = $this->hasOne('App\DAO\ReportTypeDAO','id','type_fk');

        return $type->first();

    }

    public function status(){

        $status = $this->hasOne('App\DAO\ReportStatusDAO','id','status_fk');

        return $status->first();
    }
    /**
     * @return Report
     */
   public function toEntity()
    {
        $entity = new Report(
            $this->customer, $this->object_first_name,$this->object_last_name ,
            $this->english_first_name,$this->english_last_name,$this->object_id ,$this->type(),$this->user(),$this->status(),$this->comment);

        $entity->setId($this->id);

        $entity->setUrl($this->url);

        $entity->setDate($this->created_at);

        $entity->setReferences($this->references);

        $entity->setFiles($this->files);

        $entity->setEmail($this->email);

        $entity->setSecondaryEmail($this->secondary_email);

        $entity->setPhoneNumber($this->phone);

        $entity->setMobileNumber($this->mobile_phone);

        $entity->setFax($this->fax);

        $entity->setNickName($this->nickname);

        $entity->setSecondaryName($this->secondary_name);

        $entity->setSecondaryPhone($this->secondary_phone);

        $entity->setSecondaryEnglishName($this->secondary_english_name);

        $entity->setEnglishNickname($this->english_nickname);

        $entity->setCrmId($this->crm_id);

        return $entity;

    }


  public function fillFromEntity(Report $report)
    {
        $this->customer = $report->getCustomer();

        $this->object_first_name = $report->getObjectFirstName();

        $this->object_last_name = $report->getObjectLastName();

        $this->english_first_name=$report->getEnglishFirstName();

        $this->english_last_name=$report->getEnglishLastName();

        $this->object_id = $report->getObjectId();

        $this->url = $report->getUrl();

        $this->type_fk = $report->getType()->id;

        $this->user_fk = $report->getUser()->id;

        $this->status_fk = $report->getStatus()->id;

        $this->id = $report->getId();

        $this->comment =$report->getComment();

        $this->phone = $report->getPhoneNumber();

        $this->mobile_phone = $report->getMobileNumber();

        $this->fax = $report->getFax();

        $this->email =$report->getEmail();

        $this->nickname = $report->getNickName();

        $this->secondary_name = $report->getSecondaryName();

        $this->secondary_email = $report->getSecondaryEmail();

        $this->secondary_phone = $report->getSecondaryPhone();

        $this->english_nickname = $report->getEnglishNickname();

        $this->secondary_english_name = $report->getSecondaryEnglishName();

        $this->crm_id = $report->getCrmId();

    }

    /**
     * @param $query
     * @return mixed
     */
    public function getResultsForQueryWithTrashed($query){
        return $this->googleResults()
            ->withTrashed()
            ->where('query','=',$query);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getResultsForQuery($query){
        return $this->googleResults()
            ->where('query','=',$query);
    }

    public function getCheckedResultsByReport($reportId){
       return $this->find($reportId)
           ->googleResults()
           ->withTrashed()
           ->where(['is_checked' => true])
           ->get()
           ->toEntities();
    }


}
