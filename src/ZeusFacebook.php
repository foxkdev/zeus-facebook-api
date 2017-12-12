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
      // $response = get_object_vars(json_decode($response)); //ESTO HAY QUE MEJORARLO PARA SUBARRAYS SON STDCLASS
      $response = $this->objectToArray(json_decode($response));
    }
    curl_close($curl);
    return $response;
  }


  private function arrayCastRecursive($array)
  {
      if (is_array($array)) {
          foreach ($array as $key => $value) {
              if (is_array($value)) {
                  $array[$key] = $this->arrayCastRecursive($value);
              }
              if ($value instanceof stdClass) {
                  $array[$key] = null;
                  // $array[$key] = $this->arrayCastRecursive((array)$value);
              }
          }
      }
      if ($array instanceof stdClass) {
          return $this->arrayCastRecursive((array)$array);
      }
      return $array;
  }

  private function objectToArray($array) {
        return json_decode(json_encode($array, JSON_FORCE_OBJECT), false);
    }
}
 ?>
