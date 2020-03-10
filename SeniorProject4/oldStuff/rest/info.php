<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <style>
            body
            {
                width:75%;
                
            }
            a{
                text-decoration:none;
            }
            a:visited
            {
                text-decoration:none;
                color:blue;
            }
            a:hover
            {
                color:orange;
            }
            
        </style>
    </HEAD>
    <BODY>
        
        <h1>Scheduler's REST documentation</h1>
        <h4>Here is the documentation regarding our REST api. Listed below are the parameters you may pass in.</h4>
        <h5>Scheduler's REST API - <a href="https://chrispeloso.com/SeniorProject4/rest/" target="_blank" >REST API</a></h5>
        
        
        <li><b>No Parameters - </b>returns every item in the appointments table joined with some related info from other tables.</li><br>
        
        <li><b>clientFirstName and clientLastName - </b>returns appointments with the client name specified.</li>
        <li><b>clientFirstName - </b>returns appointments with the client first name specified.</li>
        <li><b>clientLastName - </b>returns appointments with the client last name specified.</li><br>
        
        <li><b>businessID (number) - </b>returns appointments with the business ID specified.</li><br>
        
        <li><b>date - </b>returns appointments with the date specified. Format dates YYYY-MM-DD, example: 2020-01-26.</li>
        <li><b>time - </b>returns appointments with the time specified. Format time HH:MM:SS, example: 16:30:00</li>
        <li><b>date and time - </b>returns appointments with the date and time specified.</li><br>


        <li><b>businessID (number) and date - </b>returns appointments with the business ID and date specified.</li>
        <li><b>businessName and date - </b>returns appointments with the business name and date specified.</li><br>
        
        <li><b>clientLastName and date - </b>returns appointments with the client last name specified on the date specified.</li><br>

        
        
    </BODY>
</HTML>