<nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
            <a class="navbar-brand" style="" href="?action=index">Schedulers</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <?php 
                //$link = $_SERVER['HTTP_HOST'];
                /*$link = $_SERVER['PHP_SELF'];
                $link = str_replace("/z.etc/bootstraptest/index.php", "", $link);
                echo $link;*/
            ?>
            <li<?php
                if($action == "index")
                { 
                    echo "  class=\"active\"";
                }
                else 
                { 
                    echo "";
                } 
                ?>><a id="headerLinkButtons" href="?action=index" style="opacity:1;transition:0.3s;">Home</a></li>
            
            <!--<li<?php
                if($action == "aboutUs")
                { 
                    echo " class=\"active\"";
                }
                else 
                { 
                    echo "";
                } 
                ?>
                ><a id="headerLinkButtons" href="?action=aboutUs" style="opacity:1;transition:0.3s;">Fortnite API</a></li>-->

            <li<?php
                if($action == "shop")
                { 
                    echo " class=\"active\"";
                }
                else 
                { 
                    echo "";
                } 
                ?>
                ><a id="headerLinkButtons" href="?action=shop" style="opacity:1;transition:0.3s;"></a></li>

            <!-- Photography -->
            <li class="dropdown">
                <a  id="headerLinkButtons" class="dropdown-toggle" data-toggle="dropdown" href="#" style="opacity:1;transition:0.3s;">Profile
                <span class="caret"></span></a>

                <ul class="dropdown-menu">

                    <li<?php
                        if($action == "userSettings")
                        { 
                            echo " class=\"active\"";
                        }
                        else 
                        { 
                            echo "";
                        } 
                        ?>
                        ><a id="headerLinkButtons" href="?action=userSettings" style="opacity:1;transition:0.3s;">User Settings</a></li>

                        <li><a id="headerLinkButtons" href="logout.php" style="opacity:1;transition:0.3s;">Logout</a></li>
                        
                        </ul>
                        
            </li>
            
            
            
            
            
        </div>
      </div>
    </nav>
