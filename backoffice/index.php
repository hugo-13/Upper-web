<?php


// Composer 
require('../vendor/autoload.php');


// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Message.php');
require('../Controller/Demande.php');




// utilisation de contact class 
use Message\Message;
use Demande\Demande;


// appel de la class
$message = new Message;

$message->message();

// Total de resultat 
$total = $message->getTotal();

$demande = new Demande;
$demande->demande();
$total2 = $demande->getTotal();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('./partials/navbar.php')
    ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</head>

<body style="margin-top:30px; background : grey; overflow-x: visible;">
    <div id="style_back" style="display:flex;">

        <!-- messagerie carte  -->
        <div class="card" style="width: 30%; margin-left:13%; margin-top:15%;">
            <img src="../images/back_message.PNG" class="card-img-top" alt="...">
            <div class="card-body">
                <!-- titre card  -->
                <h5 class="card-title">Message</h5>
                <p class="card-text">
                    <!-- Pluriel ou non  -->
                    <?php 

                    if($total > 1){
                        echo "Vous avez $total messages non lus";
                    } else {
                        echo "Vous avez $total message non lu";
                    } 

                    ?>
                </p>
                <a href="./message.php" class="btn btn-primary">Y-aller</a>
            </div>
        </div>

        <div class="card" style="width: 30%; margin-left:10%; margin-top:15%;">
            <img src="../images/back_message.PNG" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Demande de devis</h5>
                <p class="card-text">
                    <!-- Pluriel ou non  -->
                    <?php 

                    if($total2 > 1){
                        echo "Vous avez $total2 demandes de devis non lus";
                    } else {
                        echo "Vous avez $total2 demande de devis non lu";
                    } 

                    ?></p>
                <a href="./demande.php" class="btn btn-primary">Y-aller</a>
            </div>
        </div>


    </div>

</body>

</html>