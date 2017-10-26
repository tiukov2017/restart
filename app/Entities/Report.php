<?php
namespace App\Entities;

use App\DAO\ReportStatusDAO;
use App\DAO\ReportTypeDAO;
use App\User;

class Report implements IEntity
{
    /** @var  int */
    private $id;
    /** @var  string */
    private $customer;
    /** @var  string */
    private $objectFirstName;
    /** @var  string */
    private $objectLastName;
    /** @var  string */
    private $englishFirstName;
    /** @var  string */
    private $englishLastName;
    /** @var  string */
    private $objectId;
    /** @var  string */
    private $url;
    /** @var  string */
    private $date;
    /** @var  ReportTypeDAO */
    private $type;
    /** @var  ReportStatusDAO */
    private $status;
    /** @var  \App\User */
    private $user;
    /** @var  \Illuminate\Database\Eloquent\Relations\HasMany*/
    private $references;
    /** @var string */
    private $comment;
    /**@var boolean */
    private $lock;
    /** @var  string */
    private $phoneNumber;
    /** @var  string */
    private $mobileNumber;
    /** @var  string */
    private $fax;
    /** @var  string */
    private $email;
    /** @var  string */
    private $secondaryEmail;
    /** @var  string */
    private $secondaryPhone;
    /** @var  string */
    private $secondaryName;
    /** @var  string */
    private $nickName;
    /** @var  string */
    private $englishNickname;
    /** @var  string */
    private $secondaryEnglishName;
    /** @var  string */
    private $lockMessage;
    /** @var  \Illuminate\Database\Eloquent\Relations\HasMany*/
    private $files;
    /** @var  string */
    private $crmId;
    /**
     * @param $customer
     * @param $objectFirstName
     * @param $objectLastName
     * @param $englishFirstName
     * @param $englishLastName
     * @param $objectId
     * @param ReportTypeDAO $type
     * @param User $user
     * @param ReportStatusDAO $status
     * @param $comment
     */
    public function __construct($customer, $objectFirstName, $objectLastName,$englishFirstName,
        $englishLastName,
        $objectId,ReportTypeDAO $type ,User $user,ReportStatusDAO $status,$comment)
    {
        $this->customer = $customer;
        $this->objectFirstName = $objectFirstName;
        $this->englishFirstName = $englishFirstName;
        $this->englishLastName = $englishLastName;
        $this->type = $type;
        $this->user = $user;
        $this->objectLastName = $objectLastName;
        $this->objectId = $objectId;
        $this->status = $status;
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getCrmId()
    {
        return $this->crmId;
    }

    /**
     * @param string $crmId
     */
    public function setCrmId($crmId)
    {
        $this->crmId = $crmId;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    /**
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }
    /**
     * @param string $mobileNumber
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSecondaryEmail()
    {
        return $this->secondaryEmail;
    }

    /**
     * @param string $secondaryEmail
     */
    public function setSecondaryEmail($secondaryEmail)
    {
        $this->secondaryEmail = $secondaryEmail;
    }

    /**
     * @return string
     */
    public function getSecondaryPhone()
    {
        return $this->secondaryPhone;
    }

    /**
     * @param string $secondaryPhone
     */
    public function setSecondaryPhone($secondaryPhone)
    {
        $this->secondaryPhone = $secondaryPhone;
    }

    /**
     * @return string
     */
    public function getSecondaryName()
    {
        return $this->secondaryName;
    }

    /**
     * @param string $secondaryName
     */
    public function setSecondaryName($secondaryName)
    {
        $this->secondaryName = $secondaryName;
    }

    /**
     * @return string
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * @param string $nickName
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
    }

    /**
     * @return string
     */
    public function getEnglishNickname()
    {
        return $this->englishNickname;
    }

    /**
     * @param string $englishNickname
     */
    public function setEnglishNickname($englishNickname)
    {
        $this->englishNickname = $englishNickname;
    }

    /**
     * @return string
     */
    public function getSecondaryEnglishName()
    {
        return $this->secondaryEnglishName;
    }

    /**
     * @param string $secondaryEnglishName
     */
    public function setSecondaryEnglishName($secondaryEnglishName)
    {
        $this->secondaryEnglishName = $secondaryEnglishName;
    }

    /**
     * @return mixed
     */
    public function getlockMessage()
    {
        return $this->lockMessage;
    }

    /**
     * @param mixed $lockUser
     */
    public function setlockMessage($message)
    {
        $this->lockMessage = $message;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getFiles()
    {
        return $this->files;
    }
    /**
     * @param \Illuminate\Database\Eloquent\Relations\HasMany $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }
    /**
     * @return mixed
     */
    public function getLock()
    {
        return $this->lock;
    }

    public function setLock()
    {
        $this->lock = true;
    }
    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    /**
     * @return mixed
     */
    public function getReferences()
    {
        return $this->references;
    }
    /**
     * @param mixed $references
     */
    public function setReferences($references)
    {
        $this->references = $references;
    }
    /**
     * @return string
     */
    public function getEnglishFirstName()
    {
        return $this->englishFirstName;
    }
    /**
     * @param string $englishFirstName
     */
    public function setEnglishFirstName($englishFirstName)
    {
        $this->englishFirstName = $englishFirstName;
    }
    /**
     * @return string
     */
    public function getEnglishLastName()
    {
        return $this->englishLastName;
    }
    /**
     * @param string $englishLastName
     */
    public function setEnglishLastName($englishLastName)
    {
        $this->englishLastName = $englishLastName;
    }
    /**
     * @return ReportStatusDAO
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    /**
     * @return string
     */
    public function getObjectLastName()
    {
        return $this->objectLastName;
    }
    /**
     * @param string $objectLastName
     */
    public function setObjectLastName($objectLastName)
    {
        $this->objectLastName = $objectLastName;
    }

    /**
     * @return string
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * @param string $objectId
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return  $this->url ;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param string $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return string
     */
    public function getObjectFirstName()
    {
        return $this->objectFirstName;
    }

    /**
     * @param string $objectFirstName
     */
    public function setObjectFirstName($objectFirstName)
    {
        $this->objectFirstName = $objectFirstName;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return ReportTypeDAO
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \App\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \App\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @desc Returns the path to the published version of the report.
     * @return string
     */
    public function getPublishedVersionPath()
    {
        $filePath = $this->getUrl();
        $extension_pos = strrpos($filePath, '.'); // find position of the last dot, so where the extension starts
        $clientVersionPath = substr($filePath, 0, $extension_pos) . '_final' . substr($filePath, $extension_pos);

        return $clientVersionPath;
    }
}