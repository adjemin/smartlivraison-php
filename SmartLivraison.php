<?php

namespace App\Utils\SmartLivraison;
use App\Utils\SmsCompaigns\BaseApi;
use Symfony\Component\HttpFoundation\ParameterBag;

class SmartLivraison extends BaseApi{

    /**
     * The base URL for the Smart Livraison Api
     */
    private $base_api_url = "https://api.smartlivraison.com";

    private $clientId;
    private $clientSecret;

    /**
     * Initializinz the Class
     * 
     */
    public function __construct($client_id, $client_secret){
        parent::__construct($this->getBaseApiUrl());
        $this->clientId = $client_id;
        $this->clientSecret = $client_secret;
    }

    /**
     * Return the base api url property
     *
     * @return void
     */
    public function getBaseApiUrl()
    {
        return $this->base_api_url;
    }

    /**
     * Return the Client's ID
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Return the Client's Secret
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }



    /**
     * Find Task by Id
     * @param $task_id
     * @return ParameterBag
     */
    public function findTaskById($task_id)
    {
        
        if(!is_string($task_id) || !is_int($task_id)){
            throw new Exception('task_id is invalid'); 
        }

        if(empty($task_id)){
            throw new Exception('task_id is required'); 
        }

        $jsonToken = $this->obtainToken();

        if(!empty($jsonToken) && $jsonToken->get('access_token') != null){
                    // Scafolding request's options
            $options = [
                'headers'=> [
                    'Accept: application/json',
                    'Cache-Control: no-cache',
                    'Authorization: Bearer '.$jsonToken->get('access_token')
                ]
            ];
            // Sending POST Request
            $result =  $this->get('v1/tasks/'.$task_id, $options);

            $result = (array)json_decode($result, true);

            //Transfor array to @ParameterBag
            $resultJson = new ParameterBag($result);

            return $resultJson;


        }else{
            return $jsonToken;
        }


    }

    /**
     * Find Job by Id
     * @param $job_id
     * @return ParameterBag
     */
    public function findJobById($job_id)
    {
        
        if(!is_string($job_id) || !is_int($job_id)){
            throw new Exception('job_id is invalid'); 
        }

        if(empty($job_id)){
            throw new Exception('job_id is required'); 
        }

        $jsonToken = $this->obtainToken();

        if(!empty($jsonToken) && $jsonToken->get('access_token') != null){
                    // Scafolding request's options
            $options = [
                'headers'=> [
                    'Accept: application/json',
                    'Cache-Control: no-cache',
                    'Authorization: Bearer '.$jsonToken->get('access_token')
                ]
            ];
            // Sending POST Request
            $result =  $this->get('v1/jobs/'.$job_id, $options);

            $result = (array)json_decode($result, true);

            //Transfor array to @ParameterBag
            $resultJson = new ParameterBag($result);

            return $resultJson;


        }else{
            return $jsonToken;
        }


    }


    /**
     * Find Merchant Assignment by Id
     * @param $task_id
     * @return ParameterBag
     */
    public function findMerchantAssignmentById($merchant_assignment_id)
    {
        
        if(!is_string($merchant_assignment_id) || !is_int($merchant_assignment_id)){
            throw new Exception('merchant_assignment_id is invalid'); 
        }

        if(empty($merchant_assignment_id)){
            throw new Exception('merchant_assignment_id is required'); 
        }

        $jsonToken = $this->obtainToken();

        if(!empty($jsonToken) && $jsonToken->get('access_token') != null){
                    // Scafolding request's options
            $options = [
                'headers'=> [
                    'Accept: application/json',
                    'Cache-Control: no-cache',
                    'Authorization: Bearer '.$jsonToken->get('access_token')
                ]
            ];
            // Sending POST Request
            $result =  $this->get('v1/merchant_assignements/'.$merchant_assignment_id, $options);

            $result = (array)json_decode($result, true);

            //Transfor array to @ParameterBag
            $resultJson = new ParameterBag($result);

            return $resultJson;


        }else{
            return $jsonToken;
        }


    }

