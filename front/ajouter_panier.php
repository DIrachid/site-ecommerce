<?php
session_start();
if(empty($_SESSION['utilisateur'])){
    header('location: ../connexion.php');
}else{

    $id=$_POST['id'];
    $qty=$_POST['quantite'];
    $id_utilisateur=$_SESSION['utilisateur']['id'];
    if(!isset($_SESSION['panier'][$id_utilisateur])){
        $_SESSION['panier'][$id_utilisateur]=[];
    }
    if($qty == 0){
        unset($_SESSION['panier'][$id_utilisateur][$id]);
               
    }else{
        $_SESSION['panier'][$id_utilisateur][$id]=$qty; 
    }
}
header('location: '.$_SERVER['HTTP_REFERER']);