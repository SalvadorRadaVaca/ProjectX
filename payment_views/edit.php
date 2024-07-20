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

                <form action="index.php?m=updatePayment" method="POST">
                    <?php while($paymentBill = mysqli_fetch_array($paymentBills)) { ?>
                    <div class="form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" value="<?php echo $paymentBill['id'] ?>" name="txtID" id="txtID" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="txtPaymentDate">Payment Date:</label>
                        <input type="date" class="form-control" value="<?php echo $paymentBill['payment_date'] ?>" name="txtPaymentDate" id="txtPaymentDate" required>
                    </div>

                    <div class="form-group">
                        <label for="txtAmountPaid">Amount Paid:</label>
                        <input type="text" class="form-control" value="<?php echo $paymentBill['amount_paid'] ?>" name="txtAmountPaid" id="txtAmountPaid" required>
                    </div>

                    <div class="form-group">
                        <label for="txtWayToPay">Way to Pay:</label>
                        <input type="text" class="form-control" value="<?php echo $paymentBill['way_to_pay'] ?>" name="txtWayToPay" id="txtWayToPay" required>
                    </div>

                    <div class="form-group">
                        <label for="txtBill">Bill:</label>
                        <input type="text" class="form-control" value="<?php echo $paymentBill['bill_id'] ?>" name="txtBill" id="txtBill" required readonly>
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="update" id="update" class="btn btn-info">Update</button>
                        <a href="index.php?m=paymentTable" class="btn btn-secondary">Back</a>
                    </div>
                    <?php } ?>
                </form> 
            </div>
        </div>
        
    </div>
<?php include("template/footer.php"); ?>