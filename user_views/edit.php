<?php include("template/header.php"); ?>

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

            <form action="index.php?m=updateUser" method="POST">
                <?php while($row = mysqli_fetch_array($dataUser)) {?>
                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" class="form-control" name="txtID" value="<?php echo $row['id']; ?>" id="txtID" required readonly>
                </div>

                <div class="form-group">
                    <label for="txtName">Name:</label>
                    <input type="text" class="form-control" name="txtName" value="<?php echo $row['name']; ?>" id="txtName" required>
                </div>

                <div class="form-group">
                    <label for="txtLastName">Last Name:</label>
                    <input type="text" class="form-control" name="txtLastName" value="<?php echo $row['last_name']; ?>" id="txtLastName" required>
                </div>

                <div class="form-group">
                    <label for="txtEmail">Email:</label>
                    <input type="email" class="form-control" name="txtEmail" value="<?php echo $row['email']; ?>" id="txtEmail" required>
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
                    <button type="submit" name="update" id="update" class="btn btn-info">Update</button>
                    <a href="index.php?m=index" class="btn btn-secondary">Back</a>
                </div>
                <?php } ?>
            </form> 
        </div>
    </div>
    
</div>

<?php include("template/footer.php"); ?>