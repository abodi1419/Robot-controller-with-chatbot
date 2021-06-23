<?php
if(isset($message)):
?>
<div class="alert alert-success"><?php echo $message?></div>
<?php
unset($message);
endif;
