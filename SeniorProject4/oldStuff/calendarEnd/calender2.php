<div id="calender" style="border:1px solid black;width:500px;">
    
    <?php
    
        $month = date('F');
        $year = date('Y');
        $day = date('d');
        
        // echo $month;
        // echo $year;
        // echo $day;
    
    ?>
    
    <h2><?php echo $month . " " . $year  ?></h2>
    
    <?php
    
    $month += 1; echo $month;
    
    ?>
    
</div>