    /**
     * Send a notification 
     * @param $merchant_id
     * @param array $pickup
     * @param array $pickup
     * @param string $delivery_service is the username of a delivery service
     * @param string $customer_payment_method_code must be cash or online
     * @param bool $customer_paid
     * @param string $merchant_notification_url
     * @return ParameterBag
     */
    public function merchantCreateTask($merchant_id, array $pickup, array $delivery, string $delivery_service,string $customer_payment_method_code, bool $customer_paid, string $merchant_notification_url )
    {
        
        if(!is_string($merchant_id) || !is_int($merchant_id)){
            throw new Exception('merchant_id must be string'); 
        }

        if(!is_array($pickup)){
            throw new Exception('pickup must be array'); 
        }

        if(!is_array($delivery)){
            throw new Exception('delivery must be array'); 
        }

        if(!is_string($delivery_service)){
            throw new Exception('delivery service must be string'); 
        }

        if(!is_string($merchant_notification_url)){
            throw new Exception('merchant_notification_url must be string'); 
        }

        if(!is_bool($customer_paid) || !is_int($customer_paid) || !is_string($customer_paid) ){
            throw new Exception('customer_paid must be boolean or integer or string'); 
        }

        if(!is_bool($customer_payment_method_code)){
            throw new Exception('customer_payment_method_code must be string'); 
        }

        if(!in_array($customer_payment_method_code, ['cash', 'online'])){
            throw new Exception('customer_payment_method_code must be cash or online'); 
        }

        if(empty($merchant_id)){
            throw new Exception('merchant_id is required'); 
        }

        if(empty($pickup)){
            throw new Exception('pickup is required'); 
        }

        if(empty($delivery)){
            throw new Exception('delivery is required'); 
        }


        if(empty($delivery_service)){
            throw new Exception('delivery_service is required'); 
        }

        if(empty($merchant_notification_url)){
            throw new Exception('merchant_notification_url is required'); 
        }

        if(empty($customer_paid)){
            throw new Exception('customer_paid is required'); 
        }

        if(empty($customer_payment_method_code)){
            throw new Exception('customer_payment_method_code is required'); 
        }
        
        // Scafolding the request's params
         $b = [
            "jobs"=> [
                $pickup,
                $delivery
            ],
            "delivery_service" => $delivery_service."",
            "merchant_id" => $merchant_id."",
            "customer_payment_method_code" => $customer_payment_method_code."",
            "customer_paid" => boolval($customer_paid),
            "merchant_notification_url" => $merchant_notification_url
        ];

        $jsonToken = $this->obtainToken();

        if(!empty($jsonToken) && $jsonToken->get('access_token') != null){
                    // Scafolding request's options
            $options = [
                'headers'=> [
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Cache-Control: no-cache',
                    'Authorization: Bearer '.$jsonToken->get('access_token')
                ],
                'params' => $b
            ];
            // Sending POST Request
            $result =  $this->post('v1/merchant_create_tasks', $options);

            $result = (array)json_decode($result, true);

            //Transfor array to @ParameterBag
            $resultJson = new ParameterBag($result);

            return $resultJson;


        }else{
            return $jsonToken;
        }


    }

    

    /**
     * Create Job 
     * @param $merchant_id
     * @param $task_id
     * @param string $customer_name
     * @param string $customer_phone
     * @param string $customer_email 
     * @param string $location_name
     * @param string $location_latitude 
     * @param string $location_longitude
     * @param string $order_id, 
     * @param string $order_description 
     * @param string $order_price
     * @param string $currency_code
     * @param bool $has_pickup
     * @param string $delivery_fees
     * @param string $job_datetime
     * @param array  $images
     * @param string $description
     * 
     * @return ParameterBag
     */
    public function merchantCreateJob(
        $merchant_id, 
        $task_id,         
        $customer_name = "", 
        $customer_phone = "",
        $customer_email = "",
        $location_name = "", 
        $location_latitude = null, 
        $location_longitude = null, 
        $order_id, 
        $order_description = "",
        $order_price,
        $currency_code = "XOF",
        $has_pickup = true,
        $delivery_fees = "0",
        $job_datetime = "",
        $images = [],
        $description = "" ){
        
        if(!is_string(merchant_id) || !is_int(merchant_id)){
            throw new Exception('merchant_id must be string'); 
        }

        
        return $this->createJob("merchants", $merchant_id, $task_id, $customer_name, 
        $customer_phone, $customer_email, $location_name, 
        $location_latitude, $location_longitude, 
        $order_id, $order_description,$order_price,$currency_code,$has_pickup,$delivery_fees,
        $job_datetime,$images,$description);


    }

