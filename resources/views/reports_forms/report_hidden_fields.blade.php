<form id="hidden-report-data">

<input type="hidden" name="reportId" data-prop="reportId" value="{{$report->getId()}}">

<input type="hidden" name="objectId" data-prop="objectId" value="{{$report->getObjectId()}}">

<input type="hidden" name="objectFirstName" data-prop="objectFirstName" value="{{$report->getObjectFirstName()}}">

<input type="hidden" name="objectLastName" data-prop="objectLastName" value="{{$report->getObjectLastName()}}">

<input type="hidden" name="englishLastName" data-prop="englishLastName" value="{{$report->getEnglishLastName()}}">

<input type="hidden" name="englishFirstName" data-prop="englishFirstName" value="{{$report->getEnglishFirstName()}}">

<input type="hidden" name="comment" data-prop="comment" value="{{$report->getComment()}}"/>

<input type="hidden" name="phone" data-prop="phone" value="{{$report->getPhoneNumber()}}">

<input type="hidden" name="mobile" data-prop="mobile" value="{{$report->getMobileNumber()}}">

<input type="hidden" name="fax" data-prop="fax" value="{{$report->getFax()}}">

<input type="hidden" name="email" data-prop="email" value="{{$report->getEmail()}}">

<input type="hidden" name="nickname" data-prop="nickname" value="{{$report->getNickname()}}">

<input type="hidden" name="secondary-name" data-prop="secondary-name" value="{{$report->getSecondaryName()}}">

<input type="hidden" name="secondary-email" data-prop="secondary-email" value="{{$report->getSecondaryEmail()}}">

<input type="hidden" name="secondary-phone" data-prop="secondary-phone" value="{{$report->getSecondaryPhone()}}">

<input type="hidden" name="english-nickname" data-prop="english-nickname" value="{{$report->getEnglishNickname()}}">

<input type="hidden" name="secondary-english-name" data-prop="secondary-english-name" value="{{$report->getSecondaryEnglishName()}}">

<input type="hidden" name="customer" data-prop="customer" value="{{$report->getCustomer()}}">

<input type="hidden" name="full-name" data-prop="full-name" value="{{$report->getObjectFirstName().' '.$report->getObjectLastName() }}">

<input type="hidden" name="english-full-name" data-prop="english-full-name" value="{{$report->getEnglishFirstName().' '.$report->getEnglishLastName() }}">

</form>