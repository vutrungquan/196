<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_video = $_POST['id_video'];
    $check_date = $_POST['check_date'];
    $revenue = $_POST['revenue'];
    $share_count = $_POST['share_count'];
    $comment_count = $_POST['comment_count'];
    $like_count = $_POST['like_count'];
    $reach_count = $_POST['reach_count'];


    try {

        $sql = "INSERT INTO statistical (id_video, check_date, revenue, share_count, comment_count, like_count, reach_count) 
                VALUES (:id_video, :check_date, :revenue, :share_count, :comment_count, :like_count, :reach_count)";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(':id_video', $id_video);
        $stmt->bindParam(':check_date', $check_date);
        $stmt->bindParam(':revenue', $revenue);
        $stmt->bindParam(':share_count', $share_count);
        $stmt->bindParam(':comment_count', $comment_count);
        $stmt->bindParam(':like_count', $like_count);
        $stmt->bindParam(':reach_count', $reach_count);
        $stmt->execute();

        header('Location: manage_revenue.php');
        exit();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }

    $connection = null;
}
?>
