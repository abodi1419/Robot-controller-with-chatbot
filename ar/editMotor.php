<?php
include 'config/database.php';
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($mysql,$_GET['id']);
}else{
    die("Missing parameter!");
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = mysqli_real_escape_string($mysql,$_POST['name']);
    $value = mysqli_real_escape_string($mysql,$_POST['value']);
    $degree = mysqli_real_escape_string($mysql,$_POST['degree']);
    if($value>$degree){
        array_push($errors,'يجب أن تكون القيمة أقل من زاوية الدوران القصوى');
    }if($degree>360 || $degree<0){
        array_push($errors,'يجب أن تكون زاوية الدوران القصوى بين 0 و 360');
    }if($mysql->query("select name from motors where name='$name' and id!='$id'")->num_rows){
        array_push($errors);
    }

    if(!count($errors)){
        $mysql->query("update motors set name='$name',degree='$degree',value='$value' where id='$id'");
        if($mysql->error){
            array_push($errors,$mysql->error);
        }else{
            $message = "تم تحديث محرك بإسم "."'$name'"."  بنجاح";
        }
    }


}
$motor = $mysql->query("select * from motors where id='$id'");
if($motor->num_rows){
    $motor=$motor->fetch_assoc();
}else{
    die("لم يتم إيجاد محرك بالرقم المعطى!");
}

$title='تعديل محرك';
include "template/header.php";
?>
<div class="card text-center">
    <div class="card-header bg-light-blue text-light">
        <h4 class="">تعديل محرك</h4>
    </div>


    <div class="card-body text-center">
        <?php include 'template/errors.php' ?>
        <form method="post" class="">
            <div class="form-group">
                <label for="name">الإسم</label>
                <input autocomplete="off" type="text" class="form-control text-center" name="name" id="name" value="<?php echo $motor['name'];?>" placeholder="أدخل اسم فريد" required>
            </div>
            <div class="form-group">
                <label for="name">زاوية الدوران القصوى</label>
                <input autocomplete="off" type="number" class="form-control text-center" onchange="document.getElementById('value').max=this.value" name="degree" id="degree" min="0" max="360" value="<?php echo $motor['degree'];?>" placeholder="أدخل زاوية الدوران القصوى" required>
            </div>
            <div class="form-group">
                <label for="value">القيمة</label>
                <input autocomplete="off" type="number" class="form-control text-center" name="value" value="<?php echo $motor['value'];?>" min="0" max="<?php echo $motor['degree'];?>" id="value" placeholder="أدخل القيمة الأولية" required >
            </div>
            <button class="btn bg-light-blue text-light">تحديث المحرك</button>
        </form>
    </div>

</div>
<?php include "template/footer.php"; ?>