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
    } else {
        $demande_type = get($type);
        if ($demande_type['contrat_id']) {
            if (!isset($_POST['contrat_id']) || !isHisContrat($_POST['contrat_id'])) {
                Redirect("index.php#Demandes");
            }
            $res = addDemandeResiliationToDb($type, $_POST['contrat_id']);
        } elseif ($demande_type['historique_date']) {
            if (!isset($_POST['historique_date']) || empty($_POST['historique_date'])) {
                Redirect("index.php#Demandes");
            }
            $res = addDemandeHistoriqueEncaissementToDb($type, $_POST['historique_date']);
        } elseif ($demande_type['historique_date_debut']) {
            if (!isset($_POST['historique_date_debut']) || empty($_POST['historique_date_debut']) || !isset($_POST['historique_date_fin']) || empty($_POST['historique_date_fin'])) {
                Redirect("index.php#Demandes");
            }
            $res = addDemandeHistoriqueReleveToDb($type, $_POST['historique_date_debut'], $_POST['historique_date_fin']);
        } else {
            $res = addDemandeToDb($type);
        }
        if ($res) {
            RedirectwithPost("index.php#Demandes", 1, "demande", "Votre demande est envoyée avec succes");
        } else {
            RedirectwithPost("index.php#Demandes", 0, "demande", "Il y a un erreur Merci de Réssayer");
        }
    }
}
function traiterDemande()
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
