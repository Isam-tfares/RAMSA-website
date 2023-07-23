<?php

function download($contrat)
{
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
                Nom : ' . $contrat['nom'] . '
            </div>
            <div style="padding-bottom: 5px;">
                Prenom : ' . $contrat['prenom'] . '
            </div>
            <div style="padding-bottom: 5px;">
                Date de début : ' . $contrat['date_de_debut'] . '
            </div>
            <div style="padding-bottom: 5px;">
                Date de fin : ' . $contrat['date_de_fin'] . '
            </div>
            <div style="padding-bottom: 5px;">
                Adresse : ' . $contrat['adresse_local'] . '
            </div>
            <div style="padding-bottom: 5px;">
                Localité : ' . $contrat['localite_name'] . '
            </div>
        </div>

    </main>
    <footer style="background-color: #5caddc;padding:5px;position:absolute;bottom:0">
        <div style="text-align: center;color: #000f6c;">
            <p style="font-weight:bold;font-size: 18px;margin:0">REGIE AUTONOME MULTI-SERVICES D\'AGADIR</p>
            <p style="margin:0">Rue 18 Novembre Quartier Industriel AGADIR </p>
            <p style="margin:0">Tel : 0528233030 (L.G) : 0528272727 Fax : 0528272727 </p>
            <div style="display: flex;align-items:center;justify-content: space-evenly;">
                <div>
                <p style="margin:0"> Email:regie.ramsa@gmail.com </p>

                </div>
                <div style="display: flex;align-items:center">
                <p style="margin:0"> https://www.facebook.com/ramsamultiservices/ </p>

                </div>
                <div style="display: flex;align-items:center">
                <p style="margin:0">https://twitter.com/ramsa-agadir </p>

                </div>
                <div>
                <p style="margin:0">Site web : http://www.ramsa.ma</p>

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
    $pdf->Output('table.pdf', 'I');
}

