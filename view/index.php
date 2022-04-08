<?php
setcookie('lang', 'fr', time() + 3600 * 24 * 365, null, null, false, true);

// Composer 


use Index\Index;

require('../vendor/autoload.php');
// Database connexion 
require('../Config/setup.php');

// Controller 
require('../Controller/function.php');
require('../Controller/Confirmation.php');

$index = new Index;

$index->ConfirmRegister();

$index->Devis();


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

    <?php
    if (isset($_SESSION['msg'])) {
        notif_register($_SESSION['msg']);
    }

    ?>

    <main>
        <!-- partie slider  -->
        <section id="slider">
            <div class="slider">
                <figure>
                    <div class="slide">
                        <img src="https://www.mathieu-crevoulin.com/img/bg_02.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="slide">
                        <img src="https://www.mathieu-crevoulin.com/img/bg_03.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="https://www.mathieu-crevoulin.com/img/bg_01.jpg" alt="">
                    </div>
                </figure>
            </div>
            <div class="fleche_bas">
                <a href="../#presentation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor" class="bi bi-arrow-down-circle-fill bounce" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                    </svg>
                </a>
            </div>
        </section>


        <!-- gifs entre 1 et 2  -->
        <div class="gifs">
            <div class="text_gif show-on-scroll left">
                <img src="../images/codeur.gif" alt="" class="taille_gif">
                <span>Passionne</span>
            </div>

            <div class="text_gif show-on-scroll right">
                <img src="../images/arc.gif" alt="" class="taille_gif">
                <span>
                    Vise dans le mile !
                </span>
            </div>

            <div class="text_gif show-on-scroll left">
                <img src="../images/curieux.gif" alt="" class="taille_gif cercle">
                <span>
                    Creatif
                </span>
            </div>

            <div class="text_gif show-on-scroll right">
                <img src="../images/pinceaux.gif" alt="" class="taille_gif">
                <span>
                    Reflechi
                </span>
            </div>
        </div>


        <!-- partie qui suis-je ?  -->
        <section id="presentation">

            <div class="head-content-top"></div>


            <div class="content-parcours">
                <!-- image cv gif  -->
                <figure class="cv show-on-scroll">
                    <img src="../images/cv.gif" />
                    <figcaption>
                        <a href="../images/cv.jpg" download="cv.jpg">
                            <img src="../images/download.png" alt="DOWNLOAD" class="dowload_img">
                        </a>
                    </figcaption>
                </figure>

                <!-- text de la section 2  -->
                <h2 class="show-on-scroll">HUGO SEIGLE</h2>
                <h3 class="show-on-scroll">
                    <div class="waviy">
                        <span style="--i:1">M</span>
                        <span style="--i:2">O</span>
                        <span style="--i:3">N</span>
                        <span style="--i:4"></span>
                        <span style="--i:4"></span>
                        <span style="--i:5">P</span>
                        <span style="--i:6">A</span>
                        <span style="--i:7">R</span>
                        <span style="--i:8">C</span>
                        <span style="--i:9">O</span>
                        <span style="--i:10">U</span>
                        <span style="--i:11">R</span>
                        <span style="--i:12">S</span>
                </h3>

            </div>
            <hr class="show-on-scroll">
            <p class="show-on-scroll">
                Passionné par l'informatique et les jeux vidéo, je me suis intéressé au métier de <span>développeur</span> <br>
                en commençant par la modification d'un jeu vidéo en 3ème suite à cela je me suis tourné vers <br>
                le <span>développement du site internet</span>.
                <br> C'est pourquoi en première j'ai choisi un BAC <span>STI2D</span>
                avec option SIN <br>(informatique et numérique) où j'ai pu acquérir des bases en <span>HTML/CSS, PHP et JS.<br>
                </span>Aujourd'hui je suis en formation professionnelle chez <span>M2i formation</span> à Lyon <br>
                afin d'obtenir un <span>Bac +2 développeur web, web mobiles</span>. <br>
                Je suis actuellement à la recherche d'un <span>stage</span> de 3 mois à partir de Juillet et d'un <br>
                éventuel poste en tant <span>qu'alternant</span> pour octobre.<br>
                <span> <br>Cliquez sur mon CV pour le télécharger !</span>
            <div class="bouton_quisuisje">
                <a href="../contact">
                    <button type="button" class="btn btn-outline-primary show-on-scroll">Me contacter</button>
                </a>
            </div>
            </p>


            <div class="head-content-bottom"></div>
        </section>


        <!-- partie de devis  -->
        <section id="devis">
            <!-- TITRE DE LA PAGE  -->

            <h2 class='show-on-scroll'>Demander un devis</h2>
            <hr class="show-on-scroll">
            <!-- method post pour recuperer le type de site  -->
            <form action="../" method="post">
                <div class="row">
                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 left show-on-scroll">
                        <div class="bg-white rounded shadow-sm"><img src="../images/devis_1.jpg" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5>Site vitrine</h5>
                                <p class="small text-muted mb-0">Le site internet vitrine permet d’avoir une présentation rapide d’une activité.</p>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" name="reg_devis" value="1">Demander</button>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 right show-on-scroll">
                        <div class="bg-white rounded shadow-sm"><img src="../images/devis_2.jpg" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5>Site E-Commerce</h5>
                                <p class="small text-muted mb-0">Site permettant de réaliser des transactions sécurisées..</p>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" name="reg_devis" value="2">Demander</button>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 left show-on-scroll">
                        <div class="bg-white rounded shadow-sm"><img src="../images/devis_3.jpg" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5>Site communautaire</h5>
                                <p class="small text-muted mb-0">Site permettant l'interaction avec plusieurs utilisateur (ex : réseaux sociaux).</p>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" name="reg_devis" value="3">Demander</button>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 right show-on-scroll">
                        <div class="bg-white rounded shadow-sm"><img src="../images/devis_4.jpg" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5>Forum</h5>
                                <p class="small text-muted mb-0">Permet une discussion souvent entraide entre des personnes.</p>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" name="reg_devis" value="4">Demander</button>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 left show-on-scroll">
                        <div class="bg-white rounded shadow-sm"><img src="../images/devis_5.jpg" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5>Site mobile</h5>
                                <p class="small text-muted mb-0">Le site internet mobile permet d’optimiser l’ergonomie d’un site existant sur les devices portatifs.</p>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" name="reg_devis" value="5">Demander</button>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 right show-on-scroll">
                        <div class="bg-white rounded shadow-sm"><img src="../images/devis_6.jpg" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5>Mini-­Site</h5>
                                <p class="small text-muted mb-0">Les mini-­sites sont des sites éphémères, permettant de présenter un évènement spécifique ou promotionnel.</p>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" name="reg_devis" value="6">Demander</button>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 left show-on-scroll">
                        <div class="bg-white rounded shadow-sm"><img src="../images/devis_7.jpg" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5>Site institutionnel</h5>
                                <p class="small text-muted mb-0">Site permettant aux organismes publics, ou de grand groupe de communiquer au plus grand nombre.</p>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" name="reg_devis" value="7">Demander</button>
                        </div>
                    </div>
                    <!-- End -->

                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 right  show-on-scroll">
                        <div class="bg-white rounded shadow-sm"><img src="../images/devis_8.jpg" alt="" class="img-fluid card-img-top">
                            <div class="p-4">
                                <h5>Site sur mesure</h5>
                                <p class="small text-muted mb-0">Tout site demandant une analyse précise via un cahier des charges, impliquant des fonctionnalité complexes.</p>
                            </div>
                            <button type="submit" class="btn btn-outline-secondary" name="reg_devis" value="8">Demander</button>
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </form>
        </section>
        <div class="bottomFixButtionComponent">
            <a href="../#slider">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                    <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                </svg>
            </a>
        </div>
    </main>

    <!-- Footer  -->
    <footer class="bg-secondary text-white text-center text-md-start">
        <?php include('./partials/footer.php') ?>
    </footer>

    <!-- script du slider  -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- script on scrolll animation  -->
    <script src="../js/show-on-scroll.js"></script>

</body>

</html>