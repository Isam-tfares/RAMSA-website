<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des encaissements</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css file link  -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .details-table {
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            /* margin-top: 10px; */
        }

        .details-table .activities {
            position: relative;
            display: grid;
            min-height: 500px;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
        }

        .details-table .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .cardHeader h2 {
            font-weight: 600;
            color: var(--blue);
        }

        .cardHeader .btn {
            position: relative;
            padding: 5px 10px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
        }

        .details-table table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .details-table table thead td {
            font-weight: 600;
        }

        .details-table .activities table tr {
            color: var(--black1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .details-table .activities table tr:last-child {
            border-bottom: none;
        }

        .details-table .activities table tbody tr:hover {
            background: var(--blue);
            color: var(--white);
        }

        .details-table .activities table tr td {
            padding: 10px;
        }

        .details-table .activities table tr td:last-child {
            text-align: end;
        }

        .details-table .activities table tr td:nth-child(2) {
            text-align: end;
        }

        .details-table .activities table tr td:nth-child(3) {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main">
        <a href="index.php" style="position: absolute;left:30px;top:20px;z-index:1000000">Accueil</a>
        <div class="details-table p-0 px-2">
            <div class="activities pt-0 lesson-block m-0 mx-3 my-0">
                <h2 class="fw-bold mt-5 mb-4 text-center">Historique des encaissements</h2>
                <div class="container">
                    <div style="display:flex;justify-content:flex-start;align-items:center">
                        <h5>Client : </h5>&nbsp;&nbsp;
                        <h5 style="color:#4d4545"><?= $_SESSION['client']['nom'] . ' ' . $_SESSION['client']['prenom'] ?></h5>
                    </div>
                    <div style="display:flex;justify-content:flex-start;align-items:center">
                        <h5>N° Contrat : </h5>&nbsp;&nbsp;
                        <h5 style="color:#4d4545"><?= $encaissements[0]['contrat_id']  ?></h5>
                    </div>
                    <div style="display:flex;justify-content:flex-start;align-items:center">
                        <h5>Adresse : </h5>&nbsp;&nbsp;
                        <h5 style="color:#4d4545"><?= $encaissements[0]['adresse_local'] . ' ' . $encaissements[0]['localite_name']  ?></h5>
                    </div>

                </div>
                <div style="display: flex;justify-content:flex-end">
                    <form action="assets/Demandes/<?php echo $demande["file_path"]; ?>" method="get" target="_blank">
                        <button type="submit" class="btn btn-primary"> Télécharger</button>
                    </form>
                </div>
                <table class="border-top">
                    <thead>
                        <tr>
                            <td class="text-start ps-3">Numéro Encaissement</td>
                            <td class="text-start">Mois/Année</td>
                            <td class="text-start ps-3">N° Facture </td>
                            <td class="text-start ps-3">Montant </td>
                            <td class="text-start ps-3">Date de payement</td>
                            <td class="text-start ps-3">Mode de payement</td>
                        </tr>

                    </thead>

                    <tbody id="" style="max-height: 600px;overflow-y:auto">
                        <?php foreach ($encaissements as $key => $encaissement) { ?>

                            <tr>
                                <td class="text-start ps-3"> <?= $encaissement['encaissement_id'] ?></td>
                                <td class="text-start ps-3"><?= $encaissement['consommation_mois'] . '/' . $encaissement['consommation_annee'] ?></td>
                                <td class="text-start ps-3"><?= $encaissement['facture_id'] ?></td>
                                <td class="text-start ps-3"><?= $encaissement['montant'] ?> DH</td>
                                <td class="text-start ps-3"><?= $encaissement['encaissement_date'] ?></td>
                                <td class="text-start ps-3"><?= $encaissement['mode_payement'] ?></td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/clients.js"></script>

</body>

</html>