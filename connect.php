<?php
    try{
        $db = new PDO("Your Host Here",'Username','Password');
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
