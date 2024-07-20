<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Login</title>
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
            <div class="col-md-4">

            </div>

            <div class="col-md-4">
                <br/><br/><br/>
                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
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

                        <?php if(isset($message2) && isset($message_type2)) { ?>
                        <div class="alert alert-<?php echo $message_type2; ?> alert-dismissible fade show" role="alert">
                            <?php echo $message2; ?>
                            <button type="button" class="close" id="alert2" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php } ?>

                        <?php if(isset($message3) && isset($message_type3)) { ?>
                        <div class="alert alert-<?php echo $message_type3; ?> alert-dismissible fade show" role="alert">
                            <?php echo $message3; ?>
                            <button type="button" class="close" id="alert3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php } ?>

                        <form action="index.php?m=login" method="POST">

                            <div class = "form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>

                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            
                            <div class="btn-group" role="group" aria-label="">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                                <a href="index.php?m=newUser" class="btn btn-secondary">New User</a>
                                <a href="index.php?m=showPasswordResetTokens" class="btn btn-info">Reset Password</a>
                            </div>

                        </form>

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

                            $("#alert3").on('click', function() {
                                window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                });
                                }, 1);
                            });
                        </script>
                        
                    </div>
                    
                </div>

            </div>
            
        </div>
    </div>

  </body>
</html>