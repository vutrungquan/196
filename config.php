<?php

define('DATABASE_SERVER', 'localhost');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', 'trungquanadg123');
define('DATABASE_NAME', 'manager');

try {

    $connection = new PDO(
        "mysql:host=".DATABASE_SERVER.";dbname=".DATABASE_NAME, 
        DATABASE_USER, DATABASE_PASSWORD
    );

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    echo "Kết nối thất bại: " . $e->getMessage();
    $connection = null;
}
?>
