<?php $title = "Acceuil" ?>
<?php
$nbrClients = count(clients());
$nbrDemandes = count(getDemandesNonTraites());
$nbrContrats = count(getActivesContarts());
$nbrMessages = count(getMessages());
$messages = getLastMessagesC();
$demandes = getLastDemandes();
[$activities1, $activities2] = getLastActivities();
$current_date = new DateTime();
$consommationsAreInserted = ConsommationsAreInserted();


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
<div class="text-center d-flex align-items-center justify-content-center cardHeader">
    <?php if (!$consommationsAreInserted) { ?>
        <a class="btn" href="?page=consommations">Enregistrer les consommations</a>
    <?php }  ?>
</div>
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
            <div class="cardName">Réclamations non répondues</div>
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
            <h2>Derniers Activités</h2>
            <a href="?page=activities" class="btn">Voir tous</a>
        </div>

        <table>

            <tbody>
                <?php foreach ($activities1 as $activity) { ?>
                    <tr>
                        <td>
                            <?= $activity['activity_content'] ?>
                            <br>
                            <!-- <span class="fullname"><?= $activity['email'] ?></span> -->
                            <span class="fullname"><?= $activity['activity_date'] . " " . $activity['activity_time'] ?></span>
                        </td>

                    </tr>
                <?php } ?>
                <?php foreach ($activities2 as $activity) { ?>
                    <tr>
                        <td>
                            <?= $activity['activity_content'] ?>
                            <br>
                            <!-- <span class="fullname"><?= $activity['nom'] . " " . $activity['prenom'] ?></span> -->
                            <span class="fullname"><?= $activity['activity_date'] . " " . $activity['activity_time'] ?></span>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

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
