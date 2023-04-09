<?php

namespace App\Controllers; 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use App\Data\UserData;

class UserController
{

  public static function home(Request $request, Response $response): Response
  {
    try{

      $stmt = UserData::getUsers();
      $tableList = [];
      
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $tableList[] = $row;
      }
  
      $response->getBody()->write(json_encode($tableList));
    
      return $response->withHeader('Content-Type', 'application/json');

    }catch(\PDOException $e) {
      return $e->getMessage();
    }

  }

}
