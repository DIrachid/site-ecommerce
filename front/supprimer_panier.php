<?php
session_start();
if(!isset($_SESSION['utilisateur'])){
    header('location: connexion.php');
}
$id=$_POST['id'];
$id_utilisateur = $_SESSION['utilisateur']['id'];
unset($_SESSION['panier'][$id_utilisateur][$id]);
header('location:'.$_SERVER['HTTP_REFERER']);