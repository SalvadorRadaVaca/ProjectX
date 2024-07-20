<?php include("template/header.php"); ?>
    <br/><br/><br/>
    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Bill data
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

                <form action="index.php?m=saveBill" method="POST">
                    <?php while($client = mysqli_fetch_array($clientData)) { ?>
                    <div class="form-group">
                        <label for="txtHireDate">Hire Date:</label>
                        <input type="date" class="form-control" name="txtHireDate" id="txtHireDate" required>
                    </div>

                    <div class="form-group">
                        <label for="txtInvoice">Invoice:</label>
                        <input type="text" class="form-control" name="txtInvoice" id="txtInvoice" required>
                    </div>

                    <div class="form-group">
                        <label for="txtPackageDescription">Package Description:</label>
                        <textarea class="form-control" name="txtPackageDescription" id="txtPackageDescription" rows="4" cols="50" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtInitialContractedAmount">Initial Contracted Amount:</label>
                        <input type="text" class="form-control" name="txtInitialContractedAmount" id="txtInitialContractedAmount" required>
                    </div>

                    <div class="form-group">
                        <label for="txtBalance">Balance:</label>
                        <input type="text" class="form-control" name="txtBalance" id="txtBalance" required>
                    </div>

                    <div class="form-group">
                        <label for="txtEmail">Email:</label>
                        <input type="text" class="form-control" value="<?php echo $client['email']; ?>" name="txtEmail" id="txtEmail" required readonly>
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="save" id="save" class="btn btn-success">Save</button>
                        <a href="index.php?m=billTable" class="btn btn-secondary">Back</a>
                    </div>
                    <?php } ?>
                </form> 
            </div>
        </div>
        
    </div>
<?php include("template/footer.php"); ?>