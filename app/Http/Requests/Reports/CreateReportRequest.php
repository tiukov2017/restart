<?php

namespace App\Http\Requests\Reports;


use App\DAO\ReportStatusDAO;
use App\DAO\ReportTypeDAO;
use App\Entities\Report;
use App\Http\Requests\EntityRelatedRequest;
use App\User;

class CreateReportRequest extends EntityRelatedRequest
{

    function rules()
    {
        return [
            'objectId' => 'required',
            'type' => 'required',
            'customer' => 'required',
            'englishFirstName'=>'required',
             'englishLastName'=>'required',
             'objectFirstName'=>'required',
             "objectLastName"=>'required',
             'files[]'=>'mimes:jpeg,bmp,png,pdf,docx'
        ];

    }

    function authorize()
    {
        return true;
    }

    function requestToEntity()
    {
        $customer = $this->get("customer");

        $objectFirstName = $this->get("objectFirstName");

        $objectLastName = $this->get("objectLastName");

        $englishFirstName = $this->get("englishFirstName");

        $englishLastName = $this->get("englishLastName");

        $objectId = $this->get("objectId");

        $comment = $this->get('comment');

        $type = ReportTypeDAO::find(intval($this->get("type")));

        $user = User::find(intval($this->get("user")));

        $status = ReportStatusDAO::where('name', '=', 'in_progress')->first();

        $report = new Report($customer, $objectFirstName, $objectLastName, $englishFirstName, $englishLastName,
            $objectId, $type, $user, $status, $comment);

        $report =  $this->fillReportEntityOptionalFields($report);

        return $report;
    }
}
