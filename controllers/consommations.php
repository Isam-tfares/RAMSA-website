<?php
require_once('./models/consommations.php');
require_once('./models/factures.php');

function getConsommationsOfLM()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }

    $currentMonth = date('n');
    $currentYear = date('Y');
    if ($currentMonth == 1) {
        $lastMonthNumber = 11;
        $lastMonthYear = $currentYear - 1;
    } elseif ($currentMonth == 2) {
        $lastMonthNumber = 12;
        $lastMonthYear = $currentYear - 1;
    } else {
        $lastMonthNumber = $currentMonth - 2;
        $lastMonthYear = $currentYear;
    }

    $consommations = getConsommationsOfLastMonth($lastMonthNumber, $lastMonthYear);
    return $consommations;
}
function getYears()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    return Years();
}
function getMounths()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    return Mounths();
}
function getHistoriqueConsommations($year, $mounth)
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (!empty($year) && !empty($mounth)) {
        return getHistoriqueConsommationsDB($year, $mounth);
    } else {
        RedirectwithPost("index.php?page=consommations", 0, "invalid data");
    }
}
function addConsommation() // Add facture
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    $contrat_id = $_POST['contrat_id'];
    $index2 = $_POST['index2'];
    $index1 = getLastIndex($contrat_id);

    $currentMonth = date('n');
    $currentYear = date('Y');
    if ($currentMonth == 1) {
        $mounth = 12;
        $year = $currentYear - 1;
    } else {
        $mounth = $currentMonth - 1;
        $year = $currentYear;
    }
    if (!ConsommationOfMounthAndYearOfContrat($mounth, $year, $contrat_id)) {
        if ($index2 > $index1) {
            $res = addConsommationDB($contrat_id, $index2, $index1, $mounth, $year);
            // add facture
            if ($res) {
                $montant = ($index2 - $index1) * 10; // Montant
                $consommation_id = $res;
                $result = insertFacture($montant, $consommation_id, $contrat_id);
            }
            RedirectwithPost("index.php?page=consommations", $res && $result);
            echo $res;
        }
    } else {
        Redirect("index.php?page=consommations");
    }
}
function editConsommation() // Update facture
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (!isset($_POST['consommation_id']) || empty($_POST['consommation_id']) || !isset($_POST['index2']) || empty($_POST['index2'])) {
        RedirectwithPost("?page=consommations", 0);
    }
    $res = updateConsommation($_POST['consommation_id'], $_POST['index2']);
    $montant = ($_POST['index2'] - $_POST['index1']) * 10;
    $result = updateFactureMontant($_POST['consommation_id'], $montant);
    RedirectwithPost("index.php?page=consommations", $res);
}
function getConsommationsOfCM()
{
    $currentMonth = date('n');
    $currentYear = date('Y');
    if ($currentMonth == 1) {
        $lastMonthNumber = 12;
        $lastMonthYear = $currentYear - 1;
    } else {
        $lastMonthNumber = $currentMonth - 1;
        $lastMonthYear = $currentYear;
    }
    return getConsommationsOfCMDB($lastMonthNumber, $lastMonthYear);
}
