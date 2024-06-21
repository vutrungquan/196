<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_video = $_POST['id_video'];
    $title_video = $_POST['title_video'];
    $id_page = $_POST['id_page'];
    $published_date = $_POST['published_date'];

    try {

        $sql = "INSERT INTO videos (id_video, title_video, id_page, published_date) 
                VALUES (:id_video, :title_video, :id_page, :published_date)";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(':id_video', $id_video);
        $stmt->bindParam(':title_video', $title_video);
        $stmt->bindParam(':id_page', $id_page);
        $stmt->bindParam(':published_date', $published_date);

        $stmt->execute();

        header('Location: manage_videos.php');
        exit();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
