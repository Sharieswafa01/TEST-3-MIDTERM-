<?php
session_start();
session_unset();
session_destroy();
header("Location: procedural_login.php");
exit;
?>
