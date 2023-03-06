<?php 
require_once './include/database.php';
$id = $_GET['id'];
$etat = $_GET['etat'];

$sqlstate = $pdo->prepare("update commande set valide = :etat where id= :id");
$sqlstate->bindParam(':etat',$etat);
$sqlstate->bindParam(':id',$id);
$sqlstate->execute();
header('location:commande.php?id='.$id);
