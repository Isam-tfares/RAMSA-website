<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
    }
}
?>

<header class="header">

    <section class="flex1">

        <a href="home.php" class="logo d-flex align-items-center justify-content-center">
            <img src="assets/imgs/ramsa-logo.png" width="50px" height="50px" alt="">
            <span>RAMSA</span>
        </a>

        <nav class="navbar1">
            <a href="#home">Accueil</a>
            <a href="#Demandes">Demandes</a>
            <a href="#Contrats">Contrats</a>
        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="profile">
            <p><?= $_SESSION['client']['nom'] . " " . $_SESSION['client']['prenom'] ?></p>
            <!-- <a href="update_user.php" class="option-btn text-decoration-none">Modifier Profile</a> -->
            <form action="index.php" method="post">
                <input type="submit" class="delete-btn" value="Se Déconnecter" name="logout" onclick="return confirm('logout from the website?');">
            </form>

        </div>

    </section>

</header>