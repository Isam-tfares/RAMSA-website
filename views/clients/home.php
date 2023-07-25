<?php
// get Datas
$demandes_types = getDemandesTypes();
[$demandes, $demandes2] = getDemandes();
$reclamations = getMessages();
$contrats = getContratsC();
$allContrats = getContratsCAll();
$localites = getLocalities();

if (isset($_POST['id'])) {
    if ($_POST['message'] == "demande") {
        $demandeSended = $_POST['id'];
    } elseif ($_POST['message'] == "message") {
        $isSended = $_POST['id'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .main-h1::after {
            content: "";
            position: absolute;
            border: 2px solid var(--main-color);
            width: 100px;
            bottom: -10px;
            left: calc(50% - 50px);
        }

        .block-service {
            width: 400px;
        }

        .active-router {
            border-bottom: 4px solid #6495ED;
        }

        .router {
            cursor: pointer;
        }

        .disabled-block {
            display: none;
        }
    </style>

</head>

<body>

    <?php include 'views/includes/client_header.php'; ?>

    <div class="home-bg" id="home">

        <section class="home">

            <div class="swiper home-slider">

                <div class="swiper-wrapper">

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="./assets/imgs/RAMSA.jpg" alt="">
                        </div>
                        <div class="content mx-md-2">
                            <h3>RAMSA</h3>
                            <span> (Régie Autonome de Distribution d'Eau et d'Assainissement) est un établissement public au Maroc chargé de la gestion de la distribution d'eau et de l'assainissement dans la région du Grand Agadir, offrant des prestations techniques et commerciales pour assurer l'accès à l'eau potable et la préservation de l'environnement.</span>
                            <br>
                            <div class="text-center"><a href="#Demandes" class="btn btn-light" style="font-size: 1.6rem;">Demander</a></div>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination"></div>

            </div>

        </section>
    </div>
    <div class="Demandes" id="Demandes">
        <div class="container my-2">



            <div class="d-flex justify-content-center m-0 mt-5 pt-5">
                <div class="heading  mx-2">
                    <h3 class="router rter1 active-router fw-bold mt-5 mb-0 text-center position-relative">Nos services</h3>

                </div>
                <div class="heading mx-2">
                    <h3 class="router rter2  fw-bold mt-5 mb-0 text-center position-relative">Vos Demandes</h3>
                </div>
            </div>
            <section class="overflow-hidden lesson-block rounded " style="background-color: #eeeeee;">

                <div class=" px-1 px-md-5 text-center text-lg-start my-5">
                    <div class="row mb-5 lesson-block">

                        <div class="col-12">
                            <div style="font-size: 2rem;">
                                <?php if (isset($demandeSended)) {
                                    if ($demandeSended) { ?>
                                        <div class="alert alert-success alert-dismissible fade show  text-center" role="alert">
                                            <?= $_POST['success'] ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-danger alert-dismissible fade show  text-center" role="alert">
                                            <?= $_POST['success'] ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <p class="text-center w-75 mx-auto my-3">Avec notre service, c'est aussi simple qu'un clic. Demandez votre document aujourd'hui et soyez assuré qu'il vous sera entre vos mains en seulement 72 heures au maximum.</p>
                            <div class="d-flex justify-content-center flex-wrap">
                                <?php foreach ($demandes_types as $demande) { ?>
                                    <div class="mb-3">
                                        <div class="service rounded">
                                            <div class="card1">
                                                <h1 class="title"><?= $demande['demande_name'] ?></h1>
                                            </div>

                                            <?php if ($demande['contrat']) { ?>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#demander<?= $demande['demande_type_id'] ?>" class="btn btn-outline-primary w-50 Demander" style="font-size: 12px;font-weight: bold;">
                                                    Demander
                                                </button>
                                                <!-- Modal demander Resiliation -->
                                                <div class="modal fade" id="demander<?= $demande['demande_type_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel" style="color:black;font-size:2rem"><?= $demande['demande_name'] ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size:2rem"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="?page=addDemande" method="post">
                                                                    <input type="hidden" name="type" value="<?= $demande['demande_type_id'] ?>">

                                                                    <div class="form-outline mb-4">
                                                                        <label class="form-label text-dark text-start" for="form5Example1" style="color: black;text-align:left;font-size:2rem">Adresse corespondant</label>
                                                                        <select name="contrat_id" id="selectMounth" class="form-select w-75" aria-label="Default select example" style="height: 40px !important;color: black;text-align:left;font-size:2rem">
                                                                            <?php foreach ($contrats as $contrat) { ?>
                                                                                <option value="<?= $contrat['contrat_id'] ?>" style="font-size:2rem"><?= $contrat['adresse_local'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                    <div>
                                                                        <button type="submit" class="btn btn-primary w-25 mt-5 text-white border-none" onclick="return confirm('Êtes-vous sûr de vouloir demande ce service ?');" style="font-size:2rem">Demander</button>
                                                                    </div>
                                                                </form>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#demander<?= $demande['demande_type_id'] ?>" class="btn btn-outline-primary w-50 Demander" style="font-size: 12px;font-weight: bold;">
                                                    Demander
                                                </button>

                                                <div class="modal fade" id="demander<?= $demande['demande_type_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel" style="color:black;font-size:2rem">Demande d'abonnement</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size:2rem"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="?page=addDemande" method="post">
                                                                    <input type="hidden" name="type" value="<?= $demande['demande_type_id'] ?>">

                                                                    <div class="form-outline my-4">
                                                                        <label class="form-label text-dark text-start" for="form5Example1" style="color: black;text-align:left;font-size:2rem">Entrer Votre adresse local</label>
                                                                        <input class="form-control" type="text" name="adresse" id="" style="color: black;text-align:left;font-size:2rem" required>
                                                                    </div>
                                                                    <div class="form-outline my-4">
                                                                        <label class="form-label text-dark text-start" for="form5Example1" style="color: black;text-align:left;font-size:2rem">Selectionner Localité</label>
                                                                        <select name="localite_id" id="selectMounth" class="form-select w-100" aria-label="Default select example" style="height: 40px !important;color: black;text-align:left;font-size:2rem">
                                                                            <?php foreach ($localites as $localite) { ?>
                                                                                <option value="<?= $localite['localite_id'] ?>" style="font-size:2rem"><?= $localite['localite_name'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                    <div>
                                                                        <button type="submit" class="btn btn-primary w-25 mt-5 text-white border-none" onclick="return confirm('Êtes-vous sûr de vouloir demande ce service ?');" style="font-size:2rem">Demander</button>
                                                                    </div>
                                                                </form>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="nv-block col-12 p-5 rounded border disabled-block overflow-hidden lesson-block " style="background-color: #eeeeee;">
                <h2 class="title2">Vos demandes</h2>
                <div>
                    <div class="row m-0 container-fluid rounded">
                        <div class="col-3 col-lg-3  bdr ps-3 fw-bold bg-light title1">Type de Demande</div>
                        <div class="col-3 col-lg-3 text-center bdr fw-bold bg-light title1">Date de Demande</div>
                        <div class="col-3 col-lg-3 text-center bdr fw-bold bg-light title1">Etat</div>
                        <div class="col-3 col-lg-3 text-center bdr fw-bold bg-light title1">Action</div>
                    </div>
                    <div class="row m-0 container-fluid">
                        <?php foreach ($demandes as $demande) { ?>
                            <div class="col-3 col-lg-3  bg-white  bdr ps-3"><?= $demande['demande_name'] ?></div>
                            <div class="col-3 col-lg-3 bg-white text-center bdr"><?= $demande['demande_date'] ?></div>
                            <?php if ($demande['etat'] == '1') { ?>
                                <div class="col-3 col-lg-3 text-center bdr bg-white text-success fw-bold">Traité</div>
                                <div class="col-3 col-lg-3 text-center bdr bg-white ">
                                    <?php if ($demande['demande_type_id'] == 5) { ?> <!-- Contrats -->
                                        <form class="col ps-0 text-end pe-0" action="assets/Contrats/<?php echo $demande["file_path"]; ?>" method="get" target="_blank" style="display: flex;justify-content: space-around;">
                                            <button type="submit" class="btn btn-primary w-md-50" style="font-size: 1.6rem;"> Télécharger</button>
                                        </form>
                                    <?php } elseif ($demande['demande_type_id'] == 3 || $demande['demande_type_id'] == 4) { ?> <!-- Encaissements -->
                                        <form class="col ps-0 text-end pe-0" action="" method="POST" target="_blank" style="display: flex;justify-content: space-around;">
                                            <input type="hidden" name="demande_id" value="<?= $demande['demande_id'] ?>">
                                            <button type="submit" class="btn btn-primary w-md-50" style="font-size: 1.6rem;"> Voir</button>
                                        </form>
                                        <!-- <form class="col ps-0 text-end pe-0" action="assets/Demandes/<?php echo $demande["file_path"]; ?>" method="get" target="_blank" style="display: flex;justify-content: space-around;">
                                            <button type="submit" class="btn btn-primary w-md-50" style="font-size: 1.6rem;"> Télécharger</button>
                                        </form> -->
                                    <?php } ?>

                                </div>
                            <?php } else { ?>
                                <div class="col-3 col-lg-3 text-center bdr text-warning fw-bold bg-white">Non Traité</div>
                                <div class="col-3 col-lg-3 text-center bdr bg-white"><button class="btn btn-primary w-md-50" style="font-size: 1.6rem;" disabled>Télécharger</button></div>
                            <?php } ?>
                        <?php } ?>

                        <!-- Demandes d'Abonnement -->

                        <?php foreach ($demandes2 as $demande) { ?>
                            <div class="col-3 col-lg-3  bg-white  bdr ps-3">Demande d'abonnement</div>
                            <div class="col-3 col-lg-3 bg-white text-center bdr"><?= $demande['demande_date'] ?></div>
                            <?php if ($demande['etat'] == '1') { ?>
                                <div class="col-3 col-lg-3 text-center bdr bg-white text-success fw-bold">Traité</div>
                                <div class="col-3 col-lg-3 text-center bdr bg-white ">


                                </div>
                            <?php } else { ?>
                                <div class="col-3 col-lg-3 text-center bdr text-warning fw-bold bg-white">Non Traité</div>
                                <div class="col-3 col-lg-3 text-center bdr bg-white">
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                </div>

            </section>
        </div>
    </div>

    <!-- messages -->

    <div class="Demandes" id="Réclamations">
        <div class="container my-2">



            <div class="d-flex justify-content-center m-0 mt-5 pt-5">
                <div class="heading  mx-2">
                    <h3 class="router rter3 active-router fw-bold mt-5 mb-0 text-center position-relative">Réclamation</h3>

                </div>
                <div class="heading mx-2">
                    <h3 class="router rter4  fw-bold mt-5 mb-0 text-center position-relative">Vos Réclamations</h3>
                </div>
            </div>
            <section class="overflow-hidden lessons-block rounded " style="background-color: #eeeeee;">

                <div class=" px-1 px-md-5 text-center text-lg-start my-5">
                    <div class="row mb-5 lesson-block">

                        <div class="col-12">
                            <div style="font-size: 2rem;">
                                <?php if (isset($isSended)) {
                                    if ($isSended) { ?>
                                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                            <?= $_POST['success'] ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-danger alert-dismissible fade show  text-center" role="alert">
                                            <?= $_POST['success'] ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                <?php }
                                } ?>

                            </div>


                            <div class="col-8 offset-2 position-relative p-0">
                                <div class="card">
                                    <div class="card-body px-4 py-5 px-md-5">
                                        <div>
                                            <h3 class="text-center fw-bold mb-2" style="color:var(--dark-blue);">Contactez-nous</h3>
                                            <p class="text-center w-75 mx-auto mb-5">Merci de votre intérêt pour nos services. Si vous avez des demandes particulières ou des besoins spécifiques, veuillez remplir le formulaire ci-dessous. Notre équipe se fera un plaisir d'examiner votre demande et de vous fournir une réponse dans les plus brefs délais. Nous sommes là pour vous aider !</p>
                                            <form class="container bg-white py-5 px-3 mb-5" action="?page=addMessage" method="POST">

                                                <div class="mb-3">
                                                    <label for="message" class="form-label">Réclamation</label>
                                                    <textarea style="height: 200px;font-size:1.7rem" type="text" class="form-control" name="message" id="message" aria-describedby="emailHelp" required><?php if (isset($message)) {
                                                                                                                                                                                                            echo $message;
                                                                                                                                                                                                        } ?></textarea>
                                                </div>
                                                <!-- Submit button -->
                                                <div class="text-center">
                                                    <button type="submit" id="btnMessage" class="btn btn-primary mt-5 mb-4 " name="send">
                                                        Envoyer
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="nv-block2 col-12 p-5 rounded border disabled-block overflow-hidden lesson-block " style="background-color: #eeeeee;">
                <h2 class=" title2" style="margin-top: 50px;">Vos réclamations</h2>
                <div>
                    <div class="row m-0 container-fluid rounded">
                        <div class="col-4 col-lg-4 bdr ps-3 fw-bold bg-light title1">Réclamations</div>
                        <div class="col-4 col-lg-4 text-center bdr fw-bold bg-light title1">Date de réclamations</div>
                        <div class="col-4 col-lg-4 text-center bdr fw-bold bg-light title1">Etat</div>
                    </div>
                    <div class="row m-0 container-fluid">
                        <?php foreach ($reclamations as $message) { ?>
                            <div class="col-4 col-lg-4  bg-white  bdr ps-3" style="height:100px;overflow-y:auto"><?= $message['message_content'] ?></div>
                            <div class="col-4 col-lg-4 bg-white text-center bdr"><?= $message['message_date'] ?></div>
                            <?php if ($message['message_statut'] == '1') { ?>
                                <div class="col-4 col-lg-4 text-center bdr text-succes fw-bold bg-white">Traité</div>
                            <?php } else { ?>
                                <div class="col-4 col-lg-4 text-center bdr text-warning fw-bold bg-white">NonTraité</div>
                            <?php } ?>
                        <?php } ?>


                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Contrats -->
    <div id="Contrats">
        <div class="heading mx-2">
            <h3 class="fw-bold mt-5 mb-0 text-center position-relative">Vos Contrats</h3>
        </div>
        <div class="container">
            <section class=" col-12 p-5 rounded border overflow-hidden " style="background-color: #eeeeee;">

                <div>
                    <div class="row m-0 container-fluid rounded">
                        <div class="col-3 col-lg-3  bdr ps-3 fw-bold bg-light title1">Listes des contrats</div>
                        <div class="col-3 col-lg-3 text-center bdr fw-bold bg-light title1">Date de Début</div>
                        <div class="col-3 col-lg-3 text-center bdr fw-bold bg-light title1">Date de fin</div>
                        <div class="col-3 col-lg-3 text-center bdr fw-bold bg-light title1">Action</div>
                    </div>
                    <div class="row m-0 container-fluid">
                        <?php foreach ($allContrats as $contrat) { ?>
                            <div class="col-3 col-lg-3  bg-white  bdr ps-3">Contrat n<?= $contrat['numero'] ?></div>
                            <div class="col-3 col-lg-3 bg-white text-center bdr"><?= $contrat['date_de_debut'] ?></div>
                            <div class="col-3 col-lg-3 bg-white text-center bdr"><?= $contrat['date_de_fin'] ? $contrat['date_de_fin'] : "non définie" ?></div>
                            <div class="col-3 col-lg-3 text-center bdr bg-white">
                                <?= $contrat['adresse_local'] . ' ' . $contrat['localite_name'] ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </section>
        </div>
    </div>












    <?php include 'views/includes/client_footer.php'; ?>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="js/clients.js"></script>


</body>

</html>