<?php

/*
 * The class is used to initiate a REST call
 */

/**
 * Description of IPNCall
 *
 * 
 */
class IPNCall {

    /*
     * This mehtod will initiate a REST call to the given URL and the results will be recived as response
     * the resposne will contain the configured merchant paramters.
     */
    function callRestURL($restURL) {

        $service_url = $restURL;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $service_url);
        $curl_response = curl_exec($curl);
        var_dump($curl_response);

        curl_close($curl); //ssss
    }
}
