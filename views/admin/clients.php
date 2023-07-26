<?php
$clients = clients();
?>

<?php $title = "Clients" ?>
<?php ob_start(); ?>

<div class="details-table pt-0">
    <div class="activities">
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent" style="height: 40px !important;">
                Ajouter
            </button>
            <!-- Modal add Client -->
            <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="?page=addClient" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Nom</label>
                                    <input type="text" id="form5Example1" class="form-control" name="nom" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Prénom</label>
                                    <input type="text" id="form5Example1" class="form-control" name="prenom" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Email</label>
                                    <input type="text" id="form5Example1" class="form-control" name="email" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">numéro de téléphone</label>
                                    <input type="text" id="form5Example1" class="form-control" name="tel" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Adresse</label>
                                    <input type="text" id="form5Example1" class="form-control" name="adresse" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">mot de passe</label>
                                    <input type="text" id="form5Example1" class="form-control" name="password" id="" required />

                                </div>


                                <button type="submit" class="btn btn-primary btn-block mb-4">Ajouter</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>



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
        <table>
            <thead>
                <tr>
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td class="text-start">Email </td>
                    <td class="text-start">Téléphone</td>
                    <td class="text-start">Adresse</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($clients as $client) { ?>
                    <tr>
                        <td>
                            <?= $client['nom'] ?>
                        </td>
                        <td class="text-start">
                            <?= $client['prenom'] ?>
                        </td>
                        <td class="text-start">
                            <?= $client['email'] ?>
                        </td>
                        <td class="text-start">
                            <?= $client['tel'] ?>
                        </td>
                        <td class="text-start">
                            <?= $client['adresse'] ?>
                        </td>
                        <td class="d-flex justify-content-evenly py-2 mt-2 mx-2">
                            <button type="button" class="status btn delivered border-none mx-2" data-bs-toggle="modal" data-bs-target="#modifierClient<?= $client['client_id'] ?>">Modifier</button>
                            <form action="?page=deleteClient" method="post">
                                <input type="hidden" name="client_id" value="<?= $client['client_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le client  <?= $client['nom'] . ' ' . $client['prenom'] ?>  ?');">Supprimer</button>

                            </form>
                        </td>
                        <!-- modal for edit student datas -->
                        <div class="modal fade" id="modifierClient<?= $client['client_id']  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier les données d'un client
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="?page=editClient" method="post">
                                            <input type="hidden" name="client_id" value="<?= $client['client_id'] ?>">
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Nom</label>
                                                <input type="text" id="form5Example1" class="form-control" name="nom" id="" value="<?= $client['nom'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Prénom</label>
                                                <input type="text" id="form5Example1" class="form-control" name="prenom" id="" value="<?= $client['prenom'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Email</label>
                                                <input type="text" id="form5Example1" class="form-control" name="email" id="" value="<?= $client['email'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">numéro de téléphone</label>
                                                <input type="text" id="form5Example1" class="form-control" name="tel" id="" value="<?= $client['tel'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Adresse</label>
                                                <input type="text" id="form5Example1" class="form-control" name="adresse" id="" value="<?= $client['adresse'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">mot de passe</label>
                                                <input type="text" id="form5Example1" class="form-control" name="password" id="" placeholder="Entrer le mot de passe si vous voulez le changer" />

                                            </div>


                                            <button type="submit" class="btn btn-primary btn-block mb-4">Modifier</button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
