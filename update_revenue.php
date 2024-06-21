<?php
include 'config.php';

// Lấy dữ liệu từ form
$id_statistical = $_POST['id_statistical'];
$id_video = $_POST['id_video'];
$check_date = $_POST['check_date'];
$revenue = $_POST['revenue'];
$share_count = $_POST['share_count'];
$comment_count = $_POST['comment_count'];
$like_count = $_POST['like_count'];
$reach_count = $_POST['reach_count'];

try {
    // Chuẩn bị truy vấn SQL update
    $sql = "UPDATE statistical 
            SET id_video = :id_video, 
                check_date = :check_date, 
                revenue = :revenue, 
                share_count = :share_count, 
                comment_count = :comment_count, 
                like_count = :like_count, 
                reach_count = :reach_count 
            WHERE id_statistical = :id_statistical";
    $stmt = $connection->prepare($sql);

    // Bind các giá trị vào các tham số của truy vấn
    $stmt->bindParam(':id_video', $id_video);
    $stmt->bindParam(':check_date', $check_date);
    $stmt->bindParam(':revenue', $revenue);
    $stmt->bindParam(':share_count', $share_count);
    $stmt->bindParam(':comment_count', $comment_count);
    $stmt->bindParam(':like_count', $like_count);
    $stmt->bindParam(':reach_count', $reach_count);
    $stmt->bindParam(':id_statistical', $id_statistical);

    // Thực thi truy vấn
    $stmt->execute();

    // Chuyển hướng về trang quản lý sau khi cập nhật thành công
    header('Location: manage_revenue.php');
    exit();
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

// Đóng kết nối
$connection = null;
?>
