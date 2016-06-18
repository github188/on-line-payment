<?php
    $username=$_POST['username'];
    $password=$_POST['password'];
    $passwordd=null;

    $dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
         mysqli_set_charset($dbc, 'utf8');
         $q= "SELECT * FROM admin WHERE admin.admin_name='$username'"; 
         $r= @mysqli_query($dbc,$q);          
         while($row=mysqli_fetch_assoc($r)){    
               $passwordd=md5($row['password']);
                }
    mysqli_free_result($r);    
    mysqli_close($dbc);   
         



    if($password===$passwordd){//这里的if条件需要修改
        session_start();
        $_SESSION["admin"]=$username;
        $_SESSION['agent']=md5($_SERVER['HTTP_USER_AGENT']);//设置会话

        echo "true";
    }

    else{
        echo "false";
    }
?>