      /**
     * Create Job 
     * @param $merchant_id
     * @param $task_id
     * @param string $customer_name
     * @param string $customer_phone
     * @param string $customer_email 
     * @param string $location_name
     * @param string $location_latitude 
     * @param string $location_longitude
     * @param string $order_id, 
     * @param string $order_description 
     * @param string $order_price
     * @param string $currency_code
     * @param bool $has_pickup
     * @param string $delivery_fees
     * @param string $job_datetime
     * @param array  $images
     * @param string $description
     * 
     * @return ParameterBag
     */
    private function createJob(
        $created_by, 
        $creator_id,
        $task_id,         
        $customer_name = "", 
        $customer_phone = "",
        $customer_email = "",
        $location_name = "", 
        $location_latitude = null, 
        $location_longitude = null, 
        $order_id, 
        $order_description = "",
        $order_price,
        $currency_code = "XOF",
        $has_pickup = true,
        $delivery_fees = "0",
        $job_datetime = "",
        $images = [],
        $description = "" ){
        
        if(!is_string($merchant_id) || !is_int($merchant_id)){
            throw new Exception('merchant_id must be string'); 
        }

        
        // Scafolding the request's params
         $b = [
            "created_by" => $created_by."",
            "creator_id" => $creator_id."",
            "customer_name" => $customer_name,
            "customer_phone" => $customer_phone,
            "customer_email" => $customer_email,
            "location_name" => $location_name,
            "location_latitude" => $location_latitude,
            "location_longitude" => $location_longitude,
            "order_id" => $order_id,
            "order_description" => $order_description,
            "order_price" => $order_price,
            "currency_code" => $currency_code,
            "has_pickup" => $has_pickup,
            "delivery_fees" => $delivery_fees,
            "job_datetime" => $job_datetime,
            "images" => $images,
            "description" => $description
        ];

        $jsonToken = $this->obtainToken();

        if(!empty($jsonToken) && $jsonToken->get('access_token') != null){
                    // Scafolding request's options
            $options = [
                'headers'=> [
                    'Accept: application/json',
                    'Cache-Control: no-cache',
                    'Authorization: Bearer '.$jsonToken->get('access_token')
                ],
                'params' => $b
            ];
            // Sending POST Request
            $result =  $this->post('v1/merchant_create_tasks', $options);

            $result = (array)json_decode($result, true);

            //Transfor array to @ParameterBag
            $resultJson = new ParameterBag($result);

            return $resultJson;


        }else{
            return $jsonToken;
        }


    }

