<?php
//Month and year of last month
$currentMonth = date('n');
$currentYear = date('Y');
$years = getYears();
$mounths = Months();
$yearSelected = $years[0]['consommation_annee'];
$mounthSelected = $mounths[0]['month'];
if (isset($_POST['year']) && !empty($_POST['year'])) {
    $yearSelected = $_POST['year'];
    $mounthSelected = $_POST['mounth'];
    $encaissements = getAllEncaissements($mounthSelected, $yearSelected);
} else {
    $encaissements = getAllEncaissements($currentMonth, $currentYear);
}
$modes_payement = getModes();

$title = "Encaissemets" ?>
<?php ob_start(); ?>

<div class="details-table p-0 px-2">
    <div class="activities pt-0 lesson-block m-0 mx-3 my-0">
        <h2 class="fw-bold mt-5 mb-4 text-center">Encaissements</h2>
        <div class="d-flex flex-start my-2 mx-5">
            <div class="d-flex me-3">
                <label class="fw-bold fs-5 mt-1">Année &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <select name="year" id="selectYear" class="form-select w-75" aria-label="Default select example" style="height: 40px !important;">
                    <?php if (isset($_POST['year'])) { ?>
                        <?php foreach ($years as $year) {
                            if ($_POST['year'] == $year['consommation_annee']) { ?>
                                <option value="<?= $year['consommation_annee'] ?>" selected><?= $year['consommation_annee'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $year['consommation_annee'] ?>"><?= $year['consommation_annee'] ?></option>

                        <?php  }
                        }
                    } else { ?>
                        <?php foreach ($years as $year) { ?>
                            <option value="<?= $year['consommation_annee'] ?>"><?= $year['consommation_annee'] ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="d-flex">
                <label class="fw-bold fs-5 mt-1">Mois &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <select name="mounth" id="selectMounth" class="form-select w-75" aria-label="Default select example" style="height: 40px !important;">
                    <?php if (isset($_POST['mounth'])) { ?>
                        <?php foreach ($mounths as $mounth) {
                            if ($_POST['mounth'] == $mounth['month']) { ?>
                                <option value="<?= $mounth['month'] ?>" selected><?= date('F', strtotime("01-" . $mounth['month'] . "-2000")) ?></option>
                            <?php } else { ?>
                                <option value="<?= $mounth['month'] ?>"><?= date('F', strtotime("01-" . $mounth['month'] . "-2000")) ?></option>

                        <?php  }
                        }
                    } else { ?>
                        <?php foreach ($mounths as $mounth) { ?>
                            <option value="<?= $mounth['month'] ?>"><?= date('F', strtotime("01-" . $mounth['month'] . "-2000")) ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <table class="border-top">
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">Adresse</td>
                    <td>N° Facture </td>
                    <td class="text-start ps-3">Montant </td>
                    <td class="text-start ps-3">Date de payement</td>
                    <td class="text-start ps-3">Mode de payement</td>
                    <td class="text-center">Action</td>
                </tr>

            </thead>

            <tbody id="" style="max-height: 600px;overflow-y:auto">
                <?php foreach ($encaissements as $key => $encaissement) { ?>

                    <tr>
                        <td> <?= $encaissement['nom'] . " " . $encaissement['prenom'] ?></td>
                        <td class="text-start"><?= $encaissement['adresse_local'] ?></td>
                        <td class=" py-1 m-1 px-2 "><?= $encaissement['facture_id'] ?></td>
                        <td class=" py-1 m-1 px-2 "><?= $encaissement['montant'] ?> DH</td>
                        <td class=" py-1 m-1 px-2 "><?= $encaissement['encaissement_date'] ?></td>
                        <td class=" py-1 m-1 px-2 "><?= $encaissement['mode_payement'] ?></td>
                        <td>
                            <div class="d-flex justify-content-evenly py-2 align-items-center">
                                <button type="button" class="status btn delivered border-none mx-2" data-bs-toggle="modal" data-bs-target="#editEncaissement<?= $encaissement['encaissement_id'] ?>">
                                    Modifier
                                </button>

                                <form action="?page=deleteEncaissement" method="post">
                                    <input type="hidden" name="facture_id" value="<?= $encaissement['encaissement_id'] ?>">
                                    <button type="submit" class="status btn return border-none mx-2">Supprimer</button>
                                </form>
                            </div>
                        </td>
                        <!-- Modal edit Facture -->
                        <div class="modal fade" id="editEncaissement<?= $encaissement['encaissement_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalLabel">Modifier L'encaissement N° <?= $encaissement['encaissement_id'] ?> du <?= $encaissement['nom'] . " " . $encaissement['prenom'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="?page=editEncaissement" method="post">
                                            <input type="hidden" name="encaissement_id" id="" value="<?= $encaissement['encaissement_id'] ?>">
                                            <div class="form-outline mb-4">
                                                <label class="form-label text-dark text-start" for="form5Example1" style="text-align: left !important;">Mode de réglement </label>
                                                <select name="mode_payement" id="selectMounth" class="form-select w-75" aria-label="Default select example" style="height: 40px !important;">
                                                    <?php foreach ($modes_payement as $mode) { ?>
                                                        <option value="<?= $mode['mode_payement_id'] ?>" <?= $mode['mode_payement_id'] == $encaissement['mode_payement_id'] ? "selected" : "" ?>><?= $mode['mode_payement'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label text-dark text-start" for="form5Example1" style="text-align: left !important;">référence du paiement</label>
                                                <input class="form-control" type="text" name="Ncheque,transaction" id="" value="<?= $encaissement['Ncheque,transaction'] ?>">
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

<form method="post" action="" id="FilterMounth">
    <input type="hidden" name="mounth" value="" id="inputMounth">
    <input type="hidden" name="year" id="" value="<?php echo (isset($_POST['year'])) ? $_POST['year'] : $years[0]['consommation_annee'] ?>">
</form>
<form method="post" action="" id="FilterYear">
    <input type="hidden" name="year" value="" id="inputYear">
    <input type="hidden" name="mounth" id="" value="<?php echo (isset($_POST['mounth'])) ? $_POST['mounth'] : $mounths[0]['month'] ?>">
</form>
<script>
    let select = document.querySelector('#selectMounth');
    let inputMounth = document.querySelector('#inputMounth');
    select.addEventListener('change', (e) => {
        inputMounth.value = (e.currentTarget.value);
        document.getElementById("FilterMounth").submit();
    });
    let selectSemstre = document.querySelector('#selectYear');
    let inputYear = document.querySelector('#inputYear');
    selectSemstre.addEventListener('change', (e) => {
        inputYear.value = (e.currentTarget.value);
        document.getElementById("FilterYear").submit();
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
