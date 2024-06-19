<?php
include 'database.php';

function addPage($page_title) {
    global $connection;
    $sql = "INSERT INTO pages (page_title) VALUES (:page_title)";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':page_title', $page_title);
    $stmt->execute();
    return $connection->lastInsertId();
}

function editPage($id_page, $page_title) {
    global $connection;
    $sql = "UPDATE pages SET page_title = :page_title WHERE id_page = :id_page";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':page_title', $page_title);
    $stmt->bindParam(':id_page', $id_page);
    $stmt->execute();
}

function deletePage($id_page) {
    global $connection;
    $sql = "DELETE FROM pages WHERE id_page = :id_page";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_page', $id_page);
    $stmt->execute();
}

function addVideo($id_video, $title_video, $id_page) {
    global $connection;
    $sql = "INSERT INTO videos (id_video, title_video, id_page) VALUES (:id_video, :title_video, :id_page)";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_video', $id_video);
    $stmt->bindParam(':title_video', $title_video);
    $stmt->bindParam(':id_page', $id_page);
    $stmt->execute();
}

function editVideo($id_video, $title_video, $id_page) {
    global $connection;
    $sql = "UPDATE videos SET title_video = :title_video, id_page = :id_page WHERE id_video = :id_video";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':title_video', $title_video);
    $stmt->bindParam(':id_page', $id_page);
    $stmt->bindParam(':id_video', $id_video);
    $stmt->execute();
}

function deleteVideo($id_video) {
    global $connection;
    $sql = "DELETE FROM videos WHERE id_video = :id_video";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_video', $id_video);
    $stmt->execute();
}

function addStatistical($id_video, $check_date, $revenue, $share_count, $comment_count, $like_count, $reach_count, $published_date) {
    global $connection;
    $sql = "INSERT INTO statistical (id_video, check_date, revenue, share_count, comment_count, like_count, reach_count, published_date)
            VALUES (:id_video, :check_date, :revenue, :share_count, :comment_count, :like_count, :reach_count, :published_date)";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_video', $id_video);
    $stmt->bindParam(':check_date', $check_date);
    $stmt->bindParam(':revenue', $revenue);
    $stmt->bindParam(':share_count', $share_count);
    $stmt->bindParam(':comment_count', $comment_count);
    $stmt->bindParam(':like_count', $like_count);
    $stmt->bindParam(':reach_count', $reach_count);
    $stmt->bindParam(':published_date', $published_date);
    $stmt->execute();
}

function editStatistical($id_statistical, $id_video, $check_date, $revenue, $share_count, $comment_count, $like_count, $reach_count, $published_date) {
    global $connection;
    $sql = "UPDATE statistical SET id_video = :id_video, check_date = :check_date, revenue = :revenue, share_count = :share_count, comment_count = :comment_count, like_count = :like_count, reach_count = :reach_count, published_date = :published_date WHERE id_statistical = :id_statistical";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_video', $id_video);
    $stmt->bindParam(':check_date', $check_date);
    $stmt->bindParam(':revenue', $revenue);
    $stmt->bindParam(':share_count', $share_count);
    $stmt->bindParam(':comment_count', $comment_count);
    $stmt->bindParam(':like_count', $like_count);
    $stmt->bindParam(':reach_count', $reach_count);
    $stmt->bindParam(':published_date', $published_date);
    $stmt->bindParam(':id_statistical', $id_statistical);
    $stmt->execute();
}

function deleteStatistical($id_statistical) {
    global $connection;
    $sql = "DELETE FROM statistical WHERE id_statistical = :id_statistical";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id_statistical', $id_statistical);
    $stmt->execute();
}
function getAllPages($connection) {
    $sql = "SELECT * FROM pages";
    $stmt = $connection->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function getAllVideos($connection) {
    $sql = "SELECT * FROM videos";
    $stmt = $connection->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function getAllStatistical($connection) {
    $sql = "SELECT * FROM statistical";
    $stmt = $connection->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>