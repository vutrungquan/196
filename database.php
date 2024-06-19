<?php

define('DATABASE_SERVER', 'localhost');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', 'trungquanadg123');
define('DATABASE_NAME', 'manager');
$connection = null;

try {

    $connection = new PDO(
        "mysql:host=".DATABASE_SERVER.";dbname=".DATABASE_NAME, 
        DATABASE_USER, DATABASE_PASSWORD
    );
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 

    $sql = "INSERT INTO pages (page_title) VALUES ('FC QUỲNH TRANG');";
    $sql .= "INSERT INTO pages (page_title) VALUES ('FC QUỲNH TRANG');";

    $sql .= "INSERT INTO videos (id_video, title_video, id_page) VALUES ('2343959542469340', 'FC Mừng kỷ niệm 8 năm ca hát của pé Chang 🎊🎊🎊🎊', '1');";
    $sql .= "INSERT INTO videos (id_video, title_video, id_page) VALUES ('7206551692783680', 'CHỒNG XA - QUỲNH TRANG Cre : Quỳnh Trang Official', '2');";

   
    $sql .= "INSERT INTO statistical (id_video, check_date, revenue, share_count, comment_count, like_count, reach_count, published_date) VALUES ('2343959542469340', '2024-06-17', '0', '36', '150' ,'2853', '160160', '2024-04-22 15:49:00');";
    $sql .= "INSERT INTO statistical (id_video, check_date, revenue, share_count, comment_count, like_count, reach_count, published_date) VALUES ('7206551692783680', '2024-06-17', '0', '31', '83' ,'1429', '67491', '2024-04-20 11:25:00');";

    $sql = "UPDATE videos SET title_video = 'ĐƯỜNG TRẦN LÁ ĐỔ (DUY KHÁNH) - QUỲNH TRANG' WHERE id_video = '2343959542469340';";
    $sql = "DELETE FROM pages WHERE id_page = 1;";
    $connection->exec($sql);
    
   
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $connection = null;
}
$connection = null;
?>
