<?php

        $action = $_POST['action'];
        
        if($_GET['action'] != null)
        {
            $action = $_GET['action'];
        }
        
        if($_SESSION['ownerLogin'] == false)
        {
            ?>
            <meta http-equiv="Refresh" content="0; url=adminEnd/login.php" />
            <?php
        }
        
        
        switch($action)
        {
            case "about":
                include_once('adminEnd/header.php');
                include_once('adminEnd/about.php');
                break;
                
            // adding a service for a business
            case "addBusinessServices":
                include_once('adminEnd/addBusinessServices.php');
                break;
            
            case "addBusinessPractitioner":
                include_once('adminEnd/addBusinessPractitioner.php');
                break;
                
            case "businessSettings":
                include_once('adminEnd/header.php');
                include_once('adminEnd/businessSettings.php');
                break;
                
            case "calendar":
                ?>
                <meta http-equiv="Refresh" content="0; url=?businessID=<?php echo $_SESSION['ownerID']; ?>" />
                <?php
                break;
                
            case "login":
                include_once('adminEnd/login.php');
                break;
                
            case "loginOwner":
                include_once('adminEnd/signOwnerIn.php');
                break;
            
            case "logout":
                include_once('adminEnd/logout.php');
                break;
            
            case "ownerLanding":
                include_once('adminEnd/header.php');
                include_once('adminEnd/ownerLanding.php');
                break;
                
            case "registerOwner":
                include_once('adminEnd/register.php');
                break;
                
            case "updateBusinessHours":
                include_once('adminEnd/updateBusinessHours.php');
                break;
                
            case "updateBusinessOwnerName":
                include_once('adminEnd/updateBusinessOwnerName.php');
                break;
                
            default:
                if(isset($_SESSION['ownerLogin']))
                {
                    $ownerID = $_SESSION['ownerLogin'];
                    
                    include_once('adminEnd/header.php');
                    include_once('adminEnd/ownerLanding.php');
                }
                else
                    {
                     ?>
                     <meta http-equiv="Refresh" content="0; url=adminEnd/login.php" />
                     <?php
                }
                break;
        }
        
?>