<?php

    header('Content-type: application/json');
    
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    
    
    //includes database file
    include_once('../adminEnd/db.php');
    
    //includes the classes
    include_once('../adminEnd/Classes/Owners.php');
    include_once('../adminEnd/Classes/Appointments.php');
    include_once('../adminEnd/Classes/Practitioners.php');
    include_once('../adminEnd/Classes/Services.php');

    //Creates new client
    $owner = new Owners($db);
    
    //Creates a new appointment
    $appointment = new Appointments($db);
    
    //Creates a new practitioner
    $practitioner = new Practitioners($db);
    
    //Creates a new service
    $service = new Services($db);
    
    
    
    //Grab all from appointments for a specific business
    if(isset($_GET['businessID']) && !isset($_GET['date']))
    {
        $arrayThing = $appointment->readInnerJoinBusiness($_GET['businessID']);
    }
    
    //Search by a business name and date
    elseif(isset($_GET['businessName']) && isset($_GET['date']))
    {
        $arrayThing = $appointment->readInnerJoinBusinessNameDate($_GET['businessName'], $_GET['date']);
    }
    
    //Search by a business ID and date
    elseif(isset($_GET['businessID']) && isset($_GET['date']))
    {
        $arrayThing = $appointment->readInnerJoinBusinessIDdate($_GET['businessID'], $_GET['date']);
    }
    
    
    elseif(isset($_GET['clientLastName']) && isset($_GET['date']))
    {
        $arrayThing = $appointment->readInnerJoinLastNameDate($_GET['clientLastName'], $_GET['date']);
    }
    
    
    
    
    // Search by date and time for appointments
    elseif(isset($_GET['date']) && isset($_GET['time']))
    {
        $arrayThing = $appointment->readInnerJoinDateTime($_GET['date'], $_GET['time']);
    }
    
    //Search by date for appointments
    elseif(isset($_GET['date']))
    {
        $arrayThing = $appointment->readInnerJoinDate($_GET['date']);
    }
    
    // Search by time for appointments
    elseif(isset($_GET['time']))
    {
        $arrayThing = $appointment->readInnerJoinTime($_GET['time']);
    }
    
    //Grab all from appointments for a specific client
    elseif(isset($_GET['clientFirstName']) && isset($_GET['clientLastName']))
    {
        $arrayThing = $appointment->readInnerJoinClientFullName($_GET['clientFirstName'], $_GET['clientLastName']);
    }
    
    //Search by a client's first name
    elseif(isset($_GET['clientFirstName']))
    {
        $arrayThing = $appointment->readInnerJoinClientFirstName($_GET['clientFirstName']);
    }
    
    //Search by a client's last name
    elseif(isset($_GET['clientLastName']))
    {
        $arrayThing = $appointment->readInnerJoinClientLastName($_GET['clientLastName']);
    }
    
    
    
    
    //if nothing specified, grab all appointments.
    else
    {
        $arrayThing = $appointment->readInnerJoin();
    }


























    // //searches for clients by first and last name
    // if(isset($_GET['firstName']) && isset($_GET['lastName']))
    // {
    //     //searches clients for name
    //     $arrayThing = $owner->readName($_GET['firstName'], $_GET['lastName']);
    // }
    // elseif(isset($_GET['email']))
    // {
    //     //searches clients for email
    //     $arrayThing = $owner->readEmail($_GET['email']);
    // }
    // elseif(isset($_GET['phone']))
    // {
    //     //searches clients for phone number
    //     $arrayThing = $owner->readPhoneNumber(strval($_GET['phone']));
    // }
    // elseif(isset($_GET['businessID']))
    // {
    //     $arrayThing = $appointment->readInnerJoin();
    // }
    // elseif(isset($_GET['practitionerID']))
    // {
    //     $arrayThing = $practitioner->read();
    // }
    // elseif(isset($_GET['serviceID']))
    // {
    //     $arrayThing = $service->read();
    // }
    // else{
    //     //reads everything in clients
    //     $arrayThing = $appointment->readInnerJoin();
    // }
    

    
    $num = count($arrayThing);
    
    if($num > 0)
    {
        $products_arr = array();
        $products_arr['records'] = array();
        
        foreach($arrayThing as $arr)
        {
            $product_item = array();
            foreach($arr as $key => $value)
            {
                $product_item[$key] = $value;
            }
            
            array_push($products_arr['records'], $product_item);
            
        }
        
        http_response_code(200);
        
        echo json_encode($products_arr);
    }
    else{
        
        //Nothing found, sends code 404 - not found
        http_response_code(404);
        
        //sends a json with message that no products are found.
        echo json_encode(
            array('message' => "No products found.")
        );
    }




?>