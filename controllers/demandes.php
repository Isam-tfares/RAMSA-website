<?php
require('models/demandes.php');

function getAllDemandes()
{
    $demandes = getDemandes();
    return $demandes;
}
function addDemande()
{
    if (!isset($_POST['type']) || !in_array($_POST['type'], getDemandesIds())) {
        RedirectwithPost("index.php#Demandes", 0, "demande", "Il y a un erreur Merci de Réssayer");
    }
    $type = $_POST['type'];
    if (getDemandeByTypeandClient($type)) {
        RedirectwithPost("index.php#Demandes", 0, "demande", "Vous avez déja demander ce service");
    }
    $res = addDemandeToDb($type);
    if ($res) {
        RedirectwithPost("index.php#Demandes", 1, "demande", "Votre demande est envoyée avec succes");
    } else {
        RedirectwithPost("index.php#Demandes", 0, "demande", "Il y a un erreur Merci de Réssayer");
    }
}
function traiterDemande()    // add file path
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['demande_id']) && !empty($_POST['demande_id']) && isset($_FILES['file'])) {
        $files = $_FILES;
        $res = updateDemande($_POST['demande_id'], $files);
        RedirectwithPost("?page=demandes", $res, "La demande a été traitée avec succés");
    } else {
        Redirect("?page=demandes");
    }
}



function deleteDemande()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['demande_id']) && !empty($_POST['demande_id'])) {
        $res = deleteDemandeDB($_POST['demande_id']);
        RedirectwithPost("?page=demandes", $res, "La demande a été supprimé avec succés");
    } else {
        Redirect("?page=demandes");
    }
}
