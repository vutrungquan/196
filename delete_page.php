<?php
include 'config.php';


if (!isset($_GET['id'])) {
    die('Không có ID được cung cấp');
}

$id = $_GET['id'];

try {

    $stmt = $connection->prepare("DELETE FROM pages WHERE id_page = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    $stmt->execute();

    header('Location: manage_pages.php');
    exit();
} catch (PDOException $e) {

    echo "Lỗi khi xóa trang: " . $e->getMessage();
}

$connection = null;
?>
