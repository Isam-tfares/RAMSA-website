<?php $title = "Acceuil" ?>
<?php
$nbrClients = count(clients());
$nbrDemandes = count(getDemandesNonTraites());
$nbrContrats = count(getActivesContarts());
$nbrMessages = count(getMessages());
$messages = getLastMessagesC();
$demandes = getLastDemandes();
$current_date = new DateTime();


ob_start(); ?>
<style>
    .home-admin {
        background: var(--white);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
    }
</style>
<!-- ======================= Cards ================== -->
<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers"><?= $nbrClients ?></div>
            <div class="cardName">Clients </div>
        </div>

        <div class="iconBx">
            <i class="fa-solid fa-users"></i>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?= $nbrContrats ?></div>
            <div class="cardName">Contrats</div>
        </div>

        <div class="iconBx">
            <i class="bi bi-journals"></i>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?= $nbrDemandes ?></div>
            <div class="cardName">Demandes non traités</div>
        </div>

        <div class="iconBx">
            <i class="bi bi-clipboard2-check-fill"></i>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?= $nbrMessages ?></div>
            <div class="cardName">Réclamations non lues</div>
        </div>

        <div class="iconBx">
            <i class="bi bi-envelope-fill"></i>
        </div>
    </div>

</div>

<!-- ================ activities List ================= -->
<div class="details">
    <div class="activities">
        <div class="cardHeader">
            <h2>Derniers Réclamations</h2>
            <a href="?page=demandes#messages" class="btn">Voir tous</a>
        </div>

        <table>

            <tbody>
                <?php foreach ($messages as $message) { ?>
                    <tr>
                        <td>
                            <?= $message['message_content'] ?>
                            <br>
                            <span class="fullname"><?= $message['nom'] . " " . $message['prenom'] ?></span>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <!-- ================= New Customers ================ -->
    <div class="Demandes">
        <div class="cardHeader">
            <h2>Derniers Demandes</h2>
            <a href="?page=demandes" class="btn">Voir tous</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Type de demande</td>
                </tr>
            </thead>
            <?php foreach ($demandes as $demande) { ?>
                <tr>
                    <td>
                        <h4><?= $demande['demande_name'] ?><br><span><?= $demande['nom'] . " " . $demande['prenom'] ?></span></h4>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php $content = ob_get_clean();
// ALERTE FOR UPDATE PASSWORD
if (isset($_POST['id'])) { ?>
    <script>
        window.onload = function() {
            alert("<?= $_POST['message'] ?>");
        }
    </script>
<?php }

require('views/admin/layout.php');
