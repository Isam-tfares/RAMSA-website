<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

    <section class="form-container">

        <form action="index.php" method="post">
            <h3>Se connecter</h3>
            <?php if (isset($_POST['message'])) { ?>
                <div class="alert alert-danger error" role="alert">
                    <?= $_POST['message'] ?>
                </div>
            <?php } ?>
            <input type="email" name="email" required placeholder="enter votre email" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?php echo (isset($_POST['id'])) ? explode("-", $_POST['id'])[0] : "" ?>" required>
            <div class="position-relative">
                <input id="passwordEdit" type="password" name="password" required placeholder="enter votre mot de passe" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?php echo (isset($_POST['id'])) ? explode("-", $_POST['id'])[1] : "" ?>" required>
                <span class="position-absolute top-50 start-100 translate-middle pe-5" id="changeVisibility">
                    <i class="bi bi-eye-fill  " style="font-size: 15px;"></i>
                </span>
            </div>
            <div class="d-flex justify-content-between align-items-center">

                <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" name="check" style="width: 15px;height:15px" />
                    <label class="form-check-label" for="form2Example3" style="font-size: 15px;margin-left:10px">
                        Souviens moi
                    </label>
                </div>
                <a href="#!" class="text-body" style="font-size: 15px;">Mot de passe oublié</a>
            </div>
            <div class="d-flex justify-content-between align-items-center">

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </div>


            </div>

        </form>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        let $eyes = document.querySelector('#changeVisibility i');
        let $password = document.querySelector('#passwordEdit');
        if ($eyes != null) {
            $eyes.addEventListener('click', (e) => {
                // password is hidden
                if (e.currentTarget.classList.value == "bi bi-eye-fill") {
                    e.currentTarget.classList.value = "bi bi-eye-slash-fill";
                    $password.setAttribute('type', 'text');
                } else {
                    e.currentTarget.classList.value = "bi bi-eye-fill";
                    $password.setAttribute('type', 'password');
                }

            })
        }
    </script>
</body>

</html>