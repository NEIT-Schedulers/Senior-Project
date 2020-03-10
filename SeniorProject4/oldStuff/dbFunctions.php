<?php

    function grabAllFromTable($db, $table)
    {
        $sql = "SELECT * FROM :table";
        $sql = $sql->prepare($db);
        $sql->bindParam(':table', $table);
        $sql->execute();
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    




?>