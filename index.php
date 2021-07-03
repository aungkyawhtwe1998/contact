<?php
require_once "core/base.php";?>
<?php require_once "core/function.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/feather-icons-web/feather.css">
    <style>
        .profile{
            width:50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Contact</button>
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Add New Contact</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="my-3">
                                            <?php
                                            if(isset($_POST['save'])){
                                                addContact();
                                            }
                                            ?>
                                            <form action="" method="post"  enctype="multipart/form-data">
                                                <div class="form-group mb-3">
                                                    <label for="profile">Upload Profile Picture</label>
                                                    <input type="file" name="profile" class="form-control">
                                                    <?php if(getError('name')){?>
                                                        <small class="text-danger font-weight-bold">
                                                            <?php echo getError('profile'); ?>
                                                        </small>
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group mb-3">

                                                    <label for="name" class="col-form-label">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo old('name'); ?>">
                                                    <?php if(getError('name')){?>
                                                        <small class="text-danger font-weight-bold">
                                                            <?php echo getError('name'); ?>
                                                        </small>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="email" class="col-form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email'); ?>">
                                                    <?php if(getError('email')){?>
                                                        <small class="text-danger font-weight-bold">
                                                            <?php echo getError('email'); ?>
                                                        </small>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="phone" class="col-form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo old('phone'); ?>">
                                                    <?php if(getError('phone')){?>
                                                        <small class="text-danger font-weight-bold">
                                                            <?php echo getError('phone'); ?>
                                                        </small>
                                                    <?php } ?>
                                                </div>
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button name="save" class="btn btn-primary">Save</button>


                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    </div>
                    <div class="">
                        <table class="table table-striped table-bordered table-hover mt-3 mb-0">
                            <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Control</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach(getContacts() as $c){
                            ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $c['profile'];?>" class="profile"/>
                                    </td>
                                    <td><?php echo $c['name'];?></td>
                                    <td><?php echo $c['email'];?></td>
                                    <td><?php echo $c['phone'];?></td>
                                    <td class="text-nowrap">
                                        <a href="contact_delete.php?id=<?php echo $c['id'];?>" class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure to delete')"><i class="feather-trash"></i></a>
                                        <a href="contact_edit.php?id=<?php echo $c['id'];?>" class="btn btn-warning btn-sm">
                                            <i class="feather-edit-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php clearError() ; ?>
<script src="<?php echo $url; ?>/assets/vendor/datatable/jquery-3.5.1.js"></script>
<script src="<?php echo $url; ?>/assets/vendor/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="<?php echo $url; ?>/assets/vendor/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo $url; ?>/assets/vendor/datatable/dataTables.bootstrap5.min.js"></script>
<script>
    $(".table").dataTable({
        "order": [
            [0, "desc"]
        ]
    });
</script>
</body>
</html>