
<?php

    date_default_timezone_set('America/New_York');

    $businessID = $_GET['businessID'];


    if(isset($_GET['setMonth']))
    {
        $month = $_GET['setMonth'];
    }
    else{
        $month = date('n');
    }
    
    // $month = date('n');
    if(isset($_GET['setYear']))
    {
        $year = $_GET['setYear'];
    }
    else{
        $year = date('Y');
    }
    
    // $year = date('Y');
    if(isset($_GET['setDay']))
    {
        $day = $_GET['setDay'];
    }
    else{
        $day = date('d');
    }
    
    
    
    $dayOfWeek = date('l');
    $dayOfWeekNum = date('d');
    $lastDayOfMonthNum = date('t' , strtotime($year . "-" . $month . "-01"));
    
    
    
    // $firstDayOfMonthNum = ;
    // echo $firstDayOfMonthNum;
    // $firstDayOfMonthNum = date('');
    // echo "<br>First day of prevous month: ";
    // echo date("Y-n-j", strtotime("first day of previous month"));
    // echo "<br>Last day of previous month: ";
    // echo date("Y-n-j", strtotime("last day of previous month"));
    // $lastDayLastMonth = date("j", strtotime("last day of previous month"));
    // echo "<br>";
    // echo "Day itself: " . $lastDayLastMonth;
    // echo "<br><br>";
    
    
    
    $date = $year . "-" . $month . "-01";
    $lastDayOfMonthAsDay = date('l', strtotime($date));
    $firstDayOfMonthNum = date("w", strtotime($year . "-" . $month . "-01"));

    $dayOfCurrentMonth = date("l", strtotime($year . "-" . $month . "-01"));

    
    if(2020 % 4 != 0)
    {
        $leapYear = "This year is not a leap year.";
    }
    else{
        $leapYear = "This year is a leap year.";
    }

    ?>



<?php
    
    // Shows the calendar per month
    if(!isset($_GET['setDay']))
    {
        include_once('calendarFull.php');
    }
    
    // Shows the calendar per day
    else
    {
        include_once('calendarPerDay.php');
    }
    
    
    

    function printFirstWeek($dayOfWeekNum)
    {
        $lastDayLastMonth = date("j", strtotime("last day of previous month"));

        $lastDayLastMonth -= $dayOfWeekNum - 1;

        if($dayOfWeekNum > 0)
        {
            for($i = $dayOfWeekNum - 1; $i != -1; $i--)
            {
                ?>
                    <td><div class="calendarTDInactive"><?php echo $lastDayLastMonth; ?></div></td>
                <?php
                $lastDayLastMonth += 1;
            }
        }

    }

    function printLastWeek($count)
    {
        $dayThing = 1;
        for($i = $count; $i < 7; $i++)
        {
            ?>

                <td><div class="calendarTDInactive"><?php echo $dayThing; ?></div></td>

            <?php
            $dayThing += 1;
        }
    }

?>
