<?php
require_once('TCPDF/tcpdf.php');
$contrats = getContratsC();
$localites = getLocalities();
$clients = clients();
// $consommations = getConsommationsOfLM();
$consommations = getConsommationsOfLMTest();
$consommationsOfCM = getConsommationsOfCM();
$years = getYears();
$mounths = getMounths();
$yearSelected = $years[0]['consommation_annee'];
$mounthSelected = $mounths[0]['consommation_mois'];
if (isset($_POST['year']) && !empty($_POST['year'])) {
    $yearSelected = $_POST['year'];
    $mounthSelected = $_POST['mounth'];
}
$historique_consommations = getHistoriqueConsommations($yearSelected, $mounthSelected);
$firstDayLastMonth = strtotime('first day of last month');
$lastDayLastMonth = strtotime('last day of last month');
$firstDayFormatted = date('j/n', $firstDayLastMonth);
$lastDayFormatted = date('j/n', $lastDayLastMonth);

$title = "Consommations" ?>
<?php ob_start(); ?>

<div class="details-table p-0 px-2">
    <div class="activities pt-0 lesson-block m-0 mx-3 my-0">

        <h2 class="fw-bold mt-5 mb-3 text-center">Consommations du mois dernier</h2>
        <table class="border-top" style="max-height: 600px;overflow-y:auto;">
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">Adresse</td>
                    <td>index1 (<?= $firstDayFormatted ?>)</td>
                    <td class="text-start ps-3">index2 (<?= $lastDayFormatted ?>)</td>
                    <td class="text-center">Action</td>
                </tr>

            </thead>

            <tbody id="">
                <?php foreach ($consommations as $key => $contrat) { ?>
                    <form action="index.php?page=addConsommation" method="post">
                        <input type="hidden" name="contrat_id" id="" value="<?= $contrat['contrat_id'] ?>">
                        <tr>
                            <td> <?= $contrat['nom'] . " " . $contrat['prenom'] ?></td>
                            <td class="text-start"><?= $contrat['adresse_local'] ?></td>
                            <td class=" py-1 m-1 px-2 "><?= $contrat['consommation_index2'] ?></td>
                            <td class=" py-1 m-1 px-2 ">
                                <?php if ($consommationsOfCM[$key]["consommation_index2"]) {
                                    echo $consommationsOfCM[$key]["consommation_index2"];
                                } else { ?>
                                    <input type="number" name="index2" id="" min="<?= $contrat['consommation_index2'] ?>" required>
                                <?php } ?>

                            </td>
                            <td>
                                <div class="d-flex justify-content-evenly py-2 align-items-center">

                                    <?php if ($consommationsOfCM[$key]["consommation_index2"]) { ?>
                                        <button type="button" class="status btn pending border-none mx-2" data-bs-toggle="modal" data-bs-target="#editConsommation<?= $consommationsOfCM[$key]['consommation_id'] ?>">
                                            Modifier
                                        </button>

                                    <?php } else { ?>
                                        <button type="submit" class="status btn delivered border-none mx-2">Enregistrer</button>
                                    <?php } ?>

                                </div>
                            </td>

                        </tr>
                    </form>
                    <!-- Modal edit consommation -->
                    <div class="modal fade" id="editConsommation<?= $consommationsOfCM[$key]['consommation_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="exampleModalLabel">Modifier La consommation du <?= $consommationsOfCM[$key]['nom'] . " " .  $consommationsOfCM[$key]['prenom'] . "<br>( " .  $consommationsOfCM[$key]['adresse_local'] . " )" ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="?page=editConsommation" method="post">
                                        <input type="hidden" name="consommation_id" id="" value="<?= $consommationsOfCM[$key]['consommation_id'] ?>">
                                        <input type="hidden" name="index1" value="<?= $contrat['consommation_index2'] ?>">
                                        <div class="form-outline mb-4">
                                            <label class="form-label text-dark" for="form5Example1">Index 2 </label>
                                            <input type="number" id="form5Example1" class="form-control" name="index2" min="<?= $contrat['consommation_index2'] ?>" value="<?= $consommationsOfCM[$key]["consommation_index2"] ?>" id="" required />
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mb-4">Modifier</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>

        <h2 class="fw-bold mt-5 mb-4 text-center">Historique des Consommations</h2>
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
                    <td>index1 </td>
                    <td class="text-start ps-3">index2 </td>
                    <td class="text-start ps-3">Consommation</td>
                    <?php if ($yearSelected == $years[0]['consommation_annee'] && $mounthSelected == $mounths[0]['consommation_mois']) { ?>
                        <td class="text-center">Action</td>
                    <?php } ?>
                </tr>

            </thead>

            <tbody id="" style="max-height: 600px;overflow-y:auto">
                <?php foreach ($historique_consommations as $key => $contrat) { ?>

                    <tr>
                        <td> <?= $contrat['nom'] . " " . $contrat['prenom'] ?></td>
                        <td class="text-start"><?= $contrat['adresse_local'] ?></td>
                        <td class=" py-1 m-1 px-2 "><?= $contrat['consommation_index1'] ?></td>
                        <td class=" py-1 m-1 px-2 "><?= $contrat['consommation_index2'] ?></td>
                        <td class=" py-1 m-1 px-2 "><?= $contrat['consommation_index2'] - $contrat['consommation_index1'] ?></td>
                        <?php if ($yearSelected == $years[0]['consommation_annee'] && $mounthSelected == $mounths[0]['consommation_mois']) { ?>
                            <td>
                                <div class="d-flex justify-content-evenly py-2 align-items-center">
                                    <button type="button" class="status btn delivered border-none mx-2" data-bs-toggle="modal" data-bs-target="#editConsommation<?= $contrat['contrat_id'] ?>">
                                        Modifier
                                    </button>
                                </div>
                            </td>
                            <!-- Modal add Client -->
                            <div class="modal fade" id="editConsommation<?= $contrat['contrat_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modifier La consommation du <?= $contrat['nom'] . " " . $contrat['prenom'] . "<br>( " . $contrat['adresse_local'] . " )" ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="?page=editConsommation" method="post">
                                                <!-- <input type="hidden" name="contrat_id" id="" value="<?= $contrat['contrat_id'] ?>">
                                                <input type="hidden" name="year" id="" value="<?= $yearSelected ?>">
                                                <input type="hidden" name="mounth" id="" value="<?= $mounthSelected ?>"> -->
                                                <input type="hidden" name="index1" value="<?= $contrat['consommation_index1'] ?>">
                                                <input type="hidden" name="consommation_id" value="<?= $contrat['consommation_id'] ?>">

                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="form5Example1">Index 2 </label>
                                                    <input type="number" id="form5Example1" class="form-control" name="index2" min="<?= $contrat['consommation_index1'] ?>" value="<?= $contrat['consommation_index2'] ?>" id="" required />
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block mb-4">Modifier</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

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
