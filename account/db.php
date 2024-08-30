<?php
$host = 'localhost';
$dbname = 'mikrotel_cusco';
$username = 'root';
$password = 'rootroot';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
    die();
}
?>
