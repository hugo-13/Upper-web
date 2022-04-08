<?php

// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Login.php');

// Composer 
require('../vendor/autoload.php');


// utilisation de contact class 
use Login\Login;

// appel de la class
$login = new Login;

// On lance la fonction login 
$login->login();

// nav bar pour le login inscri 
$login_page = 1;


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- head  -->
    <?php include('./partials/head.php') ?>

</head>

<body>

    <header>
        <!-- Navbar  -->
        <?php include('./partials/navbar.php') ?>
    </header>


    <!-- Contenue principale -->
    <main id="main3" class="ioAir d-Flex">

        <div class="word"></div>
        <div class="row cvvpgf">
            <div class="row">
                <div class="row fjnrxx">
                    <div class="row gmX centrer-pile">
                        <form action="../login" method="post">
                            <!-- Message d'erreur  -->
                            <?php echo "<div class='erreurs font-weight'>" . $login->getErreurEnvoie() . "</div>" ?>
                            <!-- Animation Text  -->
                            <script src="../js/heyAnim"></script>

                            <!-- Titre  -->
                            <div class="dWisct text-center para row">
                                <h2 class="dWist"><span class="txt-rotate" data-period="2000" data-rotate='[ "Bonjour !", "Hello !", "Hola !", "Buongiorno !"]'></span></h2>
                                <p class="dWist fdcl">
                                    Connectez-vous pour faire une demande <br>de devis.
                                </p>
                            </div>

                            <!-- edmande mail  -->
                            <div class="row iUxn form">
                                <div class="iazk">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Email address </span><span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="email">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $login->getErreurMail() . "</div>" ?>
                                    </div>

                                    <!-- demande mdp  -->
                                    <div class="mb-3No">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Password </span><span style="color: red;">*</span></label>
                                        <input type="password" class="form-control" id="myInput" placeholder="" name="password">
                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $login->getErreurPass() . "</div>" ?>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" onclick="showPass()">
                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                            Show Password
                                        </label>
                                        <!-- show pass  -->
                                        <script src="../js/showPass.js"></script>
                                    </div>
                                    <div class="little">
                                        <p><a href="../forgot/password">Mot de passe oublié ?</a></p>
                                    </div>

                                    <!-- bouton pour confirmer  -->
                                    <div class="text-center button_text">
                                        <button type="sumbit" class="btn btn-success" name="reg_login">Se connecter</button>
                                        <div class="not-acc">
                                            <p>Pas encore client ?
                                            <div class="sinsc"><a href="../register">S'inscrire</a></div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>

</html>