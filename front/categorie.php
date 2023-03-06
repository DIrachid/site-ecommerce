<?php session_start() ?>
<?php require_once '../include/database.php' ?>
<?php include_once '../include/nav_front.php' ;
    
    $id = $_GET['id'];
    $sql = $pdo->prepare('select * from categoriee where id=?');
    $sql->execute([$id]);
    $cat = $sql->fetch(PDO::FETCH_ASSOC);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>categorie | <?php echo $cat['libelle'] ?></title>

    
</head>
<body>
    <div class="container">
        <h2><i class="<?php echo $cat['icon'] ?>"></i> <?php echo $cat['libelle'] ?></h2>
        <div class="container">
            <div class="row">
    <?php
    $sqlstate = $pdo->prepare('select * from produit where id_categorie=?');
    $sqlstate->execute([$id]);
    $produits=$sqlstate->fetchAll(PDO::FETCH_OBJ);
    foreach($produits as $produit){
        $idp = $produit->id;
        ?>
        <div class="card mb-3 col-md-3">
                <img src="../upload/produit/<?php echo $produit->image ?>" class="card-img-top" alt="Card image cap">             
                <div class="card-body">
                    <a href="produit.php?id=<?php echo $idp ?>" class="btn stretched-link"></a>
                    <h5 class="card-title"><?php echo $produit->libelle ?></h5>
                    <p class="card-text"><?php echo $produit->prix ?> MAD</p>
                    <p class="card-text"><?php echo $produit->description ?></p>
                    <p class="card-text"><small class="text-muted">Ajoute le : <?php echo date_format(date_create($produit->date_creation),'Y-m-d') ?></small></p>
                </div>
                <dib class="card-footer z-1">
                    <?php include '../include/front/counter.php' ?>
                </dib>
            </div>
        <?php
    }
    if(empty($produit)){
        ?>
        <div class="alert alert-info">
            for moment i don't find that produit next time
        </div>
        <?php
    }
    ?>
             </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="../assets/js/produit/counter.js"></Script>
</body>
</html>