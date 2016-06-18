<?php
     include_once("check-session.php");
    $test=0;
    $id=$_POST['hotel-id'];                if ($id==''||$id==NULL) $test=1;
    $name=$_POST['name'];                  if ($name==''||$name==NULL) $test=1;
    $province=$_POST['province'];          if ($province==''||$province==NULL) $test=1;
    $city=$_POST['city'];                  if ($city==''||$city==NULL) $test=1;
    $block=$_POST['block'];                if ($block==''||$block==NULL) $test=1;
    $street=$_POST['street'];              if ($street==''||$street==NULL) $test=1;
    $rank=$_POST['rank'];                  if ($rank==''||$rank==NULL) $test=1;
    $reviewer=$_POST['reviewer'];          if ($reviewer==''||$reviewer==NULL) $test=1;
    $low=$_POST['low-price'];              if ($low==''||$low==NULL) $test=1;
    $rooms=$_POST['rooms'];                if ($rooms==''||$rooms==NULL) $test=1;
    $logitude=$_POST['logitude'];          if ($logitude==''||$logitude==NULL) $test=1;
    $latitude=$_POST['latitude'];          if ($latitude==''||$latitude==NULL) $test=1;
    $points=$_POST['points'];              if ($points==''||$points==NULL) $test=1;
    $heat=$_POST['heat'];                  if ($heat==''||$heat==NULL) $test=1;

    if ($test==0){

    $typeone=mb_substr($rooms,0,3,'utf-8');
    $pone=mb_substr($rooms,4,4,'utf-8');
    $typetwo=mb_substr($rooms,9,3,'utf-8');
    $ptwo=mb_substr($rooms,13,4,'utf-8');
    if (mb_substr($pone,0,1,'utf-8')==' '){
      $pone=mb_substr($pone,1,3,'utf-8');
    }
    if (mb_substr($ptwo,0,1,'utf-8')==' '){
      $ptwo=mb_substr($ptwo,1,3,'utf-8');
    }

     $dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
     mysqli_set_charset($dbc, 'utf8');
     $q= "UPDATE hotel
          SET hotel.name='$name'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.add_province='$province'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.add_city='$city'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.add_block='$block'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.add_street='$street'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.star='$rank'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.hotel_price=$low
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.heat=$heat
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.score='$points'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.reviewer='$reviewer'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.logitude='$logitude'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 
     $q= "UPDATE hotel
          SET hotel.latitude='$latitude'
          WHERE hotel.h_id='$id'";
              @mysqli_query($dbc,$q); 

     $q= "DELETE FROM room WHERE room.hotel_name='$name'"; 
              @mysqli_query($dbc,$q);
     $q= "INSERT INTO room(hotel_name,type,room_price) 
          VALUES ('$name','$typeone',$pone)";
              @mysqli_query($dbc,$q); 
     $q= "INSERT INTO room(hotel_name,type,room_price) 
          VALUES ('$name','$typetwo',$ptwo)"; 
              @mysqli_query($dbc,$q);



    //if(success)
            echo "<script>alert('成功修改,即将返回');window.location.href='admin-info-hotel.php';</script>";
    //else 
        //echo "<script>alert(error);window.location.href='update-hotel.php';</script>";


          }


        else
          echo "<script>alert('error');window.location.href='admin-info-hotel.php';</script>";
?>