    /**
     * Assign Task to Business
     * @param string $merchant_id
     * @param string $task_id
     * @param string $delivery_service is the username of a delivery service
     * @param string $merchant_notification_url is a url that must provide for webhook
     * @return ParameterBag
     */
    public function merchantAssignTask( $merchant_id, $task_id, string $delivery_service, string $merchant_notification_url)
    {
        
        if(!is_string($merchant_id) || !is_int($merchant_id)){
            throw new Exception('merchant_id must be string'); 
        }

        if(!is_string($task_id) || !is_int($task_id)){
            throw new Exception('task_id must be string'); 
        }

        if(!is_string($delivery_service)){
            throw new Exception('delivery service must be string'); 
        }

        if(!is_string($merchant_notification_url)){
            throw new Exception('merchant_notification_url must be string'); 
        }

        if(empty($merchant_id)){
            throw new Exception('merchant_id is required'); 
        }

        if(empty($task_id)){
            throw new Exception('task_id is required'); 
        }

        if(empty($delivery_service)){
            throw new Exception('delivery_service is required'); 
        }

        if(empty($merchant_notification_url)){
            throw new Exception('merchant_notification_url is required'); 
        }
        
        // Scafolding the request's params
         $b = [
            "task_id" => $task_id."",
            "merchant_id" => $merchant_id."",
            "delivery_service" => $delivery_service."",
            "merchant_notification_url" => $merchant_notification_url.""
        ];

        $jsonToken = $this->obtainToken();

        if(!empty($jsonToken) && $jsonToken->get('access_token') != null){
                    // Scafolding request's options
            $options = [
                'headers'=> [
                    'Accept: application/json',
                    'Cache-Control: no-cache',
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer '.$jsonToken->get('access_token'),
                    
                ],
                'params' => $b
            ];

           
            // Sending POST Request
            $result =  $this->post('v1/merchant_assign_tasks', $options);

           
            $result = (array)json_decode($result, true);

            return $result;
            //Transfor array to @ParameterBag
            $resultJson = new ParameterBag($result);

            return $resultJson;


        }else{
            return $jsonToken;
        }


    }

    /**
     * Notify Delivery Service
     *
     * @param $product_id
     * @param string $product_title
     * @param string $product_image
     * @param string $product_description
     * @param string $product_link
     * @param array $delivery_services
     * @return ParameterBag
     */
    public function merchantNotifyDeliveryService( $product_id, $product_title, $product_image, $product_description, $product_link, $delivery_services)
    {
        
        if(!is_string($product_id)){
            throw new Exception('product_id must be string'); 
        }

        if(!is_string($product_title)){
            throw new Exception('product_title must be string'); 
        }

        if(!is_string($product_image)){
            throw new Exception('product_image must be string'); 
        }

        if(!is_string($product_link)){
            throw new Exception('product_link must be string'); 
        }

        if(!is_array($delivery_services)){
            throw new Exception('delivery_services must be array'); 
        }

        if(empty($product_id)){
            throw new Exception('product_id is required'); 
        }

        if(empty($product_title)){
            throw new Exception('product_title is required'); 
        }

        if(empty($product_image)){
            throw new Exception('product_image is required'); 
        }

        if(empty($product_link)){
            throw new Exception('product_link is required'); 
        }

        if(empty($delivery_services)){
            throw new Exception('delivery_services is empty'); 
        }
        
        // Scafolding the request's params
         $b = [
            "product_id" => $product_id."",
            "product_title" => $product_title."",
            "product_image" => $product_image."",
            "product_description" => $product_description."",
            "product_link" => $product_link."",  
            "delivery_services" => $delivery_services
        ];

        $jsonToken = $this->obtainToken();

        if(!empty($jsonToken) && $jsonToken->get('access_token') != null){
                    // Scafolding request's options
            $options = [
                'headers'=> [
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'Cache-Control: no-cache',
                    'Authorization: Bearer '.$jsonToken->get('access_token')
                ],
                'params' => $b
            ];
            // Sending POST Request
            $result =  $this->post('v1/businesses_notify_tag', $options);

            $result = (array)json_decode($result, true);

            //Transfor array to @ParameterBag
            $resultJson = new ParameterBag($result);

            return $resultJson;


        }else{
            return $jsonToken;
        }


    }

