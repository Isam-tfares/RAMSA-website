<?php
require('models/messages.php');
function getAllMessages()
{
    $messages = getMessages();
    return $messages;
}
function getLastMessagesC()
{
    return getLastMessages();
}
function addMessage()
{
    if (!isset($_POST['message'])) {
        RedirectwithPost("index.php#Réclamations", 0, "message", "Il y a un erreur Merci de Réssayer");
    }
    $message = $_POST['message'];
    $res = insertMessage($message);
    if ($res) {
        $content = $_SESSION['client']['nom'] . " " . $_SESSION['client']['prenom'] . " a ajouté une réclamation ";
        insertActivityClient($content, $_SESSION['client']['client_id']);
        RedirectwithPost("index.php#Réclamations", 1, "message", "Votre réclamation est envoyée avec succes");
    } else {
        RedirectwithPost("index.php#Réclamations", 0, "message", "Il y a un erreur Merci de Réssayer");
    }
}

function traiterMessage()    // add file path
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }

    if (isset($_POST['message_id']) && !empty($_POST['message_id'])) {
        $res = updateMessage($_POST['message_id']);
        $content = $_SESSION['admin']['email']  . " a lis la réclamation " . $_POST['message_id'];
        insertActivityAdmin($content, $_SESSION['admin']['id']);
    }
    Redirect("?page=demandes#messages");
}
function deleteMessage()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }

    if (isset($_POST['message_id']) && !empty($_POST['message_id'])) {
        $res = deleteMessageDB($_POST['message_id']);
    }
    Redirect("?page=demandes#messages");
}
function getMessagesNonLues()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    return MessagesNonLues();
}
