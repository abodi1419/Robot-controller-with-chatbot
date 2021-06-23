<?php
$title='إدارة المحركات';
include "template/header.php";
include 'config/database.php';

?>
<div class="card text-center">
    <div class="card-header bg-light-blue text-light">
        <h4 class="">إدارة المحركات</h4>
    </div>


    <div class="card-body text-center">
        <table class="table table-responsive-sm text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">الإسم</th>
                <th scope="col">القيمة</th>
                <th scope="col">زاوية الدوران القصوى</th>
                <th scope="col">الإجراءات</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'getMotors.php';
            foreach ($motors as $key => $motor) :
            ?>
                <tr>
                    <th scope="row"><?php echo $key+1; ?></th>
                    <td><?php echo $motor['name'];?></td>
                    <td><?php echo $motor['value'];?></td>
                    <td><?php echo $motor['degree'];?></td>
                    <td>
                        <a href="editMotor.php?id=<?php echo $motor['id'] ?>" class="btn text-primary bg-transparent m-0 p-0"><i class="fa fa-edit"></i></a>
                        <a href="deleteMotor.php?id=<?php echo $motor['id'] ?>" class="btn text-danger bg-transparent m-0 p-0"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        <a href="addMotor.php" class="btn bg-transparent text-primary h-100 w-100"><i class="fa fa-plus fa-2x"></i></a>
    </div>

</div>
<?php include "template/footer.php"; ?>