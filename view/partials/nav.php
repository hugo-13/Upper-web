
    <!-- icon dans l'onglet  -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/onglet.png">
    <!-- titre de lonlet  -->
    <title>Upper web, your designer web</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap connect  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- nav bar responsiv  -->
    <?php
    if (!isset($page_contact)) {
    ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="../images/logo.png" height="45" alt="UPPER_WEB" class="logo">
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                    </div>
                    <div class="navbar-nav ms-auto">
                        <a href="../#slider" class="nav-item nav-link">Accueil</a>
                        <a href="../#presentation" class="nav-item nav-link">Qui suis-je ?</a>
                        <a href="../#devis" class="nav-item nav-link">Devis</a>
                        <a href="../contact" class="nav-item nav-link">Me contacter</a>
                    </div>
                </div>
            </div>
        </nav>
    <?php } else { ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="../images/logo.png" height="45" alt="UPPER_WEB" class="logo">
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                    </div>
                    <div class="navbar-nav ms-auto">
                        <a href="../#slider" class="nav-item nav-link">Accueil</a>
                        <a href="../#presentation" class="nav-item nav-link">Qui suis-je ?</a>
                        <a href="../#devis" class="nav-item nav-link">Devis</a>
                        <a href="../#contact" class="nav-item nav-link">Me contacter</a>
                    </div>
                </div>
            </div>
        </nav>



    <?php } ?>
