<!--the back button-->
<br><br>
<a href="?businessID=<?php echo $businessID; ?>&setMonth=<?php echo $month; ?>&setYear=<?php echo $year; ?>" class="button">Return to Calendar</a>
<br><br>

<?php 

    $dayOfCurrentMonth = date("l", strtotime($year . "-" . $month . "-" . $day));

    $dateThing = $year . "-" . $month . "-" . $day;
    
    
    // Pulls services for the business
    include_once('../adminEnd/db.php');
    include_once('../adminEnd/Classes/Services.php');
    $service = new Services($db);
    $results = $service->pullServices($businessID);
    // print_r($results);
    
    
    // Pulls practitioners for the business
    include_once('../adminEnd/Classes/Practitioners.php');
    $practitioner = new Practitioners($db);
    $resultsPractitioners = $practitioner->pullPractitioners($businessID);
    // print_r($resultsPractitioners);
    
    // Pulls appointments thing
    include_once('../adminEnd/db.php');
    include_once('../adminEnd/Classes/Appointments.php');
    $appointment = new Appointments($db);
    
    $allAppointmentsToday = $appointment->readInnerJoinBusinessIDWithPracID($_GET['businessID'], $dateThing);
    // print_r($allAppointmentsToday);
?>





<br>

<div id="appointmentSchedulerDiv">
    <h4 class="heading">Add Appointment</h4>
    <form action="index.php" method="POST" class="appointmentSchedulerForm">
    
        <!--Lists all the different service types-->
        <!--<select id="servicesListing" onchange="serviceChange(this.value)" name="serviceID">-->
        <div class="formEntry">
            <label for="servicesListing">Service: </label>
            <select id="servicesListing" class="entry" name="serviceID">
              <?php
              
                foreach($results as $re)
                {
                    ?>
                    
                        <option value="<?php echo $re['serviceID']; ?>"><?php echo $re['serviceName']; ?></option>
                    
                    <?php
                }
              
              ?>
            </select>
        </div>
    
        <!--Practitioner selecter-->
        <div class="formEntry">
        <label for="practitionersListing">Practitioner: </label>
        <select id="practitionersListing" class="entry" onchange="practitionerChange(this.value)" name="practitionerID">
            
            <?php
          
            foreach($resultsPractitioners as $re)
            {
                ?>
                
                    <option value="<?php echo $re['practitionerID']; ?>"><?php echo $re['practitionerFirstName'] . " " . $re['practitionerLastName']; ?></option>
                
                <?php
            }
          
          ?>
            
        </select>
        </div>
    
        <div class="formEntry">
        <label for="firstName">First Name: </label>
        <input type="text"  id="firstName"  class="entry"  name="clientFirstName"   placeholder="First Name"                                                        tabIndex=1 />
        </div>
        <div class="formEntry">
        <label for="lastName">Last Name: </label>
        <input type="text"  id="lastName"  class="entry"  name="clientLastName"    placeholder="Last Name"                                                         tabIndex=2 />
        </div>
        <div class="formEntry">
        <label for="email">Email: </label>
        <input type="text"   id="email"   name="clientEmail"    class="entry"   placeholder="Email"         pattern="[A-z,0-9]{2,}@[A-z]{2,}.[A-z]{2,}"         tabIndex=3 />
        </div>
        <div class="formEntry">
        <label for="phone">Phone: </label>
        <input type="text"   id="phone"   name="clientPhone"    class="entry"   placeholder="Phone"                                                             tabIndex=4 />
        </div>
        
        <!--Sends the date-->
        <input type='hidden'    name="appointmentDate"                  value="<?php echo $dateThing; ?>"/> 
        
        <!--Sends the business ID-->
        <input type='hidden'    name="businessID"                       value="<?php echo $_GET['businessID']; ?>"/> 
        
        <div class="formEntry">
        <label for="date">Date: </label>
        <input type="time"   id="date" class="entry"  name="appointmentTime" />
        </div>
        
        <div class="formEntry">
        <button type="submit" id="btnAppointmentSet" name="action" value="submitAppointment" >Set Appointment</button><br>
        </div>

        <div class="formEntry"></div>
        
        
    </form>
    
    <br>
    <br>

    <h4 class="heading">Appointments Scheduled</h4>
    <br>
    <?php
    
        
        if(isset($_GET['returnStatement']))
        {
            $rs = $_GET['returnStatement'];

            if($rs == "ERROR: Appointment collision!")
            {
                ?>
                <p style="color:red;"><?php echo $_GET['returnStatement']; ?></p>
                <?php
            }
            else
            {
                ?>
                <p style="color:green;"><?php echo $_GET['returnStatement']; ?></p>
                <?php
            }
        }
    
    ?>
    
    
    <p id='appointmentSchedulerP'></p>
    
    
</div>







<?php

// print_r($_SESSION['ownerArray']);








?>

