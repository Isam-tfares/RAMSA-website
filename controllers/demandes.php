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
        $Dtype = get($type);
        $content = $_SESSION['client']['nom'] . " " . $_SESSION['client']['prenom'] . " a demandé " . $Dtype['demande_name'];
        insertActivityClient($content, $_SESSION['client']['client_id']);
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
                        $client = getClient($data['client_id']);
                        $Dtype = get($demande['demande_type_id']);
                        $content = $_SESSION['admin']['email'] . " a traité la demande " . $Dtype['demande_name'] . " du client " . $client['nom'] . " " . $client['prenom'];
                        insertActivityAdmin($content, $_SESSION['admin']['id']);
                        RedirectwithPost("?page=demandes", $result, "La demande d'abonnement est traitée avec succées et une contrat a été crée");
                    }
                }
                break;
            case 2:
                $res = Resiliation($demande['contrat_id']);
                if ($res) {
                    $result = updateOtherDemandes($demande['demande_id']);
                    $client = getClient($demande['client_id']);
                    $Dtype = get($demande['demande_type_id']);
                    $content = $_SESSION['admin']['email'] . " a traité la demande " . $Dtype['demande_name'] . " du client " . $client['nom'] . " " . $client['prenom'];
                    insertActivityAdmin($content, $_SESSION['admin']['id']);
                    RedirectwithPost("?page=demandes", $result, "La demande de resiliation est traitée avec succées ");
                }
                break;
            case 3:
                $fileName = downloadHistoriqueEncaissements(getHistoryEncaissemnts($demande['contrat_id']));
                $res = updateDemandeContratAndHistory($demande['demande_id'], $fileName);
                $client = getClient($demande['client_id']);
                $Dtype = get($demande['demande_type_id']);
                $content = $_SESSION['admin']['email'] . " a traité la demande " . $Dtype['demande_name'] . " du client " . $client['nom'] . " " . $client['prenom'];
                insertActivityAdmin($content, $_SESSION['admin']['id']);
                RedirectwithPost("?page=demandes", $res, "La demande d'hsitorique des encaissements est traitée avec succées ");
                break;
            case 4:
                $consommations = getHistoriqueConsommationsOfClient($demande['contrat_id']);
                $fileName = downloadHistoriqueConsommation($consommations);
                $res = updateDemandeContratAndHistory($demande['demande_id'], $fileName);
                $client = getClient($demande['client_id']);
                $Dtype = get($demande['demande_type_id']);
                $content = $_SESSION['admin']['email'] . " a traité la demande " . $Dtype['demande_name'] . " du client " . $client['nom'] . " " . $client['prenom'];
                insertActivityAdmin($content, $_SESSION['admin']['id']);
                RedirectwithPost("?page=demandes", $res, "La demande d'hsitorique des consommations est traitée avec succées ");
                break;
            case 5:
                $contrat = getContrat($demande['contrat_id']);
                $fileName = download2($contrat);
                $res = updateDemandeContratAndHistory($demande['demande_id'], $fileName);
                $client = getClient($demande['client_id']);
                $Dtype = get($demande['demande_type_id']);
                $content = $_SESSION['admin']['email'] . " a traité la demande " . $Dtype['demande_name'] . " du client " . $client['nom'] . " " . $client['prenom'];
                insertActivityAdmin($content, $_SESSION['admin']['id']);
                RedirectwithPost("?page=demandes", $res, "La demande de contrat est traitée avec succées ");
                break;
            default:
                Redirect("?page=demandes");
                break;
        }
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
