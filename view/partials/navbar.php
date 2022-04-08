        <!-- Si je ne suis pas sur la page login, register ou devis  -->
        <?php if (!isset($login_page) and !isset($register_page) and !isset($forgot_page) and (!isset($contact_page))) { ?>
            <div id="nav-1">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a href="../"><img src="../images/logo.png" height="50" width="150" alt="UPPER_WEB" class="logo"></a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <div class="navbar-nav">
                            </div>
                            <div class="navbar-nav ms-auto">
                                <a href="../#slider" class="nav-item nav-link line-anim">Accueil</a>
                                <a href="../#presentation" class="nav-item nav-link line-anim">Qui suis-je ?</a>
                                <a href="../#devis" class="nav-item nav-link line-anim">demander un Devis</a>

                                <!-- si je suis pas connecter montrer se connecter sinon je montre compte  -->
                                <?php
                                if (!isset($_SESSION['nom']) and !isset($_SESSION['admin'])) {
                                ?>
                                    <a href="../login" class="nav-item nav-link line-anim">Se connecter</a>
                                <?php
                                } else { ?>
                                    <a href="../compte" class="nav-item nav-link line-anim">votre Compte</a>
                                    <a href="../Controller/logout.php" class="nav-item nav-link line-anim">Déconnexion</a>
                                <?php } ?>


                                <?php if (isset($_SESSION['admin'])) { ?>
                                    <a href="../backoffice/index.php" class="nav-item nav-link line-anim">Back Office</a>
                                <?php   } ?>


                                <div class="nav-contact">
                                    <a href="../contact" class="nav-item nav-link line-anim blue">Contactez-moi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>



            <!-- Si je suis sur login, register ou devis  -->
        <?php } else { ?>
            <div id="nav-2">
                <nav class="navbar-expand-lg navbar-light bg-light nav-la d-flex">

                    <!-- fleche retour en arriere  -->
                    <?php if(!isset($reset_psw)){ ?> 
                    <a onclick="history.back()"><img src="../images/back_fleche.png" alt="" height="50" width="50" class="fleche-back"></a>
                    <div class="container-fluid d-flex text-center">
                        <?php } ?>

                        <div class="text-center d-flex fdcd2">
                            <a href="../"><img src="../images/text.png" alt="" height="27" width="180" class="border-right"></a>

                            <div class="d-flex iDe d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="1.5em" fill="currentColor" class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z" />
                                </svg>

                                <!-- page login  -->
                                <?php if (isset($login_page)) { ?>
                                    <h4>Connexion</h4>

                                    <!-- page register  -->
                                    <?php } else {
                                    if (isset($register_page)) {
                                    ?>
                                        <h4>Inscription</h4>

                                        <!-- page frgot  -->
                                        <?php } else {
                                        if (isset($forgot_page)) {
                                        ?> <h4>Rénitialisation</h4>

                                            <!-- page compte  -->
                                        <?php  } else {
                                        ?> <h4>Votre compte</h4> <?php
                                                                }
                                                            }
                                                        } ?>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            </nav>
        <?php } ?>