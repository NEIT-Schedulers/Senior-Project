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
    $day = date('d');
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

    echo "Current date: ";
    echo $month;
    echo "/";
    echo $day;
    echo "/";
    echo $year;
    echo "<br>";
    echo "day of week: ";
    echo $dayOfWeek;
    echo "<br>";
    echo "day of week as a number(0-6, 0 being monday 6 being saturday): $dayOfWeekNum";
    echo "<br>";
    echo "last day of the month: $lastDayOfMonthNum";
    echo  "<br>";
    $date = $year . "-" . $month . "-01";
    echo "last day of month($date): " . date('l', strtotime($date));
    echo "<br>";

    if(2020 % 4 != 0)
    {
        echo "This year is not a leap year.";
    }
    else{
        echo "This year is a leap year.";
    }



    echo "<br>First day of current month(" . date("l", strtotime($year . "-" . $month . "-01")) . "): ";
    $firstDayOfMonthNum = date("w", strtotime($year . "-" . $month . "-01"));
    echo $firstDayOfMonthNum;



    
?>


<div id="calender" style="width:75%;margin-left:12%;border:1px solid black;">
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

                            <td class="calendarTD"><?php echo $i; ?></td>

                        <?php

                        $count++;
                        // echo $count;
                    }

                    printLastWeek($count);
                }

            ?>

        </tr>






    </table>

</div>

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