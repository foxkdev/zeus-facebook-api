<?php
namespace Zeus\Facebook;

use FacebookAds\Api;

use FacebookAds\Object\CustomAudience;

class ZeusFacebook{

  private function init(){
    $id = config('zeus_facebook.app_id');
    $secret = config('zeus_facebook.app_secret');
    $token = config('zeus_facebook.access_token');
    Api::init($id, $secret, $token);

    // $api = Api::instance();
  }
  /*
   * GET AUDIENCES BY ID
   *
   */
  public function getAudience($id_audience){

    $custom_audience = new CustomAudience($id_audience);
    $audience = $custom_audience->read();

    return $audience;
  }
}
 ?>
