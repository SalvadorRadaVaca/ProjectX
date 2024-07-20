<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <br/><br/><br/>
                <div class="col-md-3"></div>

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                            User data
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

                            <form action="index.php?m=saveUser" method="POST">

                                <div class="form-group">
                                    <label for="txtName">Name:</label>
                                    <input type="text" class="form-control" name="txtName" id="txtName" required>
                                </div>

                                <div class="form-group">
                                    <label for="txtLastName">Last Name:</label>
                                    <input type="text" class="form-control" name="txtLastName" id="txtLastName" required>
                                </div>

                                <div class="form-group">
                                    <label for="txtEmail">Email:</label>
                                    <input type="email" class="form-control" name="txtEmail" id="txtEmail" required>
                                </div>

                                <div class="form-group">
                                    <label for="txtPassword">Password:</label>
                                    <input type="password" class="form-control" name="txtPassword" id="txtPassword" required>
                                </div>

                                <div class="form-group">
                                    <label for="txtTokenConfirmation">Token Confirmation:</label>
                                    <input type="text" class="form-control" name="txtTokenConfirmation" id="txtTokenConfirmation" required>
                                </div>

                                <div class="form-group">
                                    <label for="txtRol">Rol:</label>
                                    <select name="txtRol" id="txtRol">
                                        <option value="Administrator">Administrator</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="txtEnabled">Enabled?:</label>
                                    <select name="txtEnabled" id="txtEnabled">
                                        <option value="true">Yes</option>
                                        <option value="false">No</option>
                                    </select>
                                </div>

                                <div class="btn-group" role="group" aria-label="">
                                    <button type="submit" name="save" id="save" class="btn btn-success">Save</button>
                                    <a href="index.php?m=showLogin" class="btn btn-secondary">Back</a>
                                </div>
                            </form> 
                        </div>
                    </div>
                    
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
    </body>
</html>