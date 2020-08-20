<?php

class Packagist{
    
    private $TO = "https://packagist.org/";
    private static $FROM = "QuickBrowse"
    private static $API = Array(
        "uri" => Array(
            "find" => Array("search.json", "?request=!sender", "&q=!query", "&per_page=!limit", "&type=!type"),
            "list" => Array("packages/list.json", "?request=!sender", "&vendor=!vendor", "&type=!type", "&tag=!tag"),
            "info" => Array("packages/!vendor/!package.json", "?request=!sender"),
            "stat" => Array("statistics.json", "?request=!sender")
        ),
        "json" => Array(
            "find" => Array(
                "results" => Array(
                    "name",
                    "description",
                    "url",
                    "repository",
                    "downloads",
                    "favers",
                ),
                "total",
            ),
            "list" => Array(
                "packageNames",
            ),
            "info" => Array(
                "package" => Array(
                    "name",
                    "description",
                    "time",
                    "maintainers",
                    "versions",
                    "type",
                    "repository",
                    "downloads" => Array(
                        "total",
                        "monthly",
                        "daily",
                    ),
                    "favers"
                ),
            ),
            "stat" => Array(
                "total" => Array(
                    "downloads",
                    "packages",
                    "versions",
                ),
            ),
        ),
        "params" => Array(
            "required" => Array(
                "find" => Array("sender", "query"),
                "list" => Array("sender"),
                "info" => Array("sender", "vendor", "package"),
                "stat" => Array("sender"),
            ),
            "optional" => Array(
                "find" => Array("limit", "type", "response"),
                "list" => Array("vendor", "type", "tag", "response"),
                "info" => Array("response"),
                "stat" => Array("response"),
            ),
        ),
    );
    
    function __construct(string $request, array $params){
        $data = $this->process($request, $params);
        return ($data != false && $data != null) ? $data : false;
    }
    
    private function replace(string $query, string $param, string $value){
        $count = 0;
        $string = str_replace('!' . $param, $value, $query, $count);
        return $count > 0 ? $string : false;
    }
    
    private function request(string $url){
        $response = file_get_contents($url);
        return ($response != false && $response != null) ? $response : false;
    }
    
    private function process(string $request , array $params){
        $url = $this->TO;
        $input['sender'] = $this->FROM;
        $is_required = false;
        $required_params = $this->API['params']['required'][$request];
        foreach($required_params as $required){
            $found_param = false;
            foreach($params as $param => $value){
                $found_param = $param == $required ? true : false;
                foreach($this->API['uri'][$request] as $query){
                    $query = $this->replace($query, $param, $value);
                    if($query != false){
                        $url = $url . $query;
                    }
                }
            }
            $json = $found_param ? $this->request($url) : false;
        }
        $array = ($json != false && $json != null) ? json_decode($json) : false;
        return $array;
    }
    
}

?>
