<?php include("template/header.php"); ?>
    <br/><br/><br/>
    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Event data
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

                <form action="index.php?m=updateEvent" method="POST">
                    <?php 
                    while($userEvent = mysqli_fetch_array($userEvents)) { 
                        $location = str_replace(" ", "&nbsp;", $userEvent['location']);  
                    ?>
                    <div class="form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" value="<?php echo $userEvent['id']; ?>" name="txtID" id="txtID" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="txtName">Name:</label>
                        <input type="text" class="form-control" value="<?php echo $userEvent['event']; ?>" name="txtName" id="txtName" required>
                    </div>

                    <div class="form-group">
                        <label for="txtDate">Date:</label>
                        <input type="date" class="form-control" value="<?php echo $userEvent['date']; ?>" name="txtDate" id="txtDate" required>
                    </div>

                    <div class="form-group">
                        <label for="txtLocation">Location:</label>
                        <input type="text" class="form-control" value="<?php echo $location; ?>" name="txtLocation" id="txtLocation" required>
                    </div>

                    <input type="hidden" class="form-control" value="<?php echo $userEvent['email']; ?>" name="txtEmail" id="txtEmail" required>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="update" id="update" class="btn btn-info">Update</button>
                        <a href="index.php?m=eventTable" class="btn btn-secondary">Back</a>
                    </div>
                    <?php 
                    }
                    ?>
                </form> 
            </div>
        </div>
        
    </div>
<?php include("template/footer.php"); ?>