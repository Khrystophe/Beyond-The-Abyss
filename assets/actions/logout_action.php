
<?php
session_start();
unset($_SESSION['users']);
session_destroy();
$bdd = null;
header('location: ../../index.php?success=012217');
die();
?>