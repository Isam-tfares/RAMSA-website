<!-- Il reste encore mettre la demande comme pdf et aussi envoyer un email -->

<?php $title = "Types des demandes" ?>
<?php ob_start();
$demandes = getDemandesTypes(); // get Datas from back

?>

<div class="details-table p-0 px-2">
    <div class="activities pt-0 lesson-block m-0 mx-3 my-0">
        <?php if (isset($_POST['id'])) { ?>
            <?php if ($_POST['message'] == "del") {
                if ($_POST['id'] == true) { ?>
                    <div class="center">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Demande Supprimée avec succés
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Il y a un erreur dans le server
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php }
            } else {
                if ($_POST['id'] == true) { ?>
                    <div class="center">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Demande ajoutée avec succés
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Ce demande est déja exist
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
        <?php }
            }
        } ?>
        <h2 class="fw-bold mt-5 mb-0 ">Types des demandes</h2>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent" style="height: 40px !important;">
                Ajouter
            </button>
            <!-- Modal add Client -->
            <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un Type de demande</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="?page=addDemandeType" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Nom</label>
                                    <input type="text" id="form5Example1" class="form-control" name="demande_name" id="" required />

                                </div>
                                <button type="submit" class="btn btn-primary btn-block mb-4">Ajouter</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <table class="border-top">
            <thead class="">
                <tr class="row">
                    <td class="col-1"></td>
                    <td class="text-start col-4">Type de Demande</td>
                    <td class="text-center col-4">Action</td>
                    <td class="col-3"></td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($demandes as $demande) { ?>
                    <tr class="row">
                        <td class="col-1"></td>
                        <td class="text-start  col-4"><?= $demande['demande_name'] ?></td>
                        <td class="d-flex justify-content-evenly py-2 col-4">
                            <form action="?page=deleteDemandeType" method="post">
                                <input type="hidden" name="demande_type_id" value="<?= $demande['demande_type_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce demande ?');">Supprimer</button>
                            </form>
                        </td>
                        <td class="col-3"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
