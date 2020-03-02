<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="calendarEnd/stylesheet.css">
</head>
<body>
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


    <!--Time info things.-->
    <p id="timeInfo"></p>
    <!--<button id="saveBtn" type="submit" onclick="calendarInformation()">Time Info</button>-->
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
    
    <a href="https://chrispeloso.com/SeniorProject4/" class="calendarLogin">Looking for admin sign in? Click here.</a>


    <!--Search bar-->
    <div id="calendarBusinessSearchDiv">
        
        <form action="index.php" method="GET">
            
            <input type="input" class="calendarBusinessSearchInput" name="searchParameters" placeholder="Search for a business..." />
            
            <button type="submit" id="btnSearchParameters" name="action" value="submitBusinessSearch">Search</button>
            
        </form>    
        
    </div>
    
    <br>


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