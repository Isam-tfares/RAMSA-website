<?php
require_once('./models/factures.php');
require_once('./models/encaissements.php');

function getAllFactures($year, $mounth)
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    return getAllFacturesDB($year, $mounth);
}
function editFacture()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['facture_id']) && isset($_POST['etat'])) {
        $res = updateFacture($_POST['facture_id'], $_POST['etat']);
        RedirectwithPost("index.php?page=factures", $res);
    } else {
        Redirect("index.php?page=factures");
    }
}
function payFacture()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['facture_id']) && isset($_POST['mode_payement']) && isset($_POST['Ncheque,transaction'])) {
        $facture = getFacture($_POST['facture_id']);
        if ($facture['etat'] == 0) {
            $res = updateFacture($_POST['facture_id'], 1);
            $result = insertEncaissement($_POST['facture_id'], $_POST['mode_payement'], $_POST['Ncheque,transaction'], $facture['contrat_id']);
            RedirectwithPost("index.php?page=factures", $res && $result);
        } else {
            Redirect("index.php?page=factures");
        }
    } else {
        Redirect("index.php?page=factures");
    }
}
function impayFacture()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['facture_id'])) {
        $facture = getFacture($_POST['facture_id']);
        if ($facture['etat'] == 1) {
            $res = updateFacture($_POST['facture_id'], 0);
            $result = deleteEncaissementByFactureDB($_POST['facture_id']);
            RedirectwithPost("index.php?page=factures", $res && $result);
        } else {
            Redirect("index.php?page=factures");
        }
    } else {
        Redirect("index.php?page=factures");
    }
}

function deleteFacture()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['facture_id'])) {
        $res = deleteFactureDB($_POST['facture_id']);
        RedirectwithPost("index.php?page=factures", $res);
    } else {
        Redirect("index.php?page=factures");
    }
}
