<?php 
require_once 'confug/database.php';
require_once 'models/bebida.php'; // Incluímos nossa nova classe
 
echo "<h1>Testando Conexão e Modelo</h1>";
 
$database = new Database();
$db = $database->getConnection();
 
if (!$db) {
    echo "<p style='color: red;'>Falha na conexão.</p>";
    die(); // Encerra o script se não houver conexão
}
 
echo "<p style='color: green;'>Conexão bem-sucedida!</p>";
 
echo "<h2>Criando um objeto bebida...</h2>";
 
// Criamos uma instância da classe bebida, passando a conexão com o banco
$bebida = new bebida($db);
 
// Atribuímos valores às suas propriedades públicas
$bebida->nome = 'Margherita';
$bebida->ingredientes = 'Mussarela, fatias de tomate e manjericão fresco';
$bebida->valor = 42.50;
 
// Vamos inspecionar o objeto!
echo "<pre>"; // A tag <pre> ajuda a formatar a saída do print_r
print_r($bebida);
echo "</pre>";