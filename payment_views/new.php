<?php include("template/header.php"); ?>
    <br/><br/><br/>
    <div class="col-md-3"></div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Payment data
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

                <form action="index.php?m=savePayment" method="POST">
                    <div class="form-group">
                        <label for="txtPaymentDate">Payment Date:</label>
                        <input type="date" class="form-control" name="txtPaymentDate" id="txtPaymentDate" required>
                    </div>

                    <div class="form-group">
                        <label for="txtAmountPaid">Amount Paid:</label>
                        <input type="text" class="form-control" name="txtAmountPaid" id="txtAmountPaid" required>
                    </div>

                    <div class="form-group">
                        <label for="txtWayToPay">Way to Pay:</label>
                        <input type="text" class="form-control" name="txtWayToPay" id="txtWayToPay" required>
                    </div>

                    <div class="form-group">
                        <label for="txtBill">Bill:</label>
                        <select class="form-control" name="txtBill" id="txtBill" required>
                            <?php while($row = mysqli_fetch_array($bills)) { ?>
                            <option value="<?php echo $row['id'] ?>">Bill N°<?php echo $row['id']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="save" id="save" class="btn btn-info">Save</button>
                        <a href="index.php?m=paymentTable" class="btn btn-secondary">Back</a>
                    </div>
                </form> 
            </div>
        </div>
        
    </div>
<?php include("template/footer.php"); ?>