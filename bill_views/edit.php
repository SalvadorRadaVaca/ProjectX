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

                <form action="index.php?m=updateBill" method="POST">
                    <?php while($billClient = mysqli_fetch_array($billClients)) { ?>
                    <div class="form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" value="<?php echo $billClient['id']; ?>" name="txtID" id="txtID" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="txtHireDate">Hire Date:</label>
                        <input type="date" class="form-control" value="<?php echo $billClient['hire_date']; ?>" name="txtHireDate" id="txtHireDate" required>
                    </div>

                    <div class="form-group">
                        <label for="txtInvoice">Invoice:</label>
                        <input type="text" class="form-control" value="<?php echo $billClient['invoice']; ?>" name="txtInvoice" id="txtInvoice" required>
                    </div>

                    <div class="form-group">
                        <label for="txtPackageDescription">Package Description:</label>
                        <textarea class="form-control" name="txtPackageDescription" id="txtPackageDescription" rows="4" cols="50" required><?php echo $billClient['package_description']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="txtInitialContractedAmount">Initial Contracted Amount:</label>
                        <input type="text" class="form-control" value="<?php echo $billClient['initial_contracted_amount']; ?>" name="txtInitialContractedAmount" id="txtInitialContractedAmount" required>
                    </div>

                    <div class="form-group">
                        <label for="txtBalance">Balance:</label>
                        <input type="text" class="form-control" value="<?php echo $billClient['balance']; ?>" name="txtBalance" id="txtBalance" required>
                    </div>

                    <div class="form-group">
                        <label for="txtEmail">Email:</label>
                        <input type="text" class="form-control" value="<?php echo $billClient['email']; ?>" name="txtEmail" id="txtEmail" required readonly>
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="update" id="update" class="btn btn-success">Update</button>
                        <a href="index.php?m=billTable" class="btn btn-secondary">Back</a>
                    </div>
                    <?php } ?>
                </form> 
            </div>
        </div>
        
    </div>
<?php include("template/footer.php"); ?>