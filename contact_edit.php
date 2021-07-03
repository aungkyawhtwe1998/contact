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
            width:150px;
            height: 150px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row my-5 align-items-center justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="my-3">
                        <?php
                        $id = $_GET['id'];
                        $c = getContact($id);
                        if(isset($_POST['update'])){
                            if(updateContact()){
                                linkTo("index.php");
                            }
                        }
                        ?>
                        <form action="" method="post"  enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <div class="d-flex justify-content-center align-items-center">
                                <img class="profile" src="<?php echo $c['profile']?>" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="profile">Change Profile Picture</label>
                                <input type="file" name="profile" class="form-control" value="<?php echo $c['profile'] ;?>">
                                <?php if(getError('name')){?>
                                    <small class="text-danger font-weight-bold">
                                        <?php echo getError('profile'); ?>
                                    </small>
                                <?php } ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $c['name']; ?>">
                                <?php if(getError('name')){?>
                                    <small class="text-danger font-weight-bold">
                                        <?php echo getError('name'); ?>
                                    </small>
                                <?php } ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $c['email']; ?>">
                                <?php if(getError('email')){?>
                                    <small class="text-danger font-weight-bold">
                                        <?php echo getError('email'); ?>
                                    </small>
                                <?php } ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="col-form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $c['phone']; ?>"">
                                <?php if(getError('phone')){?>
                                    <small class="text-danger font-weight-bold">
                                        <?php echo getError('phone'); ?>
                                    </small>
                                <?php } ?>
                            </div>
                            <button name="update" class="btn btn-warning">Update</button>


                        </form>
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