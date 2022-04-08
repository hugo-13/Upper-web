<?php

// Page d'oublie de mdp 

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
$forgot = new Login;

// On lance la fonction login 
$forgot->forgot();

// nav bar pour le login inscri 
$forgot_page = 1;


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
                        <form action="../forgot/password" method="post">
                            <!-- Message d'erreur  -->
                            <?php echo "<div class='erreurs font-weight'>" . $forgot->getErreurEnvoie() . "</div>" ?>
                            <!-- Animation Text  -->
                            <script src="../js/heyAnim"></script>

                            <!-- Titre  -->
                            <div class="dWisct text-center para row">
                                <h2 class="dWist"><span class="txt-rotate" data-period="2000" data-rotate='[ "Bonjour !", "Hello !", "Hola !", "Buongiorno !"]'></span></h2>
                                <p class="dWist fdcl">
                                    Un email va vous être envoyé <br> afin que vous puissiez rénitialiser votre mots de passe.
                                </p>
                            </div>

                            <!-- edmande mail  -->
                            <div class="row iUxn form">
                                <div class="iazk">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Email address </span><span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Email du compte" name="email">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $forgot->getErreurMail() . "</div>" ?>
                                    </div>

                                    <!-- bouton pour confirmer  -->
                                    <div class="text-center button_text">
                                        <button type="sumbit" class="btn btn-success" name="reg_forgot">Confirmer</button>
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