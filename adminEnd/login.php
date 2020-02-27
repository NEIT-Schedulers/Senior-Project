<?php

    session_start();

?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <title>Owner Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        
        
        <style>
        
        
        
        @media screen and (min-width: 400px) {
            .ownerLoginDiv {
                width:100%;
            }
            .emailLogin
            {
                font-size:40px;k
            }
            .registerLink
            {
                font-size:32px;
            }
        
        }
    
        @media screen and (min-width: 1000px) {
            .ownerLoginDiv {
                width:50%;
            }
            .emailLogin
            {
                font-size:24px;
            }
            .registerLink
            {
                font-size:16px;
            }
        }
        
        </style>
        
        
        
    </HEAD>
    <BODY>
        <?php
        
            if(isset($_SESSION['ownerLogin']))
            {
                ?>
                <meta http-equiv="Refresh" content="0; url=../index.php?action=ownerLanding" />
                <?php
            }
        
        ?>
        <div class="row">
            
            <div class="col-xs-1 col-sm-1 col-md-2 col-lg-3">
                
            </div>
            
            <!--content-->
            <div class="col-xs-10 col-sm-10 col-md-8 col-lg-6">
                <br>
                <h2 style="text-align:center;">Scheduler's Login</h2>
                <br>
                
                <form action="../index.php" method="post">
                    
                    <input type="text"      class="emailLogin" name="email" pattern="[A-z,0-9]{2,}@[A-z]{2,}.[A-z]{2,}" title="example@email.com" placeholder="email" value="" tabIndex=1 required>
                    <br><br>
                    
                    <input type="password"  class="emailLogin" name="password"          placeholder="password" tabIndex=2 required />
                    <br><br><br>
                    
                    
                    
                    <!--Submit button-->
                    <button type="submit" id="submitBtnLogin" class="emailLogin" name="action" value="loginOwner" >Login</button><br>
                    <a href="registerForm.php" class="registerLink">No account? Click here to register</a>
                    
                </form>
            </div>
            
            <div class="col-xs-1 col-sm-1 col-md-2 col-lg-3">
                
            </div>
            
        </div>
       
        
        <p class="errorMSGLogin"><?php   echo $_SESSION['errorMSG'];     ?></p>
        <!--<p class="errorMSGLogin"><?php   //echo $_SESSION['ownerID'];     ?></p>-->
        <?php $_SESSION['errorMSG'] = ""; ?>
        
    </BODY>
</HTML>