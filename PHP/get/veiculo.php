<?php
header('Content-Type: application/json');
require_once('../../conn/conn.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['error' => 'ID não fornecido']);
    exit;
}

// Prevenção contra SQL Injection
$stmt = $conn->prepare("SELECT preco_venda FROM veiculos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(['preco_venda' => $row['preco_venda']]);
} else {
    echo json_encode(['error' => 'Veículo não encontrado']);
}
?>