function download2($contrat)
{
    $html = '
    <div class="bd">
    <div>
        <div class="header">
            <img src="./assets/imgs/ramsa-logo.png" class="imgHeader">
        </div>
    </div>
    <div class="main">
        <div class="date">
            Agadir, le 07/07/2023
        </div>
        <div class="data">
            <div class="dataD">
                Nom :  ' . $contrat['nom'] . '
            </div>
            <div class="dataD">
                Prenom :  ' . $contrat['prenom'] . '
            </div>
            <div class="dataD">
                Date de début :  ' . $contrat['date_de_debut'] . '
            </div>
            <div class="dataD">
                Date de fin :   ' . $contrat['date_de_fin'] . '
            </div>
            <div class="dataD">
                Adresse :   ' . $contrat['adresse_local'] . '
            </div>
            <div class="dataD">
                Localité :   ' . $contrat['localite_name'] . '
            </div>
        </div>

    </div>
    <div class="footer">
        <div class="footerC">
            <p class="Fp">REGIE AUTONOME MULTI-SERVICES D\'AGADIR</p>
            <p  class="para">Rue 18 Novembre Quartier Industriel AGADIR </p>
            <p  class="para">Tel : 0528233030 (L.G) : 0528272727 Fax : 0528272727 </p>
            <div class="rs">
                <div>
                    <span class="facebook"> <img src="./assets//imgs/facebook.png"  alt=""> </span> https://www.facebook.com/ramsamultiservices/   Email:regie.ramsa@gmail.com 
                </div>
                <div>
                <img src="./assets//imgs/twitter.png"  alt=""> https://twitter.com/ramsa-agadir  Site web : http://www.ramsa.ma
                </div>
            </div>

        </div>

    </div>
    </div>

<style>' . file_get_contents('./css/pdf.css') . '</style>';

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



    $pdfContent = $pdf->Output('table.pdf', 'S');

    $destinationFolder = './assets/Contrats/';

    $fileName = 'contrat_' . $contrat['contrat_id'] . $contrat['nom'] . '_' . $contrat['prenom'] . '.pdf';

    $filePath = $destinationFolder . $fileName;
    file_put_contents($filePath, $pdfContent);
    return $fileName;

    // Output the PDF as a download (optional)
    // header('Content-Type: application/pdf');
    // header('Content-Disposition: attachment; filename="' . $fileName . '"');
    // echo $pdfContent;
}
function downloadHistoriqueConsommation($consommations)
{

    $html = '<style>' . file_get_contents('./css/table_style.css') . '</style>';
    $html .= '<div>
    <div class="header">
        <img src="./assets/imgs/ramsa-logo.png" class="imgHeader">
    </div>
</div>';
    $html .= '<h3>Client : ' . $consommations[0]['nom'] . ' ' . $consommations[0]['prenom'] . '</h3>';
    $html .= '<h3>Numéro du contrat : ' . $consommations[0]['contrat_id'] . '</h3>';
    $html .= '<h3>Adresse locale : ' . $consommations[0]['adresse_local'] . ' ' . $consommations[0]['localite_name'] . '</h3>';
    $html .= '<h1 style="margin-bottom:20px">Historique des consommations</h1>';
    $html .= '<div style="height:50px"></div>';
    $html .= '<table cellpadding:"15">';
    $html .= '<tr>';
    $html .= '<th>Consommation ID</th>';
    $html .= '<th>Mois</th>';
    $html .= '<th>Année</th>';
    $html .= '<th>Index1</th>';
    $html .= '<th>Index2</th>';
    $html .= '<th>Consommation</th>';
    $html .= '</tr>';

    foreach ($consommations as $consommation) {
        $html .= '<tr>';
        $html .= '<td>' . $consommation['consommation_id'] . '</td>';
        $html .= '<td>' . $consommation['consommation_mois'] . '</td>';
        $html .= '<td>' . $consommation['consommation_annee'] . '</td>';
        $html .= '<td>' . $consommation['consommation_index1'] . '</td>';
        $html .= '<td>' . $consommation['consommation_index2'] . '</td>';
        $html .= '<td>' . ($consommation['consommation_index2'] - $consommation['consommation_index1']) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';


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
    $pdfContent = $pdf->Output('consommation_history.pdf', 'S');

    $destinationFolder = './assets/Demandes/';

    $fileName = 'consommation_history_' . $consommations[0]['nom'] . '_' . $consommations[0]['prenom'] . '_' . $consommations[0]['consommation_id'] . '.pdf';

    $filePath = $destinationFolder . $fileName;
    file_put_contents($filePath, $pdfContent);
    return $fileName;
}

function downloadHistoriqueEncaissements($encaissements)
{

    $html = '<style>' . file_get_contents('./css/table_style.css') . '</style>';
    $html .= '<div>
    <div class="header">
        <img src="./assets/imgs/ramsa-logo.png" class="imgHeader">
    </div>
</div>';
    $html .= '<h3>Client : ' . $encaissements[0]['nom'] . ' ' . $encaissements[0]['prenom'] . '</h3>';
    $html .= '<h3>Numéro du contrat : ' . $encaissements[0]['contrat_id'] . '</h3>';
    $html .= '<h3>Adresse locale : ' . $encaissements[0]['adresse_local'] . ' ' . $encaissements[0]['localite_name'] . '</h3>';
    $html .= '<h1 style="margin-bottom:20px">Historique des encaissements</h1>';
    $html .= '<div style="height:50px"></div>';
    $html .= '<table cellpadding:"15">';
    $html .= '<tr>';
    $html .= '<th>Encaissement ID</th>';
    $html .= '<th>Mois</th>';
    $html .= '<th>Année</th>';
    $html .= '<th>Date de payement</th>';
    $html .= '<th>N Facture</th>';
    $html .= '<th>Montant</th>';
    $html .= '<th>Mode de payement</th>';
    $html .= '</tr>';

    foreach ($encaissements as $encaissement) {
        $html .= '<tr>';
        $html .= '<td>' . $encaissement['encaissement_id'] . '</td>';
        $html .= '<td>' . $encaissement['consommation_mois'] . '</td>';
        $html .= '<td>' . $encaissement['consommation_annee'] . '</td>';
        $html .= '<td>' . $encaissement['encaissement_date'] . '</td>';
        $html .= '<td>' . $encaissement['facture_id'] . '</td>';
        $html .= '<td>' . ($encaissement['montant']) . '</td>';
        $html .= '<td>' . ($encaissement['mode_payement']) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';


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
    $pdfContent = $pdf->Output('encaissement_history.pdf', 'S');
    $destinationFolder = './assets/Demandes/';
    $fileName = 'encaissements_history_' . $encaissements[0]['nom'] . '_' . $encaissements[0]['prenom'] . '_' . $encaissements[0]['encaissement_id'] . '.pdf';
    $filePath = $destinationFolder . $fileName;
    file_put_contents($filePath, $pdfContent);
    return $fileName;
}
