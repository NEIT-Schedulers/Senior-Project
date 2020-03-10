<div id="calendar">
    <center>
        <h2 class="calendarYear"><?php echo $year; ?></h2>
        <h1 class="calendarYear"><?php echo date('F', strtotime($year . '-' . $month . '-01')) ?></h1>
    </center>

    <!-- Reduce calendar one month -->
    <a href="?businessID=<?php echo $businessID; ?>&setMonth=<?php
    

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
    <a href="?businessID=<?php echo $businessID; ?>&setMonth=<?php 
    
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


    <table class="calendarTable">

        <tr>

            <th class="calendarTH">Sunday</th>
            <th class="calendarTH">Monday</th>
            <th class="calendarTH">Tuesday</th>
            <th class="calendarTH">Wednesday</th>
            <th class="calendarTH">Thursday</th>
            <th class="calendarTH">Friday</th>
            <th class="calendarTH">Saturday</th>

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

                            <td class="calendarTD" onclick="location.href='?businessID=<?php echo $businessID; ?>&setMonth=<?php echo $month; ?>&setYear=<?php echo $year; ?>&setDay=<?php echo $i; ?>'" style="cursor:pointer;"><?php echo $i; ?></td>

                        <?php

                        $count++;
                        // echo $count;
                    }

                    printLastWeek($count);
                }
                else
                {
                    echo "<p style='color:red;'>There was an error.";
                }

            ?>

        </tr>






    </table>
<!-- Ends calendar div -->
</div>