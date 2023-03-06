<?php session_start();
require_once '../include/database.php';
include_once '../include/nav_front.php';
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
    <title>Panier</title>
</head>
<body>
    <?php 
    $tom=0;
    $id_utilisateur = $_SESSION['utilisateur']['id'];
    $panier = $_SESSION['panier'][$id_utilisateur];
    if(!empty($panier)){
    $id=array_keys($panier);
    // array keys is send valeur => [1,2,3,4]
    $id_pr = implode(',',$id);
    // and mysql understand that 1,2,3,4
    $id_pro = '('.$id_pr.')';
    $sql = $pdo->prepare("select * from produit where id in $id_pro");
    $sql->execute();
    $produit = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
    <div class="container">
    <h4>Panier</h4>
    <?php
        // had sql dyal ligne commande
        $sql = 'insert into ligne_commande(id_produit,id_commande,prix,quantite,total,date_creation)values';
        if(isset($_POST['vider'])){
            $_SESSION['panier'][$id_utilisateur]=[];
            echo "<script> window.location.href='panier.php'</script>";
        }
        if(isset($_POST['valider'])){
                $total=0;
                $array=[];
            foreach($produit as $prod){
                $idp=$prod['id'];
                $prix=$prod['prix'];
                $quantite = $panier[$idp];
                $total+=$prix*$quantite;
                $array[$idp]=[
                    'idproduit'=>$idp,
                    'prix'=>$prix,
                    'total'=>$prix*$quantite,
                    'quantite'=>$quantite
                ];
            }
            $id_client=(int)$id_utilisateur;
            $sqlstate = $pdo->prepare('insert into commande(id_client,total) values(?,?)');
            $nice = $sqlstate->execute([$id_client,$total]);
            $id_commande = $pdo->lastInsertId();
            $date = date('Y-m-d H:i:s');
            foreach($array as $produits){
                $id=$produits['idproduit'];
                $sql.="(:id$id,'$id_commande',:prix$id,:qty$id,:total$id,'$date'),";
            }
            $sql = substr($sql,0,-1);
            $sqlstate=$pdo->prepare($sql);
            foreach($array as $produits){
                $id=$produits['idproduit'];
                $sqlstate->bindParam(':id'.$id,$produits['idproduit']);
                $sqlstate->bindParam(':prix'.$id,$produits['prix']);
                $sqlstate->bindParam(':qty'.$id,$produits['quantite']);
                $sqlstate->bindParam(':total'.$id,$produits['total']);
            }
            $insert = $sqlstate->execute();
            if($insert){
                $_SESSION['panier'][$id_utilisateur]=[];
                ?>
                <div class="alert alert-primary">Votre commande avec le montant (<?php echo $total ?>) MAD est bien ajoute</div>
                <?php
            }
        }
    ?>
        <div class="row">
            <?php 
            
            if(empty($panier)){
                ?>
                <div class="alert alert-info">
                    Votre panier est vide
                </div>
                <?php
            }else{
                ?>
                <table class="table">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Produit</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Total</th>
                    </tr>
                        <?php
                        foreach($produit as $pro){
                            $idp = $pro['id'];
                            ?>
                            <tr>
                            <td><?php echo $pro['id'] ?></td>
                            <td><img src="../upload//produit/<?php echo $pro['image'] ?>" width="80px"  alt=""></td>
                            <td><?php echo $pro['libelle'] ?></td>
                            <td><?php include '../include/front/counter.php' ?></td>
                            <td><?php echo $pro['prix'] ?> MAD</td>
                            <?php 
                            $quantite = $panier[$pro['id']];
                            $total = $quantite * $pro['prix'];
                            $tom=$tom+$total;
                            ?>
                            <td><?php echo $total ?> MAD</td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tfoot>
                            <tr>
                            <td colspan="5" align="right"><strong>Total</strong></td>
                            <td><?php echo $tom ?> MAD</td>
                            </tr>
                            <tr>
                                <td colspan="6" align="center">
                                    <form action="" method="post">
                                        <input type="submit" name="valider" class="btn btn-success" value="Valider">
                                        <input onclick="return confirm('Voulez vous vraiment vider la commande')" type="submit" name="vider" class="btn btn-danger" value="Vider">
                                    </form>
                                </td>
                            </tr>
                        </tfoot>
                </table>
                <?php
            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="../assets/js/produit/counter.js"></Script>
</body>
</html>