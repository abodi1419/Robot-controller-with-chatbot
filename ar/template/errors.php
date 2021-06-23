<?php
if (count($errors)) {
?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) { ?>
            <p><?php echo $error ?></p>
        <?php } ?>
    </div>
<?php
}elseif (isset($_SESSION['error_msg'])) {
    ?>
    <div class="alert alert-danger">

            <p><?php echo $_SESSION['error_msg'] ?></p>

    </div>
    <?php
    $_SESSION['error_msg']=NULL;
}