<?php

namespace App\Tools;
use App\Exceptions\CurlException;
use App\Tools\Interfaces\ICurlCaller;

class CurlCaller implements ICurlCaller
{

     public function __construct() {}

    private function initialize($url,$data=null,$request_type=null)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(!is_null($data)){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        if(!is_null($request_type)){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request_type);
        }
        return $ch;
    }

    private function setHeaders($token,$content_type=null)
    {
        if($token==null){
            throw CurlException::missingToken();
        }
        $headers = array();
        if(!is_null($content_type)){
            $headers[] = "Content-Type: application/json";
        }
        $headers[] = "Accept: application/json";
        $headers[] = "Authorization: Bearer ".$token;
        $headers[] = "Accept-Language: en";
        return $headers;
    }

    private function execute($ch,$headers=null)
    {
        if(!is_null($headers)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function post($url,$data)
    {
        try{
            $ch=$this->initialize($url,$data);
            $response=$this->execute($ch);
        }catch (\Throwable $e){
            $response = "Exception found: ".  $e->getMessage(). "\n". "FILE :".$e->getFile()."\n"."LINE :".$e->getLine()."\n";
        }
        return $response;
    }

    public function postWithToken($url,$data,$token)
    {
        try{
            $ch=$this->initialize($url,$data);
            $headers=$this->setHeaders($token);
            $response=$this->execute($ch,$headers);
        }catch (\Throwable $e){
            $response = "Exception found: ".  $e->getMessage(). "\n". "FILE :".$e->getFile()."\n"."LINE :".$e->getLine()."\n";
        }
        return $response;
    }

    public function get($url,$token)
    {
        try{
            $ch=$this->initialize($url);
            $headers=$this->setHeaders($token,$content_type=true);
            $response=$this->execute($ch,$headers);
        }catch (\Throwable $e){
            $response = "Exception found: ".  $e->getMessage(). "\n". "FILE :".$e->getFile()."\n"."LINE :".$e->getLine()."\n";
        }
        return $response;
    }

    public function delete($url,$token)
    {
        try{
            $ch=$this->initialize($url,$data=null,$request_type="DELETE");
            $headers=$this->setHeaders($token,$content_type=true);
            $response=$this->execute($ch,$headers);
        }catch (\Throwable $e){
            $response = "Exception found: ".  $e->getMessage(). "\n". "FILE :".$e->getFile()."\n"."LINE :".$e->getLine()."\n";
        }
        return $response;
    }

    public function update($url,$data,$token)
    {
        try{
            $ch=$this->initialize($url,$data=http_build_query($data),$request_type="PUT");
            $headers=$this->setHeaders($token);
            $response=$this->execute($ch,$headers);
        }catch (\Throwable $e){
            $response = "Exception found: ".  $e->getMessage(). "\n". "FILE :".$e->getFile()."\n"."LINE :".$e->getLine()."\n";
        }
        return $response;
    }

}
