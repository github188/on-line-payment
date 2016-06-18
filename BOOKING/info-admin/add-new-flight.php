<meta charset="utf-8">

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
     $q= "INSERT INTO flight (flight_number,company,flight_price,start_time,arrive_time,flight_from,flight_to) 
          VALUES ('$id','$name',$price,'$start','$end','$from','$to')";
              @mysqli_query($dbc,$q); 
     $q= "INSERT INTO class (flight_number,classrate,class_price) 
          VALUES ('$id','$typeone','$pone')";
              @mysqli_query($dbc,$q); 
     $q= "INSERT INTO class (flight_number,classrate,class_price) 
          VALUES ('$id','$typetwo','$ptwo')"; 
              $r=@mysqli_query($dbc,$q);
   
     mysqli_close($dbc);

    if($r)
          echo "<script>alert('成功加入新航班,即将返回');window.location.href='admin-info-flight.php';</script>";
    else 
          echo "<script>alert('error');window.location.href='new-flight.php';</script>";
    }
    else
          echo "<script>alert('error');window.location.href='new-flight.php';</script>";
?>