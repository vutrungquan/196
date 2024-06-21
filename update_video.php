<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $id_video = $_POST['id_video'];
    $title_video = $_POST['title_video'];
    $id_page = $_POST['id_page'];
    $published_date = $_POST['published_date'];

    try {
        // Chuẩn bị truy vấn SQL update
        $sql = "UPDATE videos SET title_video = :title_video, id_page = :id_page, published_date = :published_date WHERE id_video = :id_video";
        $stmt = $connection->prepare($sql);

        // Bind các giá trị vào các tham số của truy vấn
        $stmt->bindParam(':title_video', $title_video);
        $stmt->bindParam(':id_page', $id_page);
        $stmt->bindParam(':published_date', $published_date);
        $stmt->bindParam(':id_video', $id_video);

        // Thực thi truy vấn
        $stmt->execute();

        // Chuyển hướng về trang quản lý video sau khi cập nhật thành công
        header('Location: manage_videos.php');
        exit();
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// Đóng kết nối
$connection = null;
?>
