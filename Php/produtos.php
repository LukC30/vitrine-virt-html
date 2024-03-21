<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'dbaccess.php';
$db = new DbConnect;
$conn = $db->connect();

$sql = "select a.codprod as id, descricao, prvenda as preco, a.codgru as grupo, nomegru as nome_grupo, caminho
from profilia a
inner join grupo b on a.codgru = b.codgru
inner join profilia_foto c on a.codprod = c.codprod
where a.codprod = c.codprod and c.id_foto = 1";
$path = explode('/', $_SERVER['REQUEST_URI']);
if (isset($path[3]) && is_numeric($path[3])) {
    $sql .= " and a.codprod = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $path[3]);
    $stmt->execute();
    $prod = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $prod = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
echo json_encode($prod);

?>