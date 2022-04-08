<?php


// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Compte.php');

// Composer 
require('../vendor/autoload.php');

use Compte\Compte;

$compte = new Compte;
$compte->compte();


// nav bar pour le login inscri 
$contact_page = 1;

$_SESSION['msg'] = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- head  -->
    <?php include('./partials/head.php') ?>

</head>

<body>

    <header id="header">
        <!-- Navbar  -->
        <?php include('./partials/navbar.php') ?>
    </header>


    <!-- Contenue principale -->
    <main id="main4">

        <section id="vos_infos">

            <h2>Vos information</h2>

            <h4>
                <!-- si ce n'est pas l'admin qui est connecté  -->
                <?php if (!isset($_SESSION['admin'])) { ?>
                    <p>Nom : <?php echo $compte->getNom(); ?></p>
                    <p>Email : <?php echo $compte->getEmail(); ?></p>
                    <p>Telephone : <?php echo $compte->getTelephone(); ?></p>
                    <p>Vous êtes : <?php echo $compte->getType(); ?></p>
                    <p>Région : <?php echo $compte->getRegion() . " - " . $compte->getCp(); ?></p>
                    <p>Adresse : <?php echo $compte->getAdresse(); ?></p>
            </h4>

            <form action="../compte#vos_infos" method="post">
                <div class="button-contact">
                    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Mot de passe" name="password" autocomplete="off">
                    <button type="sumbit" class="btn btn-success" name="reg_modify" value="envoyer">Modifier</button>
                    <button type="sumbit" class="btn btn-success" name="reg_delete" value="envoyer">Supprimer</button>
                </div>
            </form>

            <div class="little">
                <p><a href="../forgot/password">Mot de passe oublié ?</a></p>
            </div>
            <div class="erreur_infos"><?php echo $compte->getErreurPassword(); ?></div>

            <div class="fleche_bas">
                <a href="../compte#votre_devis">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-arrow-down-circle-fill bounce" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                    </svg>
                </a>
            </div>

        </section>

        <section id="votre_devis" style="margin-top: 100px;">

            <h2>Votre devis</h2>

            <?php if ($_SESSION['compte_devis'] != false) { ?>
                <h4>
                    <p style="text-align: center;"><img src="<?php echo $compte->getImage(); ?>" alt="" width="200px"></p>
                    <p>Nom : <?php echo utf8_encode($compte->getNomProduit()); ?></p>
                    <p>Description : <?php echo utf8_encode($compte->getDescription()); ?></p>
                    <p>Message : <?php echo utf8_encode($compte->getExigence()); ?></p>
                </h4>


                <form action="../compte#votre_devis" method="post">
                <button type="sumbit" class="btn btn-success" name="reg_download" value="envoyer" style="display:block;margin-left:auto;margin-right:auto;">Télécharger</button>

                    <div class="button-contact">
                        <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Mot de passe" name="password_2" autocomplete="off">
                        <button type="sumbit" class="btn btn-success" name="reg_delete_2" value="envoyer">Supprimer</button>
                    </div>
                </form>

                <div class="little">
                    <p><a href="../forgot/password">Mot de passe oublié ?</a></p>
                </div>
                <br>
                <div class="erreur_pass"><?php echo "<p style='color:red; text-align:center;'>".$compte->getErreurPassword_2()."</p>" ?></div>
        </section>
    <?php } else { ?>
        <h4>
            <p style="text-align: center;">Vous n'avez pas de demande de devis</p>
        </h4>
        <div class="button-contact" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:50px">
            <a href="../#devis"><button type="sumbit" class="btn btn-success" value="envoyer">Demander</button></a>
        </div>
    <?php }  ?>

<?php } else { ?>
    <p style="text-align: center;font-weight:650">
        Vous êtes connectez en tant que Admin !
    </p>
    </h4>
<?php } ?>

    </main>



</body>

</html>