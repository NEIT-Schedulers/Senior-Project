
    <?php
        include_once("header.php");
        include_once("../Mobile-Detect-2.8.33/Mobile_Detect.php");
        $detect = new Mobile_Detect();
        ?> 
        <p style="text-align:center;min-width:100px;">Scheduly makes it easy to create applications utilizing your schedules already stored here.</p>
        <?php

        if($detect->isMobile())
        {
            ?>

                <center>

                    <a href="adminEnd/RestWiki.pdf">Click here to download resume PDF.</a>

                </center>

            <?php
        }
        else{ 
        ?>
            <center>
                <a href="adminEnd/RestWiki.pdf">Click here to download resume PDF.</a>
            </center>
    
            <div id="pdfDiv">
        
                <embed src="adminEnd/RestWiki.pdf" type="application/pdf" height=1000px width=100% class="responsive">
        
            </div>
        <?php
        }

    ?>

    <br><br>