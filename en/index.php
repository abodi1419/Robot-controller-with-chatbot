<?php
$title='Home';
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
        }.my-arrows-btn{
             height: 60px;
         }
    </style>
<div class="card mb-3">
    <div class="card-header bg-light-blue text-light">
        <h3 class="">Base Controller</h3>
    </div>


    <div class="card-body" dir="ltr">
        <div class="row">
            <div class="col-4"></div>
            <button id="forward" class="col-4 btn bg-light-blue my-arrows-btn text-center mb-3 text-light">
                <i class="fas fa-arrow-up fa-2x"></i>
            </button>
            <div class="col-4"></div>

            <button id="left" class="col-4 btn bg-light-blue my-arrows-btn text-center p-0 m-0 text-light">
                <i class="fas fa-arrow-left fa-2x"></i>
            </button>
            <div class="col-4"></div>
            <button id="right" class="col-4 btn bg-light-blue my-arrows-btn text-center p-0 m-0 text-light">
                <i class="fas fa-arrow-right fa-2x"></i>
            </button>
            <div class="col-4"></div>

            <button id="backward" class="col-4 btn bg-light-blue my-arrows-btn text-center p-0 mt-3 text-light">
                <i class="fas fa-arrow-down fa-2x"></i>
            </button>
            <div class="col-4"></div>
        </div>
    </div>
</div>

    <div class="card text-center">
        <div class="card-header bg-light-blue text-light">
            <h3 class="">Arm Controller</h3>
        </div>


        <div class="card-body text-center">
            <?php
            include 'getMotors.php';
            if(!count($motors)):?>
                <p>No Motors added yet! <a href="addMotor.php">Add now</a></p>
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
            <button class="btn bg-light-blue text-light my-btn m-1" id="save" onclick="save()">Save <i class="fa fa-save"></i></button>
            <button class="btn bg-light-blue text-light my-btn m-1" id="run" onclick="run(this)">
                <?php if($mysql->query("select is_on from settings")->fetch_assoc()['is_on']): ?>
                    Running <i class="fa fa fa-cogs text-primary"></i>
                <?php else: ?>
                    Run <i class="fa fa-cogs"></i>
                <?php endif; ?>
            </button>
            <a class="btn bg-light-blue text-light my-btn m-1" href="http://192.168.1.10/control-panel/ar/showMotors.php">Manage Motors <i class="fa fa-edit"></i></a>

        </div>
        <div class="alert alert-danger" id="error-area" hidden>

            <p id="error-label"></p>

        </div>
    </div>


<?php
include "template/footer.php"
?>
<script type="text/javascript">
    var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
        isMobile = true;
    }
    $(window).blur(function(){
        location.reload();
    });
    class Motor{
        constructor(id,value,degree) {
            this.id = id;
            this.value=value;
            this.degree=degree;
        }
    }
    function setValueLabel(e){
        document.getElementById(e.id+'L').value=e.value;
        document.getElementById('save').innerHTML = 'Save <i class="fa fa-save"></i>'
    }
    function setSliderValue(e){

        if(parseInt(e.value)>parseInt(e.max) || e.value<e.min || e.value==0 || e.value != parseInt(e.value , 10)){
            e.value = 90;
            e.select();
        }
        document.getElementById('save').innerHTML = 'Save <i class="fa fa-save"></i>'
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
                    document.getElementById('save').innerHTML = 'Saved <i class="fa fa-thumbs-up text-primary"></i>'
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
                    document.getElementById('run').innerHTML = 'Running <i class="fa fa fa-cogs text-primary"></i>';
                }else if (response==='stopped') {
                    document.getElementById('run').innerHTML = 'Run <i class="fa fa fa-cogs"></i>';
                }else {
                    document.getElementById('error-label').innerText = response;
                    document.getElementById('error-area').hidden = false;
                }
            }
        });
    }

    var start = function start(e){
        window.addEventListener("contextmenu", function(e) { e.preventDefault(); })
        e=this;
        $.ajax({
            url: '../baseControl.php',
            type: 'get',
            data: ("name="+this.id+"&value=1"),
            success: function(response){
                if(response==='done'){
                    e.classList.remove('bg-light-blue')
                    e.classList.add('btn-danger')
                }
            }
        });
    }
    var end = function end(e){

        e=this
        $.ajax({
            url: '../baseControl.php',
            type: 'get',
            data: ("name="+this.id+"&value=0"),
            success: function(response){
                if(response==='done'){
                    e.classList.remove('btn-danger')
                    e.classList.add('bg-light-blue')
                }
            }
        });
        window.addEventListener("contextmenu", function(e) {})
    }
    if(!isMobile) {
        document.getElementById('forward').addEventListener("mousedown", start);
        document.getElementById('forward').addEventListener("mouseup", end);
        document.getElementById('left').addEventListener("mousedown", start);
        document.getElementById('left').addEventListener("mouseup", end);
        document.getElementById('right').addEventListener("mousedown", start);
        document.getElementById('right').addEventListener("mouseup", end);
        document.getElementById('backward').addEventListener("mousedown", start);
        document.getElementById('backward').addEventListener("mouseup", end);

    }else {
        document.getElementById('forward').addEventListener("touchstart", start);
        document.getElementById('forward').addEventListener("touchend", end);
        document.getElementById('left').addEventListener("touchstart", start);
        document.getElementById('left').addEventListener("touchend", end);
        document.getElementById('right').addEventListener("touchstart", start);
        document.getElementById('right').addEventListener("touchend", end);
        document.getElementById('backward').addEventListener("touchstart", start);
        document.getElementById('backward').addEventListener("touchend", end);



    }
</script>

