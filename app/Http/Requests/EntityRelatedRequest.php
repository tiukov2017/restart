<?php

namespace App\Http\Requests;

use App\Entities\Report;
use Illuminate\Foundation\Http\FormRequest;

abstract class EntityRelatedRequest extends Request
{

    abstract function requestToEntity();

    /**
     * @param Report $report
     * @return Report
     */
    protected function fillReportEntityOptionalFields(Report $report){

        //Optional fields
        $phone = $this->get('phone');

        $mobile = $this->get('mobile');

        $fax = $this->get('fax');

        $email = $this->get('email');

        $secondaryEmail = $this->get('secondary-email');

        $nickname = $this->get('nickname');

        $englishNickname = $this->get('english-nickname');

        $secondaryName = $this->get('secondary-name');

        $secondaryPhone = $this->get('secondary-phone');

        $secondaryEnglishName = $this->get('secondary-english-name');

        $report->setPhoneNumber($phone);

        $report->setMobileNumber($mobile);

        $report->setFax($fax);

        $report->setEmail($email);

        $report->setSecondaryEmail($secondaryEmail);

        $report->setNickName($nickname);

        $report->setSecondaryName($secondaryName);

        $report->setSecondaryPhone($secondaryPhone);

        $report->setEnglishNickname($englishNickname);

        $report->setSecondaryEnglishName($secondaryEnglishName);

        return $report;
    }
}
