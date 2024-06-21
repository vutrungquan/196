<?php
include 'config.php';

$id = $_GET['id'];

try {
  
    $stmt = $connection->prepare("DELETE FROM videos WHERE id_video = :id_video");
    $stmt->bindParam(':id_video', $id, PDO::PARAM_STR);

    $stmt->execute();

    header('Location: manage_videos.php');
    exit();
} catch (PDOException $e) {

    echo "Lỗi khi xóa video: " . $e->getMessage();
}

$connection = null;
?>
