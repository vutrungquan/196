<?php
include 'config.php';

// Kiểm tra xem id có tồn tại không
if (!isset($_GET['id'])) {
    die('Không có ID được cung cấp');
}

$id = $_GET['id'];

try {
    $stmt = $connection->prepare("DELETE FROM statistical WHERE id_statistical = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    $stmt->execute();
    
    header('Location: manage_revenue.php');
    exit();
} catch (PDOException $e) {

    echo "Lỗi khi xóa dữ liệu thống kê: " . $e->getMessage();
}

$connection = null;
?>
