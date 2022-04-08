<?php
include('../model/back_message_delete.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('./partials/nav.php')
    ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>

<body style="margin-top:100px; background : grey; overflow-x: visible;">
    <div id="style_back">
        <h3>Messages</h3>
        <table border=1 cellpadding=3 class="center">

            <form method="post" enctype="multipart/form-data" multiple action="./message.php">
                <tr>
                    <td colspan="7">
                        <div class="input-group mb">
                            <select class="form-select" aria-label="Default select example" name="selected">
                                <option value="id_contact">Id</option>
                                <option value="email" selected>Email</option>
                                <option value="telephone">Téléphone</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Email/Téléphone/Id" aria-label="Recipient's username" aria-describedby="button-addon2" name="search" autocomplete="off">
                            <button type="submit" id="button-addon2" value="search" name="message_search">Search</button>
                        </div>
                    </td>
                </tr>
            </form>

            <form method="post" enctype="multipart/form-data" multiple action="./message.php">
                <tr class="haut_tab">
                    <td class="nom_colonne">Id</td>
                    <td class="nom_colonne">Email</td>
                    <td class="nom_colonne">Téléphone</td>
                    <td class="nom_colonne">Objet</td>
                    <td class="nom_colonne">Message</td>
                    <td class="nom_colonne">Date</td>
                    <td><span>Select All</span><input type="checkbox" for='selectAll' id="selectAll" class="check_upp radio"></td>

                    <?php
                    $cpt = 0;
                    while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td  style='color: red; font-weight:700;'>" . $ligne['id_contact'] . "</td>";
                        echo "<td>" . $ligne['email'] . "</td>";
                        echo "<td>" . $ligne['telephone'] . "</td>";
                        echo "<td>" . $ligne['objet'] . "</td>";
                        echo "<td>" . $ligne['message'] . "</td>";
                        echo "<td>" . $ligne['date_message'] . "</td>";
                        $cpt = $cpt+1;
                    ?>
                        <td> <input type="checkbox" name="check[]" value="<?php echo $ligne['id_contact'] ?> " class="checkClass check_upp checkbox"><br></td>
                    <?php
                        echo "</tr>";
                    }
                    array_push($errors,"<span style='color:grey'>". $cpt . " données</span>");
                    ?>

                <tr>
                    <td class="message_errors" colspan="6" style="background: black;"><?php include "../controller/erros.php" ?></td>
                    <?php if ($retour == 0) { ?>
                        <td><button name="delete_message" value="supression">Supprimer</button></td>
                    <?php } else { ?>
                        <td><button name="refresh_message" value="supression">Refresh</button></td> <?php } ?>
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