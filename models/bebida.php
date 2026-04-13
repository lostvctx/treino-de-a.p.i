<?php
 
class Bebida{
 
    private $conn;
    private $tabela ="bebidas";
    public $idBebida;
    public $nome;
    public $tipo;
    public $qtdLitros;
    public $valor;
 
    public function __construct($db) {
        $this->conn = $db;
    }
    function read() {
        // Query SQL para selecionar todos os campos da tabela de pizzas
        $query = "SELECT idBebida, nome, tipo, qtdLitros, valor FROM " . $this->tabela . " ORDER BY valor";
 
        // Prepara a query
        $stmt = $this->conn->prepare($query);
 
        // Executa a query
        $stmt->execute();
 
        return $stmt;
    }


    public function create()
    {
        // Query de inserção
        $query = 'INSERT INTO ' . $this->tabela . ' SET nome = :nome, tipo = :tipo, qtdLitros = :qtdLitros, valor = :valor';
 
        // Preparar a query
        $stmt = $this->conn->prepare($query);
 
        // Limpar os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));
        $this->qtdLitros = htmlspecialchars(strip_tags($this->qtdLitros));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
       
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':qtdLitros', $this->qtdLitros);
        $stmt->bindParam(':valor', $this->valor);
 
        // Executar a query
        if ($stmt->execute()) {
            return true;
        }    
        return false;
    }

    
    public function read_single()
    {
        $query = 'SELECT
        p.idbebida,
        p.nome,
        p.tipo,
        p.qtdLitros,
        p.valor
    FROM
        ' . $this->tabela . ' p
    WHERE
        p.idBebida = ?
    LIMIT 1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->idBebida);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //  VALIDAÇÃO IMPORTANTE
        if ($row) {
            $this->idBebida = $row['idbebida'];
            $this->nome = $row['nome'];
            $this->tipo = $row['tipo'];
            $this->qtdLitros = $row['qtdLitros'];
            $this->valor = $row['valor'];
            return true;
        } else {
            return false;
        }
    }

}
 
 