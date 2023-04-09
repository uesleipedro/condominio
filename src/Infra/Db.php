<?php

namespace App\Infra;

use PDO;
use pq\Connection;

class Db
{
  private static $conn;

  public function connect():PDO
  {  

    //read parameters in the ini configuration file
    $params = parse_ini_file('database.ini');
    if ($params === false) {
      throw new \Exception("Error reading database configuration file");
    }
    
    // connect to the postgresql database
    $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
      $params['host'], 
      $params['port'], 
      $params['dbname'], 
      $params['user'], 
      $params['password']);

      $pdo = new \PDO($conStr);
      $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

      return $pdo;
  }

  public static function get(){
    if (null === static::$conn) {
      static::$conn = new static();
    }

    return static::$conn;
  }

} 

