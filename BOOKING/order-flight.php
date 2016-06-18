<?php
    //if(not login)
        //header("location")
    include("include/head.html");
     include("include/time-picker.html");

    $id=$_GET['id'];//航班id
?>
<?php 
$flights=array();
$dbc = @mysqli_connect ('localhost', 'payment', 'payment123', 'payment') OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
     mysqli_set_charset($dbc, 'utf8');
     $q= "SELECT * FROM flight WHERE flight.flight_number='$id'"; 
     $r= @mysqli_query($dbc,$q);          
     while($row=mysqli_fetch_assoc($r)){    
           $name=$row['company'];
           $from=$row['flight_from'];
           $to=$row['flight_to'];
           $start=$row['start_time'];
           $end=$row['arrive_time'];
           $price=$row['flight_price'];     
            }
    $cangweis=array();
                $qr= "SELECT * FROM class WHERE class.flight_number ='$id'"; 
                $s= @mysqli_query($dbc,$qr); 
                while($row=mysqli_fetch_assoc($s)){    
                        $cangweis[]=array("classrate" => $row['classrate'], "class_price" => $row['class_price']);   
                        }
    mysqli_free_result($s);
    $cangwei = $_GET['cangwei'];
    
mysqli_free_result($r);    
mysqli_close($dbc); 
?>
<style type="text/css">
    .button {
            display: inline-block;
            border-radius: 4px;
            background-color: limegreen;
            border: none;
            color: #FFF;
            text-align: center;
            font-size: 15px;
            padding: 5px;
            width: 100px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }
        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }
        .button span:after {
            content: '»';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }
        .button:hover span {
            padding-right: 25px;
        }
        .button:hover span:after {
            opacity: 1;
            right: 0;
        }

        a:hover, a:active {
            background-color: lime;
        }

        .left {
            position: relative;;
            left: 30%;
        }

        .right {
            position: relative;;
            left: 70%;
        }

        #register {
            display: inline-block;
            border-radius: 4px;
            background-color: limegreen;
            border: none;
            color: #FFF;
            text-align: center;
            font-size: 15px;
            padding: 5px;
            width: 100px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        select
        {
            color: black;
        }
        option
        {
            color: black;
        }
</style>
<link href="//cdn.bootcss.com/raty/2.7.0/jquery.raty.css" rel="stylesheet">
<script src="//cdn.bootcss.com/raty/2.7.0/jquery.raty.js"></script>

<script type="text/javascript">
    $(function(){
        $('#hotelstars').raty();
    });
</script>

<!--站点标题-->
<body class="home-template">
<div class="container">
      <div class="row" id="headline-container">
           <h1 class="col-md-12">
                <span><img src="/img/图标.jpg" width="70" height="70" alt="some_text">&nbsp;&nbsp;</span><em><strong>远途网<span>&nbsp;&nbsp;&nbsp;&nbsp;酒店机票信息管理</span></strong></em>
         </h1>
      </div>
    </div>
 <hr size=1 style="height:3px;background-color: green"><br><br>

<div class="container" >
    <div class="row" style="padding-top: 15px">
    <form method="post" action="insert-flight.php" id="submit">
    <input type="text" hidden name="id" <?php echo 'value="' . $id . '"' ?>;>
        <div class="col-md-3" ></div>
        <div class="col-md-5" id="content-container">
        <div class="form-horizontal" id="form" style="padding-top: 20px">
                <div class="form-group">
                    <label class="col-sm-3 control-label" >航空公司</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  readonly="readonly" name="name" <?php echo 'value="' . $name .'"'?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >出发地点</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  readonly="readonly" name="from" <?php echo 'value="' . $from .'"'?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >到达地点</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   readonly="readonly" name="to" <?php echo 'value="' . $to .'"'?>>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >出发时期</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   id="startdate" readonly="readonly" name="start-date" <?php echo 'value="' . $start .'"'?>>
                    </div>
                    <script type="text/javascript">
                         $('#startdate').daterangepicker({
                                singleDatePicker: true,
                                showDropdowns: true,
                                startDate: moment(),
                            });
                    </script>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >出发时间</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   readonly="readonly" name="start" <?php echo 'value="' . $start .'"'?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >到达时间</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   readonly="readonly" name="end" <?php echo 'value="' . $end .'"'?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >舱位</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  readonly="readonly" name="cangwei" <?php echo 'value="' . $cangwei .'"'?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >价格</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   readonly="readonly" name="price" <?php echo 'value="' . $price .'"'?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-5">
                        <input type="submit" value="提交订单" class="button">
                    </div>
                </div>
                </div>
        </div>
        </form>
        </div></div>
        <?php
            include("include/footer.html");
        ?>
</body>
</html>
