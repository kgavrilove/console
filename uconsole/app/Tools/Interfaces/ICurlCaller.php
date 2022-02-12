<?php

namespace App\Tools\Interfaces;

interface ICurlCaller
{
    public function post($url,$data);

    public function postWithToken($url,$data,$token);

    public function get($url,$token);

    public function delete($url,$token);

    public function update($url,$data,$token);

}
