<?php

    include_once('db.php');
    include_once('Classes/Services.php');
    include_once('Classes/Practitioners.php');
    
    $service = new Services($db);
    $servicesResults = $service->pullServices($_SESSION['ownerArray'][0]['ownerID']);
    // print_r($serviceArray);
    // foreach($serviceArray as $se)
    // {
    //     echo "<br>";
    //     print_r($se);
    // }
    
    $prac = new Practitioners($db);
    $pracArray = $prac->pullPractitioners($_SESSION['ownerArray'][0]['ownerID']);

?>
<div class="row">

    <div class="col-xs-1 col-sm-1 col-md-2 col-lg-3"></div>
    
    <div class="col-xs-10 col-xs-10 col-md-8 col-lg-6">
        <h1>Business Settings</h1>
    
        <hr>
        
        
        
        

        <!--Business Operating Hour Changer-->
        <h5>Change Business Operating Hours</h5>

            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#businessOperatingHours">Open</button>
            <div id="businessOperatingHours" class="collapse">
                <br>
                <form action="index.php" method="post">
            
                    <label class="businessSettingsLabel">Opening Hour</label><br>
                    <input type="time"      class="businessSettingsHours" name="openingHour"       value="09:00"  tabIndex=1 required />
                    <br><br>
                    
                    <label class="businessSettingsLabel">Closing Hour</label><br>
                    <input type="time"      class="businessSettingsHours" name="closingHour"       value="17:00"  tabIndex=2 required />
                    <br><br>
                    
                    <input type="password" class="businessSettingsHours" name="passwordConfirm"     placeholder="Password" tabIndex=3 required />
                    <br><br>
                    
                    <label style="color:red">
                        <?php
                        
                        if(isset($_SESSION['errorMSGhours']))
                        {
                            echo $_SESSION['errorMSGhours'];
                        }
                        if(!isset($_SESSION['errorMSGhours'])){
                            echo "<b>WARNING: </b>This will delete all current appointments!";
                        }
                        
                        ?>
                        
                    </label>
                    <br>
                    
                    <!--Submit button-->
                    <button type="submit" class="businessSettingsHours" name="action" value="updateBusinessHours" >Update Business Hours</button><br>
                    
                </form>
            </div>
        
        <hr>
        
        
        
        
        
        <!--Business Owner Name Changer-->
        <h5>Change Business Owner Name</h5>
        
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#businessOwnerName">Open</button>
            <div id="businessOwnerName" class="collapse">
                <br>
                <form action="index.php" method="post">
            
                    <input type="text" name="ownerFName" placeholder="First Name"/>
                    <br><br>
                    
                    <input type="text" name="ownerLName" placeholder="Last Name"/>
                    <br><br>
                    
                    <input type="password" name="passwordConfirm" placeholder="Password"/>
                    <br><br>
                    
                    <label style="color:red">
                        <?php
                        
                        if(isset($_SESSION['errorMSGname']))
                        {
                            echo $_SESSION['errorMSGname'];
                        }
                        if(!isset($_SESSION['errorMSGname'])){
                            echo "";
                        }
                        
                        ?>
                        
                    </label>
                    <br><br>
                    
                    <button type="submit" class="businessSettingsHours" name="action" value="updateBusinessOwnerName">Update Owner's Name</button>
                    
                </form>
            </div>
        
        <hr>
        
        
                
        
        
        <!--Service adder-->
        <h5>Add a service</h5>
        
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#businessServiceAdder">Open</button>
            <div id="businessServiceAdder" class="collapse">
                <br>
                <form action="index.php" method="post">
                
                    <input type="text" name="serviceName" placeholder="Service name"/>
                    <br><br>
                    
                    <input type="text" name="description" placeholder="Description"/>
                    <br><br>
                    
                    <input type="text" name="price" placeholder="Price"/>
                    <br><br>
                    
                    <input type="text" name="time" placeholder="Duration (In Minutes)"/>
                    <br><br>
                    
                    <input type="password" name="passwordConfirm" placeholder="Password"/>
                    <br><br>
                    
                    <label style="color:red">
                        <?php
                        
                        if(isset($_SESSION['errorMSGservices']))
                        {
                            echo $_SESSION['errorMSGservices'];
                        }
                        if(!isset($_SESSION['errorMSGservices'])){
                            echo "";
                        }
                        
                        ?>
                        
                    </label>
                    <br><br>
                    
                    <button type="submit" class="businessSettingsHours" name="action" value="addBusinessServices">Add Service</button>
                    
                </form>
            </div>
            
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#businessServiceEditor">Edit</button>
            <div id="businessServiceEditor"class="collapse">
                <br>
                
                <form action="index.php" method="POST">
                    
                    <select id="servicesListing" onchange="servicesEditorChange(this.value)" name="serviceID">
            
                        <?php
                      
                        foreach($servicesResults as $re)
                        {
                            ?>
                            
                                <option value="<?php echo $re['serviceID']; ?>"><?php echo $re['serviceName']; ?></option>
                            
                            <?php
                        }
                      
                      ?>
                        
                    </select>
                
                    <br>
                
                    <input type="text" id="serviceEditorName" name="serviceEditorName" placeholder="Service name"/>
                    
                    <br>
                    
                    <input type="text" id="description" name="description" placeholder="Description" />
                    
                    <br>
                    
                    <input type="text" id="price" name="price" placeholder="Price" />
                    
                    <br>
                    
                    <input type="text" id="lengthOfTime" name="lengthOfTime" placeholder="Duration (minutes)" />
                    
                    <br>
                    
                    <button type="submit" id="btnServiceEditor" name="action" value="updateService" >Update Service</button><br>
        
                
                </form>
                

                
            </div>
        
        <hr>
        
        
        
        
        
        <!--Practitioner Adder-->
        <h5>Add a practitioner</h5>
        
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#businessPractitionerAdder">Open</button>
            <div id="businessPractitionerAdder" class="collapse">
                <br>
                <form action="index.php" method="post">
                
                    <input type="text" name="practitionerFirstName" placeholder="First Name"/>
                    <br><br>
                    
                    <input type="text" name="practitionerLastName" placeholder="Last Name"/>
                    <br><br>
                    
                    <input type="text" name="practitionerEmail" placeholder="Email"/>
                    <br><br>
                    
                    <input type="text" name="practitionerPhone" placeholder="Phone Number"/>
                    <br><br>
                    
                    <input type="password" name="passwordConfirm" placeholder="Password"/>
                    <br><br>
                    
                    <label style="color:red">
                        <?php
                        
                        if(isset($_SESSION['errorMSGprac']))
                        {
                            echo $_SESSION['errorMSGprac'];
                        }
                        if(!isset($_SESSION['errorMSGprac'])){
                            echo "";
                        }
                        
                        ?>
                        
                    </label>
                    <br><br>
                    
                    <button type="submit" class="businessSettingsHours" name="action" value="addBusinessPractitioner">Add Service</button>
                    
                </form>
            </div> 
            
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#businessPractitionerEditor">Edit</button>
            <div id="businessPractitionerEditor"class="collapse">
                <br>
                
                <form action="index.php" method="POST">
                    
                    <select id="practitionersListing" onchange="practitionersEditorChange(this.value)" name="practitionerID">
            
                        <?php
                      
                        foreach($pracArray as $re)
                        {
                            ?>
                            
                                <option value="<?php echo $re['practitionerID']; ?>"><?php echo $re['practitionerFirstName'] . " " . $re['practitionerLastName']; ?></option>
                            
                            <?php
                        }
                      
                      ?>
                        
                    </select>
                
                    <br>
                
                    <input type="text" id="practitionerFirstName" name="practitionerFirstName" placeholder="Practitioner First Name"/>
                    
                    <br>
                    
                    <input type="text" id="practitionerLastName" name="practitionerLastName" placeholder="Practitioner Last Name" />
                    
                    <br>
                    
                    <input type="text" id="practitionerEmail" name="practitionerEmail" placeholder="Practitioner Email" />
                    
                    <br>
                    
                    <input type="text" id="practitionerPhone" name="practitionerPhone" placeholder="Duration (minutes)" />
                    
                    <br>
                    
                    <button type="submit" id="btnPracEditor" name="action" value="updatePractitioner" >Update Practitioner</button><br>
        
                
                </form>
                

                
            </div>
            
        </form>
        
        
        <?php
        
            unset($_SESSION['errorMSGhours']);
        
        ?>
    </div>
    
    <div class="col-xs-1 col-sm-1 col-md-2 col-lg-3"></div>
    
