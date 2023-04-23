<?php

namespace App\Data;

use App\Infra\Db;
use stdClass;

class ClienteData {
  
  public static function getClientes(){

      $conn = Db::get()->connect();
      $stmt = $conn->prepare("SELECT * FROM condominio.cliente");
      $stmt->execute();
    
      return $stmt;
  }

  public static function getClienteById($id_cliente){
    
    $conn = Db::get()->connect();
    $stmt = $conn->prepare("SELECT * FROM condominio.cliente WHERE id_cliente = :id_cliente");
    $stmt->bindValue(':id_cliente', $id_cliente);
    $stmt->execute();
    $result = $stmt->fetchObject();

    return $result;
  }

  public static function store($data): stdClass{
    try{
      $conn = Db::get()->connect();
      $query =
        "INSERT INTO condominio.cliente 
          (
            email, 
            senha, 
            nome, 
            empresa, 
            telefone, 
            qtd_condominio, 
            segmento, 
            estado, 
            uf, 
            id_administradora, 
            tipo_usuario
          )
          VALUES (
            :email, 
            :senha, 
            :nome, 
            :empresa, 
            :telefone, 
            :qtd_condominio, 
            :segmento, 
            :estado, 
            :uf, 
            :id_administradora, 
            :tipo_usuario
          )
        RETURNING id_cliente";

      $stmt = $conn->prepare($query);
      $stmt->bindValue(':email', $data['email'], \PDO::PARAM_STR);
      $stmt->bindValue(':senha', $data['senha'], \PDO::PARAM_STR);
      $stmt->bindValue(':nome', $data['nome'], \PDO::PARAM_STR);
      $stmt->bindValue(':empresa', $data['empresa'], \PDO::PARAM_STR);
      $stmt->bindValue(':telefone', $data['telefone'], \PDO::PARAM_STR);      
      $stmt->bindValue(':qtd_condominio', $data['qtd_condominio'], \PDO::PARAM_INT);
      $stmt->bindValue(':segmento', $data['segmento'], \PDO::PARAM_INT);
      $stmt->bindValue(':estado', $data['estado'], \PDO::PARAM_STR);
      $stmt->bindValue(':uf', $data['uf'], \PDO::PARAM_STR);
      $stmt->bindValue(':id_administradora', $data['id_administradora'], \PDO::PARAM_INT);
      $stmt->bindValue(':tipo_usuario', $data['tipo_usuario'], \PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll();

      $inserted_client = self::getClienteById($result[0]['id_cliente']);
      return $inserted_client;

    }catch(\PDOException $e){
      
      return $e->getMessage();
    }

  }
}
