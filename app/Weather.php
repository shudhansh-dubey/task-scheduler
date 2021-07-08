<?php namespace App;

class Weather {

    private $city;  

    public function __construct($city) {
        $this->city = $city;
    }

    public function getCurrentData() 
    {
        $data = array(
            'key'                           =>    WEATHERAPI_APIKEY,
            'q'                             =>    $this->city, 
            'aqi'                           =>    'no'
        );
        $request_data = http_build_query($data);
        $url = WEATHERAPI_URL_CURRENT . "?" . $request_data;
        
        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 

        $resp = curl_exec($curl);
        curl_close($curl);

        return json_decode($resp); 
    }

}