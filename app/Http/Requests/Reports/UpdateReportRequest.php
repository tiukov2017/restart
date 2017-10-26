<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 27/06/16
 * Time: 18:39
 */

namespace App\Http\Requests\Reports;


use App\Entities\Report;
use App\Http\Requests\EntityRelatedRequest;

class UpdateReportRequest extends EntityRelatedRequest
{
    function rules(){

        return [];
    }

    function authorize()
    {
        return true;
    }
    function requestToEntity(){

    }

    /**
     * @param Report $report
     * @return Report
     */
   public function proccessReportUpdateRequest(Report $report){

        $objectId = $this->get('objectId');

        $firstName = $this->get('objectFirstName');

        $lastName = $this->get('objectLastName');

        $englishFirstName = $this->get('englishFirstName');

        $englishLastName = $this->get('englishLastName');

        $customer = $this->get('customer');

        $report->setObjectId($objectId);

        $report->setEnglishFirstName($englishFirstName);

        $report->setEnglishLastName($englishLastName);

        $report->setObjectLastName($lastName);

        $report->setObjectFirstName($firstName);

        $report->setCustomer($customer);

        $report = $this->fillReportEntityOptionalFields($report);

        return $report ;

    }



}