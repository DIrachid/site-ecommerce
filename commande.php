<?php
require_once './include/database.php';
include_once './include/nav.php';
$id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">    
    <title>Commande <?php echo $id ?></title>
</head>
<body>
    <div class="p-2">
        <h4>Commande N <?php echo $id ?></h4>
        <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Validation</th>
                </tr>
            </thead>
                <?php
                $requete = $pdo->prepare('select commande.*,utilisateur.login as "name_client" from commande inner join utilisateur on commande.id_client = utilisateur.id where commande.id = :id');
                $requete->bindParam(':id',$id);
                $requete->execute();
                $ligne = $requete->fetch();
                ?>
                <tr>
                    <td><?php echo $ligne['id'] ?></td>
                    <td><?php echo $ligne['name_client'] ?></td>
                    <td><?php echo $ligne['total'] ?></td>
                    <td><?php echo $ligne['date_creation'] ?></td>
                    <?php if($ligne['valide'] == 0): ?>
                    <td><a href="valider_commande.php?id=<?php echo $ligne['id'] ?>&etat=1" class="btn btn-success sm">Valider la commande</a></td>
                    <?php else : ?>
                    <td><a href="valider_commande.php?id=<?php echo $ligne['id'] ?>&etat=0" class="btn btn-danger sm">Annuler la commande</a></td>
                    <?php endif; ?>
                </tr>
        </table>
        </div>
        <hr>
        <h4>Produits</h4>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>produit</th>
                    <th>image</th>
                    <th>prix</th>
                    <th>quantite</th>
                    <th>total</th>
                </tr>
            </thead>
                <?php
                $requetes = $pdo->prepare('select ligne_commande.*,produit.* from ligne_commande inner join produit on ligne_commande.id_produit = produit.id where ligne_commande.id_commande=?');
                $requetes->execute([$id]);
                $lignes = $requetes->fetchAll();
                foreach($lignes as $produit){
                ?>
                <tr>
                    <td><?php echo $produit['id'] ?></td>
                    <td><?php echo $produit['libelle'] ?></td>
                    <td><img width="80px" src="upload/produit/<?php echo $produit['image'] ?>" alt=""></td>
                    <td><?php echo $produit['prix'] ?></td>
                    <td><?php echo $produit['quantite'] ?></td>
                    <td><?php echo $produit['total'] ?></td>
                </tr>
                <?php } ?>
        </table>
    </div>
</body>
</html>