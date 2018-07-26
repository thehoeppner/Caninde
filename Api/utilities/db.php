<?php
function getDB()
{
    $dbhost = "sql213.epizy.com";
    $dbuser = "epiz_22442389";
    $dbpass = "I985nWVk9AMX";
    $dbname = "epiz_22442389_caninde_api";
 
    $mysql_conn_string = "mysql:host=$dbhost;dbname=$dbname";
    $dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass); 
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
}

