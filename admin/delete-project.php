<?php
session_start();

// I use this for auth check
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// This is to check if the a person tries to reach this action but not clicking the submit button
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admin-page.php');
    exit;
}

spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $filepath = __DIR__ . '/../includes/' . $class . '.php';
    $filepath = str_replace("/", DIRECTORY_SEPARATOR, $filepath);
    require_once $filepath;
});

use Portfolio\Database;
use PDO;
$db = new Database();
$connection = $db->connect();

// I use this to get project name for the message
$stmt = $connection->prepare("SELECT title FROM projects WHERE id = ?");
$stmt->bindParam(1, $_POST['id'], PDO::PARAM_INT);
$stmt->execute();
$project = $stmt->fetch(PDO::FETCH_ASSOC);
$title = $project['title'] ?? 'Unknown';

// I use this logic for Delete - foreign keys with ON DELETE CASCADE handle tags, tools, gallery
$stmt = $connection->prepare("DELETE FROM projects WHERE id = ?");
$stmt->bindParam(1, $_POST['id'], PDO::PARAM_INT);
$stmt->execute();

$_SESSION['message'] = 'Project "' . $title . '" has been deleted.';
header('Location: admin-page.php');
exit;

?>