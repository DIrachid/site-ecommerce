<?php 
require_once './include/database.php';
include_once './include/nav.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Commandes</title>
</head>
<body>
    <div class="container py-2">
        <h4>List des commandes</h4>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $requete = $pdo->prepare("select commande.*,utilisateur.login as 'nom_client' from commande inner join utilisateur on commande.id_client = utilisateur.id order by commande.date_creation desc");
                $requete->execute();
                $sql = $requete->fetchAll(PDO::FETCH_ASSOC);
                foreach($sql as $commande){
                    ?>
                    <tr>
                        <td><?php echo $commande['id'] ?></td>
                        <td><?php echo $commande['nom_client'] ?></td>
                        <td><?php echo $commande['total'] ?> MAD</td>
                        <td><?php echo $commande['date_creation'] ?></td>
                        <td><a class="btn btn-success sm" href="commande.php?id=<?php echo $commande['id'] ?>">Afficher d'etails</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>