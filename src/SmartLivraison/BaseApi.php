<?php

namespace SmartLivraison;

use SmartLivraison\Exception\SmartLivraisonHttpException;
use SmartLivraison\Exception\SmartLivraisonConnexionException;

/**
 * This class is for performing Api call.
 * Actually, only POST and GET methods are embedded for an Http request.
 * 
 * @license MIT
 * @author Franck BROU <franckbrou@adjemin.com>
 */
class BaseApi
{
    /**
     * Define the base url
     *
     * @var string
     */
    private $base_url = "";

    /**
     * Inits the class
     *
     * @param string $base_url
     */
    public function __construct($base_url)
    {
        $this->base_url = $base_url;
    }

    /**
     * Call GET request
     *
     * @param string $endpoint
     * @param array $options
     * @return string
     */
    public function get($endpoint, array $options = [])
    {
        return $this->call("GET", $endpoint, $options, null);
    }

    /**
     * Call POST request
     * 
     * @param string $endpoint
     * @param array $options
     * @param string $contentType
     */
    public function post($endpoint, array $options = [], string $contentType =null)
    {
        return $this->call("POST", $endpoint, $options, $contentType);
    }

    /**
     * Create API query and execute a GET/POST request
     *
     * @param string $http_method GET/POST
     * @param string $endpoint
     * @param array $options
     * @param string $contentType
     */
    public function call($http_method, $endpoint, array $options = [], string $contentType = null)
    {
        try {
            $url = $this->base_url."/".$endpoint;
            
            // Initialize curl session
            $curl = curl_init("$url");

            // Disable SSL verification
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            // Set timeout
            curl_setopt($curl, CURLOPT_TIMEOUT, 80);

            // Returns the data/output as a string instead of raw data
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            // Check if request as options
            if (!is_null($options) && is_array($options)) {
                $curl = $this->buildRequestScafolding($curl, $http_method, $options, $contentType);
            }

            // Performing request
            $response = curl_exec($curl);

            // Closing the session
            curl_close($curl);

            // Rendering the response
            if ($response === false) {
                // An error occurs when processing
                throw new SmartLivraisonConnexionException("Oups, Cannot connect to remote server.");
            }

            return $response;
        } catch (\Exception $exception) {
            if ($exception instanceof SmartLivraisonConnexionException) {
                throw $exception;
            }

            throw new SmartLivraisonHttpException($exception->getMessage(), 500);
        };
    }

    /**
     * Build the curl request scafolding
     *
     * @param resource $curl
     * @param string $http_method
     * @param array $options
     * @param string $contentType
     */
    public function buildRequestScafolding($curl, $url, $http_method, array $options, $contentType)
    {
        if (array_key_exists("headers", $options)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $options["headers"]);
        }

        switch ($http_method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                if (array_key_exists("params", $options)) {

                    if($contentType == "application/json"){
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($options["params"]));
                    }else{
                        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($options["params"]));
                    }
                    
                }
                break;

            case "GET":

                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);                
             
                if (array_key_exists("params", $options)) {
                    $data = http_build_query($options["params"]);
                    $getUrl = $url."?".$data;
                    curl_setopt($curl, CURLOPT_URL, $getUrl);
                }else {
                    curl_setopt($curl, CURLOPT_URL, $url);
                } 


                break;
        }

        return $curl;
    }
}