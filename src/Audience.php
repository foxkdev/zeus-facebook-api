<?php
namespace Zeus\Facebook;

use Zeus\Facebook\ZeusFacebook;

class Audience extends ZeusFacebook{
  public $id = null;
  public $account_id = null;
  public $name = null;
  public $description = null;
  public $approximate_count = null;
  public $operation_status = null;

  public $retention_days = null;
  public $data_source = null;
  public $ads = null;

  public $time_created = null;
  public $time_updated = null;
  public $time_content_updated = null;


  private $fields = null;


  public function __construct($id = null, $fields = null){
    $this->id = $id; //set id
    //fields set
    if($fields == null){
      $this->fields = array(
        'fields' => 'account_id,name,approximate_count,data_source,retention_days,ads,description,operation_status,time_created,time_updated,time_content_updated'
      );
    }else{
      $this->fields = $fields;
    }

  }
  /**
   *GET DATA in Array
   * @return array
   */
  public function toArray(){
    return array(
      'id' => $this->id,
      'account_id' => $this->account_id,
      'name' => $this->name,
      'description' => $this->description,
      'approximate_count' => $this->approximate_count,
      'retention_days' => $this->retention_days,
      'data_source' => $this->data_source,
      'ads' => $this->ads,
      'operation_status' => $this->operation_status,
      'time_created' => $this->time_created,
      'time_updated' => $this->time_updated,
      'time_content_updated' => $this->time_content_updated
    );
  }

  /*
   * GET AUDIENCES BY ID
   * @return Array Audience
   */
  public function read($fields = null){
    //fields set
    if($fields != null){
      $this->fields = array(
        'fields' => $fields
      );
    }

    $resp = $this->curl($this->id, $this->fields);
    foreach ($resp as $key => $value) {
      $this->{$key} = $value;
    }

    // $this->name = $resp['name'];
    // $this->retention_days = $resp['retention_days'];
    // $this->data_source = $resp['data_source'];
    // $this->approximate_count = $resp['approximate_count'];
    // $this->account_id = $resp['account_id'];
    // return $resp;
  }
  /**
   * GET AUDIENCE
   *
   */
  public function getAudience($id, $fields = null){
    $this->id = $id;
    $this->read($fields);
  }


}
 ?>
