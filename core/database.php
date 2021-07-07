<?php


$con=new mysqli("localhost","root","","tables");

if($con->connect_error){
    die("failed to connect:".$con->connect_error);
}