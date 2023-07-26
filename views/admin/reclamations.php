<!-- Il reste encore  envoyer un email -->

<?php $title = "Réclamations" ?>
<?php ob_start();
$messages = getMessages(); // get Réclamations from back
?>

<div class="details-table p-0 px-2">
    <div class="activities pt-0 lesson-block m-0 mx-3 my-0">
        <!-- messages Students -->
        <h2 class="fw-bold mt-5 mb-0 text-center">Réclamations</h2>
        <table class="border-top" id="messages">
            <thead>
                <tr>
                    <td>Client</td>
                    <td class="text-start">Réclamation</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($messages as $message) { ?>
                    <tr>
                        <td><?= $message['nom'] . " " . $message['prenom'] ?></td>
                        <td class="text-start"><?= $message['message_content'] ?></td>
                        <td class="d-flex justify-content-evenly py-2">
                            <?php if ($message['message_statut'] == 0) { ?>

                                <button type="button" class="status btn delivered border-none" style="width: 70px;" data-bs-toggle="modal" data-bs-target="#repondre<?= $message['message_id'] ?>">Répondre</button>
                            <?php } ?>
                            <!-- modal for edit student datas -->
                            <div class="modal fade" id="repondre<?= $message['message_id']  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLabel">Répondre a une réclamation
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="?page=updateMessage" method="post">
                                                <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label text-start text-dark" for="form5Example1">Réponse</label>
                                                    <textarea type="text" id="form5Example1" class="form-control" name="reponse" id="" value="" required rows="6"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block mb-4">Répondre</button>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- <form action="?page=deleteMessage" method="post">
                                <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce message ?');">Supprimer</button>
                            </form> -->
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
