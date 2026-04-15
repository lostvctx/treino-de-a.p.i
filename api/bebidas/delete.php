<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
include_once '../../confug/Database.php';
include_once '../../models/Bebida.php';
 
// Instanciar o banco de dados e conectar
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Pizza
$Bebida = new Bebida($db);
 
 
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        // Obter os dados postados
        $data = json_decode(file_get_contents("php://input"));
        // Verificar se o ID foi fornecido
        if (!empty($data->id)) {
            // Atribuir o ID para deleção
            $Bebida->idBebida = $data->id;
 
            // Tentar deletar a pizza
            if ($Bebida->delete()) {
                http_response_code(200);
                // Resposta de sucesso
                echo json_encode(
                    array('Mensagem' => 'Bebida Deletada com Sucesso')
                );
            } else {
                http_response_code(500);
                // Resposta de erro
                echo json_encode(
                    array('Mensagem' => 'Nao foi possivel deletar a Pizza.')
                );
            }
        } else {
            http_response_code(400);
            // Resposta se o ID não for fornecido
            echo json_encode(
                array('Mensagem' => 'ID inválido. Nao foi possivel deletar a Bebida.')
            );
        }
 
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array("erro" => $e->getMessage()));
    }
} else {
    http_response_code(405);
    echo json_encode(array("erro" => "Método não suportado!"));
}