    public function obtainToken()
    {
         // Scafolding the request's params
         $b = [
            "grant_type" => "client_credentials",
            "client_id" => $this->getClientId(),
            "client_secret" => $this->getClientSecret(),
            "scope" => "*"
        ];

        // Scafolding request's options
        $options = [
            'headers'=> [
                'Accept: application/json',
                'Content-Type: application/json',
                'Cache-Control: no-cache'
            ],
            'params' => $b
        ];
        // Sending POST Request
        $result =  $this->post('oauth/token', $options);

        $result = (array)json_decode($result, true);

        //Transfor array to @ParameterBag
        /**
         * 
         * {
    "token_type": "Bearer",
    "expires_in": 300,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZGJlZDUwYTU0ODg4Mzk1YzMyZmM4MGUwYjhkMWRiNzc1M2ZmNzViNmJjNGE1MzJkNzRmYzFmOWZhMTg2YzRhYzQyNTAwMDQ0ZDMwMDMzMDUiLCJpYXQiOjE1OTIyNDUwNzUsIm5iZiI6MTU5MjI0NTA3NSwiZXhwIjoxNTkyMjQ1Mzc1LCJzdWIiOiIiLCJzY29wZXMiOlsiKiJdfQ.oMeZzWxt4yrM38nafTFDcPKdOg3fznRLyU-uhniM1_V4i8dz73Zafmb3ME9MysXYxl5MJzxhagfrGNPxthLLdM7RBKwgttVNYs9AD9BOWuZcIgTIMstcg2OtITLN52APnRVyC4RKCQh70eKLIyMLk9kgCcr-3uygUEudFsUv1lbRhB42Yp4fNyOoxeTm9MIFt_kaCftTYgHny0LyXIB4wv7jUBDsnoUpkBnmK32YYb-3ymjpniyKySVfk5i4RIhubHrmyuieR48hfquBYHS0mUBBibmMrk1oW9knd4h8YR8x9Ta-EM9-4wiiDe2kI1BoqfA9FzZyR0pg6AgrVttT0oVyM6JK_GLAqYL_6bHSQfIZVuo8job6a74IUOLbj6JlAaTMKZSifEq8RUEJJfJQlppPoZ4LML-Fgw0y_aVjsasN4m531CZ4xl5v6pq_snET_w9VX7l861HIi-K-FnlwXYAPr0pawO7LsqN8IbG2VcVLKyb-o_rUqhikEZda0F-L1pJUmfugHkFf3qEyyjqO68CaHF8b2clv2PBhfHs-RjOLqMF6K6lGGtZd6H9x8--Jsbg5qHTlOYHgcXN71t_67CRk388C-Yfnj03Tog76qXxMRfzTBmHgRugNXvcviFlRW40Ej6du-Hpm7lOBr7LNl1xDrp3GyW2PzSQcmKgT_Fs"
}
         * 
         */
        $resultJson = new ParameterBag($result);

        return $resultJson;
    }

    /**
     * @param string $customer_name
     * @param string $customer_phone
     * @param string $customer_email 
     * @param string $location_name
     * @param string $location_latitude 
     * @param string $location_longitude
     * @param string $order_id, 
     * @param string $order_description 
     * @param string $order_price
     * @param string $currency_code
     * @param bool $has_pickup
     * @param string $delivery_fees
     * @param string $job_datetime
     * @param array  $images
     * @param string $description
     * 
     * @return array
     */
    public  static function paramJob(
        $customer_name = "", 
        $customer_phone = "",
        $customer_email = "",
        $location_name = "", 
        $location_latitude = null, 
        $location_longitude = null, 
        $order_id, 
        $order_description = "",
        $order_price,
        $currency_code = "XOF",
        $has_pickup = true,
        $delivery_fees = "0",
        $job_datetime = "",
        $images = [],
        $description = ""
        ){
        return [
            "customer_name" => $customer_name,
            "customer_phone" => $customer_phone,
            "customer_email" => $customer_email,
            "location_name" => $location_name,
            "location_latitude" => $location_latitude,
            "location_longitude" => $location_longitude,
            "order_id" => $order_id,
            "order_description" => $order_description,
            "order_price" => $order_price,
            "currency_code" => $currency_code,
            "has_pickup" => $has_pickup,
            "delivery_fees" => $delivery_fees,
            "job_datetime" => $job_datetime,
            "images" => $images,
            "description" => $description

        ];
    }


}