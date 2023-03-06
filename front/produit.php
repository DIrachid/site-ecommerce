<?php 
    require_once '../include/database.php';
    $sql = $pdo->prepare('select * from produit where id=?');
    $sql->execute([$_GET['id']]);
    $produit=$sql->fetch(PDO::FETCH_ASSOC);
    $idp=$produit['id'];
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
    <link rel="stylesheet" href="../style.css" type="text/css">
    <title>Produit | <?php echo $produit['libelle'] ?></title>
</head>
<body>
    <?php include_once '../include/nav_front.php' ?>
    <div class="container py-2">
      <h4><?php echo $produit['libelle'] ?></h4>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img img-fluid w-75" src="../upload/produit/<?php echo $produit['image'] ?>" alt="">
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center">
                    <h1><?php echo $produit['libelle'] ?></h1>
                    <?php
                        if(!empty($produit['discount'])){
                            ?>
                            <span class="badge text-bg-success">-<?php echo $produit['discount'] ?> %</span>
                            <?php
                        }
                    ?>
                    </div>
                    <hr>
                    <p><?php echo $produit['description'] ?></p>
                    <?php 
                        $total=0;
                        $prix=$produit['prix'];
                        
                        if(!empty($produit['discount'])){
                            $remise = $produit['discount'];
                            $total = $prix-(($prix*$remise)/100);
                            ?>
                            <div class="d-flex align-items-center">
                            <h3><span class="badge text-bg-danger mx-1"><strike><?php echo $prix ?> MAD</strike></span></h3>
                            <h3><span class="badge text-bg-success mx-1"><?php echo $total ?> MAD</span></h3>
                            </div>

                            <?php
                        }else{
                            ?>
                              <h3><span class="badge text-bg-success m-2"><?php echo $prix ?> MAD</span></h3>
                            <?php
                        }
                    ?>

                    <p>
                        <?php include_once '../include/front/counter.php' ?>
                    </p>
                    <hr>
                    <a href="#" class="btn btn-primary">Acheter</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="../assets/js/produit/counter.js"></Script>
</body>
</html>