<?php
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

<div class="container" id="content-container">
    <div class="row" style="padding-top: 15px">
<form method="post" action="add-new-hotel.php" id="submit">
        <div class="col-md-6">
        <div class="form-horizontal" id="form" style="padding-top: 20px">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">酒店名</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >省份</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"   name="province">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >城市</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"   name="city">
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >区</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"  name="block">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >街道</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"   name="street">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >热度</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"   name="heat">
                    </div>
                </div>
                 
                </div>
            
        </div>
        <div class="col-md-6">
            <div class="form-horizontal" name="form" style="padding-top: 20px">
            <div class="form-group">
                    <label class="col-sm-2 control-label" >酒店星级</label>
                    <div class="col-sm-1">
                        <select name="rank">
                            <option name="star" >1</option>
                            <option name="star" >2</option>
                            <option name="star" >3</option>
                            <option name="star" >4</option>
                            <option name="star" >5</option>
                        </select>
                    </div>
                    <label class="col-sm-2 control-label" >酒店评分</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control"   name="points">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">居住人次</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"   name="reviewer">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">最低房价</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"    name="low-price">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">房型列表</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control"   name="rooms">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">经度</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control"   name="logitude">
                    </div>
                    <label class="col-sm-2 control-label" for="inputusername">纬度</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control"    name="latitude">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputusername">缩略图</label>
                    <div class="col-sm-3">
                        <input type="file"   name="small-img">
                    </div>
                    <label class="col-sm-2 control-label" for="inputusername">详图</label>
                    <div class="col-sm-3">
                        <input type="file" name="big-img">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-2">
                        <input class="button" name="search" type="submit" style="vertical-align:middle;width:100%" value="添加新酒店">
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
                '酒店名字': $('[name=name]').val(),
                '纬度': $('[name=latitude]').val(),
                 '经度': $('[name=logitude]').val(),
                 '房间': $('[name=rooms]').val(),
                 '最低价格': $('[name=low-price]').val(),
                 '居住人次': $('[name=reviewer]').val(),
                 '评分': $('[name=points]').val(),
                 '热度': $('[name=heat]').val(),
                 '街道': $('[name=street').val(),
                 '城市': $('[name=city]').val(),
                 '省份': $('[name=province]').val(),
                 '区': $('[name=block]').val()
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