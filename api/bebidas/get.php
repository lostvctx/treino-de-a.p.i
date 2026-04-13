<?php
// api/pizza/get.php
 
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../confug/Database.php';
include_once '../../models/bebida.php';
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Pizza
$bebida = new bebida($db);

$bebida->idBebida = isset($_GET['id']) ? $_GET['id'] : null;
 
if ($bebida->idBebida) {
    // Busca a pizza
    if ($bebida->read_single()) {

        http_response_code(200);
        echo json_encode($bebida);

    } else {

        http_response_code(404);
        echo json_encode(["mensage" => "bebida não encontrada"]);

    }
} else {
 http_response_code(400);
 echo json_encode(["mensage" => "Parametro id não fornecido"]);
}