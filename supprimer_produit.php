<?php

$id = $_GET['id'];

require_once './include/database.php';

$data = $pdo->prepare('delete from produit where id=?');
$data->execute([$id]);
header('location: produits.php');
