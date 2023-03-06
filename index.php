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
    <?php include_once './include/nav.php' ?>
    <div class="container">
        <?php 
        if(isset($_POST['ajouter'])){
            $login=$_POST['login'];
            $password=$_POST['password'];
            if(!empty($login) && !empty($password)){
                require_once './include/database.php';
                $date = date('Y-m-d');
                $sqlstate=$pdo->prepare('insert into utilisateur values(null,?,?,?) ');
                $sqlstate->execute([$login,$password,$date]);
                header('location: connexion.php');
                ?>
                <div class="alert alert-success" role="alert">
                success ?
                </div>
                <?php }else{?>
                <div class="alert alert-warning" role="alert">
                Obligatoire pour remplir les champs ?
                </div>
                <?php
            }
        }
        ?>
        <form action="" method="post">
            <h4 class="my-2">Ajouter Utilisateur</h4>
            <label class="form-label">Login</label>
            <input type="text" name="login" class="form-control">

            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
            
            <div id="passwordHelpBlock" class="form-text">
            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </div>

            <input type="submit" name="ajouter" value="Ajouter Utilisateur" class="btn btn-primary my-2">
        </form>
    </div>
</body>
</html>