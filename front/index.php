<?php require_once '../include/database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Front</title>
</head>
<body>
    <?php include_once '../include/nav_front.php' ?>
    <div class="container">
        <h2><i class="fa fa-light fa-list"></i> Listes categories</h2>
        <ul class="list-group list-group-flush w-25">
        <?php
        $sql = $pdo->prepare('select * from categoriee');
        $sql->execute();
        foreach($sql as $categorie){
            ?>
            
                <li class="list-group-item"><i class="<?php echo $categorie['icon'] ?>" ></i> <a class="btn btn-light" href="categorie.php?id=<?php echo $categorie['id'] ?>"><?php echo $categorie['libelle'] ?></a></li>
            
            <?php
        }
        ?>
        </ul>
    </div>
</body>
</html>