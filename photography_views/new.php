<?php include("template/header.php"); ?>
    <br/><br/><br/>
    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Photography data
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

                <form action="index.php?m=savePhotography" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="txtImageURL">Image URL:</label>
                        <input type="file" class="form-control" name="txtImageURL" id="txtImageURL" required>
                    </div>

                    <div class="form-group">
                        <label for="txtAppointment">Appointment:</label>
                        <select class="form-control" name="txtAppointment" id="txtAppointment" required>
                            <?php while($row = mysqli_fetch_array($appointments)) { ?>
                            <option value="<?php echo $row['id'] ?>">Appointment N°<?php echo $row['id']; ?></option>
                            <?php } ?>
                        </select>
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
                        <input type="text" class="form-control" name="txtBalance" id="txtBalance" required>
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="save" id="save" class="btn btn-info">Save</button>
                        <a href="index.php?m=photographyTable" class="btn btn-secondary">Back</a>
                    </div>
                </form> 
            </div>
        </div>
        
    </div>
<?php include("template/footer.php"); ?>