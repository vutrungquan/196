<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_page = $_POST['id_page'];
    $page_title = $_POST['page_title'];

    try {

        $sql = "UPDATE pages SET page_title = :page_title WHERE id_page = :id_page";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(':page_title', $page_title);
        $stmt->bindParam(':id_page', $id_page);

        $stmt->execute();
        header('Location: manage_pages.php');
        exit();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
    $connection = null;
}
?>
