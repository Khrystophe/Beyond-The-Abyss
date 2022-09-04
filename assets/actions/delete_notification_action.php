<?php
session_start();
require('../require/check_data.php');

require('../require/co_bdd.php');

$req = $bdd->prepare('DELETE FROM notifications WHERE id = :id');
$req->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$req->execute();

header('location: ../../my_account.php?success=notification_deleted');
