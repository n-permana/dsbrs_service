<?php
class SlightlyBigApi {
    function __construct() {}
    
    function post($endpoint,$data) {
        return self::request('POST', $endpoint, $data);
    }

    function get($endpoint,$data = false) {
        return self::request('GET', $endpoint, $data);
    }

    private static function request($method, $endpoint, $data = false) {
        $configs = parse_ini_file($_SERVER['PWD'] .'/config.ini');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $configs["api_base_url"].$endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $configs['api_secret_key'] .':');
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}
?>