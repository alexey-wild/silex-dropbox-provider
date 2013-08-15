<?php
namespace DropboxApi\Silex\Provider;

class DropboxApi
{

  var $key;
  var $secret;

  function __construct($key, $secret)
  {
    $this->key = $key;
    $this->secret = $secret;
    return $this;
  }

  public function send($url)
  {
    if ($curl = curl_init($url)) {
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1');
      $stream = curl_exec($curl);
      return $stream;
    }
    return null;
  }

  function api($method, $params = array())
  {
    $query = '';
    $res = $this->send($query);
    return json_decode($res, true);
  }

  function params($params) {
    $pice = array();
    foreach($params as $k=>$v) {
      $pice[] = $k.'='.urlencode($v);
    }
    return implode('&',$pice);
  }

}