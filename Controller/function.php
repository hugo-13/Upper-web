<?php

function historisation($dossier, $fichier, $message)
{
    // NOM DU DOSSIER AVEC / au bout  ($dossier = log2/)
    $dossier = $dossier . "./";
    //FICHIER ( concatenation valeur dossier avec / + nom fichier + extension (.txt))
    // $fichier = log2/loguser.txt
    $fichier = $dossier . $fichier . ".txt";
    //AJOUTE UN RETOUR A LA LIGNE AU MESSAGE DONNE PAR LA PERSONNE QUI LANCE LA FONCTION
    // $message = Inscription ok 
    $message = $message . "\n";

    //SI LE DOSSIER N'EXISTE PAS, PHP LE CREE AVEC MKDIR
    // is_dir($dossier) renvoi false si le dossier n'existe
    //est-ce que false == false 
    // c'est vrai donc j'execute les instructions du alors
    if (is_dir($dossier) == false) {
        mkdir($dossier);
    }

    //POUR LE FICHIER
    if (file_exists($fichier)) {
        //RECUPERATION DU CONTENU
        $contenu = file_get_contents($fichier);
        // DANS LA VARIABLE ON AJOUTE LA NOUVELLE LIGNE
        $message = $contenu . $message;
        /*
        $CONTENU = "DEPART : \n" et en plus "info blablabla [02/03/22 09:30:20] \n"
        */
    }

    //SI LE FICHIER EXISTE PAS, LA FONCTION CREE LE FICHIER AVEC LE CONTENU DONNE
    //SI LE FICHIER EXISTE, ECRASE LE FICHIER EXISTANT AVEC LE CONTENU DONNE
    file_put_contents($fichier, $message);
}


// notif contact message a bien été envoyé 
function notif_contact()
{ ?>
    <div id="notif_contact">
        <div class="alert alert-success alert-dismissible fade show align-items-center" role="alert">
            <img src="../images/nuage.png" alt="" width="40" height="35">
            <strong>
                Message envoyé !
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="this.parentElement.style.display='none';" aria-label="Close"></button>
        </div>
    </div>
<?php }


// notif contact message a bien été envoyé 
function notif_register($message)
{ ?>
    <div id="notif_contact">
        <div class="alert alert-success alert-dismissible fade show align-items-center" role="alert">
            <img src="../images/nuage.png" alt="" width="40" height="35">
            <strong>
                <?php echo "$message" ?>
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="this.parentElement.style.display='none';" aria-label="Close"></button>
        </div>
    </div>
<?php }
