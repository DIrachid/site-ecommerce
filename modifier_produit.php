<?php 
require_once './include/database.php';
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
    <title>Modifier produit</title>
</head>
<body>
    <?php include_once './include/nav.php' ?>
    <?php
    $sql = $pdo->prepare("select * from produit where id=?");
    $sql->execute([$id]);
    $produit = $sql->fetch();
    if(isset($_POST['modifier'])){
        $libelle = $_POST['libelle'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $categ = $_POST['categorie'];
        $description = $_POST['description'];

        $file_name='produit.png';
        if(!empty($_FILES['image']['name'])){
            $file_name=uniqid() . $file_name;
            move_uploaded_file($_FILES['image']['tmp_name'],'upload/produit/' . $file_name);
        }
        
        if(!empty($libelle) && !empty($prix) && !empty($categ)){
            if(isset($_FILES['image']['name'])){
                $data = $pdo->prepare('update produit set libelle=?,prix=?,discount=?,id_categorie=?,description=? where id=?');
                $data->execute([$libelle,$prix,$discount,$categ,$description,$id]);
                header('location: produits.php');           
            }else{
                $data = $pdo->prepare('update produit set libelle=?,prix=?,discount=?,id_categorie=?,description=?,image=? where id=?');
                $data->execute([$libelle,$prix,$discount,$categ,$description,$file_name,$id]);
                header('location: produits.php');
            }
        }
    }
    ?>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h4 class="my-2">Modifier Produit</h4>
            <label class="form-label">Libelle</label>
            <input type="text" value="<?php echo $produit['libelle'] ?>" name="libelle" class="form-control">

            <label for="" class="form-label">Prix</label>
            <input type="text" value="<?php echo $produit['prix'] ?>" name="prix" min="0" class="form-control">

            <label for="" class="form-label">Discount</label>
            <input type="text" value="<?php echo $produit['discount'] ?>" name="discount" min="0" max="90" class="form-control">

            <label for="" class="form-label">Description</label>
            <textarea name="description" class="form-control"><?php echo $produit['description'] ?></textarea>

            <label for="" class="form-label">image</label>
            <input type="file" name="image" class="form-control">
            <div class="card mb-3 col-md-3 m-3">
                <img src="upload/produit/<?php echo $produit['image'] ?>" alt="" class="card-image-top">
            </div>

            <label for="" class="form-label">Categorie</label>
            <select name="categorie" id="" class="form-control my-2">
                <option value="" class="form-control">Choisiez un categorie</option>
                <?php 
                $sqlstate = $pdo->query('select * from categoriee')->fetchAll(PDO::FETCH_ASSOC);
                foreach($sqlstate as $sqlstates){
                $selected = $produit['id_categorie'] == $sqlstates['id']?'selected':'';
                    echo "<option $selected value='".$sqlstates['id']."' >".$sqlstates['libelle']."</option>";
                } ?>    
            </select>
            <input type="submit" name="modifier" value="Modifier" class="btn btn-primary my-2">
        </form>
    </div>
</body>
</html>