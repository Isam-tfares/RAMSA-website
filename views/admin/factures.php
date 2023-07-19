<?php
//Month and year of last month
$currentMonth = date('n');
$currentYear = date('Y');
if ($currentMonth == 1) {
    $lastMonthNumber = 12;
    $lastMonthYear = $currentYear - 1;
} else {
    $lastMonthNumber = $currentMonth - 1;
    $lastMonthYear = $currentYear;
}

$years = getYears();
$mounths = getMounths();
$yearSelected = $years[0]['consommation_annee'];
$mounthSelected = $mounths[0]['consommation_mois'];
if (isset($_POST['year']) && !empty($_POST['year'])) {
    $yearSelected = $_POST['year'];
    $mounthSelected = $_POST['mounth'];
    $factures = getAllFactures($yearSelected, $mounthSelected);
} else {
    $factures = getAllFactures($lastMonthYear, $lastMonthNumber);
}

$title = "Factures" ?>
<?php ob_start(); ?>

<div class="details-table p-0 px-2">
    <div class="activities pt-0 lesson-block m-0 mx-3 my-0">
        <h2 class="fw-bold mt-5 mb-4 text-center">Factures</h2>
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
                            if ($_POST['mounth'] == $mounth['consommation_mois']) { ?>
                                <option value="<?= $mounth['consommation_mois'] ?>" selected><?= date('F', strtotime("01-" . $mounth['consommation_mois'] . "-2000")) ?></option>
                            <?php } else { ?>
                                <option value="<?= $mounth['consommation_mois'] ?>"><?= date('F', strtotime("01-" . $mounth['consommation_mois'] . "-2000")) ?></option>

                        <?php  }
                        }
                    } else { ?>
                        <?php foreach ($mounths as $mounth) { ?>
                            <option value="<?= $mounth['consommation_mois'] ?>"><?= date('F', strtotime("01-" . $mounth['consommation_mois'] . "-2000")) ?></option>
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
                    <td class="text-start ps-3">Etat</td>
                    <td class="text-center">Action</td>
                </tr>

            </thead>

            <tbody id="" style="max-height: 600px;overflow-y:auto">
                <?php foreach ($factures as $key => $facture) { ?>

                    <tr>
                        <td> <?= $facture['nom'] . " " . $facture['prenom'] ?></td>
                        <td class="text-start"><?= $facture['adresse_local'] ?></td>
                        <td class=" py-1 m-1 px-2 "><?= $facture['facture_id'] ?></td>
                        <td class=" py-1 m-1 px-2 "><?= $facture['montant'] ?> DH</td>
                        <td class=" py-1 m-1 px-2 "><?= $facture['etat'] ? "payée" : "impayée" ?></td>
                        <td>
                            <div class="d-flex justify-content-evenly py-2 align-items-center">
                                <button type="button" class="status btn delivered border-none mx-2" data-bs-toggle="modal" data-bs-target="#editFacture<?= $facture['facture_id'] ?>">
                                    Modifier
                                </button>

                                <form action="?page=deleteFacture" method="post">
                                    <input type="hidden" name="facture_id" value="<?= $facture['facture_id'] ?>">
                                    <button type="submit" class="status btn return border-none mx-2">Supprimer</button>
                                </form>
                            </div>
                        </td>
                        <!-- Modal edit Facture -->
                        <div class="modal fade" id="editFacture<?= $facture['facture_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalLabel">Modifier La Facture N° <?= $facture['facture_id'] ?> du <?= $facture['nom'] . " " . $facture['prenom'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="?page=editFacture" method="post">
                                            <input type="hidden" name="facture_id" id="" value="<?= $facture['facture_id'] ?>">
                                            <div class="form-outline mb-4">
                                                <label class="form-label text-dark text-start" for="form5Example1" style="text-align: left !important;">Etat </label>
                                                <select name="etat" id="selectMounth" class="form-select w-75" aria-label="Default select example" style="height: 40px !important;">
                                                    <option value="1" <?= $facture['etat'] ? "selected" : "" ?>>Payée</option>
                                                    <option value="0" <?= $facture['etat'] ? "" : "selected" ?>>Impayée</option>
                                                </select>
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
    <input type="hidden" name="mounth" id="" value="<?php echo (isset($_POST['mounth'])) ? $_POST['mounth'] : $mounths[0]['consommation_mois'] ?>">
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
