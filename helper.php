<?php

/**
* Debugging Helper
**/
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

/**
* SQL-Helper function
* SQL-Connect, runSQLquery and Chechresults helper
**/
class MyDB extends SQLite3 {
    function __construct()
    {
        //connect to db
        $this->open('./SchulungsDB.db');
    }
}

function runSQLquery($query, $type){    
    
    $db = new MyDB();
    //debug_to_console( "bla" );
    if(!$db){
        echo $db->lastErrorMsg();
        //debug_to_console( "db error" );
        die("SQL-Query Error.");
    } 
    else {
        /**
        * query-function bug executes each query twice if insert with query is used
        * as workarround, each insert call needs to use exec function which not return any datasets
        * but true or false.
        **/
        
        if ($type === 'select') {
            $results = array();
            $result = $db->query($query);
            checkresult($result);
            //debug_to_console( $results );
            while($row=$result->fetchArray(SQLITE3_ASSOC)){
                $rows = array($row);
                $results = array_merge($results,$rows);
                //debug_to_console( $rows );
            }
        }
        else {
            //debug_to_console( "not select");
            $result = $db->exec($query);
            checkresult($result);
            return $result;
        }
    }
    
    $db->close();
    return $results;
}

function checkResult($result){
    if (!$result) {
        throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
        //debug_to_console( "db error 2" );
        die("SQL-Query Error.");
    }
}


?>