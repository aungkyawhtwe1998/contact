<?php
function conn(){
    return mysqli_connect("localhost","root","","contact-db");
}

$url= "http://{$_SERVER['HTTP_HOST']}/contact";

date_default_timezone_set ('Asia/Yangon');
