<!-- Il reste encore mettre la demande comme pdf et aussi envoyer un email -->

<?php $title = "Demandes" ?>
<?php ob_start();
$demandes = getAllDemandes(); // get Datas from back
$messages = getMessages(); // get Datas from back
?>

<div class="details-table p-0 px-2">
    <div class="activities pt-0 lesson-block m-0 mx-3 my-0">
        <h2 class="fw-bold mt-5 mb-0 text-center">Demandes</h2>
        <?php if (isset($_POST['id'])) { ?>
            <div class="center">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_POST['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php } ?>
        <table class="border-top">
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">Type de Demande</td>
                    <td>Etat</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($demandes as $demande) { ?>
                    <tr>
                        <td><?= $demande['nom'] . " " . $demande['prenom'] ?></td>
                        <td class="text-start"><?= $demande['demande_name'] ?></td>
                        <?php if ($demande['etat'] == '1') { ?>
                            <td class=" py-1 m-1 px-2 ">Traité</td>

                            <td class="d-flex justify-content-evenly py-2">
                                <form action="?page=deleteDemande" method="post">
                                    <input type="hidden" name="demande_id" value="<?= $demande['demande_id'] ?>">
                                    <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce demande ?');">Supprimer</button>
                                </form>
                            </td>
                        <?php } else { ?>
                            <td class=" py-1 m-1 px-2 ">Non Traité</td>
                            <td class="d-flex justify-content-evenly py-2">
                                <button type="button" class="btn btn-warning text-white border-none" data-bs-toggle="modal" data-bs-target="#traiter<?= $demande['demande_id'] ?>" style="height: 40px !important;">
                                    Traiter
                                </button>
                                <!-- Modal traiter Demande -->
                                <div class="modal fade" id="traiter<?= $demande['demande_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel" style="color:black">Traiter Un demande</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="p-2">
                                                    <?php if (!empty($demande['historique_date'])) { ?>
                                                        <div class="my-2">
                                                            <p style="color: black;text-align:left">Date Correspond : <bold><?= date("M", strtotime($demande['historique_date'])) . " " . date("Y", strtotime($demande['historique_date'])) ?></bold>
                                                            </p>
                                                        </div>
                                                    <?php  } elseif (!empty($demande["historique_date_debut"])) { ?>
                                                        <div class="my-2">
                                                            <p style="color: black;text-align:left">De : <bold><?= date("M", strtotime($demande['historique_date_debut'])) . " " . date("Y", strtotime($demande['historique_date_debut'])) ?></bold>
                                                            </p>
                                                        </div>
                                                        <div class="my-2">
                                                            <p style="color: black;text-align:left">A : <bold><?= date("M", strtotime($demande['historique_date_fin'])) . " " . date("Y", strtotime($demande['historique_date_fin'])) ?></bold>
                                                            </p>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <form action="?page=traiterDemande" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="demande_id" value="<?= $demande['demande_id'] ?>">

                                                    <div class="my-2">
                                                        <p style="color: black;text-align:left">Ajouter la demande</p>
                                                    </div>
                                                    <div class="my-2"><input class="form-control" type="file" name="file" id="" required></div>
                                                    <button type="submit" class="btn btn-warning text-white border-none" onclick="return confirm('Êtes-vous sûr de vouloir Traiter ce demande ?');">Traiter</button>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
