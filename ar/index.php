<?php
$title='الرئيسية';
include "template/header.php";
include 'config/database.php';

?>
    <style type="text/css">
        .my-btn{
            height: 45px;
            min-width: 60px;
        }.my-circle-div{
             height: 60px;
             width: 60px;

         }.center-me {
              margin: 0 auto;
          }
        .link {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }textarea:focus, input:focus{
             outline: none;
                 }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }.vertical-center {
             margin: 0;
             position: absolute;
             top: 50%;
             -ms-transform: translateY(-50%);
             transform: translateY(-50%);
         }.slider {
              -webkit-appearance: none;
              width: 100%;
              height: 15px;
              border-radius: 5px;
              background: #d3d3d3;
              outline: none;
              opacity: 0.7;
              -webkit-transition: .2s;
              transition: opacity .2s;
          }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #0D5957;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #0D5957;
            cursor: pointer;
        }
        .my-green{
            color: #1252cf;
        }

        .my-text-color{
            color: lightgrey;
        }
    </style>


    <div class="card text-center">
        <div class="card-header bg-light-blue text-light">
            <h3 class="">متحكم الذراع</h3>
        </div>


        <div class="card-body text-center">
                <?php
                include 'getMotors.php';
                if(!count($motors)):?>
                    <p>لم يتم إضافة محركات بعد! <a href="addMotor.php">إضافة الان</a></p>
                <?php
                else:
                ?>
            <div class="row justify-content-center align-items-center">

                <?php
                foreach ($motors as $key => $motor):
                ?>
                <?php if($key%2==0): ?>
                <div class="col-7 col-md-4 col-lg-5">
                    <div class="form-group">
                        <label for="<?php echo $motor['name'] ?>"><?php echo $motor['name'] ?></label>
                        <input type="range" autocomplete="off"  min="0" max="<?php echo $motor['degree'] ?>" value="<?php echo $motor['value']?>" class="slider form-control" id="<?php echo $motor['name'] ?>" onchange="setValueLabel(this)"  oninput="setValueLabel(this)">
                    </div>
                </div>
                <div class="col-5 col-md-2 col-lg-1 font-weight-bold text-center">
                    <div class="rounded-circle bg-light-blue my-circle-div center-me link vertical-center">
                        <input  type="number" autocomplete="off" style="width: 60px; font-size: 25px;" min="0" max="<?php echo $motor['degree'] ?>" class="bg-transparent h-100 text-center my-text-color font-weight-bold border-0 " id="<?php echo $motor['name'] ?>L" value="<?php echo $motor['value'] ?>" onclick="this.select()" oninput="setSliderValue(this)">
                    </div>
                </div>
                <?php else: ?>
                <div class="col-5 col-md-2 col-lg-1  font-weight-bold text-center">
                    <div class="rounded-circle bg-light-blue border-1 border-success my-circle-div center-me link vertical-center">
                        <input  type="number" autocomplete="off" style="width: 60px; font-size: 25px;" min="0" max="<?php echo $motor['degree'] ?>" class="bg-transparent h-100 text-center my-text-color font-weight-bold border-0 " id="<?php echo $motor['name'] ?>L" value="<?php echo $motor['value'] ?>" onclick="this.select()" oninput="setSliderValue(this)">
                    </div>
                </div>
                <div class="col-7 col-md-4 col-lg-5">
                    <div class="form-group">
                        <label for="<?php echo $motor['name'] ?>"><?php echo $motor['name'] ?></label>
                        <input type="range" autocomplete="off"  min="0" max="<?php echo $motor['degree'] ?>" value="<?php echo $motor['value'] ?>" class="slider form-control" id="<?php echo $motor['name'] ?>" onchange="setValueLabel(this)" oninput="setValueLabel(this)" >
                    </div>
                </div>
                <?php endif; ?>

                <?php endforeach; ?>
                <?php if($key%2==0): ?>
                    <div class="col-5 col-md-2 col-lg-1 font-weight-bold text-center"></div>
                    <div class="col-7 col-md-4 col-lg-5"></div>
                <?php endif; ?>
            </div>
                <?php endif; ?>
            <hr>
            <button class="btn bg-light-blue text-light my-btn m-1" id="save" onclick="save()">حفظ <i class="fa fa-save"></i></button>
            <button class="btn bg-light-blue text-light my-btn m-1" id="run" onclick="run(this)">
                <?php if($mysql->query("select is_on from settings")->fetch_assoc()['is_on']): ?>
                    قيد التشغيل <i class="fa fa fa-cogs text-primary"></i>
                <?php else: ?>
                    تشغيل <i class="fa fa-cogs"></i>
                <?php endif; ?>
            </button>
            <a class="btn bg-light-blue text-light my-btn m-1" href="http://192.168.1.10/control-panel/ar/showMotors.php">إدارة المحركات <i class="fa fa-edit"></i></a>

        </div>

        <div class="alert alert-danger" id="error-area" hidden>

            <p id="error-label"></p>

        </div>
    </div>


<?php
include "template/footer.php"
?>
<script type="text/javascript">
    class Motor{
        constructor(id,value,degree) {
            this.id = id;
            this.value=value;
            this.degree=degree;
        }
    }
    function setValueLabel(e){
        document.getElementById(e.id+'L').value=e.value;
        document.getElementById('save').innerHTML = 'حفظ <i class="fa fa-save"></i>'
    }
    function setSliderValue(e){

        if(parseInt(e.value)>parseInt(e.max) || e.value<e.min || e.value==0 || e.value != parseInt(e.value , 10)){
            e.value = 90;
            e.select();
        }
        document.getElementById('save').innerHTML = 'حفظ <i class="fa fa-save"></i>'
        document.getElementById(e.id.slice(0, -1)).value=e.value;
    }
    function save(){
        document.getElementById('error-area').hidden = true;
        var motors = <?php echo json_encode($motors); ?>;
        console.log(motors[0]['id']);
        var arr=[];
        for (var i = 0; i < motors.length; i++) {

            arr.push(new Motor(motors[i]['id'],document.getElementById(motors[i]['name']+'L').value,motors[i]['degree']));
        }
        console.log(arr);
        $.ajax({
            url: 'save.php',
            type: 'post',
            data: JSON.stringify(arr),
            success: function(response){
                if(response==='done'){
                    document.getElementById('save').innerHTML = 'تم الحفظ <i class="fa fa-thumbs-up text-primary"></i>'
                }else {
                    document.getElementById('error-label').innerText = response;
                    document.getElementById('error-area').hidden = false;
                }
            }
        });
    }
    function run(e){
        document.getElementById('error-area').hidden = true;
        $.ajax({
            url: 'run.php',
            type: 'get',
            success: function(response){
                if(response==='done'){
                    document.getElementById('run').innerHTML = 'قيد التشغيل <i class="fa fa fa-cogs text-primary"></i>';
                }else if (response==='stopped') {
                    document.getElementById('run').innerHTML = 'تشغيل <i class="fa fa fa-cogs"></i>';
                }else {
                    document.getElementById('error-label').innerText = response;
                    document.getElementById('error-area').hidden = false;
                }
            }
        });
    }
</script>

