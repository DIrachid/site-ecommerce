<?php
$id_utilisateur = $_SESSION['utilisateur']['id'];
$qty=$_SESSION['panier'][$id_utilisateur][$idp] ?? 0;

?>
<div class="">
 <form class="num counter d-flex justify-content-center" action="ajouter_panier.php" method="post">
    <input type="hidden" name="id" value="<?php echo $idp ?>">
    <button onclick="return false" class="btn btn-primary mx-1 counter-moin">-</button>
    <input class="form-control text-center" min="0" value="<?php echo $qty ?>" type="number" name="quantite" id="qty" max="99">
    <button onclick="return false" class="btn btn-primary mx-1 counter-plus">+</button>
    <?php if($qty == 0){ ?>
      <button class="btn btn-success" name="ajouter"><i class="fa-solid fa-cart-arrow-down"></i></button>    
    <?php 
    }else{
    ?>
    <button class="btn btn-success mx-1" value="modifier"><i class="fa-solid fa-pen"></i></button>
    <button class="btn btn-danger mx-1" formaction="supprimer_panier.php"><i class="fa-solid fa-trash"></i></button>
    <?php } ?>
 </form>
</div>