</div>
<br><br><br><br>

<?php

    $_SESSION['errorMSGname'] = "";
    $_SESSION['errorMSGhours'] = "<b>WARNING: </b>This will delete all current appointments!";
    $_SESSION['errorMSGservices'] = "";
    $_SESSION['errorMSGprac'] = "";

?>

<script>
    
    var newAppointment = <?php echo json_encode($servicesResults); ?>
    // var newPrac = <?php //echo json_encode($practitionersResults); ?>

    // Function that gets performed every time the select option is changed
    function servicesEditorChange(val)
    { 
        console.log("value: " + val);
        
        for(var i = 0; i < newAppointment.length; i++)
        {
            if(newAppointment[i]['serviceID'] === val)
            {
                document.getElementById('serviceEditorName').value = newAppointment[i]['serviceName'];
                document.getElementById('description').value = newAppointment[i]['description'];
                document.getElementById('price').value = newAppointment[i]['price'];
                document.getElementById('lengthOfTime').value = newAppointment[i]['lengthOfTime'];
            }
        }
    }
    
    // Function that gets performed every time the select option is changed
    // function practitionersEditorChange(val)
    // {
    //     console.log("value: " + val);
        
    //     for(var i = 0; i < newPrac.length; i++)
    //     {
    //         if(newPrac[i]['practitionerID'] === val)
    //         {
    //             document.getElementById('practitionerFirstName').value = newPrac[i]['practitionerFirstName'];
    //             document.getElementById('practitionerLastName').value = newPrac[i]['practitionerFirstName'];
    //             document.getElementById('practitionerEmail').value = newPrac[i]['practitionerEmail'];
    //             document.getElementById('practitionerPhone').value = newPrac[i]['practitionerPhone'];
    //         }
    //     }
    // }
    
    document.getElementById('serviceEditorName').value = newAppointment[0]['serviceName'];
    document.getElementById('description').value = newAppointment[0]['description'];
    document.getElementById('price').value = newAppointment[0]['price'];
    document.getElementById('lengthOfTime').value = newAppointment[0]['lengthOfTime'];
    
    // document.getElementById('practitionerFirstName').value = newPrac[0]['practitionerFirstName'];
    // document.getElementById('practitionerLastName').value = newPrac[0]['practitionerFirstName'];
    // document.getElementById('practitionerEmail').value = newPrac[0]['practitionerEmail'];
    // document.getElementById('practitionerPhone').value = newPrac[0]['practitionerPhone'];
</script>



























