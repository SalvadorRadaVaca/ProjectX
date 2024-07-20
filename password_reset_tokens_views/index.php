<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>

    <div class="container">
        <div class="row">

            <div class="col-md-3"></div>

            <div class="col-md-6">
                <br/><br/><br/>
                <div class="card">
                    <div class="card-header">
                        <h4>Change password</h4>
                    </div>

                    <div class="card-body">

                        <?php if(isset($message) && isset($message_type)) { ?>
                        <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="close" id="alert1" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php } ?>

                        <form action="index.php?m=passwordResetTokens" method="POST">
                            <div class="form-group">
                                <label for="txtEmail">Email:</label>
                                <input type="email" class="form-control" name="txtEmail" id="txtEmail" required>
                            </div>

                            <div class="form-group">
                                <label for="txtNewPassword">New password:</label>
                                <input type="password" class="form-control" name="txtNewPassword" id="txtNewPassword" required>
                            </div>

                            <div class="form-group">
                                <label for="txtPasswordConfirmation">Password Confirmation:</label>
                                <input type="password" class="form-control" name="txtPasswordConfirmation" id="txtPasswordConfirmation" required>
                            </div>

                            <div class="btn-group" role="group" aria-label="">
                                <button type="submit" name="update" id="update" class="btn btn-info">Update</button>
                                <a href="index.php?m=showLogin" class="btn btn-secondary">Back</a>
                            </div>
                        </form> 
                    </div>
                </div>
                
            </div>

            <script type="text/javascript">
                $("#alert1").on('click', function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 1);
                });
                
                $("#alert2").on('click', function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 1);
                });
            </script>

        </div>
    </div>

  </body>
</html>