<?php

namespace App\Controllers; 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use App\Data\ClienteData;

class ClienteController
{

  public static function getClientes(Request $request, Response $response): Response
  {
    try{

      $stmt = ClienteData::getClientes();
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

  public static function store(Request $request, Response $response, $args){

    $data = $request->getParsedBody();
    $payload = ClienteData::store($data);
    $response->getBody()->write(json_encode($payload));
    
    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus(201);

  }

}
