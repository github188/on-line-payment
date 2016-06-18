<?php
    $id=$_POST['id'];//航班id

$dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
     mysqli_set_charset($dbc, 'utf8');
     $q= "DELETE FROM flight WHERE flight.flight_number='$id'"; 
     @mysqli_query($dbc,$q);
     $q= "DELETE FROM class WHERE class.flight_number='$id'"; 
     @mysqli_query($dbc,$q);            
mysqli_close($dbc); 

    echo "success";
?>