<div class="navigation-admin">
    <ul>
        <li>
            <a href="#">
                <span class="icon">
                    <i class="bi bi-person-fill"></i>
                </span>
                <span class="title"><?= $_SESSION['admin']['email'] ?></span>
            </a>
        </li>

        <li>
            <a href="index.php">
                <span class="icon">
                    <i class="bi bi-house-door"></i>
                </span>
                <span class="title">Acceuil</span>
            </a>
        </li>

        <li>
            <a href="?page=clients">
                <span class="icon">
                    <i class="bi bi-people"></i>
                </span>
                <span class="title">Clients</span>
            </a>
        </li>


        <li>
            <a href="?page=demandes">
                <span class="icon">
                    <i class="bi bi-building"></i>
                </span>
                <span class="title">Demandes</span>
            </a>
        </li>

        <li>
            <a href="?page=demandesTypes">
                <span class="icon">
                    <i class="bi bi-building"></i>
                </span>
                <span class="title">Types des demandes</span>
            </a>
        </li>

        <li>
            <a href="?page=contrats">
                <span class="icon">
                    <i class="bi bi-easel2"></i>
                </span>
                <span class="title">Contrats</span>
            </a>
        </li>

        <li>
            <a type="button" class="text-white pass" data-bs-toggle="modal" data-bs-target="#password">
                <span class="icon">
                    <i class="bi bi-lock"></i>
                </span>
                <span class="title">Mot de Passe</span>
            </a>
        </li>


        <li>
            <form class="deconn" method="post">
                <span class="icon ">
                    <i class="bi bi-box-arrow-right "></i>
                </span>
                <span class="title w-100">
                    <button type="submit" name="logout" class="border-0 m-0 text-white w-100 " style="background-color:inherit;text-align:left" title="deconexion">Deconnexion</button>
                </span>
            </form>
        </li>
    </ul>
</div>
<style>
    .pass:hover {
        color: black !important;
    }

    .deconn:hover {
        color: black !important;
    }

    .deconn button:hover {
        color: black !important;
    }
</style>