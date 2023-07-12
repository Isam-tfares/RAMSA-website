<?php
$user = new EtudiantController();
$user->userDconn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="jquery-3.6.3.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./style/admin_style.css"> -->
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./assets/icons/css/all.css">
    <link rel="stylesheet" href="./style/prof_style.css">
    <script src="./js/file.js"></script>
    <script src="./js/script.js" defer></script>
    <link rel="stylesheet" href="./style/slider.css">
    <title><?= $title ?></title>
    <style></style>
</head>

<body>

    <?php require('header.php') ?>
    <div>
        <?= $content ?>
    </div>
    <?php require('footer.php') ?>

    <script src="./js/style.js"></script>
    <script>
        <?php if ($title != "Accueil") { ?>
            var nav = document.querySelector('.navbar');
            var li = document.querySelectorAll('.navbar ul li a');
            var style = document.querySelector('style');
            nav.classList.add("bg-white");
            nav.classList.remove("bleu-back");
            style.innerHTML = '.nav-item a:hover { color: var(--main-color);font-weight: normal;} .navbar{box-shadow: 0px 1px 0px rgba(0, 0, 0, .1);}';
            window.onscroll = function() {
                sFunction()
            };

            function sFunction() {
                if (document.body.scrollTop < 20 || document.documentElement.scrollTop < 20) {
                    nav.classList.add("bg-white");
                    nav.classList.remove("bleu-back");
                    style.innerHTML = css_hover;
                }
            }
        <?php } ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>