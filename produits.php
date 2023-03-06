<?php
    // connexion
    require_once './include/database.php';

    // navbar
    include_once './include/nav.php';
    ?>
<?php if(empty($_SESSION['utilisateur'])){
    header('location: connexion.php');
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
        <h3>Listes des produits</h3>
        <a href="ajouter_produit.php" class="btn btn-primary my-3">Ajouter Produit</a>
        <table class="table table-striped table-hover">
            <tr>
                <th>id</th>
                <th>libelle</th>
                <th>Prix</th>
                <th>discount</th>
                <th>categorie</th>
                <th>date</th>
                <th>Image</th>
                <th>Operation</th>
            </tr>
            <?php
            $sql = $pdo->prepare("select produit.*,categoriee.libelle as 'libelle_categorie' from produit inner join categoriee on produit.id_categorie = categoriee.id");
            $sql->execute();
            foreach($sql as $produit){
                ?>
                <tr>
                    <td><?php echo $produit['id'] ?></td>
                    <td><?php echo $produit['libelle'] ?></td>
                    <td><?php echo $produit['prix'] ?></td>
                    <td><?php echo $produit['discount'] ?></td>
                    <td><?php echo $produit['libelle_categorie'] ?></td>
                    <td><?php echo $produit['date_creation'] ?></td>
                    <td><img src="upload/produit/<?php echo $produit['image'] ?>" width="100px" height="100px" alt=""></td>
                    <td>
                        <a href="modifier_produit.php?id=<?php echo $produit['id'] ?>" class="btn btn-success">modifier</a>
                        <a href="supprimer_produit.php?id=<?php echo $produit['id'] ?>" onclick="return confirm('Voulez vous vraiment supprimer <?php echo $produit['libelle'] ?>')" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>