<?php
session_start();
session_id();
$Username = array('bank','big','nut');
$_SESSION['username']= $Username;

foreach ($_SESSION['username'] as $key){
    echo('Session[username]:'.$key."<br>");

}
echo 'Session_id:'.session_id();

?>