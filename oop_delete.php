<?php
session_start();
require_once 'classes/DB.php';

if (!isset($_GET['id'])) {
    header("Location: oop_dashboard.php");
    exit();
}

$db = new DB();
$db->deleteUser($_GET['id']);
header("Location: oop_dashboard.php");
exit();
?>
