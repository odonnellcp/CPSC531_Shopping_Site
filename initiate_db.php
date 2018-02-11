<?php
//Configure DB Information
define("HOST", "localhost");
define("USER", "root");
define("PASS", "koolkidz");
define("NAME", "531Proj");

if (get_magic_quotes_gpc())   
{   
  function stripslashes_deep($value)   
  {   
    $value = is_array($value) ?   
        array_map('stripslashes_deep', $value) :   
        stripslashes($value);   
   
    return $value;   
  }   
   
  $_POST = array_map('stripslashes_deep', $_POST);   
  $_GET = array_map('stripslashes_deep', $_GET);   
  $_COOKIE = array_map('stripslashes_deep', $_COOKIE);   
  $_REQUEST = array_map('stripslashes_deep', $_REQUEST);   
}   



//Connect to database
try
 {
  $db = new PDO("mysql:host=".HOST.";dbname=".NAME.";charset=utf8", "".USER."", "".PASS."");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} 
catch (PDOException $e)
{
  echo $e->getMessage();
}

//Checks that the connection worked
if (!$db) 
{ 
  $output = 'Unable to connect to the database server.'; 
  include 'output.html.php'; 
  exit(); 
}
?>