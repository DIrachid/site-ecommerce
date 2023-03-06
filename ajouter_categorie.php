<?php include_once './include/nav.php' ?>
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
    <title>Ajouter utilisateur</title>
</head>
<body>
    
    <div class="container">
        <form action="" method="post">
            <h4 class="my-2">Ajouter Gategorie</h4>
            <?php
            if(isset($_POST['ajouter'])){
                $libelle = $_POST['libelle'];
                $description= $_POST['description'];
                $icon=$_POST['icon'];
                if(!empty($libelle) && !empty($description) && !empty($icon)){
                    require_once './include/database.php';
                    $sqlstate = $pdo->prepare('insert into categoriee(libelle,description,icon) values(?,?,?)');
                    $sqlstate->execute([$libelle,$description,$icon]);
                    header('location: categories.php');
                }else{
                    ?>
                    <div class="alert alert-danger">
                        please charge this field
                    </div>
                    <?php
                }
            }
            ?>
            <label class="form-label">Libelle</label>
            <input type="text" name="libelle" class="form-control">

            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" ></textarea>

            <label for="" class="form-label">icone</label>
            <input type="text" name="icon" class="form-control">

            <input type="submit" name="ajouter" value="Ajouter" class="btn btn-primary my-2">
        </form>
    </div>
</body>
</html>