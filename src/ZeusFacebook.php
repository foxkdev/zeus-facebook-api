<?php
namespace Zeus\Facebook;

use FacebookAds\Api;

use FacebookAds\Object\CustomAudience;
use FacebookAds\Object\AdAccount;
class ZeusFacebook{
  private $base_url = null;
  private $token = null;
  private $ad_account = null;

  public function __construct(){
    $this->base_url = config('zeus_facebook.base_url');
    $this->token = config('zeus_facebook.access_token');
    $this->ad_account = config('zeus_facebook.ad_account_id');
  }
  public function setToken($token = null){
    $this->token = $token;
  }
  public function setAdAccount($adAccount){
    $this->ad_account = $adAccount;
  }
  public function getAdAccount(){
    return $this->ad_account;
  }
  protected function curl($url, $fields = array()){

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
      $response = json_decode($response, true); //parse to arrays recursive
    }
    curl_close($curl);
    return $response;
  }



}
 ?>
