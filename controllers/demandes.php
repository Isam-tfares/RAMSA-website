<?php

require('models/demandes.php');

function getAllDemandes($type = null)
{
    if (isset($_SESSION['admin'])) {
        if ($type == null) {
            return getDemandes();
        } elseif ($type == 1) {
            $demandes = demandesAbonnements();
            foreach ($demandes as $key => $d) {
                $demandes[$key]['demande_name'] = "Demande d'abonnement";
            }
            return $demandes;
        } else {
            return demandes($type);
        }
    } else {
        $demandes = getDemandes($type);
        return $demandes;
    }
}
function addDemande()
{
    if (!isset($_POST['type']) || !in_array($_POST['type'], getDemandesIds())) {
        RedirectwithPost("index.php#Demandes", 0, "demande", "Il y a un erreur Merci de Réssayer");
    }
    $type = $_POST['type'];
    if ($type == 1) { //Demande d'abonnement
        if (isset($_POST['adresse']) && !empty($_POST['adresse'])) {

            if (DemandeisAlreadyExisted($type, $_SESSION['client']['client_id'])) {
                RedirectwithPost("index.php#Demandes", 0, "demande", "Vous avez déja demander ce service");
            } else {
                $res = insertDemandeAbonnement($_SESSION['client']['client_id'], $_POST['adresse'], $_POST['localite_id']);
            }
        } else {
            Redirect("index.php");
        }
    } else {  // Other demandes
        if (isset($_POST['contrat_id']) && !empty($_POST['contrat_id']) && isHisContrat($_POST['contrat_id'])) {
            if (DemandeisAlreadyExisted($type, $_SESSION['client']['client_id'], $_POST['contrat_id'])) {
                RedirectwithPost("index.php#Demandes", 0, "demande", "Vous avez déja demander ce service");
            } else {
                $res = addDemandeToDb($type, $_SESSION['client']['client_id'], $_POST['contrat_id']);
            }
        } else {
            Redirect("index.php");
        }
    }
    if ($res) {
        RedirectwithPost("index.php#Demandes", 1, "demande", "Votre demande est envoyée avec succes");
    } else {
        RedirectwithPost("index.php#Demandes", 0, "demande", "Il y a un erreur Merci de Réssayer");
    }
}
function traiterDemande()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['abonnement'])) {
        $demande = getDemande($_POST['demande_id'], 1);
    } else {
        $demande = getDemande($_POST['demande_id']);
    }

    if ($demande['etat'] == 1) {
        Redirect("?page=demandes");
    } else {
        switch ($demande['demande_type_id']) {
            case 1:
                if (isExistedAdresse($demande['adresse_local'])) {
                    RedirectwithPost("?page=demandes", 0, "L'adresse correspond au demande est déja exist");
                } else {
                    $data = [
                        'client_id' => $demande['client_id'],
                        'dateBegin' => Date("Y-m-d"),
                        'dateEnd' => NULL,
                        'adresse' => $demande['adresse_local'],
                        'localite' => $demande['localite_id']
                    ];
                    $res = insertContart($data, getNLastContrat($demande['client_id']) + 1);
                    if ($res) {
                        $result = updateDemandeAbonnement($demande['demande_id']);
                        RedirectwithPost("?page=demandes", $result, "La demande d'abonnement est traitée avec succées et un contrat a été crée");
                    }
                }
                break;
            case 2:
                $res = Resiliation($demande['contrat_id']);
                if ($res) {
                    $result = updateOtherDemandes($demande['demande_id']);

                    RedirectwithPost("?page=demandes", $result, "La demande de resiliation est traitée avec succées ");
                }
                break;
            case 3:
                // echo "Historique de L'encaissement";
                // create file for Historique de L'encaissement  and make etat=1 
                // get Historique of $demande['contrat_id']
                // echo "<pre>";
                // print_r(getHistoryEncaissemnts($demande['contrat_id']));
                // echo "</pre>";

                $fileName = downloadHistoriqueEncaissements(getHistoryEncaissemnts($demande['contrat_id']));
                $res = updateDemandeContratAndHistory($demande['demande_id'], $fileName);
                RedirectwithPost("?page=demandes", $res, "La demande d'hsitorique des encaissements est traitée avec succées ");


                break;
            case 4:
                // echo "Historique de Consommation";
                // file Historique de Consommation  and make etat=1 for $demande['demande_id']
                // get Historique of $demande['contrat_id']

                $consommations = getHistoriqueConsommationsOfClient($demande['contrat_id']);
                $fileName = downloadHistoriqueConsommation($consommations);
                $res = updateDemandeContratAndHistory($demande['demande_id'], $fileName);
                RedirectwithPost("?page=demandes", $res, "La demande d'hsitorique des consommations est traitée avec succées ");
                break;
            case 5:
                // demande de contrat
                $contrat = getContrat($demande['contrat_id']);

                $fileName = download2($contrat);
                $res = updateDemandeContratAndHistory($demande['demande_id'], $fileName);
                RedirectwithPost("?page=demandes", $res, "La demande de contrat est traitée avec succées ");

                break;
            default:
                Redirect("?page=demandes");
                break;
        }
    }
    // Redirect("?page=demandes");

    // if (isset($_POST['demande_id']) && !empty($_POST['demande_id']) && isset($_FILES['file'])) {
    //     $files = $_FILES;
    //     $res = updateDemande($_POST['demande_id'], $files);
    //     RedirectwithPost("?page=demandes", $res, "La demande a été traitée avec succés");
    // } else {
    //     Redirect("?page=demandes");
    // }
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
