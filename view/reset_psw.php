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
$reset_pass = new Login;


// On lance la fonction register
$reset_pass->resetPassword();

// nav bar pour le login inscri 
$forgot_page = 1;
$reset_psw = 1;


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
    <!-- Contenue principale -->
    <main id="main3" class="ioAir d-Flex">

        <div class="word"></div>
        <div class="row cvvpgf">
            <div class="row">
                <div class="row fjnrxx">
                    <div class="row gmX centrer-pile">
                        <form method="post" action="">
                            <!-- Message d'erreur  -->
                            <?php echo "<div class='erreurs font-weight'>" . $reset_pass->getErreurEnvoie() . "</div>" ?>
                            <!-- Animation Text  -->
                            <script src="../js/heyAnim"></script>

                            <!-- Titre  -->
                            <div class="dWisct text-center para row">
                                <h2 class="dWist"><span class="txt-rotate" data-period="2000" data-rotate='[ "Bonjour !", "Hello !", "Hola !", "Buongiorno !"]'></span></h2>
                                <p class="dWist fdcl">
                                    Changez votre mot de passe !
                                </p>
                            </div>

                            <!-- edmande mail  -->
                            <div class="row iUxn form">
                                <div class="iazk">


                                    <!-- demande mdp  -->
                                    <div class="mb-3No">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Password </span><span style="color: red;">*</span></label>
                                        <input type="password" class="form-control" id="myInput" placeholder="6 - 18 / 1 majuscule, 1 miniscule, 1 chiffre" name="password_1">
                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $reset_pass->getErreurPassword1() . "</div>" ?>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" onclick="showPass()">
                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                            Show Password
                                        </label>
                                        <!-- show pass  -->
                                        <script src="../js/showPass.js"></script>
                                    </div>

                                    <!-- Password pour confirmer -->
                                    <div class="mb-3" style="margin-top: 20px;">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Confirm</span><span style="color: red;"> *</span></label>
                                        <input type="password" class="form-control" id="myInput" placeholder="" name="password_2">
                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $reset_pass->getErreurPassword2() . "</div>" ?>
                                    </div>

                                    <!-- bouton pour confirmer  -->
                                    <div class="text-center button_text">
                                        <button type="sumbit" class="btn btn-success" name="reg_reset">Confirmer</button>
                                        <div class="not-acc">
                                            <p>Revenir a l'acceuil ?
                                            <div class="sinsc"><a href="../">Accueil</a></div>
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