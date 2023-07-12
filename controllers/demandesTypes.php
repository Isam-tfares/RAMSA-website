<?php
function addDemandeType()
{
    $name = $_POST['demande_name'];
    if (getDemandeByName($name) == false) {
        $res = insertDemandeType($_POST['demande_name']);
        // Redirect('index.php?page=demandesTypes');
        RedirectwithPost("index.php?page=demandesTypes", $res);
    } else {
        echo "Name already exist";
        RedirectwithPost("index.php?page=demandesTypes", 0);
    }
}
function deleteDemandeType()
{
    $res = deleteDemandeTypeFromDB($_POST['demande_type_id']);
    RedirectwithPost("index.php?page=demandesTypes", $res, "del");
}
