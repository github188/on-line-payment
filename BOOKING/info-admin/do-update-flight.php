<?php
     include_once("check-session.php");
     $test=0;
     $id=$_POST["id"];              if ($id==''||$id==NULL) $test=1;        
     $name=$_POST["name"];          if ($name==''||$name==NULL) $test=1;
     $from=$_POST["from"];          if ($from==''||$from==NULL) $test=1;
     $to=$_POST["to"];              if ($to==''||$to==NULL) $test=1;
     $start=$_POST["start"];        if ($start==''||$start==NULL) $test=1;
     $end=$_POST["end"];            if ($end==''||$end==NULL) $test=1;
     $cangwei=$_POST["cangwei"];    if ($cangwei==''||$cangwei==NULL) $test=1;
     $price=$_POST["price"];        if ($price==''||$price==NULL) $test=1;

     if ($test==0){

     $typeone=mb_substr($cangwei,0,3,'utf-8');
     $pone=mb_substr($cangwei,4,4,'utf-8');
     $typetwo=mb_substr($cangwei,9,3,'utf-8');
     $ptwo=mb_substr($cangwei,13,4,'utf-8');

     if (mb_substr($pone,0,1,'utf-8')==' '){
       $pone=mb_substr($pone,1,3,'utf-8');
     }
     if (mb_substr($ptwo,0,1,'utf-8')==' '){
       $ptwo=mb_substr($ptwo,1,3,'utf-8');
     }

     $dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
     mysqli_set_charset($dbc, 'utf8');
     $q= "UPDATE flight
          SET company='$name'
          WHERE flight_number='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE flight
          SET flight_price=$price
          WHERE flight_number='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE flight
          SET start_time='$start'
          WHERE flight_number='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE flight
          SET arrive_time='$end'
          WHERE flight_number='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE flight
          SET flight_from='$from'
          WHERE flight_number='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE flight
          SET flight_to='$to'
          WHERE flight_number='$id'";
              @mysqli_query($dbc,$q); 


     $q= "DELETE FROM class WHERE class.flight_number='$id'"; 
              @mysqli_query($dbc,$q);
     $q= "INSERT INTO class(flight_number,classrate,class_price) 
          VALUES ('$id','$typeone',$pone)";
              @mysqli_query($dbc,$q); 
     $q= "INSERT INTO class(flight_number,classrate,class_price) 
          VALUES ('$id','$typetwo',$ptwo)"; 
              @mysqli_query($dbc,$q);


     mysqli_close($dbc);
    //if(success)
       echo "<script>alert('修改成功,即将返回');window.location.href='admin-info-flight.php';</script>";
    //else 
        //echo "<script>alert(error);window.location.href='new-hotel.php';</script>";

     }
     else
        echo "<script>alert('error');window.location.href='admin-info-flight.php';</script>";
?>