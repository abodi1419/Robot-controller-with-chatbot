<?php
$title='Manage Motors';
include "template/header.php";
include 'config/database.php';

?>
<div class="card text-center">
    <div class="card-header bg-light-blue text-light">
        <h4 class="">Manage Motors</h4>
    </div>


    <div class="card-body text-center">
        <?php
        include 'getMotors.php';
        if(!count($motors)):?>
            <p>No Motors added yet! <a href="addMotor.php">Add now</a></p>
        <?php
        else:
        ?>
        <table class="table table-responsive-sm text-center w-100">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Value</th>
                <th scope="col">Degree of Rotation</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
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
        <?php endif; ?>
    </div>
    <div class="card-footer bg-white">
        <a href="addMotor.php" class="btn bg-transparent text-primary h-100 w-100"><i class="fa fa-plus fa-2x"></i></a>
    </div>

</div>
<?php include "template/footer.php"; ?>
