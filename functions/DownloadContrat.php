<?php
require_once('../TCPDF/tcpdf.php');
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
    $pdf->Output('table.pdf', 'I');
}
