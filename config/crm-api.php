<?php
return [

     'api_key'=>'49bb2bf3-258e-442f-81f7-a2870b0a0681',
    /*
    |Api methods paths
    */
    'api_base_path'=>'https://secure.powerlink.co.il/api/',

     'customers_method_path'=>'record/account/',

     'orders_method_path'=>'record/CrmOrder/',

     'contacts_method_path'=>'record/Contact/',

      'query_path'=>'query/',

    /*
  |Crm order statuses
  */
    'new'=>'1',
    'in_progress'=>'3',
    'closed'=>'2',
    /*
    |Crm order default user id
    */
     'default_user'=>env('CRM_REPORT_DEFAULT_USER',1),
      /*
     |Crm product id(report type)
     */
       '9bb9d55a-62ec-4ef3-b8d5-de26aa1f6961'=>'expanded',
        'be9e2840-d2a8-449e-b2d5-e3d4320b5071'=>'standard',
    /*
   |Crm records id's
   */
    'orders'=>'13'

];