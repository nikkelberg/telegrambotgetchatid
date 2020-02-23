Added a table print formatted<?php 
include 'funzioniutili.php';
$response = file_get_contents("https://api.telegram.org/bot<bottoken>/getUpdates");

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
//dd($users);

echo "<table border=\"1\" style=\"width:50%\">";
echo "<tr><th>CHATID</th><th>NAME</th><th>USERNAME</th></tr>";
$lastuser = " ";
foreach($users as $user){
    echo "<tr>";
    if($user[1] == NULL){ //delete NULL value, needless
        unset($users[$user]); 
    }else{
        if($user[0] != $lastuser){ //control for not repeat value
            echo "<td>".$user[0]."</td><td>".$user[1]."</td><td>".$user[2]."</td>";
          //  echo "<br>";
            $lastuser = $user[0];
        }
    }    
    echo "</tr>";
}
echo "</table>";

?>
