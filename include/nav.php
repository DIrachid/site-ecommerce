<?php
$conn=false;
 session_start();
 if(isset($_SESSION['utilisateur'])){
    $conn = true;
 }else{
    $conn=false;
 }
?>
<?php
// for you know to server open
$page = $_SERVER['PHP_SELF'];
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php if($page == '/projet1/index.php') echo 'active' ?>" aria-current="page" href="index.php"><i class="fa-solid fa-user"></i> ajouter utilisateur</a>
        </li>
        
        <?php if($conn){ ?>
            <li class="nav-item">
              <a href="admin.php" class="nav-link <?php if($page == '/projet1/admin.php') echo 'active' ?>"><i class="fa-solid fa-house"></i> Profil</a>
            </li>
            <li class="nav-item">
                <a href="ajouter_categorie.php" class="nav-link <?php if($page == '/projet1/ajouter_categorie.php') echo 'active' ?>"><i class="fa-solid fa-box"></i> Ajouter Categorie</a>
            </li>
            <li class="nav-item">
                <a href="ajouter_produit.php" class="nav-link <?php if($page == '/projet1/ajouter_produit.php') echo 'active' ?>"><i class="fa-solid fa-ticket"></i> Ajouter Produit</a>
            </li>
            <li class="nav-item">
              <a href="categories.php" class="nav-link <?php if($page == '/projet1/categories.php') echo 'active' ?>"><i class="fa-solid fa-bars"></i> Categories</a>
            </li>
            <li class="nav-item">
              <a href="produits.php" class="nav-link <?php if($page == '/projet1/produits.php') echo 'active' ?>"><i class="fa-solid fa-cart-shopping"></i> Produits</a>
            </li>
            <li class="nav-item">
                <a href="commandes.php" class="nav-link <?php if($page == '/projet1/commandes.php') echo 'active' ?>"><i class="fa-solid fa-truck"></i> Commandes</a>
            </li>
            <li class="nav-item">
                <a href="deconnexion.php" class="nav-link <?php if($page == '/projet1/index.php') echo 'active' ?>"><i class="fa-solid fa-right-from-bracket"></i> Deconnexion</a>
            </li>
        <?php }else{ ?>
            <li class="nav-item">
          <a class="nav-link <?php if($page == '/projet1/connexion.php') echo 'active' ?>" href="connexion.php"><i class="fa-solid fa-unlock"></i> Connexion</a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>