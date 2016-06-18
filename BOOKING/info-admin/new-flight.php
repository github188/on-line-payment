<?php
    //if(not login)
        //header("location")
   include_once("check-session.php");
    include("../include/head.html");
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
    <form method="post" action="add-new-flight.php" id="submit">
        <div class="col-md-3" ></div>
        <div class="col-md-5" id="content-container">
        <div class="form-horizontal" id="form" style="padding-top: 20px">
                <div class="form-group">
                    <label class="col-sm-3 control-label" >航班号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  name="id">
                    </div>
                </div>            
                <div class="form-group">
                    <label class="col-sm-3 control-label" >航空公司</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputpassword">出发地点</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  name="from">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputpassword">到达地点</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   name="to">
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputpassword">出发时间</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   name="start">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputpassword">到达时间</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   name="end">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputpassword">舱位</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  name="cangwei">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputpassword">价格</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control"   name="price">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-5">
                        <input type="submit" value="添加新航班" class="button">
                    </div>
                </div>
                </div>
        </div>
        </form>
        </div></div>
        <?php
            include("../include/footer.html");
        ?>
</body>
</html>
<script type="text/javascript">
    $(function(){
        $('#submit').submit(function(){
            variables={
                '航班号': $('[name=id]').val(),
                '航空公司': $('[name=name]').val(),
                '出发地点': $('[name=from]').val(),
                '到达地点': $('[name=to]').val(),
                '出发时间': $('[name=start]').val(),
                '到达时间': $('[name=end]').val(),
                '舱位': $('[name=cangwei]').val(),
                '价格': $('[name=price]').val()
            };
            for (item in variables){
                if(variables[item]===""){
                    alert(item+"不能为空");
                    return false;
                }
            }
        })
    });
    
</script>
