<?php


// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Update.php');

// Composer 
require('../vendor/autoload.php');


// utilisation de contact class 
use Update\Update;

// appel de la class
$update = new Update;


// On lance la fonction register
$update->update();

// nav bar pour le login inscri 
$compte_page = 1;

// Lancer le read region 
$update->readRegion();

// On recupere region 
$result_region = $update->getRegion();
// compteur pour value 
$cpt_region = 0;

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
                        <form action="" method="post">
                            <!-- Message d'erreur  -->
                            <?php echo "<div class='erreurs font-weight'>" . $update->getErreurEnvoie() . "</div>" ?>
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
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $update->getNom();  ?>" name="nom">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $update->getErreurNom() . "</div>" ?>
                                    </div>

                                    <!-- demande d'un mail  -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Email </span><span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $update->getEmail();  ?>" name="email">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $update->getErreurEmail() . "</div>" ?>
                                    </div>

                                    <!-- Demande de Tel -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Téléphone <span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $update->getTelephone();  ?>" name="telephone">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $update->getErreurTelephone() . "</div>" ?>
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
                                        <?php echo "<div class='erreurs'>" . $update->getErreurType() . "</div>" ?>
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
                                        <?php echo "<div class='erreurs'>" . $update->getErreurRegion() . "</div>" ?>
                                    </div>

                                    <!-- Demande de adresse rue -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"><span>Adresse </span><span style="color: red;"> *</span></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $update->getAdresse();  ?>" name="adresse">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $update->getErreurAdresse() . "</div>" ?>
                                    </div>

                                    <!-- Captcha  -->
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"><span>Captcha </span><span style="color: red;">*</span></label>

                                        <img src="../Controller/captcha.php" style="margin-left: 10px;" />
                                        <input type="text" class="form-control" id="inputAddress2" placeholder="Captcha" name="captcha" style="width: 175px;" autocomplete="off">

                                        <!-- message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $update->getErreurCaptcha() . "</div>" ?>
                                    </div>

                                    <!-- bouton d'envoie  -->
                                    <div class="text-center button_text">

                                        <!-- Message d'erreur  -->
                                        <?php echo "<div class='erreurs'>" . $update->getErreurPassword() . "</div>" ?>

                                        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Mot de passe" name="password" autocomplete="off">
                                        <button type="sumbit" class="btn btn-success" name="reg_register" value="envoyer" style="margin-top: 10px;">Modifier</button>
                                        <div class="little">
                                            <p><a href="../forgot/password">Mot de passe oublié ?</a></p>
                                        </div>
                                        <div class="not-acc">
                                            <p>Revenir à l'accueil
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