<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 10/07/16
 * Time: 11:31
 */

namespace App\Services;


use App\Entities\Report;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;



class CrmApiService
{
    /** @var  string */
    private $api_key;
    /** @var  /GuzzleHttp/Client */
    private $client;
    /** @var string */
    private $api_base_path;

    private $user_service;

    private $customer_service;

    private $report_service;

    private $report_type_service;

    private $log;


    public function __construct(
        UserService $userService,
        CustomerService $customerService,
        ReportService $reportService,
        ReportTypeService $reportTypeService,
        ReportStatusService $reportStatusService){

        $this->api_key = config('crm-api.api_key');
        $this->api_base_path = config('crm-api.api_base_path');
        $this->client = new Client();
        $this->user_service = $userService;
        $this->customer_service = $customerService;
        $this->report_service = $reportService;
        $this->report_type_service = $reportTypeService;
        $this->report_status_service = $reportStatusService;
//        $this->log = new Logger('crm-import-log');
//        $this->log->pushHandler(new StreamHandler('storage/logs/crm-import-log.log', Logger::INFO));

    }

    /**
     * @param int $status
     * @desc Get orders from crm filtered by status
     */
    public function getOrdersByStatus($status)
    {
        $methodUrl = config('crm-api.query_path');
        $json = json_encode([
            'objecttype' => config('crm-api.orders'),
            'query' => '(statuscode = ' . $status . ')'
        ]);
        $response = $this->sendRequest('Post', $methodUrl, ['body' => $json]);

        if ($response != "Request Error") {
            $this->saveReports($response);
        }
    }

    /**
     * @param Array $jsonOrders
     * @desc save crm reports to database
     */
    private function saveReports($jsonOrders)
    {

        foreach ($jsonOrders as $order) {

            try {
                //Order id in crm
                $orderid = $order->crmorderid;
                $customerName = $order->accountidname;
                $firstName = $order->systemfield29;
                $lastName = $order->systemfield31;
                $englishFirstName = $order->systemfield39;
                $englishLastName = $order->systemfield41;
                $objectId = $order->systemfield35;
                $productId = $order->systemfield10;

                //Report type name in checknet db
                $reportTypeName = config('crm-api.' . $productId);
                $reportTypeDAO = $this->report_type_service->getTypeByName(config('constants.' . $reportTypeName));
                //Default user handles the report order
                $user = User::find(config('crm-api.default_user'));

                $reportStatusDAO = $this->report_status_service->getStatusByName(config('constants.new_status'));
                $comment = '';
                $report = new Report($customerName, $firstName, $lastName, $englishFirstName,
                    $englishLastName, $objectId, $reportTypeDAO, $user, $reportStatusDAO, $comment);

                $report->setCrmId($orderid);

                $this->report_service->create($report);

//                $this->log->info('Order with order Id:'.$orderid.' added to database');

                $this->updateOrderStatus($orderid, config('crm-api.in_progress'));

            } catch (Exception $e) {
//                $this->log->error($e);
            }
        }
//        $this->log->info(count($jsonOrders).' records imported from crm');
    }
//    public function getCustomers(){
//
//          $methodUrl = config('crm-api.customers_method_path');
//
//          $response = $this->sendRequest('Get',$methodUrl,[]);
//
//          foreach($response as $customer){
//
//              $customerId = $customer->primarykey;
//
//              $dbCustomer = $this->customer_service->getCustomerById($customerId);
//
//              if(count($dbCustomer)==0){
//
//                  $contactId = $customer->primarycontactid;
//
//                  $owner = $this->getUserById($contactId);
//
//                  $customerEntity = new Customer($customer->primarykey,$customer->accountname,$owner,$owner);
//
//                  $this->saveCustomer($customerEntity);
//
//              }
//          }
//    }

//    public function getUsers(){
//
//        $methodUrl = config('crm-api.contacts_method_path');
//
//        $response = $this->sendRequest('Get',$methodUrl,[]);
//
//        foreach($response as $user){
//
//            $dbUser = User::where('crm_id','=',$user->primaryKey)->get();
//
//            if(count($dbUser)==0){
//
//               $this->saveUser($user);
//            }
//        }
//    }

//    public function getUserById($id){
//
//        $dbUser = User::where('crm_id','=',$id)->first();
//
//        if(count($dbUser)==0){
//
//        $methodUrl = config('crm-api.query_path');
//
//            $json = json_encode(['objecttype'=>2,'query'=>'(contactid = '.$id.')']);
//
//            $body = ['body'=>$json];
//
//        $response = $this->sendRequest('Post',$methodUrl,$body);
//
//        $user = $this->saveUser($response[0]);
//
//            return $user;
//        }
//        return $dbUser;
//    }

//    public function saveUser($response){
//
//        $user =  User::create([
//            'name' => $response->fullname,
//            'email' => $response->emailaddress1,
//            'password' => bcrypt(bcrypt(str_random(6))),
//            'role' => config('constants.customer'),
//            'phone' => $response->telephone1,
//            'status' => config('constants.active'),
//            'crm_id'=>$response->contactid
//        ]);
//        return $user;
//    }

    /**
     * @param string $orderId
     * @param string $statusId
     * @desc Update order status in crm
     */
    public function updateOrderStatus($orderId, $statusId)
    {

        $updateStatusJson = json_encode(['statuscode' => $statusId]);
        $body = ['body' => $updateStatusJson];
        $this->updateOrder($orderId, $body);
    }

    /**
     * @param $id
     * @param $body
     * @desc Update order attributes
     */
    public function updateOrder($id, $body)
    {

        $methodUrl = config('crm-api.orders_method_path') . $id;
        $result = $this->sendRequest('Put', $methodUrl, $body);
//        $this->log->info('Order with order Id:'.$id.' status update result :'.$result);
    }

//    public function saveCustomer(Customer $customer){
//
//       $this->customer_service->create($customer);
//    }

    /**
     * @param string $method
     * @param string $methodUrl
     * @param array $body
     * @return \Psr\Http\Message\StreamInterface|string
     * @desc Send http request
     */
    private function sendRequest($method, $methodUrl, $body)
    {

        $url = $this->api_base_path . $methodUrl . '?tokenid=' . $this->api_key;
        $response = $this->client->request($method, $url, $body);

        if ($response->getStatusCode() == 200) {

            switch ($method) {
                case 'Put':
                    return $this->parseUpdateResponse($response->getBody());
                    break;
                case 'Post':
                    return $this->parseQueryResponse($response->getBody());
                    break;

                case 'Get':
                    return $this->parseGetResponse($response->getBody());
                    break;

                default :
//                    $this->log->info($response->getBody());

                    return 'Request Error';
            }
        } else {
//            $this->log->error($response->getReasonPhrase());
            return 'Request Error';
        }
    }

    /**
     * @param $responseBody
     * @return array
     */
    private function parseGetResponse($responseBody)
    {
        $responseJson = json_decode($responseBody);
        return $responseJson->data->Records;
    }

    /**
     * @param $responseBody
     * @return array
     */
    private function parseUpdateResponse($responseBody)
    {
        $responseJson = json_decode($responseBody);
        return $responseJson->success;
    }

    /**
     * @param $responseBody
     * @return array
     */
    private function parseQueryResponse($responseBody)
    {
        $responseJson = json_decode($responseBody);
        return $responseJson->data->Data;
    }


}