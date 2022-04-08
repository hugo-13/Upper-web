<?php

// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Message.php');

// Composer 
require('../vendor/autoload.php');


// utilisation de contact class 
use Message\Message;

// appel de la class
$message = new Message;

$message->message();

// Result pour le fectch 
$result = $message->getMessage();

// Total de resultat 
$total = $message->getTotal();

// Message de la recherche 
$console = $message->getSearch();



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Navbar  -->
    <?php include('./partials/navbar.php') ?>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>

<body style="margin-top:100px; background : grey; overflow-x: visible;">
    <div id="style_back">

        <!-- Tableau  -->
        <table border=1 cellpadding=3 class="center">

            <!-- formulaire pour la fonctin search  -->
            <form method="post" enctype="multipart/form-data" multiple action="./message.php">

                <!-- Titre -->
                <tr>
                    <td colspan="7">
                        <h3>Message</h3>
                    </td>
                </tr>
                <tr>

                    <!-- Liste déroulant  -->
                    <td colspan="3">
                        <div class="input-group mb">
                            <select class="form-select" aria-label="Default select example" name="selected">
                                <option value="id_contact">Id</option>
                                <option value="email" selected>Email</option>
                                <option value="telephone">Téléphone</option>
                            </select>
                    </td>

                    <!-- Bouton Search  -->
                    <td colspan="4">
                        <div class="input-group mb">
                            <input type="text" class="form-control" placeholder="Email/Téléphone/Id" aria-label="Recipient's username" aria-describedby="button-addon2" name="search" autocomplete="off">
                            <button type="submit" id="button-addon2" class="search" value="search" name="message_search">Search</button>
                        </div>
                    </td>
                </tr>
    </div>


    </form>

    <!-- form pour la fonction supprimer  -->
    <form method="post" enctype="multipart/form-data" multiple action="./message.php">

        <!-- Titre du tableau  -->
        <tr class="haut_tab">
            <td class="nom_colonne">Id</td>
            <td class="nom_colonne">Email</td>
            <td class="nom_colonne">Téléphone</td>
            <td class="nom_colonne">Objet</td>
            <td class="nom_colonne">Message</td>
            <td class="nom_colonne">Date</td>
            <td><span>Select All</span><input type="checkbox" for='selectAll' id="selectAll" class="check_upp radio"></td>

            <?php
            // Affichage de la table 
            while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td  style='color: red; font-weight:700;'>" . $ligne['id_contact'] . "</td>";
                echo "<td>" . $ligne['email'] . "</td>";
                echo "<td>" . $ligne['telephone'] . "</td>";
                echo "<td>" . $ligne['objet'] . "</td>";
                echo "<td>" . $ligne['message'] . "</td>";
                echo "<td>" . $ligne['date_message'] . "</td>";
            ?>
                <td> <input type="checkbox" name="check[]" value="<?php echo $ligne['id_contact'] ?> " class="checkClass check_upp checkbox"><br></td>
            <?php
                echo "</tr>";
            }
            ?>

        <tr>
            <!-- Console de search et de message trouver  -->
            <td class="message_erreurs" colspan="6" style="background: black;" rowspan="2">

                <!-- J'affihe le total de message trouver et la console -->
                <?php
                // Pour accorder la phrase au pluriel 
                if ($total > 1) {
                    echo "<span style='color:grey;'>$total messages trouvés</span> <br> 
                <span style='color:red'>$console ";
                    // Prase au singulier 
                } else {
                    echo "<span style='color:grey;'>$total message trouvé</span> <br> 
                    <span style='color:red'>$console ";
                }
                // Message de la recherche 
                $message->messageDelete();
                "</span>";
                ?>
            </td>


            <td><a href="./message.php"><button name="" value="supression">Refresh</button></a></td>
        </tr>
        <tr>
            <!-- Bouton supprimer qui devient un refresh  -->
            <td>
                <button name="reg_delete" value="supression">Supprimer</button>
            </td>
        </tr>
    </form>
    </table>


    </div>

    <!-- Jquery -->
    <script>
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
            }
        });

        jackHarnerSig();
    </script>
</body>

</html>