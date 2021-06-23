<?php

include 'config/database.php';
$errors = [];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = mysqli_real_escape_string($mysql,$_POST['name']);
    $value = mysqli_real_escape_string($mysql,$_POST['value']);
    $degree = mysqli_real_escape_string($mysql,$_POST['degree']);
    if($value>$degree){
        array_push($errors,'Value must be less than Degree of Rotation!');
    }if($degree>360 || $degree<0){
        array_push($errors,'Degree of rotation must be between 0 and 360!');
    }if($mysql->query("select name from motors where name='$name'")->num_rows){
        array_push($errors,"Name is already used!");
    }

    if(!count($errors)){
        $mysql->query("insert into motors (name,degree,value) values('$name','$degree','$value')");
        if($mysql->error){
            array_push($errors,$mysql->error);
        }else{
            $message = "Motor with name "."'$name'"." was added Successfully";
        }
    }


}
$title='Add Motor';
include "template/header.php";
?>
<div class="card text-center">
    <div class="card-header bg-light-blue text-light">
        <h4 class="">Add Motor</h4>
    </div>


    <div class="card-body text-center">
        <?php include 'template/errors.php' ?>
        <form method="post" class="">
            <div class="form-group">
                <label for="name">Name</label>
                <input autocomplete="off" type="text" class="form-control text-center" name="name" id="name" placeholder="Enter a unique name" required>
            </div>
            <div class="form-group">
                <label for="name">Degree of Rotation</label>
                <input autocomplete="off" type="number" class="form-control text-center" onchange="document.getElementById('value').max=this.value" name="degree" id="degree" min="0" max="360" value="180" placeholder="Enter Degree of Rotation" required>
            </div>
            <div class="form-group">
                <label for="value">Initial Value</label>
                <input autocomplete="off" type="number" class="form-control text-center" name="value" value="90" min="0" max="180" id="value" placeholder="Enter initial value" required >
            </div>
            <button class="btn bg-light-blue text-light">Add Motor</button>
        </form>
    </div>

</div>
<?php include "template/footer.php"; ?>