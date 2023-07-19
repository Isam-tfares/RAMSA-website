<?php
require_once('./models/factures.php');

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
