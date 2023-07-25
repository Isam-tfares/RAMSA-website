<?php
require("models/user.php");
function Login()
{
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if (!empty($_POST['email'])) {
            if (!empty($_POST["password"])) {
                $res = Connect($_POST['email']);
                if ($res) {
                    if (sha1($_POST['password']) == $res['password']) {
                        if (isset($res['nom'])) {
                            $_SESSION['client'] = $res;
                            Redirect("index.php");
                        } else {
                            $_SESSION['admin'] = $res;
                            Redirect("index.php");
                        }
                    } else {
                        RedirectwithPost('', $_POST['email'] . "-" . $_POST['password'], "Le mot de passe fourni est incorrect. Veuillez vérifier votre mot de passe et réessayer.");
                    }
                } else {
                    RedirectwithPost('', $_POST['email'] . "-" . $_POST['password'], "L'adresse e-mail fournie n'existe pas. Veuillez vérifier votre e-mail et réessayer.");
                }
            } else {
                RedirectwithPost('', $_POST['email'] . "-" . $_POST['password'], "Le mot de passe fourni est incorrect. Veuillez vérifier votre mot de passe et réessayer.");
            }
        } else {
            RedirectwithPost('', $_POST['email'] . "-" . $_POST['password'], "L'adresse e-mail fournie n'existe pas. Veuillez vérifier votre e-mail et réessayer.");
        }
    } else {
        include("views/login.php");
    }
}
function changePassword()
{
    if (!isset($_SESSION['admin'])) {
        Redirect("index.php");
    }
    if (isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $current_password = getPassword();
        if ($current_password == sha1($_POST['old_password'])) {
            $res = updatePassword(sha1($_POST['password']));
            $content = $_SESSION['admin']['email'] . " a changé son mot de passe ";
            insertActivityAdmin($content, $_SESSION['admin']['id']);
            RedirectwithPost("index.php", $res, "Mot de passe a été mis a jour avec success");
        } else {
            RedirectwithPost("index.php", 0, "Mot de passe incorrecte");
        }
    } else {
        Redirect("index.php");
    }
}
function addAdmin()
{
    if (!isset($_SESSION['admin'])) {
        Redirect("index.php");
    }
    if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && !EmailIsExisted($_POST['email'])) {
        $res = addAdminToDb($_POST['email'], sha1($_POST['password']));
        $content = $_SESSION['admin']['email'] . " a ajouté un admin " . $_POST['email'];
        insertActivityAdmin($content, $_SESSION['admin']['id']);
        RedirectwithPost("index.php", $res, "Nouveau admin est ajoutée avec success");
    } else {
        Redirect("index.php");
    }
}
