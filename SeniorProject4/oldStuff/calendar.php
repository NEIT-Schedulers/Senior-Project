<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<?php

    date_default_timezone_set('America/New_York');



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
    $dayOfWeekNum = date('w');
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

    <p id="timeInfo"></p>
    <button id="saveBtn" type="submit" onclick="calendarInformation()">Time Info</button>

    <script>

        function calendarInformation() {
            if(document.getElementById("timeInfo").innerHTML === "")
            {
                document.getElementById("timeInfo").innerHTML = "<?php echo "Current date: " . date('n') . "/" . date('j') . "/" . date('Y') . "<br>"; ?>";
                document.getElementById("timeInfo").innerHTML += "<?php echo "Day of week: $dayOfWeek<br>"; ?>";
                document.getElementById("timeInfo").innerHTML += "<?php echo "Day of week as a number(0-6, 0 being monday 6 being saturday): $dayOfWeekNum<br>"; ?>";
                document.getElementById("timeInfo").innerHTML += "<?php echo "Last day of the month: $lastDayOfMonthNum<br>"; ?>";
                document.getElementById("timeInfo").innerHTML += "<?php echo "Last day of month($date): $lastDayOfMonthAsDay<br>"; ?>";
                document.getElementById("timeInfo").innerHTML += "<?php echo "$leapYear<br>"; ?>";
                document.getElementById("timeInfo").innerHTML += "<?php echo "Day of current month($dayOfCurrentMonth): $firstDayOfMonthNum"; ?>";
                document.getElementById("timeInfo").display = "block";
                document.getElementById("timeInfo").style = "border:2px solid black;width:425px;margin-left:auto;margin-right:auto;";
            }
            else{
                document.getElementById("timeInfo").innerHTML = "";
                document.getElementById("timeInfo").display = "none";
                document.getElementById("timeInfo").style = "border:0px solid black;width:425px;margin-left:auto;margin-right:auto;";
            }
        }

        // document.getElementById("timeInfo").innerHTML = "<?php echo "Current date: " . date('n') . "/" . date('j') . "/" . date('Y') . "<br>"; ?>";
        // document.getElementById("timeInfo").innerHTML += "<?php echo "Day of week: $dayOfWeek<br>"; ?>";
        // document.getElementById("timeInfo").innerHTML += "<?php echo "day of week as a number(0-6, 0 being monday 6 being saturday): $dayOfWeekNum<br>"; ?>";
        // document.getElementById("timeInfo").innerHTML += "<?php echo "last day of the month: $lastDayOfMonthNum<br>"; ?>";
        // document.getElementById("timeInfo").innerHTML += "<?php echo "last day of month($date): $lastDayOfMonthAsDay<br>"; ?>";
        // document.getElementById("timeInfo").innerHTML += "<?php echo "$leapYear<br>"; ?>";
        // document.getElementById("timeInfo").innerHTML += "<?php echo "day of current month($dayOfCurrentMonth): $firstDayOfMonthNum"; ?>";
    </script>


<?php

if(!isset($_GET['setDay']))
{

    ?>
    <div id="calender">
        <center>
            <h2><?php echo $year; ?></h2>
            <h1><?php echo date('F', strtotime($year . '-' . $month . '-01')) ?></h1>
        </center>

        <!-- Reduce calendar one month -->
        <a href="?setMonth=<?php
        

            $setMonth = date('n', strtotime($year . "-" . $month . '-01 - 1 month'));
            echo $setMonth;

            if($month == 1)
            {
                $setYear = date('Y', strtotime($year . "-" . $month . '-01 - 1 month'));
                echo "&setYear=$setYear";
            }
            else{
                echo "&setYear=$year";
            }
        
        ?>" class="prevBtn">Previous Month</a>

        <!-- Advance calendar one month -->
        <a href="?setMonth=<?php 
        
            $setMonth = date('n', strtotime($year . "-" . $month . '-01 + 1 month'));
            echo $setMonth;

            if($month == 12)
            {
                $setYear = date('Y', strtotime($year . "-" . $month . '-01 + 1 month'));
                echo "&setYear=$setYear";        
            }
            else{
                echo "&setYear=$year";
            }

        ?>" class="nextBtn">Next Month</a>


        <table style="width:100%;">

            <tr>

                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>

            </tr>

            <tr>

                <?php

                    if($dayOfWeekNum != 0)
                    {
                        printFirstWeek($firstDayOfMonthNum);
                        $count = $firstDayOfMonthNum;
                        for($i = 1; $i <= $lastDayOfMonthNum; $i++)
                        {
                            if($count == 7)
                            {
                                $count = 0;

                                ?>

                                    </tr>
                                    
                                    <tr>

                                <?php
                            }

                            ?>

                                <td class="calendarTD" onclick="location.href='appointments.php?setMonth=<?php echo $month; ?>&setYear=<?php echo $year; ?>&setDay=<?php echo $i; ?>'" style="cursor:pointer;"><?php echo $i; ?></td>

                            <?php

                            $count++;
                            // echo $count;
                        }

                        printLastWeek($count);
                    }

                ?>

            </tr>






        </table>
    <!-- Ends calendar div -->
    </div>
<?php
}
else{
    ?>
    <br><br>
    <a href="?setMonth=<?php echo $month; ?>&setYear=<?php echo $year; ?>" style="border:1px solid turquoise;background-color:turquoise;padding:5px;text-decoration:none;color:white;">Back</a>
    <h2>Specific day.</h2>
    <?php
    echo $month . "-" . $day . "-" . $year;


}
?>

<?php

    function printFirstWeek($dayOfWeekNum)
    {
        $lastDayLastMonth = date("j", strtotime("last day of previous month"));

        $lastDayLastMonth -= $dayOfWeekNum - 1;

        if($dayOfWeekNum > 0)
        {
            for($i = $dayOfWeekNum - 1; $i != -1; $i--)
            {
                ?>
                    <td class="calendarTDInactive"><?php echo $lastDayLastMonth; ?></td>
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

                <td class="calendarTDInactive"><?php echo $dayThing; ?></td>

            <?php
            $dayThing += 1;
        }
    }

?>
</body>
</html>