<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Welcome</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/welcome.css">
  </head>
  <body>

    <div class="container">
        <div class="row">
            <br/><br/><br/>
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Welcome <?php echo $userName; ?></h1>
                    <h2>You are <?php echo $rol; ?></h2>
                    <p>This is a website about photography</p>
                    <hr>
                    <p>More info</p>
                    <p>
                        <a class="btn btn-primary btn-lg" href="index.php?m=index" role="button">User table</a>
                        <a class="btn btn-secondary btn-lg" href="index.php?m=logout" role="button">Logout</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>