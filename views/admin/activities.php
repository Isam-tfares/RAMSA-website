<?php $title = "Activités" ?>
<?php
[$activitiesAdmins, $activitiesClients] = getAllActivities();
$current_date = new DateTime();
ob_start(); ?>
<div class="d-flex justify-content-center m-0">
    <div class="heading  mx-2">
        <h3 class="router rter1 active-router fw-bold mt-5 mb-0 text-center position-relative">Admins</h3>

    </div>
    <div class="heading mx-2">
        <h3 class="router rter2  fw-bold mt-5 mb-0 text-center position-relative">Clients</h3>
    </div>
</div>

<div class="details-table p-0 px-2">
    <div class="activities pt-0 lesson-block m-0 mx-3 my-0">
        <table>

            <tbody>
                <?php foreach ($activitiesAdmins as $activity) { ?>
                    <tr>
                        <td>
                            <?= $activity['activity_content'] ?>
                            <br>
                            <!-- <span class="fullname"><?= $activity['email'] ?></span> -->
                            <span class="fullname"><?= $activity['activity_date'] . " " . $activity['activity_time'] ?></span>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>


    </div>


    <div class="activities nv-block disabled-block pt-0 my-0">
        <table>

            <tbody>

                <?php foreach ($activitiesClients as $activity) { ?>
                    <tr>
                        <td>
                            <?= $activity['activity_content'] ?>
                            <br>
                            <!-- <span class="fullname"><?= $activity['nom'] . " " . $activity['prenom'] ?></span> -->
                            <span class="fullname"><?= $activity['activity_date'] . " " . $activity['activity_time'] ?></span>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>
</div>
<script>
    var rter1 = document.querySelector('.rter1');
    var rter2 = document.querySelector('.rter2');
    var lessons = document.querySelector('.lesson-block');
    var nv = document.querySelector('.nv-block');

    if (rter1 != null && rter2 != null) {
        rter1.addEventListener("click", () => {
            rter1.classList.add("active-router");
            lessons.classList.remove("disabled-block");
            rter2.classList.remove("active-router");
            nv.classList.add("disabled-block");
        });

        rter2.addEventListener("click", () => {
            rter2.classList.add("active-router");
            nv.classList.remove("disabled-block");
            rter1.classList.remove("active-router");
            lessons.classList.add("disabled-block");
        });
    }
</script>







<?php $content = ob_get_clean();


require('views/admin/layout.php');
