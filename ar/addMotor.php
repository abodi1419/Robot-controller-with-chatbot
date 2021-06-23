<?php

include 'config/database.php';
$errors = [];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = mysqli_real_escape_string($mysql,$_POST['name']);
    $value = mysqli_real_escape_string($mysql,$_POST['value']);
    $degree = mysqli_real_escape_string($mysql,$_POST['degree']);
    if($value>$degree){
        array_push($errors,'يجب أن تكون القيمة أقل من زاوية الدوران القصوى');
    }if($degree>360 || $degree<0){
        array_push($errors,'يجب أن تكون زاوية الدوران القصوى بين 0 و 360');
    }if($mysql->query("select name from motors where name='$name'")->num_rows){
        array_push($errors,'الإسم مستخدم بالفعل!');
    }

    if(!count($errors)){
        $mysql->query("insert into motors (name,degree,value) values('$name','$degree','$value')");
        if($mysql->error){
            array_push($errors,$mysql->error);
        }else{
            $message = "تمت إضافة محرك بإسم "."'$name'"."  بنجاح";
        }
    }


}
$title='إضافة محرك';
include "template/header.php";
?>
<div class="card text-center">
    <div class="card-header bg-light-blue text-light">
        <h4 class="">إضافة محرك</h4>
    </div>


    <div class="card-body text-center">
        <?php include 'template/errors.php' ?>
        <form method="post" class="">
            <div class="form-group">
                <label for="name">الإسم</label>
                <input autocomplete="off" type="text" class="form-control text-center" name="name" id="name" placeholder="أدخل اسم فريد" required>
            </div>
            <div class="form-group">
                <label for="name">زاوية الدوران القصوى</label>
                <input autocomplete="off" type="number" class="form-control text-center" onchange="document.getElementById('value').max=this.value" name="degree" id="degree" min="0" max="360" value="180" placeholder="أدخل زاوية الدوران القصوى" required>
            </div>
            <div class="form-group">
                <label for="value">قيمة الزاوية الأولية</label>
                <input autocomplete="off" type="number" class="form-control text-center" name="value" value="90" min="0" max="180" id="value" placeholder="أدخل القيمة الأولية" required >
            </div>
            <button class="btn bg-light-blue text-light">إضافة المحرك</button>
        </form>
    </div>

</div>
<?php include "template/footer.php"; ?>