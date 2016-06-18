<?php
    include("../include/head.html");
?>
<script src="/js/md5.js"></script>
    <style>
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

        a:link, a:visited {
            border-radius: 4px;
            font-weight: bold;
            color: #FFF;
            background-color: limegreen;
            width: 200px;
            text-align: center;
            padding: 6px;
            text-decoration: none;
            font-size: 15px;
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
    </style>
</head>
<body>
<div class="container">
    <div class="row" id="headline-container">
        <h1 class="col-md-12">
            <span><img src="/img/图标.jpg" width="70" height="70"
                       alt="some_text">&nbsp;&nbsp;</span><em><strong>远途网<span>&nbsp;&nbsp;&nbsp;&nbsp;信息管理登录</span></strong></em>
        </h1>
    </div>
</div>
<hr size=1 style="height:3px;background-color: green">
<br><br>



<div class="container">
    <div class="row" style="padding-top: 15px">
        <div class="col-md-4"></div>

        <div class="col-md-4" id="content-container">
            <div class="form-horizontal" id="form" style="padding-top: 20px">
                
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="inputusername">用户名</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="username" placeholder="请输入用户名" name="username">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="inputpassword">密码</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" placeholder="请输入密码" name="password">
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                        <button class="button" id="login" type="submit" style="vertical-align:middle"><span>登陆</span></button>
                        <span><p id="searchResult"></p></span>
                    </div>
                </div>
                <div class="form-group">
                </div>
            </div>
        </div>

        </body>

        <script type="text/javascript">
            $(function(){
                $("#login").click(function(){
                    var password=$("#password").val();
                    var username=$("#username").val();
                    var hash=hex_md5(password);
                    if(password===""||username===""){
                        alert("用户名和密码不能为空");
                        return false;
                    }
                    $.ajax({
                        type: "post",
                        url: "login.php",
                        data: {
                            "username": username,
                            "password": hash,
                        },
                        success: function(data, textStatus, jqXHR){
                            if(data=="false")
                                alert("用户名或者密码错误");
                            else if(data==="true")
                                window.location.href="admin-info-hotel.php";
                            console.log(data);
                        },
                        datatype: "text"
                    })
                })
            });

        </script>
