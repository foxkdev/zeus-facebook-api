<?php
namespace Zeus\Facebook;

use FacebookAds\Api;

use FacebookAds\Object\CustomAudience;
use FacebookAds\Object\AdAccount;
class ZeusFacebook{
  private $base_url = null;
  private $token = null;
  private function init(){
    $this->base_url = config('zeus_facebook.base_url');
    $this->token = config('zeus_facebook.access_token');

  }
  protected function curl($url, $fields = array()){
    $this->init();//init to config

    //fields
    $fields = http_build_query(array_merge(
      $fields,
      array('access_token' => $this->token)
    ));

    //si no es la url de base seteamos la de base.
    if(strpos($this->base_url, $url) === false){
      $url = $this->base_url.$url;
    }//si es custom seteamos la que nos pasan
    $url = $url."?". $fields;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    if($response != null){
      $response = get_object_vars(json_decode($response)); //ESTO HAY QUE MEJORARLO PARA SUBARRAYS SON STDCLASS
    }
    curl_close($curl);
    return $response;
  }
}
 ?>
