<?php include_once './include/nav.php' ?>
<?php

    // dyal session
    if(!isset($_SESSION['utilisateur'])){
        header('location: connexion.php');
    }

    require_once './include/database.php';
    if(isset($_POST['ajouter'])){
        
        $libelle = $_POST['libelle'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $cat = $_POST['categorie'];
        $date = date('Y-m-d H:i:s');
        $description=$_POST['description'];

        if(empty($discount)){
            $discount=0;
        }

        $file_name='produit.png';
        if(!empty($_FILES['image']['name'])){
            $name_image = $_FILES['image']['name'];
            $file_name = uniqid().$name_image;
            move_uploaded_file($_FILES['image']['tmp_name'],'upload/produit/' . $file_name);
        }
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
    <title>Ajouter produit</title>
</head>
<body>
    
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h4 class="my-2">Ajouter Produit</h4>
            <?php
            if(!empty($libelle) && !empty($prix) && !empty($cat) ){
                $sqlstate = $pdo->prepare('insert into produit values(null,?,?,?,?,?,?,?)');
                $sqlstate->execute([$libelle,$prix,$discount,$cat,$date,$description,$file_name]);
            }else{?>
                <div class="alert alert-danger">
                    please remplir cette fieled
                </div>
            <?php }
            ?>
            <label class="form-label">Libelle</label>
            <input type="text" name="libelle" class="form-control">

            <label for="" class="form-label">Prix</label>
            <input type="text" name="prix" min="0" class="form-control">

            <label for="" class="form-label">Discount</label>
            <input type="text" name="discount" min="0" max="90" class="form-control">

            <label for="" class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>

            <label for="" class="form-label">Image</label>    
            <input type="file" name="image" class="form-control">

            <label for="" class="form-label">Categorie</label>
            <select name="categorie" id="" class="form-control my-2">
                <option value="" class="form-control">Choissez une categorie</option>
            <?php
            
            $sqlstate = $pdo->query('select * from categoriee')->fetchAll(PDO::FETCH_ASSOC);
            foreach($sqlstate as $categorie){?>
                <option class='form-control' value="<?php echo $categorie['id'] ?>"><?php echo $categorie['libelle'] ?></option>
            <?php }
            ?>

            <label class="form-label">Date creation</label>

            <input type="submit" name="ajouter" value="Ajouter" class="btn btn-primary my-2">
        </form>
    </div>
</body>
</html>