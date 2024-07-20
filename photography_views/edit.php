<?php include("template/header.php"); ?>
    <br/><br/><br/>
    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Edit photography
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

                <form action="index.php?m=updatePhotography" method="POST" enctype="multipart/form-data">
                    <?php while($photographyAppointment = mysqli_fetch_array($photographyAppointments)) { ?>
                    <div class="form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" value="<?php echo $photographyAppointment['id']; ?>" name="txtID" id="txtID" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="txtImageURL">Image URL:</label>
                        <?php if($photographyAppointment['image_url']!="") {?>
                            <img class="img-thumbnail rounded" src="photographs/<?php echo $photographyAppointment['image_url']; ?>" width="100" alt="" srcset="">
                        <?php } ?>
                        <input type="file" class="form-control" value="<?php echo $photographyAppointment['image_url']; ?>" name="txtImageURL" id="txtImageURL" required>
                    </div>

                    <div class="form-group">
                        <label for="txtAppointment">Appointment:</label>
                        <input type="text" class="form-control" value="Appointment N°<?php echo $photographyAppointment['appointment_id']; ?>" name="txtAppointment" id="txtAppointment" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="txtSelected">Selected?</label>
                        <select class="form-control" name="txtSelected" id="txtSelected" required>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="txtWatermark">Watermark?</label>
                        <select class="form-control" name="txtWatermark" id="txtWatermark" required>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="txtBalance">Balance:</label>
                        <input type="text" class="form-control" value="<?php echo $photographyAppointment['balance']; ?>" name="txtBalance" id="txtBalance" required>
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="update" id="update" class="btn btn-info">Update</button>
                        <a href="index.php?m=photographyTable" class="btn btn-secondary">Back</a>
                    </div>
                    <?php } ?>
                </form> 
            </div>
        </div>
        
    </div>
<?php include("template/footer.php"); ?>