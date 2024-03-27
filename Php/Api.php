<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'dbaccess.php'; 
function validateID($id) {
    return is_numeric($id) && intval($id) > 0;
}

$db = new DbConnect;
$conn = $db->connect();

$sql = "SELECT a.codprod AS id, descricao, prvenda AS preco, a.codgru AS grupo, nomegru AS nome_grupo, caminho
        FROM profilia a
        INNER JOIN grupo b ON a.codgru = b.codgru
        INNER JOIN profilia_foto c ON a.codprod = c.codprod
        WHERE a.codprod = c.codprod AND c.id_foto = 1";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (validateID($id)) {
        $sql .= " AND a.codprod = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]); 
        $prod = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($prod)) {
            http_response_code(404); 
            echo json_encode(array("error" => "Produto não encontrado."));
        } else {
            echo json_encode($prod);
        }
    } else {
        http_response_code(400); 
        echo json_encode(array("error" => "ID inválido."));
    }
} else {
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $prod = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($prod);
}
?>
