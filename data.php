<?php
require_once("admin_check.php");

// Conexão com o banco de dados
$servername = "localhost";
$username = "dimy";
$password = "dimymano";
$dbname = "dimy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter os dados do estoque por tipo de produto
$sql = "SELECT tipo, SUM(quantidade) AS quantidade FROM estoque GROUP BY tipo";
$result = $conn->query($sql);

$data = [
    "estoque" => [],
    "entradas" => []
];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data["estoque"][] = $row["quantidade"];
    }
}

// Obter os dados de entradas (últimos 3 dias)
$sql = "SELECT tipo, COUNT(*) AS quantidade 
        FROM produtos 
        WHERE data_adicao >= DATE_SUB(NOW(), INTERVAL 3 DAY) 
        GROUP BY tipo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data["entradas"][] = $row["quantidade"];
    }
} else {
    // Se não houver dados de entradas nos últimos 3 dias, preencher com zeros
    $data["entradas"] = [0, 0, 0];
}

$conn->close();

// Retornar os dados como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
