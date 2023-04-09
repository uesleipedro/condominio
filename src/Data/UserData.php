<?php

namespace App\Data;

use App\Infra\Db;

class UserData {
  
  public static function getUsers(){

      $conn = Db::get()->connect();
      $stmt = $conn->query("SELECT * FROM customers");
    
      return $stmt;
  }
}
