<?php include_once './include/nav.php' ?>
<?php require_once './include/database.php';


// hadi dyal session

if(empty($_SESSION['utilisateur'])){
    header('location: connexion.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Categories</title>
</head>
<body>

    <div class="container py-2">
        <h2>Listes des categories</h2>
        <a href="ajouter_categorie.php" class="btn btn-primary my-3">Ajouter Categorie</a>
        <table class="table mytable table-striped table-hover">
            <tr>
                <th>Id</th>
                <th>libelle</th>
                <th>description</th>
                <th>date</th>
                <th>icon</th>
                <th>Operation</th>
            </tr>
                <?php
                $sql = $pdo->prepare('select * from categoriee');
                $sql->execute();
                foreach($sql as $categorie){
                ?>
                    <tr>
                        <td><?php echo $categorie['id'] ?></td>
                        <td><?php echo $categorie['libelle'] ?></td>
                        <td><?php echo $categorie['description'] ?></td>
                        <td><?php echo $categorie['create_date'] ?></td>
                        <td><i class="<?php echo $categorie['icon'] ?>"></i></td>
                        <td>
                            <a href="modifier_categorie.php?id=<?php echo $categorie['id'] ?>"  class="btn btn-success">Modifier</a>
                            <a href="supprimer_categorie.php?id=<?php echo $categorie['id'] ?>" onclick="return confirm('voulez vous vraiment supprimer la categorie <?php echo $categorie['libelle'] ?>')" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
        </table>
    </div>
</body>
</html>