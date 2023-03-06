<?php
require_once './include/database.php';

$id=$_GET['id'];

$sqlstate = $pdo->prepare('delete from categoriee where id=?');
$sqlstate->execute([$id]);
header('location: categories.php');