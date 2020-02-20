<?php 

$response = file_get_contents("https://api.telegram.org/bot<BOTTOKEN>/getUpdates");

$dati = explode('"id":', $response);//divide for id
unset($dati[0]);    //delete first array field
$users = Array();

foreach($dati as $value){  
    $userapp = Array();

    //take chat id
    $value = explode(',', $value); 

    array_push($userapp, $value[0]);

    //take name
    $name = explode('"first_name":', $value[1]); 
    $name = explode('"', $name[1]); //clean ""
    
    array_push($userapp, $name[1]);

    //take username
    $nickname = explode('"username":',$value[2]); 
    $nickname = explode('"', $nickname[1]); //clean ""

    array_push($userapp, $nickname[1]);

    array_push($users, $userapp);
}

$lastuser = " ";
foreach($users as $user){
    if($user[1] == NULL){ //delete NULL value, needless
        unset($users[$user]); 
    }else{
        if($user[0] != $lastuser){ //control for not repeat value
            echo $user[0]." ".$user[1]." ".$user[2];
            echo "<br>";
            $lastuser = $user[0];
        }
    }
    
}

?>
