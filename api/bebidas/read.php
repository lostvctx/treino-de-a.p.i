<?php
// api/bebida/read.php
 
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../confug/Database.php';
include_once '../../models/bebida.php';
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto bebida
$bebida = new Bebida($db);
// try{ colocar para demonstrar erro com coluna errada mas lá no método read em pizza
    // Chamar o método read() para buscar as pizzas
    $stmt = $bebida->read();
    $num = $stmt->rowCount();
 
    // Verificar se mais de 0 registros foram encontrados
    if ($num > 0) {
        // Array de pizzas
        $bebidas_arr = array();
 
        // Percorrer o resultado da consulta
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // A função extract transforma $row['nome'] em apenas $nome
            extract($row);
 
            $bebida_item = array(
                "id" => $idBebida,
                "nome" => $nome,
                "tipo" => $tipo,
                "qtdLitros" =>$qtdLitros,
                "valor" => $valor
            );
 
            array_push($bebidas_arr, $bebida_item);
        }
 
        http_response_code(200);
 
        echo json_encode($bebidas_arr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Nenhuma bebida encontrada.")
        );
    }
// }
// catch (Exception $e) {
//  echo json_encode(array("erro" => $e->getMessage()));
// 
 