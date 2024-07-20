<?php

require_once("controllers/index.php");

if(isset($_GET['m'])):
    if(method_exists("modelController", $_GET['m'])):
        modelController::{$_GET['m']}();  
    endif;
else:
    modelController::index();
endif;

?>