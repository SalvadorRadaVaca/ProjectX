<?php include("template/header.php"); ?>
    <br/><br/><br/>
    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Appointment data
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

                <form action="index.php?m=saveAppointment" method="POST">
                    <?php 
                    while($user = mysqli_fetch_array($dataUser)) { 
                    ?>
                    <div class="form-group">
                        <label for="txtDateTime">Date time:</label>
                        <input type="text" class="form-control" name="txtDateTime" id="txtDateTime" required>
                    </div>

                    <div class="form-group">
                        <label for="txtEvent">Event:</label>  
                        <select class="form-control" name="txtEvent" id="txtEvent" required>
                            <?php while($event = mysqli_fetch_array($events)) { ?>
                            <option value="<?php echo $event['name']; ?>"><?php echo $event['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
     
                    <div class="form-group">
                        <label for="txtEmail">User Email:</label>
                        <input type="email" class="form-control" value="<?php echo $user['email'] ?>" name="txtEmail" id="txtEmail" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="txtAppointmentType">Appointment Type:</label>
                        <input type="text" class="form-control" name="txtAppointmentType" id="txtAppointmentType" required>
                    </div>

                    <div class="form-group">
                        <label for="txtReminder">Reminder:</label>
                        <input type="text" class="form-control" name="txtReminder" id="txtReminder" required>
                    </div>

                    <div class="form-group">
                        <label for="txtConfirmed">Confirmed?</label>
                        <select name="txtConfirmed" id="txtConfirmed" required>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="txtCancelled">Cancelled?</label>
                        <select name="txtCancelled" id="txtCancelled" required>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="save" id="save" class="btn btn-success">Save</button>
                        <a href="index.php?m=appointmentTable" class="btn btn-secondary">Back</a>
                    </div>
                    <?php 
                        }
                ?>
                </form> 
            </div>
        </div>
        
    </div>
<?php include("template/footer.php"); ?>