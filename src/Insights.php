<?php
namespace Zeus\Facebook;

use Zeus\Facebook\ZeusFacebook;

class Insights extends ZeusFacebook{

  private $data = [];
  private $paging = [];
  public function __construct(){
    parent::__construct();


  }
  /* PUBLIC FUNCTIONS */
  public function spends($date = "last_30d", $sort = []){
    $this->call($date, $sort, "");
    return $this->toArray();
  }
  public function campaigns($date = "last_30d", $sort = []){
    $this->call($date, $sort, "campaign");
    return $this->toArray();
  }

  /* CALLS AND RETURNS */
  private function call($date, $sort, $level = "", $fields = ""){
    $url = "act_".$this->getAdAccount()."/insights";
    if(empty($fields)){
      $fields = "clicks,cpc,impressions,inline_link_click_ctr,unique_ctr,website_purchase_roas,spend,social_spend";
    }

    $fields = array(
      'level' => $level,
      'sort' => $sort,
      'fields' => $fields
    );

    //date preset or range
    if(is_array($date)){
      $fields['time_range'] = $date; // ['since' => 'YYYY-MM-DD', 'until' => 'YYYY-MM-DD']
    }else{
      $fields['date_preset'] = $date;
    }


    $resp = $this->curl($url, $fields);
    foreach ($resp as $key => $value) {
      $this->{$key} = $value;
    }
  }
  private function toArray(){
    return [
      'data' => $this->data,
      'paging' => $this->paging
    ];
  }
}
