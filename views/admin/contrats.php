<?php
require_once('TCPDF/tcpdf.php');
$contrats = getContratsC();
$localites = getLocalities();
$clients = clients();

if (isset($_POST['D'])) {
    $html = '<header>
    <div style="display:flex;justify-content:center">
        
    </div>
</header>
<main style="padding: 20px;">
    <div style="display: flex;flex-direction: row-reverse;font-weight: bolder;color: #000f6c;">
        Agadir, le 07/07/2023
    </div>
    <div style="font-size">
        <div style="padding-bottom: 5px;">
            Nom : ' . $contrats[$_POST['D']]['nom'] . '
        </div>
        <div style="padding-bottom: 5px;">
            Prenom : ' . $contrats[$_POST['D']]['prenom'] . '
        </div>
        <div style="padding-bottom: 5px;">
            Date de début : ' . $contrats[$_POST['D']]['date_de_debut'] . '
        </div>
        <div style="padding-bottom: 5px;">
            Date de fin : ' . $contrats[$_POST['D']]['date_de_fin'] . '
        </div>
        <div style="padding-bottom: 5px;">
            Adresse : ' . $contrats[$_POST['D']]['adresse_local'] . '
        </div>
        <div style="padding-bottom: 5px;">
            Localité : ' . $contrats[$_POST['D']]['localite_name'] . '
        </div>
    </div>

</main>
<footer style="background-color: #5caddc;padding:5px">
    <div style="text-align: center;color: #000f6c;">
        <p style="font-weight:bold;font-size: 18px;margin:0">REGIE AUTONOME MULTI-SERVICES D\'AGADIR</p>
        <p style="margin:0">Rue 18 Novembre Quartier Industriel AGADIR </p>
        <p style="margin:0">Tel : 0528233030 (L.G) : 0528272727 Fax : 0528272727 </p>
        <div style="display: flex;align-items:center;font-size: 14px;justify-content: space-evenly;">
            <div>
                Email:regie.ramsa@gmail.com
            </div>
            <div style="display: flex;align-items:center">
                 https://www.facebook.com/ramsamultiservices/
            </div>
            <div style="display: flex;align-items:center">
 https://twitter.com/ramsa-agadir
            </div>
            <div>
                Site web : http://www.ramsa.ma
            </div>
        </div>

    </div>

</footer>';

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    $pdf->SetFont('helvetica', '', 9);
    $pdf->AddPage();
    $pdf->writeHTML($html, true, 0, true, 0);
    $pdf->lastPage();

    // Output the PDF as a download
    $pdf->Output('table.pdf', 'D');
}

$title = "Contrats" ?>
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
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un contrat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="?page=addContrat" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Client</label>
                                    <select name="client_id" id="" class="form-control" required>
                                        <?php foreach ($clients as $client) { ?>
                                            <option value="<?= $client['client_id'] ?>"><?= $client['nom'] . " " . $client['prenom'] ?></option>
                                        <?php } ?>
                                    </select>

                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Date de début</label>
                                    <input type="date" id="form5Example1" class="form-control" name="dateBegin" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Date de fin</label>
                                    <input type="date" id="form5Example1" class="form-control" name="dateEnd" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Adresse local</label>
                                    <input type="text" id="form5Example1" class="form-control" name="adresse" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Localité</label>
                                    <select name="localite" class="form-select" id="">
                                        <?php foreach ($localites as $localite) { ?>
                                            <option value="<?= $localite['localite_id'] ?>"><?= $localite['localite_name'] ?></option>
                                        <?php } ?>
                                    </select>

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
        <table class="border-top">
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">N de contrat</td>
                    <td>Etat</td>
                    <td class="text-center">Action</td>
                </tr>

            </thead>

            <tbody id="">
                <?php foreach ($contrats as $key => $client) { ?>
                    <tr>
                        <td> <?= $client['nom'] . " " . $client['prenom'] ?></td>
                        <td class="text-start"><?= $client['numero'] ?></td>
                        <?php if ($client['etat'] == '1') { ?>
                            <td class=" py-1 m-1 px-2 ">En cours</td>
                        <?php } else { ?>
                            <td class=" py-1 m-1 px-2 ">Terminé</td>

                        <?php } ?>
                        <td>
                            <div class="d-flex justify-content-evenly py-2 align-items-center">
                                <button type="button" class="btn btn-warning text-white border-none" data-bs-toggle="modal" data-bs-target="#modifierClient<?= $client['contrat_id'] ?>">Modifier</button>
                                <form action="index.php?page=contrats" method="post">
                                    <input type="hidden" name="D" id="" value="<?= $key ?>">

                                    <button type="submit" class="status btn delivered border-none mx-2">Télécharger</button>
                                </form>

                            </div>
                        </td>
                        <!-- modal for edit student datas -->
                        <div class="modal fade" id="modifierClient<?= $client['contrat_id']  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier les données d'une contrat
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="?page=editContrat" method="post">
                                            <input type="hidden" name="contrat_id" value="<?= $client['contrat_id'] ?>">
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Client</label>
                                                <select name="client_id" id="" class="form-control" required>
                                                    <?php foreach ($clients as $clientt) { ?>
                                                        <option value="<?= $client['client_id'] ?>" <?php echo ($clientt['client_id'] == $client['client_id']) ? "selected" : "" ?>><?= $client['nom'] . " " . $client['prenom'] ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Date de début</label>
                                                <input type="date" id="form5Example1" class="form-control" name="dateBegin" id="" value="<?= $client['date_de_debut'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Date de fin</label>
                                                <input type="date" id="form5Example1" class="form-control" value="<?= $client['date_de_fin'] ?>" name="dateEnd" id="" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Adresse local</label>
                                                <input type="text" id="form5Example1" class="form-control" name="adresse" value="<?= $client['adresse_local'] ?>" id="" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Localité</label>
                                                <select name="localite" class="form-select" id="">
                                                    <?php foreach ($localites as $localite) { ?>
                                                        <option value="<?= $localite['localite_id'] ?>" <?php echo ($localite['localite_id'] == $client['localite_id']) ? "selected" : "" ?>><?= $localite['localite_name'] ?></option>
                                                    <?php } ?>
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

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
