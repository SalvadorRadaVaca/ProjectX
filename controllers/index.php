<?php

require_once("model/index.php");

class modelController{
    private $model;

    public function __construct(){
        $this->model = new Model();
    }

    //Appointment section
    static function appointmentTable(){
        session_start();
        $event = new Model();
        $appointmentEventUser = new Model();
        $appointment = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id']) && isset($_SESSION['rol'])) {
                if($_SESSION['rol'] == "User") {
                    $rol = $_SESSION['rol'];
                    $id = $_SESSION['id'];
                    $events = $event->select("event_table", "user_id=".$id);
                    while($row = mysqli_fetch_array($events)) {
                        if($row['state'] == 0){
                            $data = "state = ".$row['state'];
                            $appointments = $appointment->update("appointment_table", $data, "user_id=".$id);
                        }
                    }
                    $appointmentEventUsers = $appointmentEventUser->select("appointment_event_user_view", "user_id=".$id);
                    require_once("appointment_views/index.php");
                } else if($_SESSION['rol'] == "Administrator") {
                    $rol = $_SESSION['rol'];
                    $events = $event->select("event_table", "1");
                    while($row = mysqli_fetch_array($events)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $appointments = $appointment->update("appointment_table", $data, "user_id=".$row['user_id']);
                        }
                    }
                    $appointmentEventUsers = $appointmentEventUser->select("appointment_event_user_view", "1");
                    require_once("appointment_views/index.php");
                }
            }
        }
    }

    static function newAppointment(){
        session_start();
        $user = new Model();
        $event = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $dataUser = $user->select("user_table", "id=".$id);
                $events = $event->select("event_table", "user_id=".$id);
                require_once("appointment_views/new.php");
            }
        }
    }

    static function saveAppointment(){
        session_start();
        $txtDateTime = $_POST['txtDateTime'];
        $txtEvent = $_POST['txtEvent'];
        //$txtEmail = $_POST['txtEmail'];
        $txtAppointmentType = $_POST['txtAppointmentType'];
        $txtReminder = $_POST['txtReminder'];
        $txtConfirmed = $_POST['txtConfirmed'];
        $txtCancelled = $_POST['txtCancelled'];
        $txtState = true;

        $appointment = new Model();
        $event = new Model();
        $user = new Model();
        $appointmentEventUser = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $appointmentEventUsers = $appointmentEventUser->select("appointment_event_user_view", "user_id = ".$id."");
                $events = $event->select("event_table", "user_id=".$id);
                $dataUser = $user->select("user_table", "id=".$id);
                while($aEU = mysqli_fetch_array($appointmentEventUsers)) {
                    while($event = mysqli_fetch_array($events)) {
                        if($txtEvent != $aEU['event']) {
                            $dataAppointment = "'".$txtDateTime."', ".$event['id'].", ".$id.", '"
                                            .$txtAppointmentType."', '".$txtReminder."', ".$txtConfirmed.
                                            ", ".$txtCancelled.", ".$txtState."";
                            $dataAppointmentI = $appointment->insert("appointment_table", $dataAppointment);

                            if($dataAppointmentI == 1) {
                                $message = "Saved appointment successfully";
                                $message_type = "success";
                                require_once("appointment_views/new.php");
                            } else {
                                $message = "Error: Event hasn't been saved";
                                $message_type = "danger";
                                require_once("appointment_views/new.php");
                            }
                        } else {
                            $message = "Error: Event already exists";
                            $message_type = "danger";
                            require_once("appointment_views/new.php");
                        }
                    }
                }
            }
        }
    }

    static function editAppointment(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $userId = $_SESSION['id'];
                $appointmentEventUser = new Model();
                $event = new Model();
                
                $appointmentEventUsers = $appointmentEventUser->select("appointment_event_user_view", "id=".$id);
                $events = $event->select("event_table", "user_id=".$userId);
                require_once("appointment_views/edit.php");
            }
        }
    }

    static function updateAppointment(){
        session_start();
        $txtID = $_POST['txtID'];
        $txtDateTime = $_POST['txtDateTime'];
        //$txtEvent = $_POST['txtEvent'];
        //$txtEmail = $_POST['txtEmail'];
        $txtAppointmentType = $_POST['txtAppointmentType'];
        $txtReminder = $_POST['txtReminder'];
        $txtConfirmed = $_POST['txtConfirmed'];
        $txtCancelled = $_POST['txtCancelled'];
        $txtState = true;

        $appointment = new Model();
        $event = new Model();
        $appointmentEventUser = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $events = $event->select("event_table", "user_id = ".$id."");
                while($event = mysqli_fetch_array($events)) {
                    $dataAppointment = "date_time = '".$txtDateTime."', event_id = "
                                    .$event['id'].", user_id = ".$id.
                                    ", appointment_type = '".$txtAppointmentType.
                                    "', reminder = '".$txtReminder."', confirmed = ".$txtConfirmed.
                                    ", cancelled = ".$txtCancelled.", state = ".$txtState."";
                    $dataAppointmentU = $appointment->update("appointment_table", $dataAppointment, "id=".$txtID);

                    if($dataAppointmentU == 1) {
                        $message = "Updated appointment successfully";
                        $message_type = "success";
                        $appointmentEventUsers = $appointmentEventUser->select("appointment_event_user_view", "id=".$txtID);
                        require_once("appointment_views/edit.php");
                    } else {
                        $message = "Error: Event hasn't been updated";
                        $message_type = "danger";
                        $appointmentEventUsers = $appointmentEventUser->select("appointment_event_user_view", "id=".$txtID);
                        require_once("appointment_views/edit.php");
                    }
                }
            }
        }
    }

    static function deleteAppointment(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $txtState = 0;
            $appointmentEventUser = new Model();
            $appointment = new Model();
            $data = "state = ".$txtState;
            $dataAppointment = $appointment->update("appointment_table", $data, "id=".$id);
            $appointmentEventUsers = $appointmentEventUser->select("appointment_event_user_view", "1");
            header("Location:index.php?m=appointmentTable");
        }
    }
    //Appointment section end

    //Bill section
    static function billTable(){
        session_start();
        $billClient = new Model();
        $client = new Model();
        $bill = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id']) && isset($_SESSION['rol'])) {
                if($_SESSION['rol'] == "User") {
                    $id = $_SESSION['id'];
                    $rol = $_SESSION['rol'];
                    $clients = $client->select("user_table", "id=".$id);
                    while($row = mysqli_fetch_array($clients)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $billData = $bill->update("bill_table", $data, "client_id=".$id);
                        }
                    }
                    $billClients = $billClient->select("bill_client_view", "client_id=".$id);
                    require_once("bill_views/index.php");
                } else if($_SESSION['rol'] == "Administrator") {
                    $rol = $_SESSION['rol'];
                    $clients = $client->select("user_table", "1");
                    while($row = mysqli_fetch_array($clients)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $bills = $bill->update("bill_table", $data, "client_id=".$row['id']);
                        }
                    }
                    $billClients = $billClient->select("bill_client_view", "1");
                    require_once("bill_views/index.php");
                }
            }
        }
    }

    static function newBill(){
        session_start();
        $client = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $clientData = $client->select("user_table", "id=".$id);
                require_once("bill_views/new.php");
            }
        }
    }

    static function saveBill(){
        session_start();
        $txtHireDate = $_POST['txtHireDate'];
        $txtInvoice = $_POST['txtInvoice'];
        $txtPackageDescription = $_POST['txtPackageDescription'];
        $txtInitialContractedAmount = $_POST['txtInitialContractedAmount'];
        $txtBalance = $_POST['txtBalance'];
        //$txtEmail = $_POST['txtEmail'];
        $txtState = true;

        $billClient = new Model();
        $bill = new Model();
        $client = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $clientData = $client->select("user_table", "id=".$id);
                $dataBill = "'".$txtHireDate."', ".$txtInvoice.", '".$txtPackageDescription."', "
                            .$txtInitialContractedAmount.", ".$txtBalance.", ".$id.", ".$txtState."";
                $dataBillI = $bill->insert("bill_table", $dataBill);

                if($dataBillI == 1) {
                    $message = "Saved bill successfully";
                    $message_type = "success";
                    require_once("bill_views/new.php");
                } else {
                    $message = "Error: Bill hasn't been saved";
                    $message_type = "danger";
                    require_once("bill_views/new.php");
                }
            }
        }
    }

    static function editBill(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                //$id = $_SESSION['id'];
                $billClient = new Model();
                $billClients = $billClient->select("bill_client_view", "id=".$id);
                require_once("bill_views/edit.php");
            }
        }
    }

    static function updateBill(){
        session_start();
        $txtID = $_POST['txtID'];
        $txtHireDate = $_POST['txtHireDate'];
        $txtInvoice = $_POST['txtInvoice'];
        $txtPackageDescription = $_POST['txtPackageDescription'];
        $txtInitialContractedAmount = $_POST['txtInitialContractedAmount'];
        $txtBalance = $_POST['txtBalance'];
        //$txtEmail = $_POST['txtEmail'];
        $txtState = true;

        $bill = new Model();
        $client = new Model();
        $billClient = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $billClients = $billClient->select("bill_client_view", "client_id=".$id);
                $dataBill = "hire_date = '".$txtHireDate."', invoice = ".$txtInvoice.
                            ", package_description = '".$txtPackageDescription.
                            "', initial_contracted_amount = ".$txtInitialContractedAmount.
                            ", balance = ".$txtBalance.", client_id = ".$id.", state = ".$txtState."";
                $dataBillU = $bill->update("bill_table", $dataBill, "id=".$txtID);

                if($dataBillU == 1) {
                    $message = "Updated bill successfully";
                    $message_type = "success";
                    $billClients = $billClient->select("bill_client_view", "id=".$txtID);
                    require_once("bill_views/edit.php");
                } else {
                    $message = "Error: Event hasn't been updated";
                    $message_type = "danger";
                    $billClients = $billClient->select("bill_client_view", "id=".$txtID);
                    require_once("bill_views/edit.php");
                }
            }
        }
    }

    static function deleteBill(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $txtState = 0;
            $billClient = new Model();
            $bill = new Model();
            $data = "state = ".$txtState;
            $dataBill = $bill->update("bill_table", $data, "id=".$id);
            $billClients = $billClient->select("bill_client_view", "1");
            header("Location:index.php?m=billTable");
        }
    }
    //Bill section end

    //Event section
    static function eventTable(){
        session_start();
        $userEvent = new Model();
        $user = new Model();
        $event = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id']) && isset($_SESSION['rol'])) {
                if($_SESSION['rol'] == "User") {
                    $id = $_SESSION['id'];
                    $rol = $_SESSION['rol'];
                    $users = $user->select("user_table", "id=".$id);
                    while($row = mysqli_fetch_array($users)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $events = $event->update("event_table", $data, "user_id=".$id);
                        }
                    }
                    $userEvents = $userEvent->select("user_event_view", "user_id=".$id);
                    require_once("event_views/index.php");
                } else if($_SESSION['rol'] == "Administrator") {
                    $rol = $_SESSION['rol'];
                    $users = $user->select("user_table", "1");
                    while($row = mysqli_fetch_array($users)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $events = $event->update("event_table", $data, "user_id=".$row['id']);
                        }
                    }
                    $userEvents = $userEvent->select("user_event_view", "1");
                    require_once("event_views/index.php");
                }
            }
        }
    }

    static function newEvent(){
        session_start();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            require_once("event_views/new.php");
        }
    }

    static function saveEvent(){
        session_start();
        $txtName = $_POST['txtName'];
        $txtDate = $_POST['txtDate'];
        $txtLocation = $_POST['txtLocation'];
        $txtEmail = $_POST['txtEmail'];
        $txtState = true;

        $event = new Model();
        $user = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $users = $user->select("user_table", "email = '".$txtEmail."'");
            while($user = mysqli_fetch_array($users)) {
                $dataEvent = "'".$txtName."', '".$txtDate."', '".$txtLocation."', ".$user['id'].", ".$txtState."";
                $dataEventI = $event->insert("event_table", $dataEvent);

                if($dataEventI == 1) {
                    $message = "Saved event successfully";
                    $message_type = "success";
                    require_once("event_views/new.php");
                } else {
                    $message = "Error: Event hasn't been saved";
                    $message_type = "danger";
                    require_once("event_views/new.php");
                }
            }
        }
    }

    static function editEvent(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $userEvent = new Model();
            $userEvents = $userEvent->select("user_event_view", "id=".$id);
            require_once("event_views/edit.php");
        }
    }

    static function updateEvent(){
        session_start();
        $txtID = $_POST['txtID'];
        $txtName = $_POST['txtName'];
        $txtDate = $_POST['txtDate'];
        $txtLocation = $_POST['txtLocation'];
        $txtEmail = $_POST['txtEmail'];
        $txtState = true;

        $event = new Model();
        $user = new Model();
        $userEvent = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $users = $user->select("user_table", "email = '".$txtEmail."'");
            while($user = mysqli_fetch_array($users)) {
                $dataEvent = "name = '".$txtName."', date = '".$txtDate."', location = '".$txtLocation."', user_id = ".$user['id'].", state = ".$txtState."";
                $dataEventU = $event->update("event_table", $dataEvent, "id=".$txtID);

                if($dataEventU == 1) {
                    $message = "Updated event successfully";
                    $message_type = "success";
                    $userEvents = $userEvent->select("user_event_view", "id=".$txtID);
                    require_once("event_views/edit.php");
                } else {
                    $message = "Error: Event hasn't been updated";
                    $message_type = "danger";
                    $userEvents = $userEvent->select("user_event_view", "id=".$txtID);
                    require_once("event_views/edit.php");
                }
            }
        }
    }

    static function deleteEvent(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $txtState = 0;
            $userEvent = new Model();
            $event = new Model();
            $data = "state = ".$txtState;
            $dataEvent = $event->update("event_table", $data, "id=".$id);
            $userEvents = $userEvent->select("user_event_view", "1");
            header("Location:index.php?m=eventTable");
        }
    }
    //Event section end

    //Login section
    static function showLogin(){
        require_once("login.php");
    }

    static function login(){
        session_start();
        $email = (isset($_POST['email']))?$_POST['email']:"";
        $password = (isset($_POST['password']))?$_POST['password']:"";

        $login = new Model();
        $user = new Model();
        $passwordResetTokens = new Model();

        $userData = $user->select("user_table", "email = '".$email."'");
        $userLoggedIn = $login->select("login_table", "1");

        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d');

        if(mysqli_num_rows($userLoggedIn) == 1) {
            if(($email != "") && ($password != "")) {
                $data = "email = '".$email."', password = MD5('".$password."')";
                $logInUpdated = $login->update("login_table", $data, "id = 1");

                if($logInUpdated == 1) {
                    $userLoggedIn = $login->select("login_table", "1");
                    while($user = mysqli_fetch_array($userData)) {
                        while($login = mysqli_fetch_array($userLoggedIn)) {
                            $getPrt = $passwordResetTokens->select("password_reset_tokens_table", "user_id = ".$user['id']);
                            while($prt = mysqli_fetch_array($getPrt)) {
                                if($date < date($prt['expiry_date'])) {
                                    if($user['state'] == 1) {
                                        if(($user['email'] == $login['email']) && ($user['password'] == $login['password'])) {
                                            $_SESSION['user'] = "ok";
                                            $_SESSION['userName'] = $user['name'] . " " . $user['last_name'];
                                            $_SESSION['rol'] = $user['rol'];
                                            $_SESSION['id'] = $user['id'];
                                            header("Location:index.php?m=welcome");
                                        } else {
                                            $message = "Error: Email or password is incorrect";
                                            $message_type = "danger";
                                            require_once("login.php");
                                        }
                                    } else {
                                        $message3 = "Error: The user doesn't exist in the system";
                                        $message_type3 = "danger";
                                        require_once("login.php");
                                    }
                                } else {
                                    $message2 = "Your password has expired";
                                    $message_type2 = "warning";
                                    require_once("login.php");
                                }
                            }
                        }
                    }
                }
            }
        } else {
            if(($email != "") && ($password != "")) {
                $data = "'".$email."', MD5('".$password."')";
                $logInInserted = $login->insert("login_table", $data);


                if($logInInserted == 1) {
                    $userLoggedIn = $login->select("login_table", "1");

                    while($user = mysqli_fetch_array($userData)) {
                        while($login = mysqli_fetch_array($userLoggedIn)) {
                            $getPrt = $passwordResetTokens->select("password_reset_tokens_table", "user_id = ".$user['id']);
                            while($prt = mysqli_fetch_array($getPrt)) {
                                if($date < date($prt['expiry_date'])) {
                                    if(($user['email'] == $login['email']) && ($user['password'] == $login['password'])) {
                                        $_SESSION['user'] = "ok";
                                        $_SESSION['userName'] = $user['name'] . " " . $user['last_name'];
                                        $_SESSION['rol'] = $user['rol'];
                                        $_SESSION['id'] = $user['id'];
                                        header("Location:index.php?m=welcome");
                                    } else {
                                        $message = "Error: Email or password is incorrect";
                                        $message_type = "danger";
                                        require_once("login.php");
                                    }
                                } else {
                                    $message2 = "Your password has expired";
                                    $message_type2 = "warning";
                                    require_once("login.php");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    //Login section end

    //Logout section
    static function logout(){
        session_start();
        session_destroy();
        header("Location:index.php?m=showLogin");
    }
    //Logout section end

    //Password reset token section
    private static function calculateExpiryDate(){
        date_default_timezone_set('America/Mexico_City');
        $date = date('Y-m-d');
        $newDate = strtotime('+1 day', strtotime($date));
        $expiryDate = date('Y-m-d', $newDate);
        return $expiryDate;
    }

    static function showPasswordResetTokens(){
        require_once("password_reset_tokens_views/index.php");
    }

    static function passwordResetTokens(){
        $email = $_POST['txtEmail'];
        $newPassword = $_POST['txtNewPassword'];
        $passwordConfirmation = $_POST['txtPasswordConfirmation'];
        $expiryDate = self::calculateExpiryDate();

        $user = new Model();
        $passwordResetTokens = new Model();
        
        if($newPassword == $passwordConfirmation) {
            $data = "password = MD5('".$newPassword."')";
            $dataUser = $user->update("user_table", $data, "email = '".$email."'");
            $dataUser = $user->select("user_table", "email = '".$email."'");

            while($row = mysqli_fetch_array($dataUser)) {
                $dataPasswordResetTokens = "token = '".$row['token_confirmation']."', user_id = ".$row['id'].", expiry_date = '".$expiryDate."'";
                $prt = $passwordResetTokens->update("password_reset_tokens_table", $dataPasswordResetTokens, "user_id = ".$row['id']."");
            }

            $message = "Change of password was successful";
            $message_type = "success";
            require_once("password_reset_tokens_views/index.php");
        } else {
            $message = "Error: Password and password confirmation are different";
            $message_type = "danger";
            require_once("password_reset_tokens_views/index.php");
        }
    }
    //Password reset token section end

    //Payment section
    static function paymentTable(){
        session_start();
        $payment = new Model();
        $bill = new Model();
        $paymentBill = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id']) && isset($_SESSION['rol'])) {
                if($_SESSION['rol'] == "User") {
                    $id = $_SESSION['id'];
                    $rol = $_SESSION['rol'];
                    $billData = $bill->select("bill_table", "client_id=".$id);
                    while($row = mysqli_fetch_array($billData)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $paymentData = $payment->update("payment_table", $data, "bill_id=".$row['id']);
                        }
                        $paymentBills = $paymentBill->select("payment_bill_view", "bill_id=".$row['id']);
                        require_once("payment_views/index.php");
                    }
                } else if($_SESSION['rol'] == "Administrator"){
                    $rol = $_SESSION['rol'];
                    $billData = $bill->select("bill_table", "1");
                    while($row = mysqli_fetch_array($billData)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $paymentData = $payment->update("payment_table", $data, "bill_id=".$row['id']);
                        }
                    }
                    $paymentBills = $paymentBill->select("payment_bill_view", "1");
                    require_once("payment_views/index.php");
                }
            }
        }
    }

    static function newPayment(){
        session_start();
        $bill = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $bills = $bill->select("bill_table", "client_id=".$id);
                require_once("payment_views/new.php");
            }
        }
    }

    static function savePayment(){
        session_start();
        $txtPaymentDate = $_POST['txtPaymentDate'];
        $txtAmountPaid = $_POST['txtAmountPaid'];
        $txtWayToPay = $_POST['txtWayToPay'];
        $txtBill = $_POST['txtBill'];
        $txtState = true;

        $payment = new Model();
        $bill = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $data = "'".$txtPaymentDate."', ".$txtAmountPaid.", '".$txtWayToPay."', ".$txtBill.", ".$txtState."";
                $paymentDataI = $payment->insert("payment_table", $data);

                if($paymentDataI == 1) {
                    $message = "Saved payment successfully";
                    $message_type = "success";
                    $bills = $bill->select("bill_table", "client_id=".$id);
                    require_once("payment_views/new.php");
                } else {
                    $message = "Error: payment hasn't been saved";
                    $message_type = "danger";
                    $bills = $bill->select("bill_table", "client_id=".$id);
                    require_once("payment_views/new.php");
                }
            }
        }
    }

    static function editPayment(){
        session_start();
        $id = $_GET['id'];
        $paymentBill = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                //$clientId = $_SESSION['id'];
                $paymentBills = $paymentBill->select("payment_bill_view", "id=".$id);
                require_once("payment_views/edit.php");
            }
        }
    }

    static function updatePayment(){
        session_start();
        $txtID = $_POST['txtID'];
        $txtPaymentDate = $_POST['txtPaymentDate'];
        $txtAmountPaid = $_POST['txtAmountPaid'];
        $txtWayToPay = $_POST['txtWayToPay'];
        //$txtBill = $_POST['txtBill'];
        $txtState = true;

        $paymentBill = new Model();
        $payment = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $paymentBillData =  $paymentBill->select("payment_bill_view", "id=".$txtID);

                while($row = mysqli_fetch_array($paymentBillData)) {
                    $data = "payment_date = '".$txtPaymentDate."', amount_paid = ".$txtAmountPaid.", way_to_pay = '".$txtWayToPay."', state = ".$txtState."";
                    $paymentDataU = $payment->update("payment_table", $data, "id=".$txtID);
                    
                    if($paymentDataU == 1) {
                        $message = "Updated payment successfully";
                        $message_type = "success";
                        $paymentBills = $paymentBill->select("payment_bill_view", "id=".$txtID);
                        require_once("payment_views/edit.php");
                    } else {
                        $message = "Error: photography hasn't been updated";
                        $message_type = "danger";
                        $paymentBills = $paymentBill->select("payment_bill_view", "id=".$txtID);
                        require_once("payment_views/edit.php");
                    }
                }
            }
        }
    }

    static function deletePayment(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $txtState = 0;
            $paymentBill = new Model();
            $payment = new Model();
            $data = "state = ".$txtState;
            $payments = $payment->update("payment_table", $data, "id=".$id);
            $paymentBills = $paymentBill->select("payment_bill_view", "1");
            header("Location:index.php?m=paymentTable");
        }
    }
    //Payment section end

    //Photography section
    static function photographyTable(){
        session_start();
        $appointment = new Model();
        $photographyAppointment = new Model();
        $photography = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id']) && isset($_SESSION['rol'])) {
                if($_SESSION['rol'] == "User") {
                    $id = $_SESSION['id'];
                    $rol = $_SESSION['rol'];
                    $appointmentData = $appointment->select("appointment_table", "user_id=".$id);
                    while($row = mysqli_fetch_array($appointmentData)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $photographyData = $photography->update("photography_table", $data, "appointment_id=".$row['id']);
                        }
                    }
                    $photographyAppointments = $photographyAppointment->select("photography_appointment_view", "user_id=".$id);
                    require_once("photography_views/index.php");
                } else if($_SESSION['rol'] == "Administrator"){
                    $rol = $_SESSION['rol'];
                    $appointments = $appointment->select("appointment_table", "1");
                    while($row = mysqli_fetch_array($appointments)) {
                        if($row['state'] == 0) {
                            $data = "state = ".$row['state'];
                            $photographyAppointments = $photographyAppointment->update("photography_table", $data, "appointment_id=".$row['id']);
                        }
                    }
                    $photographyAppointments = $photographyAppointment->select("photography_appointment_view", "1");
                    require_once("photography_views/index.php");
                }
            }
        }
    }

    static function newPhotography(){
        session_start();
        $appointment = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $appointments = $appointment->select("appointment_table", "user_id=".$id);
                require_once("photography_views/new.php");
            }
        }
    }

    static function savePhotography(){
        session_start();
        $txtImageURL = $_FILES['txtImageURL']['name'];
        $txtAppointment = $_POST['txtAppointment'];
        $txtSelected = $_POST['txtSelected'];
        $txtWatermark = $_POST['txtWatermark'];
        $txtBalance = $_POST['txtBalance'];
        $txtState = true;

        $photography = new Model();
        $appointment = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $date = new DateTime();
                $fileName = ($txtImageURL != "")?$date->getTimestamp()."_".$_FILES['txtImageURL']['name']:"image.jpg";

                $tmpImage = $_FILES['txtImageURL']['tmp_name'];

                if($tmpImage != "") {
                    move_uploaded_file($tmpImage, "photographs/".$fileName);
                }

                $appointmentData = $appointment->select("appointment_table", "user_id=".$id);
                while($row = mysqli_fetch_array($appointmentData)) {
                    $data = "'".$fileName."', ".$row['id'].", ".$txtSelected.", ".$txtWatermark.", ".$txtBalance.", ".$txtState."";
                    $photographyDataI = $photography->insert("photography_table", $data);

                    if($photographyDataI == 1) {
                        $message = "Saved photography successfully";
                        $message_type = "success";
                        $appointments = $appointment->select("appointment_table", "user_id=".$id);
                        require_once("photography_views/new.php");
                    } else {
                        $message = "Error: photography hasn't been saved";
                        $message_type = "danger";
                        $appointments = $appointment->select("appointment_table", "user_id=".$id);
                        require_once("photography_views/new.php");
                    }
                }
            }
        }
    }

    static function editPhotography(){
        session_start();
        $id = $_GET['id'];
        $photographyAppointment = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                //$id = $_SESSION['id'];
                $photographyAppointments = $photographyAppointment->select("photography_appointment_view", "id=".$id);
                require_once("photography_views/edit.php");
            }
        }
    }

    static function updatePhotography(){
        session_start();
        $txtID = $_POST['txtID'];
        $txtImageURL = $_FILES['txtImageURL']['name'];
        $txtAppointment = $_POST['txtAppointment'];
        $txtSelected = $_POST['txtSelected'];
        $txtWatermark = $_POST['txtWatermark'];
        $txtBalance = $_POST['txtBalance'];
        $txtState = true;

        $photographyAppointment = new Model();
        $photography = new Model();

        $message = "";
        $message_type = "";

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                if($txtImageURL != "") {
                    $date = new DateTime();
                    $fileName = ($txtImageURL != "")?$date->getTimestamp()."_".$_FILES['txtImageURL']['name']:"image.jpg";
                    $tmpImage = $_FILES['txtImageURL']['tmp_name'];

                    move_uploaded_file($tmpImage, "photographs/".$fileName);

                    $photographyAppointmentData =  $photographyAppointment->select("photography_appointment_view", "id=".$txtID);

                    while($row = mysqli_fetch_array($photographyAppointmentData)) {
                        if(isset($row['image_url']) && $row['image_url'] != "image.jpg") {
                            if(file_exists("photographs/".$row['image_url'])) {
                                unlink("photographs/".$row['image_url']);
                            }
                        }

                        $data = "image_url = '".$fileName."', appointment_id = ".$row['appointment_id'].", selected = ".$txtSelected.", watermark = ".$txtWatermark.", balance = ".$txtBalance.", state = ".$txtState."";
                        $photographyDataU = $photography->update("photography_table", $data, "id=".$txtID);
                        
                        if($photographyDataU == 1) {
                            $message = "Updated photography successfully";
                            $message_type = "success";
                            $photographyAppointments = $photographyAppointment->select("photography_appointment_view", "id=".$txtID);
                            require_once("photography_views/edit.php");
                        } else {
                            $message = "Error: photography hasn't been updated";
                            $message_type = "danger";
                            $photographyAppointments = $photographyAppointment->select("photography_appointment_view", "id=".$txtID);
                            require_once("photography_views/edit.php");
                        }
                    }
                }
            }
        }
    }

    static function deletePhotography(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $txtState = 0;
            $photographyAppointment = new Model();
            $photography = new Model();
            $data = "state = ".$txtState;
            $dataPhotographyAppointment = $photographyAppointment->update("photography_appointment_view", $data, "id=".$id);
            $dataPhotography = $photography->update("photography_table", $data, "id=".$id);
            $dataPhotographyAppointment = $photographyAppointment->select("photography_appointment_view", "1");
            header("Location:index.php?m=photographyTable");
        }
    }
    //Photography section end

    //User section
    static function index(){
        session_start();
        $user = new Model();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            if(isset($_SESSION['id']) && isset($_SESSION['rol'])) {
                if($_SESSION['rol'] == "User") {
                    $id = $_SESSION['id'];
                    $rol = $_SESSION['rol'];
                    $users = $user->select("user_table", "id=".$id);
                    require_once("user_views/index.php");
                } else if($_SESSION['rol'] == "Administrator") {
                    $rol = $_SESSION['rol'];
                    $users = $user->select("user_table", "1");
                    require_once("user_views/index.php");
                }
            }   
        }
    }

    static function newUser(){
        require_once("user_views/new.php");
    }

    static function saveUser(){
        $txtName = $_POST['txtName'];
        $txtLastName = $_POST['txtLastName'];
        $txtEmail = $_POST['txtEmail'];
        $txtPassword = $_POST['txtPassword'];
        $txtTokenConfirmation = $_POST['txtTokenConfirmation'];
        $txtRol = $_POST['txtRol'];
        $txtEnabled = $_POST['txtEnabled'];
        $txtState = true;
        $expiryDate = self::calculateExpiryDate();
        
        $user = new Model();
        $passwordResetTokens = new Model();
        
        $message = "";
        $message_type = "";
        $message2 = "";
        $message_type2 = "";

        $users = $user->select("user_table", "1");

        $count = 0;

        while($row = mysqli_fetch_array($users)) {
            if($row['rol'] == "Administrator") {
                $count++;
            }
        }

        if(($count == 1) && ($txtRol == "Administrator")) {
            $dataUser = "'".$txtName."', '".$txtLastName."', '".$txtEmail."', MD5('".$txtPassword."'), '"
                        .$txtTokenConfirmation."', 'User', ".$txtEnabled.", ".$txtState."";
            $dataUserI = $user->insert("user_table", $dataUser);

            if($dataUserI == 1) {
                $userData = $user->select("user_table", "email = '".$txtEmail."'");
                while($row = mysqli_fetch_array($userData)) {
                    $dataPrt = "'".$txtTokenConfirmation."', ".$row['id'].", '".$expiryDate."'";
                    $dataPrtI = $passwordResetTokens->insert("password_reset_tokens_table", $dataPrt);
                }

                $message = "Registration Successful";
                $message2 = "There is an Administrator in the system";
                $message_type = "success";
                $message_type2 = "warning";
                require_once("user_views/new.php");
            } else {
                $message = "Registration Error";
                $message_type = "danger";
                require_once("user_views/new.php");
            }
        } else if(($count == 0) && ($txtRol == "Administrator")) {
            $dataUser = "'".$txtName."', '".$txtLastName."', '".$txtEmail."', MD5('".$txtPassword."'), '"
                        .$txtTokenConfirmation."', '".$txtRol."', ".$txtEnabled.", ".$txtState."";
            $dataUserI = $user->insert("user_table", $dataUser);

            if($dataUserI == 1) {
                $userData = $user->select("user_table", "email = '".$txtEmail."'");
                while($row = mysqli_fetch_array($userData)) {
                    $dataPrt = "'".$txtTokenConfirmation."', ".$row['id'].", '".$expiryDate."'";
                    $dataPrtI = $passwordResetTokens->insert("password_reset_tokens_table", $dataPrt);
                }

                $message = "Registration Successful";
                $message2 = "You are an Administrator";
                $message_type = "success";
                $message_type2 = "info";
                require_once("user_views/new.php");
            } else {
                $message = "Registration Error";
                $message_type = "danger";
                require_once("user_views/new.php");
            }
        } else {
            $dataUser = "'".$txtName."', '".$txtLastName."', '".$txtEmail."', MD5('".$txtPassword."'), '"
                        .$txtTokenConfirmation."', '".$txtRol."', ".$txtEnabled.", ".$txtState."";
            $dataUserI = $user->insert("user_table", $dataUser);

            if($dataUserI == 1) {
                $userData = $user->select("user_table", "email = '".$txtEmail."'");
                while($row = mysqli_fetch_array($userData)) {
                    $dataPrt = "'".$txtTokenConfirmation."', ".$row['id'].", '".$expiryDate."'";
                    $dataPrtI = $passwordResetTokens->insert("password_reset_tokens_table", $dataPrt);
                }

                $message = "Registration Successful";
                $message2 = "You are a User";
                $message_type = "success";
                $message_type2 = "info";
                require_once("user_views/new.php");
            } else {
                $message = "Registration Error";
                $message_type = "danger";
                require_once("user_views/new.php");
            }
        }
    }

    static function editUser(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $user = new Model();
            $dataUser = $user->select("user_table", "id=".$id);
            require_once("user_views/edit.php");
        }
    }

    static function updateUser(){
        session_start();
        $txtID = $_POST['txtID'];
        $txtName = $_POST['txtName'];
        $txtLastName = $_POST['txtLastName'];
        $txtEmail = $_POST['txtEmail'];
        $txtRol = $_POST['txtRol'];
        $txtEnabled = $_POST['txtEnabled'];
        $txtState = true;
        
        $user = new Model();
        
        $message = "";
        $message_type = "";
        $message2 = "";
        $message_type2 = "";

        $count = 0;

        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $users = $user->select("user_table", "1");

            while($row = mysqli_fetch_array($users)) {
                if($row['rol'] == "Administrator") {
                    $count++;
                }
            }

            if(($count == 1) && ($txtRol == "Administrator")) {
                $data = "name = '".$txtName."', last_name = '".$txtLastName."', email = '".$txtEmail
                        ."', rol = 'User', enabled = ".$txtEnabled.", state = ".$txtState."";
                $dataUser = $user->update("user_table", $data, "id=".$txtID);

                if($dataUser == 1) {
                    $message = "Update has been Successful";
                    $message2 = "There is an Administrator in the system";
                    $message_type = "success";
                    $message_type2 = "warning";
                    $dataUser = $user->select("user_table", "id=".$txtID);
                    require_once("user_views/edit.php");
                } else {
                    $message = "Update Error";
                    $message_type = "danger";
                    $dataUser = $user->select("user_table", "id=".$txtID);
                    require_once("user_views/edit.php");
                }
            } else if(($count == 0) && ($txtRol == "Administrator")) {
                $data = "name = '".$txtName."', last_name = '".$txtLastName."', email = '".$txtEmail
                        ."', rol = '".$txtRol."', enabled = ".$txtEnabled.", state = ".$txtState."";
                $dataUser = $user->update("user_table", $data, "id=".$txtID);

                if($dataUser == 1) {
                    $message = "Update has been Successful";
                    $message2 = "You are an Administrator";
                    $message_type = "success";
                    $message_type2 = "info";
                    $dataUser = $user->select("user_table", "id=".$txtID);
                    require_once("user_views/edit.php");
                } else {
                    $message = "Update Error";
                    $message_type = "danger";
                    $dataUser = $user->select("user_table", "id=".$txtID);
                    require_once("user_views/edit.php");
                }
            } else {
                $data = "name = '".$txtName."', last_name = '".$txtLastName."', email = '".$txtEmail
                        ."', rol = '".$txtRol."', enabled = ".$txtEnabled.", state = ".$txtState."";
                $dataUser = $user->update("user_table", $data, "id=".$txtID);

                if($dataUser == 1) {
                    $message = "Update has been Successful";
                    $message2 = "You are a User";
                    $message_type = "success";
                    $message_type2 = "info";
                    $dataUser = $user->select("user_table", "id=".$txtID);
                    require_once("user_views/edit.php");
                } else {
                    $message = "Update Error";
                    $message_type = "danger";
                    $dataUser = $user->select("user_table", "id=".$txtID);
                    require_once("user_views/edit.php");
                }
            }
        }
    }

    static function deleteUser(){
        session_start();
        $id = $_GET['id'];
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else {
            $txtState = 0;
            $user = new Model();
            $event = new Model();
            $data = "state = ".$txtState;
            $dataUser = $user->update("user_table", $data, "id=".$id);
            $dataEvent = $event->update("event_table", $data, "user_id=".$id);
            $users = $user->select("user_table", "1");
            header("Location:index.php?m=index");
        }
    }
    //User section end

    //Welcome section
    static function welcome(){
        session_start();
        if(!isset($_SESSION['user'])) {
            header("Location:index.php?m=showLogin");
        } else if($_SESSION['user'] == "ok") {
            if(isset($_SESSION['userName']) && isset($_SESSION['rol']) && isset($_SESSION['id'])) {
                if($_SESSION['rol'] == "Administrator") {
                    $userName = $_SESSION['userName'];
                    $rol = "an " . $_SESSION['rol'];
                    require_once("welcome.php");
                } else if($_SESSION['rol'] == "User") {
                    $userName = $_SESSION['userName'];
                    $rol = "an " . $_SESSION['rol'];
                    require_once("welcome.php");
                }
            }
        }
    }
    //Welcome section end
}

?>