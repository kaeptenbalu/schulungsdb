<?php session_start(); ?>
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include('helper.php');

/**
* Login-Stuff
* To logout -> unset($_SESSION['user_id']);
**/
if (isset($_POST["signin"])) { 
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT username, password FROM User WHERE username = '".$username."' AND password = '".$password."'";

    $results = runSQLquery($query, 'select');
    
    //echo '<pre>'; print_r($results); echo '</pre>';
    if ($username === $results[0]['username'] && $results[0]['password']) {
        //Sessioncookie
        $_SESSION['user'] = $username;
            /*array(
            'name' => $username,
            'login' => 'login',
            'some_info' => 'some info'
        );*/
        echo 'sessioncookie gesetzt. </br> 
                <script type="text/javascript">
                    window.setTimeout(function(){
                        window.location.href = "index.php";
                    }, 3000);
                </script>';
    }

    else{
        echo 'something went wrong x(, try again!
                <script type="text/javascript">
                    window.setTimeout(function(){
                        window.location.href = "login.php";
                    }, 3000);
                </script>';
    }
}


/**
* Schulungsfoo
**/
if(isset($_SESSION['user'])){
//logged In
    //debug_to_console('gehts?');
    include('datatables.php');

    if (isset($_POST["createTeilnehmer"])) {    
        $vorname = $_POST["vorname"];
        $nachname = $_POST["nachname"];
        $email = $_POST["email"];
        $firma = $_POST["firma"];
        $betrieb = $_POST["betrieb"];   

        //prepare query
        $query = "INSERT INTO Teilnehmer (vorname, nachname, mailadresse, firma, betrieb) VALUES ('".$vorname."', '".$nachname."', '".$email."', '".$firma."', '".$betrieb."');";

        //execute query
        $result = runSQLquery($query, 'insert');
        
        //get List of participants
        $results = runSQLquery("SELECT * FROM Teilnehmer;", 'select');
        echo '<pre>'; print_r($results); echo '</pre>';
        //echo '<pre>'; print_r(var_dump($results)); echo '</pre>';     
    }


    if (isset($_POST["createBetrieb"])){
        $firma = $_POST["firma"];
        $strasse = $_POST["strasse"];
        $plz = $_POST["plz"];
        $ort = $_POST["ort"];
        $bildungskoordinator = $_POST["bildungskoordinator"];

        //prepare query
        $query = "INSERT INTO Betriebe (firma, strasse, plz, ort, bildungskoordinator) VALUES ('".$firma."', '".$strasse."', '".$plz."', '".$ort."', '".$bildungskoordinator."');";

        $result = runSQLquery($query);
        echo $result;
    }


    if (isset($_POST["createSchulung"])){
        $name = $_POST["name"];
        $bezeichnung = $_POST["bezeichnung"];
        $datum = $_POST["datum"];
        $schulungsort = $_POST["schulungsort"];

        //prepare query
        $query = "INSERT INTO Schulungen (name, bezeichnung, datum, schulungsort) VALUES ('".$name."', '".$bezeichnung."', '".$datum."', '".$schulungsort."');";

        $result = runSQLquery($query);
        //query db
        //$result = $db->query("SELECT * FROM Teilnehmer;");
        echo $result;
    }


    if (isset($_POST["createBildungsbeauftragter"])){
        $name = $_POST["name"];
        $vorname = $_POST["vorname"];
        $email = $_POST["email"];
        $telefonnummer = $_POST["telefonnummer"];
        
        //$id = $_POST["id"];

        //prepare query
        //$query = "INSERT INTO Bildungsbeauftragter (name, vorname, email, telefonnummer, id) VALUES //('".$name."', '".$vorname."', '".$email."', '".$telefonnumer."','".$id."');";
        $query = "INSERT INTO Bildungsbeauftrager (name, vorname, email, telefonnumer, id) VALUES ('".$name."', '".$vorname."', '".$email."', '".$telefonnummer."', 1);";

        $result = runSQLquery($query);
        echo $result;
    }

}else{
// Not logged in :(
    echo 'You are not logged in, please login. 
        <script type="text/javascript">
            window.setTimeout(function(){
                window.location.href = "index.php";
            }, 3000);
        </script>';
}

?>