<script>
    // Changes the time format from 24 hour to 12 hour
    function changeTimeFormat(val)
    {
        var hour = val.slice(0,2);
        
        var minute = val.slice(3,5);
        
        var amPm = "am";
        
        if(hour > 12)
        {
            hour -= 12;
            amPm = "pm";
        }
        
        
        var time = hour.toString() + ":" + minute.toString() + " " + amPm;
        
        
        
        
        return time; // final time Time - 22:10
    }
    
    // Changes the date format from YYYY/MM/DD to MM/DD/YYYY
    function changeDateFormat(val)
    {
        var year = val.slice(0,4);
        
        var month = val.slice(5,7);
        
        var day = val.slice(8,10);
        
        var newDate = month + "/" + day + "/" + year;
        
        return newDate;
    }
    
    // Function that gets performed every time the select option is changed
    function serviceChange(val)
    {
        console.log("SERVICE: " + val);
        document.getElementById("appointmentSchedulerP").innerHTML = "";
        
        var pracValue = document.getElementById("practitionersListing").value;
        console.log("PRAC: " + pracValue);

        
        for(var e = 0; e < newAppointment.length;e++)
        {
            // if(val === newAppointment[e]['practitionerID'] && pracValue === newAppointment[e]['serviceID'])
            if(newAppointment[e]['practitionerID'] === pracValue && newAppointment[e]['serviceID'] === val)
            {
                document.getElementById("appointmentSchedulerP").innerHTML += "<b>" + newAppointment[e]['clientFirstName'] + " " + newAppointment[e]['clientLastName'] + "</b>";
                document.getElementById("appointmentSchedulerP").innerHTML += " has a <b>" + newAppointment[e]['serviceName'] + "</b> appointment ";
                document.getElementById("appointmentSchedulerP").innerHTML += " at <b>" + changeTimeFormat(newAppointment[e]['time']) + "</b> on <b>" + changeDateFormat(newAppointment[e]['date']) + "</b>";
                document.getElementById("appointmentSchedulerP").innerHTML += " with employee <b>" + newAppointment[e]['practitionerFirstName'] + " " + newAppointment[e]['practitionerLastName'] + "</b>";
                    
                    
                document.getElementById("appointmentSchedulerP").innerHTML += "<br>";
                
            }
        }
    }
    
    // Function that gets performed every time the select option is changed
    function practitionerChange(val)
    { 
        console.log("value: " + val);
        document.getElementById("appointmentSchedulerP").innerHTML = "";

        
        for(var e = 0; e < newAppointment.length;e++)
        {
            // console.log(newAppointment[e]['practitionerID']);
            if(val === newAppointment[e]['practitionerID'])
            {
                document.getElementById("appointmentSchedulerP").innerHTML += "<b>" + newAppointment[e]['clientFirstName'] + " " + newAppointment[e]['clientLastName'] + "</b>";
                document.getElementById("appointmentSchedulerP").innerHTML += " has a <b>" + newAppointment[e]['serviceName'] + "</b> appointment ";
                document.getElementById("appointmentSchedulerP").innerHTML += " at <b>" + changeTimeFormat(newAppointment[e]['time']) + "</b> on <b>" + changeDateFormat(newAppointment[e]['date']) + "</b>";
                document.getElementById("appointmentSchedulerP").innerHTML += " with employee <b>" + newAppointment[e]['practitionerFirstName'] + " " + newAppointment[e]['practitionerLastName'] + "</b>";
                    
                    
                document.getElementById("appointmentSchedulerP").innerHTML += "<br>";
                
            }
        }
    }
    
    
    
    
    // Turns PHP array into a javascript array.
    // var appointmentsArray = <?php //echo '["' . implode('", "', $appointment->readInnerJoinBusinessIDWithPracID($_GET['businessID'], $dateThing)) . '"]' ?>;
    var newAppointment = <?php echo json_encode($appointment->readInnerJoinBusinessIDWithPracID($_GET['businessID'], $dateThing)); ?>
    
    // Pulls client names from database.
    for(var i = 0; i < newAppointment.length; i++)
    {
        console.log(newAppointment);
        console.log(newAppointment[i]['clientFirstName'] + " " + newAppointment[i]['clientLastName'] + ", ID#: " + newAppointment[i]['practitionerID']);
    }
    
    
    
    


</script>

<!--Shows appointments for the first employee on the list-->
<script>
    var yourSelect = document.getElementById("practitionersListing");
    var val = yourSelect.value;

    console.log("value: " + val);
    document.getElementById("appointmentSchedulerP").innerHTML = "";
    
    for(var e = 0; e < newAppointment.length;e++)
    {
        if(val === newAppointment[e]['practitionerID'])
        {
            document.getElementById("appointmentSchedulerP").innerHTML += "<b>" + newAppointment[e]['clientFirstName'] + " " + newAppointment[e]['clientLastName'] + "</b>";
            document.getElementById("appointmentSchedulerP").innerHTML += " has a <b>" + newAppointment[e]['serviceName'] + "</b> appointment ";
            document.getElementById("appointmentSchedulerP").innerHTML += " at <b>" + changeTimeFormat(newAppointment[e]['time']) + "</b> on <b>" + changeDateFormat(newAppointment[e]['date']) + "</b>";
            document.getElementById("appointmentSchedulerP").innerHTML += " with employee <b>" + newAppointment[e]['practitionerFirstName'] + " " + newAppointment[e]['practitionerLastName'] + "</b>";
                
                
            document.getElementById("appointmentSchedulerP").innerHTML += "<br>";
        }
    }
</script>


