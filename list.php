<?php
include 'database.php';
include 'manage.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add_page':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $page_title = $_POST['page_title'];
            addPage($page_title);
            header("Location: list.php");
            exit();
        }
        break;
    case 'edit_page':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_page = $_GET['id'];
            $page_title = $_POST['page_title'];
            editPage($id_page, $page_title);
            header("Location: list.php");
            exit();
        }
        break;
    case 'delete_page':
        $id_page = $_GET['id'];
        deletePage($id_page);
        header("Location: list.php");
        exit();
        break;
    case 'add_video':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_video = $_POST['id_video'];
            $title_video = $_POST['title_video'];
            $id_page = $_POST['id_page'];
            addVideo($id_video, $title_video, $id_page);
            header("Location: list.php");
            exit();
        }
        break;
    case 'edit_video':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_video = $_GET['id'];
            $title_video = $_POST['title_video'];
            $id_page = $_POST['id_page'];
            editVideo($id_video, $title_video, $id_page);
            header("Location: list.php");
            exit();
        }
        break;
    case 'delete_video':
        $id_video = $_GET['id'];
        deleteVideo($id_video);
        header("Location: list.php");
        exit();
        break;
    case 'add_stat':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_video = $_POST['id_video'];
            $check_date = $_POST['check_date'];
            $revenue = $_POST['revenue'];
            $share_count = $_POST['share_count'];
            $comment_count = $_POST['comment_count'];
            $like_count = $_POST['like_count'];
            $reach_count = $_POST['reach_count'];
            $published_date = $_POST['published_date'];
            addStatistical($id_video, $check_date, $revenue, $share_count, $comment_count, $like_count, $reach_count, $published_date);
            header("Location: list.php");
            exit();
        }
        break;
    case 'edit_stat':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_statistical = $_GET['id'];
            $id_video = $_POST['id_video'];
            $check_date = $_POST['check_date'];
            $revenue = $_POST['revenue'];
            $share_count = $_POST['share_count'];
            $comment_count = $_POST['comment_count'];
            $like_count = $_POST['like_count'];
            $reach_count = $_POST['reach_count'];
            $published_date = $_POST['published_date'];
            editStatistical($id_statistical, $id_video, $check_date, $revenue, $share_count, $comment_count, $like_count, $reach_count, $published_date);
            header("Location: list.php");
            exit();
        }
        break;
    case 'delete_stat':
        $id_statistical = $_GET['id'];
        deleteStatistical($id_statistical);
        header("Location: list.php");
        exit();
        break;
    default:
        break;
}

$pages = getAllPages($connection);
$videos = getAllVideos($connection);
$statisticals = getAllStatistical($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Management</title>
</head>

<body>
    <h1>Database Management</h1>

    <h2>Pages</h2>
    <ul>
        <?php foreach ($pages as $page): ?>
        <li>
            <?php echo $page['page_title']; ?>
            <a href="list.php?action=edit_page&id=<?php echo $page['id_page']; ?>">Edit</a>
            <a href="list.php?action=delete_page&id=<?php echo $page['id_page']; ?>">Delete</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <form method="POST" action="list.php?action=add_page">
        <input type="text" name="page_title" placeholder="Page Title">
        <input type="submit" value="Add Page">
    </form>
    <form method="POST" action="list.php?action=edit_page&id=<?php echo $page['id_page']; ?>">
        <input type="text" name="page_title" value="<?php echo $page['page_title']; ?>" placeholder="Page Title">
        <input type="submit" value="Save">
    </form>
    <h2>Videos</h2>
    <ul>
        <?php foreach ($videos as $video): ?>
        <li>
            <?php echo $video['title_video']; ?> (Page ID: <?php echo $video['id_page']; ?>)
            <a href="list.php?action=edit_video&id=<?php echo $video['id_video']; ?>">Edit</a>
            <a href="list.php?action=delete_video&id=<?php echo $video['id_video']; ?>">Delete</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <form method="POST" action="list.php?action=add_video">
        <input type="text" name="id_video" placeholder="Video ID">
        <input type="text" name="title_video" placeholder="Video Title">
        <input type="text" name="id_page" placeholder="Page ID">
        <input type="submit" value="Add Video">
    </form>
    <form method="POST" action="list.php?action=edit_video&id=<?php echo $video['id_video']; ?>">
        <input type="text" name="id_video" value="<?php echo $video['id_video']; ?>" placeholder="Video ID">
        <input type="text" name="title_video" value="<?php echo $video['title_video']; ?>" placeholder="Video Title">
        <input type="text" name="id_page" value="<?php echo $video['id_page']; ?>" placeholder="Page ID">
        <input type="submit" value="Save">
    </form>
    <h2>Statistical Data</h2>
    <ul>
        <?php foreach ($statisticals as $statistical): ?>
        <li>
            Video ID: <?php echo $statistical['id_video']; ?>, Date: <?php echo $statistical['check_date']; ?>
            <a href="list.php?action=edit_stat&id=<?php echo $statistical['id_statistical']; ?>">Edit</a>
            <a href="list.php?action=delete_stat&id=<?php echo $statistical['id_statistical']; ?>">Delete</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <form method="POST" action="list.php?action=add_stat">
        <input type="text" name="id_video" placeholder="Video ID">
        <input type="date" name="check_date" placeholder="Check Date">
        <input type="text" name="revenue" placeholder="Revenue">
        <input type="text" name="share_count" placeholder="Share Count">
        <input type="text" name="comment_count" placeholder="Comment Count">
        <input type="text" name="like_count" placeholder="Like Count">
        <input type="text" name="reach_count" placeholder="Reach Count">
        <input type="datetime-local" name="published_date" placeholder="Published Date">
        <input type="submit" value="Add Stat">
    </form>
    <form method="POST" action="list.php?action=edit_stat&id=<?php echo $statistical['id_statistical']; ?>">
        <input type="text" name="id_video" value="<?php echo $statistical['id_video']; ?>" placeholder="Video ID">
        <input type="date" name="check_date" value="<?php echo $statistical['check_date']; ?>" placeholder="Check Date">
        <input type="text" name="revenue" value="<?php echo $statistical['revenue']; ?>" placeholder="Revenue">
        <input type="text" name="share_count" value="<?php echo $statistical['share_count']; ?>"
            placeholder="Share Count">
        <input type="text" name="comment_count" value="<?php echo $statistical['comment_count']; ?>"
            placeholder="Comment Count">
        <input type="text" name="like_count" value="<?php echo $statistical['like_count']; ?>" placeholder="Like Count">
        <input type="text" name="reach_count" value="<?php echo $statistical['reach_count']; ?>"
            placeholder="Reach Count">
        <input type="datetime-local" name="published_date"
            value="<?php echo date('Y-m-d\TH:i:s', strtotime($statistical['published_date'])); ?>"
            placeholder="Published Date">
        <input type="submit" value="Save">
    </form>
</body>

</html>