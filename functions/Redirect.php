<?php

function Redirect($page)
{
    header("location:$page");
}
function RedirectwithPost($page, $id, $message = null, $success = null)
{
?>
    <form method="post" action="<?= $page ?>" id="redirectForm">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="message" value="<?= $message ?>">
        <input type="hidden" name="success" value="<?= $success ?>">
    </form>
    <script type="text/javascript">
        document.getElementById("redirectForm").submit();
    </script>
<?php
}
