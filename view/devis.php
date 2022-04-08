<?php

// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Devis.php');

// Composer 
require('../vendor/autoload.php');


// utilisation de contact class 
use DEVIS\DEVIS;

// appel de la class
$devis = new Devis;

// Lancement de la fonction
$devis->devis();


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- head  -->
    <?php include('./partials/head.php') ?>

</head>

<body style=" background-image: url(https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://www.pixel-online.fr/wp-content/themes/agama/assets/img/bg-parallax-gris-clair-light.jpg);    background-size: cover;
    object-position: center;">


    <header>
        <!-- Navbar  -->
        <?php include('./partials/navbar.php') ?>
    </header>


    <!-- Contenue principale -->
    <main>
        <div class="head-content-top"></div>
        <section id="devis_page">


            <!-- Titre de la page contact  -->
            <h1 class="title_devis">
                <div class="waviy">
                    <span style="--i:1">D</span>
                    <span style="--i:2">E</span>
                    <span style="--i:3">V</span>
                    <span style="--i:3">I</span>
                    <span style="--i:4">S</span>
                </div>
            </h1>



            <!-- Formulaire -->
            <form class="devis_form" method="post" action="" enctype="multipart/form-data">

                <!-- message d'erreur global d'envoie  -->
                <?php echo "<div class='erreurs' style='text-align:center;'>" . $devis->getErreurEnvoie() . "</div>" ?>

                <!-- Devis  -->
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label"><span>Site sélectionné : </span>
                        <span style="font-weight: 700; color: #1985ff;"><?php echo utf8_encode($devis->getSite()); ?></span>
                        <br> <br>
                        Description : <span style="font-weight: 700; color: #1985ff;"><?php echo utf8_encode($devis->getDescription()); ?></span>
                    </label>
                    <!-- message d'erreur  -->
                </div>

                <!-- Demande de message  -->
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label"><span>Message </span><span style="color: red;">*</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Exigence, exemple, ..." name="message"></textarea>

                    <!-- message d'erreur  -->
                    <?php echo "<div class='erreurs'>" . $devis->getErreurMessage() . "</div>" ?>
                </div>

                <!-- Captcha  -->
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label"><span>Captcha </span><span style="color: red;">*</span></label>

                    <img src="../Controller/captcha.php" style="margin-left: 10px;" />
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Captcha" name="captcha" style="width: 175px;">

                    <!-- message d'erreur  -->
                    <?php echo "<div class='erreurs'>" . $devis->getErreurCaptcha() . "</div>" ?>
                </div>

                <!-- Boutton d'envoie  -->
                <button type="submit" class="btn btn-secondary" name="reg_envoie"><span>Envoyer</span></button>

                <div class="carte-bd-daguerre">
                    <img src="<?php echo $devis->getImage(); ?>" class="show-on-scroll map"></img>
                </div>


            </form>



        </section>
        <div class="head-content-bottom"></div>
    </main>


    <!-- Footer  -->
    <footer class="bg-secondary text-white text-center text-md-start">
        <?php include('./partials/footer.php') ?>
    </footer>



    <!-- script on scrolll animation  -->
    <script src="../js/show-on-scroll.js"></script>

</body>

</html>