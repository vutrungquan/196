<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $page_title = $_POST['page_title'];

    try {
        $sql = "INSERT INTO pages (page_title) VALUES (:page_title)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':page_title', $page_title);
        $stmt->execute();
        header('Location: manage_pages.php');
        exit();
    } catch (PDOException $e) {

        echo "Lỗi: " . $e->getMessage();
    }
}
?>
