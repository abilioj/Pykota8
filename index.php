<?php
include './vendor/autoload.php';

$conn = new ConexaoPostgres();
$conn->TestConect();
echo '' . $conn->getString();

