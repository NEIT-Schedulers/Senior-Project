<?php

    $action = $_GET['action'];
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
    }
    elseif(isset($_POST['action']))
    {
        $ction = $_POST['action'];
    }

    switch($action)
    {
        case "submitBusinessSearch":
            include_once('adminEnd/submitBusinessSearch.php');
            break;
            
        default:
            include_once('calendarEnd/calendar.php');
            break;
    }








?>