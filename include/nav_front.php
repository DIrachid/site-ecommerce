<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Listes Categories</a>
        </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">Profil</a>
          </li>
      </ul>
      <?php $id_utilisateur = $_SESSION['utilisateur']['id'];
      $num = $_SESSION['panier'][$id_utilisateur];
      ?>
      <a href="panier.php" class="btn"><i class="fa-solid fa-cart-shopping"></i>Panier (<?php echo count($num) ?>)</a>
    </div>
  </div>
</nav>