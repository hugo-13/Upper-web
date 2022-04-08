<?php


// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Register.php');

// Composer 
require('../vendor/autoload.php');


// utilisation de contact class 
use Register\Register;

// appel de la class
$register = new Register;


// On lance la fonction register
$register->register();

// nav bar pour le login inscri 
$register_page = 1;

// Lancer le read region 
$register->readRegion();

// On recupere region 
$result_region = $register->getRegion();
// compteur pour value 
$cpt_region = 0;

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
                        <form action="../register" method="post">
                            <!-- Message d'erreur  -->
                            <?php echo "<div class='erreurs font-weight'>" . $register->getErreurEnvoie() . "</div>" ?>
                            <!-- Animation Text  -->
                            <script src="../js/heyAnim"></script>

                            <div class="dWisct text-center para row">
                                <h2 class="dWist"><span class="txt-rotate" data-period="2000" data-rotate='[ "Bonjour !", "Hello !", "Hola !", "Buongiorno !"]'></span></h2>
                                <p class="dWist fdcl">
                                    S'inscrire vous permet de faire une demande <br>de devis.
                                </p>
                            </div>

                            <!-- Demande de nom -->
                            <div class="row iUxn form">
                                <div class="iazk">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Nom </span><span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Entreprise, personnel..." name="nom">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurNom() . "</div>" ?>
                                    </div>

                                    <!-- demande d'un mail  -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Email </span><span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="example@exam.ex" name="email">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurEmail() . "</div>" ?>
                                    </div>

                                    <!-- demande d'un mdp  -->
                                    <div class="mb-3No">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Password </span><span style="color: red;"> *</span></label>
                                        <input type="password" class="form-control" id="myInput" placeholder="6 - 18 / 1 majuscule, 1 miniscule, 1 chiffre" name="password_1">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurPassword() . "</div>" ?>
                                    </div>

                                    <!-- Chexk box pour voir le mdp  -->
                                    <div class="form-check" style="margin-bottom: 20px;">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" onclick="showPass()">
                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                            Show Password
                                        </label>
                                        <!-- show pass  -->
                                        <script src="../js/showPass.js"></script>
                                    </div>

                                    <!-- Password pour confirmer -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Confirm</span><span style="color: red;"> *</span></label>
                                        <input type="password" class="form-control" id="myInput" placeholder="Password" name="password_2">
                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurPasswordMatch() . "</div>" ?>
                                    </div>

                                    <!-- Demande de Tel -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Téléphone <span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="(06-07)XXXXXXXX" name="telephone">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurTelephone() . "</div>" ?>
                                    </div>

                                    <!-- Pour qui  -->
                                    <div class="mb-3" style="margin-top: 30px;margin-bottom: 30px !important;">
                                        <select class="form-select" aria-label="Default select example" name="pour">
                                            <option selected value="0">Vous-êtes ?</option>
                                            <option value="1">Une entreprise</option>
                                            <option value="2">Une startup</option>
                                            <option value="3">Un particulier</option>
                                            <option value="4">Autre</option>
                                        </select>

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurType() . "</div>" ?>
                                    </div>

                                    <!-- Région  -->
                                    <div class="mb-3" style="margin-bottom: 20px !important;">
                                        <select class="form-select" aria-label="Default select example" name="where">

                                            <!-- Liste deroulant lu par la fonction getRegion  -->
                                            <option selected value="0">Région</option>
                                            <?php while ($ligne = $result_region->fetch(PDO::FETCH_ASSOC)) {
                                                $cpt_region = $cpt_region + 1;
                                            ?>
                                                <option value="<?php echo $cpt_region ?>"><?php echo $ligne['nom_region'] . " - " . $ligne['cp'] ?></option>
                                            <?php } ?>
                                        </select>

                                        <!-- Message d'erreur -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurRegion() . "</div>" ?>
                                    </div>

                                    <!-- Demande de adresse rue -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Adresse </span><span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Entreprise, personnel..." name="adresse">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurAdresse() . "</div>" ?>
                                    </div>

                                    <!-- Captcha  -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"><span>Captcha </span><span style="color: red;">*</span></label>

                                        <img src="../Controller/captcha.php" style="margin-left: 10px;" />
                                        <input type="text" class="form-control" id="inputAddress2" placeholder="Captcha" name="captcha" style="width: 175px;" autocomplete="off">

                                        <!-- message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurCaptcha() . "</div>" ?>
                                    </div>

                                    <!-- Chexk box pour autoriser l'envoie de mail -->
                                    <div class="form-check coller-oui">
                                        <input class="form-check-input" type="checkbox" value="yes" id="flexCheckIndeterminate" name="accept" style="margin-top: 6px;">
                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                            <p style="font-size: 12px;">Accepter que UPPER_WEB puissent vous envoyer des mails</p>
                                        </label>

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $register->getErreurAccept() . "</div>" ?>
                                    </div>


                                    <!-- bouton d'envoie  -->
                                    <div class="text-center button_text">
                                        <button type="sumbit" class="btn btn-success" name="reg_register" value="envoyer">S'inscrire</button>
                                        <div class="not-acc">
                                            <p>Déjà client ?
                                            <div class="sinsc"><a href="../login">Se connecter</a></div>
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