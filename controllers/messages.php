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
        RedirectwithPost("index.php#Demandes", 0, "message", "Il y a un erreur Merci de Réssayer");
    }
    $message = $_POST['message'];
    $res = insertMessage($message);
    if ($res) {
        RedirectwithPost("index.php#Demandes", 1, "message", "Votre message est envoyée avec succes");
    } else {
        RedirectwithPost("index.php#Demandes", 0, "message", "Il y a un erreur Merci de Réssayer");
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
