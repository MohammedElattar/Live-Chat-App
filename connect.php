<?php
    try{
        $db = new PDO("mysql:host=localhost;dbname=id19341347_online_chat",'id19341347_root','Vb-82tCWnJahNj24');
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>