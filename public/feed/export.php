<?php

require_once __DIR__.'/../../vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

if (!isset($_GET['code'])) {
    return false;
}

try {
    $pdo = new PDO("pgsql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    $stm = $pdo->prepare("SELECT * FROM organizations WHERE code = ?");
    $stm->bindValue(1, $_GET['code']);
    $stm->execute();

    $data = $stm->fetch(PDO::FETCH_ASSOC);

    if ($data && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $data['feed_path'])) {
        header('Content-Type: application/xml');
        header('Last-modified: ' . date('D, j F y H:i:s', strtotime($data['updated_at'])) . ' +0600');
        echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/' . $data['feed_path']);

        exit;
    }

} catch (\PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}

http_response_code(404);