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
                                <form action="?page=updateMessage" method="post" class="mx-2">
                                    <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                    <button type="submit" class="status btn delivered border-none" style="width: 70px;">Recu <i class="bi bi-check-lg"></i></button>
                                </form>
                            <?php } ?>
                            <form action="?page=deleteMessage" method="post">
                                <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce message ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
