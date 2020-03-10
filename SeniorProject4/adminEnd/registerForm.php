<?php

    session_start();

?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <title>Owner Register</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </HEAD>
    <BODY>
        <?php $_SESSION['errorMSGLogin'] = ""; ?>
        <div class="ownerLoginDiv" style="margin-top:-65px;">
            <h2 style="text-align:center;font-family:'Harlow Solid', arial;font-size:48px;">Scheduly</h2>
            <h3 class="loginH3" style="font-family: arial;font-size:24px;font-weight:normal;">Register</h3>
            <br>
            
            <form action="../index.php" method="post">
                
                
                <input type="text"      class="emailLogin" name="email" pattern="[A-z,0-9]{2,}@[A-z]{2,}.[A-z]{2,}" title="example@email.com" placeholder="email" value="" tabIndex=1 required>
                <br><br>
                
                <input type="text"      class="emailLogin" name="businessName"          placeholder="Business Name"         tabIndex=2 required />
                <br><br>
                
                <input type="password"  class="emailLogin" name="password"              placeholder="password"              tabIndex=3 required />
                <br><br>
                
                <input type="text"      class="emailLogin" name="ownerFirstName"        placeholder="first name"            tabIndex=4 required />
                <br><br>
                
                <input type="text"      class="emailLogin" name="ownerLastName"         placeholder="last name"             tabIndex=5 required />
                <br><br>
                
                <input type="text"      class="emailLogin" name="ownerPhone"            placeholder="phone number"          tabIndex=6 required />
                <br><br>
                
                <label class="registerLabel">Opening Hour</label>
                <input type="time"      class="emailLogin" name="openingHour"           placeholder="Opening Hour"          tabIndex=7 required />
                <br><br>
                
                <label class="registerLabel">Closing Hour</label>
                <input type="time"      class="emailLogin" name="closingHour"           placeholder="Closing Hour"          tabIndex=8 required />
                <br><br>
                
                
                
                <br><br><br>
                <!--Submit button-->
                <button type="submit" class="emailLogin" name="action" value="registerOwner" >Register</button><br>
                <a href="login.php" class="registerLink">Already have an account? Click here to login</a>
                

                
                
                
                
            </form>
            
            
            
        </div>
        
    </BODY>
</HTML>