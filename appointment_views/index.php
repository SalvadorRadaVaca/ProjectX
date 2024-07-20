<?php include("template/header.php"); ?>

<div class="col-md-2"></div>

<div class="col-md-8">
    <h4>APPOINTMENT TABLE</h4><br/>
    <a href="index.php?m=newAppointment" class="btn btn-primary">New Appointment</a><br/>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date Time</th>
                <th>Event</th>
                <th>Email</th>
                <th>Appointment Type</th>
                <th>Reminder</th>
                <th>Confirmed?</th>
                <th>Canceled?</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($appointmentEventUser = mysqli_fetch_array($appointmentEventUsers)) {
                if(($appointmentEventUser['state'] == 1) && ($rol == "Administrator")) {
            ?>
                <tr>
                    <td><?=$appointmentEventUser['id']?></td>
                    <td><?=$appointmentEventUser['date_time']?></td>
                    <td><?=$appointmentEventUser['event']?></td>
                    <td><?=$appointmentEventUser['email']?></td>
                    <td><?=$appointmentEventUser['appointment_type']?></td>
                    <td><?=$appointmentEventUser['reminder']?></td>
                    <td><?=($appointmentEventUser['confirmed'])?"Yes":"No"?></td>
                    <td><?=($appointmentEventUser['cancelled'])?"Yes":"No"?></td>
                    <td>
                        <a href="index.php?m=editAppointment&id=<?php echo $appointmentEventUser['id']; ?>" class="btn btn-warning">
                            <i class="bi bi-pencil-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </i>
                        </a>
                        <a href="index.php?m=deleteAppointment&id=<?php echo $appointmentEventUser['id']; ?>" class="btn btn-danger">
                            <i class="bi bi-trash-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                </svg>
                            </i>
                        </a>
                    </td>
                </tr>
            <?php
                } else if(($appointmentEventUser['state'] == 1) && ($rol == "User")) {
            ?>
                <tr>
                    <td><?=$appointmentEventUser['id']?></td>
                    <td><?=$appointmentEventUser['date_time']?></td>
                    <td><?=$appointmentEventUser['event']?></td>
                    <td><?=$appointmentEventUser['email']?></td>
                    <td><?=$appointmentEventUser['appointment_type']?></td>
                    <td><?=$appointmentEventUser['reminder']?></td>
                    <td><?=($appointmentEventUser['confirmed'])?"Yes":"No"?></td>
                    <td><?=($appointmentEventUser['cancelled'])?"Yes":"No"?></td>
                    <td>
                        <a href="index.php?m=editAppointment&id=<?php echo $appointmentEventUser['id']; ?>" class="btn btn-warning">
                            <i class="bi bi-pencil-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </i>
                        </a>
                    </td>
                </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

</div>

<?php include("template/footer.php"); ?>