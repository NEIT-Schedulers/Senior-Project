
    
    <span class="calendarLogin">Looking for admin sign in? <a href="https://chrispeloso.com/SeniorProject4/" class="click"> Click here</a></span>


    <!--Search bar-->
    <div id="calendarBusinessSearchDiv">
        
        <form action="https://chrispeloso.com/SeniorProject4/index.php" method="GET" class="searchForm">
            
            <input type="input" class="calendarBusinessSearchInput" name="searchParameters" placeholder="Search for a business...">
            
            <button type="submit" id="btnSearchParameters" name="action" value="submitBusinessSearch">Search</button>
            
        </form>    
        
    </div>
    
    <br>

<center>
<div id="calendar">
    <center>
        <h3 class="calendarYear"><?php echo $year; ?></h2>
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
    
    ?>" class="prevBtn calendarBtn"><</a>

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

    ?>" class="nextBtn calendarBtn">></a>


    <table class="calendarTable">

        <tbody><tr>

            <th><div class="calendarTH">Sunday</div></th>
            <th><div class="calendarTH">Monday</div></th>
            <th><div class="calendarTH">Tuesday</div></th>
            <th><div class="calendarTH">Wednesday</div></th>
            <th><div class="calendarTH">Thursday</div></th>
            <th><div class="calendarTH">Friday</div></th>
            <th><div class="calendarTH">Saturday</div></th>

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
                            <td onclick="location.href='?businessID=<?php echo $businessID; ?>&setMonth=<?php echo $month; ?>&setYear=<?php echo $year; ?>&setDay=<?php echo $i; ?>'" style="cursor:pointer;">
                                <div class="calendarTD"><?php echo $i; ?></div>
                            </td>

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
    </tbody>
</table>

<!-- Ends calendar div -->
</div>
</center>
        
    
