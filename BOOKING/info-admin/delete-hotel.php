<?php
    $id=$_POST['id'];
    $name=null;

$dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
     mysqli_set_charset($dbc, 'utf8');
     $q= "SELECT hotel_name FROM hotel WHERE hotel.h_id='$id'"; 
     $r=@mysqli_query($dbc,$q);
     $row=mysqli_fetch_assoc($r);
     $name = $row['hotel_name'];
     $q= "DELETE FROM room WHERE room.hotel_name='$name'"; 
     @mysqli_query($dbc,$q); 
     $q= "DELETE FROM hotel WHERE hotel.h_id='$id'"; 
     @mysqli_query($dbc,$q);
              
mysqli_close($dbc); 

    echo "success";
?>