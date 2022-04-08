<?php

// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Contact.php');

// Composer 
require('../vendor/autoload.php');


// utilisation de contact class 
use Contact\Contact;

// appel de la class
$contact = new Contact;

// Lancement de la fonction 
$contact->contact();

$_SESSION['msg'] = null;

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
        <section id="contact">
            <div class="head-content-top"></div>

            <!-- Titre de la page contact  -->
            <h1 class="title_contact">
                <div class="waviy">
                    <span style="--i:1">M</span>
                    <span style="--i:2">E</span>
                    <span style="--i:3"> </span>
                    <span style="--i:3"> </span>
                    <span style="--i:4">C</span>
                    <span style="--i:5">O</span>
                    <span style="--i:6">N</span>
                    <span style="--i:7">T</span>
                    <span style="--i:8">A</span>
                    <span style="--i:9">C</span>
                    <span style="--i:10">T</span>
                    <span style="--i:11">E</span>
                    <span style="--i:12">R</span>
                </div>
            </h1>



            <!-- Formulaire -->
            <form class="form_contact" method="post" action="../contact">

                <!-- message d'erreur global d'envoie  -->
                <?php echo "<div class='erreurs'>" . $contact->getErreurEnvoie() . "</div>" ?>

                <!-- Demande de mail  -->
                <div class="col-6">
                    <label for="inputAddress" class="form-label"><span>Adresse email </span><span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Adresse email" name="email">

                    <!-- message d'erreur  -->
                    <?php echo "<div class='erreurs'>" . $contact->getErreurMail() . "</div>" ?>
                </div>

                <!-- Demande de tel  -->
                <div class="col-6">
                    <label for="inputAddress2" class="form-label"><span>Téléphone </span><span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="(06-07)XXXXXXXX" name="telephone">

                    <!-- message d'erreur  -->
                    <?php echo "<div class='erreurs'>" . $contact->getErreurTel() . "</div>" ?>
                </div>

                <!-- Demande d'objet  -->
                <div class="col-6">
                    <label for="inputAddress2" class="form-label"><span>Objet </span><span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Objet" name="objet">

                    <!-- message d'erreur  -->
                    <?php echo "<div class='erreurs'>" . $contact->getErreurObjet() . "</div>" ?>
                </div>

                <!-- Demande de message  -->
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label"><span>Message </span><span style="color: red;">*</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Votre message" name="message"></textarea>

                    <!-- message d'erreur  -->
                    <?php echo "<div class='erreurs'>" . $contact->getErreurMessage() . "</div>" ?>
                </div>

                <!-- Captcha  -->
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label"><span>Captcha </span><span style="color: red;">*</span></label>

                    <img src="../Controller/captcha.php" style="margin-left: 10px;" />
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Captcha" name="captcha" style="width: 175px;">

                    <!-- message d'erreur  -->
                    <?php echo "<div class='erreurs'>" . $contact->getErreurCaptcha() . "</div>" ?>
                </div>

                <!-- Boutton d'envoie  -->
                <button type="submit" class="btn btn-secondary" name="reg_contact"><span>Envoyer</span></button>

                <div class="carte-bd-daguerre">
                    <img src="../images/map.png" class="show-on-scroll map"></img>
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