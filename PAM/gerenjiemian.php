<?php
require_once("../common/verifyLogin.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>远途网</title>
    <link href="css/sui-themes-green.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/sui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/messages_zh.js"></script>
    <script src="js/additional-methods.js"></script>
    <script src="js/md5.js"></script>
    <link href="css/sui-append.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        #headline-container {
            margin-top: 20px;
            height: 65px;
        }

        #headline-container h1 {
            color: #27AE60;
        }

        #headline-container h1 span {
            color: green;
            font-size: 20px;
        }

        .panel-heading {
            background-color: #27AE60;
            color: black;
        }

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

        .error {
            color: red;
        }
    </style>

    <script>
        var page = 1;
        $(document).ready(function () {
          $("#tr1").hide();
          $("#tr2").hide();
          $("#tr3").hide();
          $("#tr4").hide();
          $("#tr5").hide();
            $("#mulu1").click(function () {
                $("#xiugaigerenxinxi").hide();
                $("#xiugaimima").hide();
                $("#zhanghuchongzhi").hide();
                $("#chaxunzhanghuyue").hide();
                $("#chaxunxiaofeijilu").hide();
                $("#chakangerenxinxi").show();
                Get();
            });
            $("#mulu2").click(function () {
                $("#chakangerenxinxi").hide();
                $("#xiugaimima").hide();
                $("#zhanghuchongzhi").hide();
                $("#chaxunzhanghuyue").hide();
                $("#chaxunxiaofeijilu").hide();
                $("#xiugaigerenxinxi").show();
                var request = new XMLHttpRequest();
                request.open("GET", "personInfoQuery.php");
                request.send();
                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                        if (request.status === 200) {
                            var obj = JSON.parse(request.responseText);
                            document.getElementById("mod_status").innerHTML = obj.status;
                            document.getElementById("mod_username").value = obj.username;
                            document.getElementById("mod_birthday").value = obj.birthday;
                            document.getElementById("mod_telephone").value = obj.telephone;
                            document.getElementById("mod_email").innerHTML = obj.email;
                            if (obj.sex == "男")
                                document.getElementById("male").checked = true;
                            else if (obj.sex == "女")
                                document.getElementById("female").checked = true;
                            $("#mod_real_name").empty();
                            $("#mod_IDcardNum").empty();
                            if (obj.status === "认证成功" || obj.status === "待认证") {
                                var real_name = $("<label></label>").text(obj.real_name);
                                var IDcardNum = $("<label></label>").text(obj.IDcardNum);
                            } else if (obj.status == "认证失败") {
                                var real_name = document.createElement("input");
                                real_name.value = obj.real_name;
                                var IDcardNum = document.createElement("input");
                                IDcardNum.value = obj.IDcardNum;
                            }
                            $("#mod_real_name").append(real_name);
                            $("#mod_IDcardNum").append(IDcardNum);
                        }
                        else {
                            alert("发生错误：" + request.status);
                        }
                    }
                }
            });
            $("#mulu3").click(function () {
                $("#xiugaigerenxinxi").hide();
                $("#chakangerenxinxi").hide();
                $("#zhanghuchongzhi").hide();
                $("#chaxunzhanghuyue").hide();
                $("#chaxunxiaofeijilu").hide();
                $("#xiugaimima").show();
            });
            $("#mulu4").click(function () {
                $("#xiugaigerenxinxi").hide();
                $("#xiugaimima").hide();
                $("#chakangerenxinxi").hide();
                $("#chaxunzhanghuyue").hide();
                $("#chaxunxiaofeijilu").hide();
                $("#zhanghuchongzhi").show();
            });
            $("#mulu5").click(function () {
                $("#xiugaigerenxinxi").hide();
                $("#xiugaimima").hide();
                $("#zhanghuchongzhi").hide();
                $("#chakangerenxinxi").hide();
                $("#chaxunxiaofeijilu").hide();
                $("#chaxunzhanghuyue").show();
                var request = new XMLHttpRequest();
                request.open("GET", "getBalance.php");
                request.send();
                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                        if (request.status === 200) {
                            document.getElementById("yue").innerHTML = request.responseText;
                        }
                        else {
                            alert("发生错误：" + request.status);
                        }
                    }
                }
            });
            $("#mulu6").click(function () {
                $("#xiugaigerenxinxi").hide();
                $("#xiugaimima").hide();
                $("#zhanghuchongzhi").hide();
                $("#chaxunzhanghuyue").hide();
                $("#chakangerenxinxi").hide();
                $("#chaxunxiaofeijilu").show();
            });
            $("#xiugaigerenxinxi_tijiao").click(function () {
                var mod_sex = document.getElementsByName("mod_sex");
                var mod_sexID = "未填写";
                for (var i = 0; i < mod_sex.length; i++) {
                    if (mod_sex[i].checked)
                        mod_sexID = mod_sex[i].value;
                }
                var request = new XMLHttpRequest();
                request.open("POST", "personInfoEdit.php");
                if (document.getElementById("mod_status").innerHTML == "已认证") {
                    var data = "mod_username=" + document.getElementById("mod_username").value
                            + "&mod_sex=" + mod_sexID
                            + "&mod_birthday=" + document.getElementById("mod_birthday").value
                            + "&mod_telephone=" + document.getElementById("mod_telephone").value;
                }
                else {
                    var data = "mod_username=" + document.getElementById("mod_username").value
                            + "&mod_sex=" + mod_sexID
                            + "&mod_birthday=" + document.getElementById("mod_birthday").value
                            + "&mod_telephone=" + document.getElementById("mod_telephone").value
                            + "&mod_real_name=" + document.getElementById("mod_real_name").value
                            + "&mod_IDcardNum=" + document.getElementById("mod_IDcardNum").value;
                }
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(data);

                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                        if (request.status === 200) {
                            if (request.responseText === "update success") {
                                alert("修改成功");
                            } else if (request.responseText === "update fail") {
                                alert("修改失败");
                            } else {
                                alert(request.responseText);
                            }
                        }
                        else {
                            alert("发生错误：" + request.status);
                        }
                    }
                }
            });
            $("#xiugaigerenxinxi_chongzhi").click(function () {
                var request = new XMLHttpRequest();
                request.open("GET", "personInfoQuery.php");
                request.send();
                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                        if (request.status === 200) {
                            var obj = JSON.parse(request.responseText);
                            document.getElementById("mod_status").innerHTML = obj.status;
                            document.getElementById("mod_username").value = obj.username;
                            document.getElementById("mod_birthday").value = obj.birthday;
                            document.getElementById("mod_telephone").value = obj.telephone;
                            document.getElementById("mod_email").innerHTML = obj.email;
                            if (obj.sex == "男")
                                document.getElementById("male").checked = true;
                            else if (obj.sex == "女")
                                document.getElementById("female").checked = true;
                            if (obj.status == "已认证") {
                                $("#mod_real_name").empty();
                                $("#mod_IDcardNum").empty();
                                var real_name = $("<label></label>").text(obj.real_name);
                                $("#mod_real_name").append(real_name);
                                var IDcardNum = $("<label></label>").text(obj.IDcardNum);
                                $("#mod_IDcardNum").append(IDcardNum);
                            }
                        }
                        else {
                            alert("发生错误：" + request.status);
                        }
                    }
                }
            });
            $("#xiugaimima_chongzhi").click(function () {
                document.getElementById("oldpassword").value = "";
                document.getElementById("newpassword").value = "";
                document.getElementById("renewpassword").value = "";
            });
            $("#zhanghuchongzhi_tijiao").click(function () {
                var money_charge= document.getElementById("money").value;
                var re = /^\d+$/;
                if( !re.test(money_charge) ) {
                    alert("金额只能输入数字,且为正整数");
                    return false;
                }
                var request = new XMLHttpRequest();
                request.open("POST", "deposit.php");
                var data = "chongzhipassword=" + hex_md5(document.getElementById("chongzhipassword").value)
                        + "&money=" + document.getElementById("money").value;
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(data);

                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                        if (request.status === 200) {
                            alert("success");
                        }
                        else {
                            alert("发生错误：" + request.status);
                        }
                    }
                }
            });
            $("#zhanghuchongzhi_chongzhi").click(function () {
                document.getElementById("chongzhipassword").value = "";
                document.getElementById("money").value = "";
            });
            $("#chaxun").click(function () {
              $("#tr1").hide();
              $("#tr2").hide();
              $("#tr3").hide();
              $("#tr4").hide();
              $("#tr5").hide();
              page = 1;
                var request = new XMLHttpRequest();
                var year = document.getElementById("year")
                var month = document.getElementById("month");
                var checkYear;
                var checkMonth;
                for (var i = 0; i < year.length; i++) {
                    if (year.options[i].selected)
                        checkYear = year.options[i].value;
                }
                for (var i = 0; i < month.length; i++) {
                    if (month.options[i].selected)
                        checkMonth = month.options[i].value;
                }
                request.open("GET", "dealInfoQuery.php?checkYear=" + checkYear + "&checkMonth=" + checkMonth);
                request.send();
                request.onreadystatechange = function () {
                  if (request.readyState === 4) {
                        if (request.status === 200) {
                          if(request.responseText === "") {
                            return false;
                          }
                        var obj = JSON.parse(request.responseText);
                        var ordernumber = obj.length;
                        for (var i = 1; i <= 5; i++) {
                            document.getElementById("sellername" + i).innerHTML = "";
                            document.getElementById("goodsname" + i).innerHTML = "";
                            document.getElementById("price" + i).innerHTML = "";
                            document.getElementById("num" + i).innerHTML = "";
                            document.getElementById("total" + i).innerHTML = "";
                            document.getElementById("begtime" + i).innerHTML = "";
                            document.getElementById("endtime" + i).innerHTML = "";
                        }
                        if(ordernumber < 5)
                        {
                          for (var i = 1; i <= ordernumber; i++) {
                            $("#tr" + i).show();
                          }
                        }
                        else
                        {
                          $("#tr1").show();
                          $("#tr2").show();
                          $("#tr3").show();
                          $("#tr4").show();
                          $("#tr5").show();
                        }
                          for (var i = 1; i <= ordernumber; i++) {
                              document.getElementById("sellername" + i).innerHTML = obj[i - 1].sellername;
                              document.getElementById("goodsname" + i).innerHTML = obj[i - 1].goodsname;
                              document.getElementById("price" + i).innerHTML = obj[i - 1].price;
                              document.getElementById("num" + i).innerHTML = obj[i - 1].num;
                              document.getElementById("total" + i).innerHTML = obj[i - 1].total;
                              document.getElementById("begtime" + i).innerHTML = obj[i - 1].begtime;
                              document.getElementById("endtime" + i).innerHTML = obj[i - 1].endtime;
                          }
                      }
                      else {
                          alert("发生错误：" + request.status);
                      }
                  }
                }
            });
            $("#firstpage").click(function () {
              $("#tr1").hide();
              $("#tr2").hide();
              $("#tr3").hide();
              $("#tr4").hide();
              $("#tr5").hide();
              page = 1;
                var request = new XMLHttpRequest();
                var year = document.getElementById("year")
                var month = document.getElementById("month");
                var checkYear;
                var checkMonth;
                for (var i = 0; i < year.length; i++) {
                    if (year.options[i].selected)
                        checkYear = year.options[i].value;
                }
                for (var i = 0; i < month.length; i++) {
                    if (month.options[i].selected)
                        checkMonth = month.options[i].value;
                }
                request.open("GET", "dealInfoQuery.php?checkYear=" + checkYear + "&checkMonth=" + checkMonth);
                request.send();
                request.onreadystatechange = function () {
                  if (request.readyState === 4) {
                        if (request.status === 200) {
                          if(request.responseText === "") {
                            return false;
                          }
                        var obj = JSON.parse(request.responseText);
                        var ordernumber = obj.length;
                        for (var i = 1; i <= 5; i++) {
                            document.getElementById("sellername" + i).innerHTML = "";
                            document.getElementById("goodsname" + i).innerHTML = "";
                            document.getElementById("price" + i).innerHTML = "";
                            document.getElementById("num" + i).innerHTML = "";
                            document.getElementById("total" + i).innerHTML = "";
                            document.getElementById("begtime" + i).innerHTML = "";
                            document.getElementById("endtime" + i).innerHTML = "";
                        }
                        if(ordernumber < 5)
                        {
                          for (var i = 1; i <= ordernumber; i++) {
                            $("#tr" + i).show();
                          }
                        }
                        else
                        {
                          $("#tr1").show();
                          $("#tr2").show();
                          $("#tr3").show();
                          $("#tr4").show();
                          $("#tr5").show();
                        }
                          for (var i = 1; i <= ordernumber; i++) {
                              document.getElementById("sellername" + i).innerHTML = obj[i - 1].sellername;
                              document.getElementById("goodsname" + i).innerHTML = obj[i - 1].goodsname;
                              document.getElementById("price" + i).innerHTML = obj[i - 1].price;
                              document.getElementById("num" + i).innerHTML = obj[i - 1].num;
                              document.getElementById("total" + i).innerHTML = obj[i - 1].total;
                              document.getElementById("begtime" + i).innerHTML = obj[i - 1].begtime;
                              document.getElementById("endtime" + i).innerHTML = obj[i - 1].endtime;
                          }
                      }
                      else {
                          alert("发生错误：" + request.status);
                      }
                  }
                }
            });
            $("#lastpage").click(function () {
                var request = new XMLHttpRequest();
                var year = document.getElementById("year")
                var month = document.getElementById("month");
                var checkYear;
                var checkMonth;
                for (var i = 0; i < year.length; i++) {
                    if (year.options[i].selected)
                        checkYear = year.options[i].value;
                }
                for (var i = 0; i < month.length; i++) {
                    if (month.options[i].selected)
                        checkMonth = month.options[i].value;
                }
                request.open("GET", "dealInfoQuery.php?checkYear=" + "&checkMonth=");
                request.send();
                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                        if (request.status === 200) {
                            if (page == 1)
                                return false;
                            $("#tr1").show();
                            $("#tr2").show();
                            $("#tr3").show();
                            $("#tr4").show();
                            $("#tr5").show();
                            page--;
                            var obj = JSON.parse(request.responseText);
                            for (var i = 1; i <= 5; i++) {
                                document.getElementById("sellername" + i).innerHTML = "";
                                document.getElementById("goodsname" + i).innerHTML = "";
                                document.getElementById("price" + i).innerHTML = "";
                                document.getElementById("num" + i).innerHTML = "";
                                document.getElementById("total" + i).innerHTML = "";
                                document.getElementById("begtime" + i).innerHTML = "";
                                document.getElementById("endtime" + i).innerHTML = "";
                            }
                            if (obj.length == 0) {
                                return false;
                            }
                            for (var i = 1; i <= 5; i++) {
                                document.getElementById("sellername" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].sellername;
                                document.getElementById("goodsname" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].goodsname;
                                document.getElementById("price" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].price;
                                document.getElementById("num" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].num;
                                document.getElementById("total" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].total;
                                document.getElementById("begtime" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].begtime;
                                document.getElementById("endtime" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].endtime;
                            }
                        }
                        else {
                            alert("发生错误：" + request.status);
                        }
                    }
                }
            });
            $("#nextpage").click(function () {
                var request = new XMLHttpRequest();
                var year = document.getElementById("year")
                var month = document.getElementById("month");
                var checkYear;
                var checkMonth;
                for (var i = 0; i < year.length; i++) {
                    if (year.options[i].selected)
                        checkYear = year.options[i].value;
                }
                for (var i = 0; i < month.length; i++) {
                    if (month.options[i].selected)
                        checkMonth = month.options[i].value;
                }
                request.open("GET", "dealInfoQuery.php?checkYear=" + checkYear + "&checkMonth=" + checkMonth);
                request.send();
                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                        if (request.status === 200) {
                            var obj = JSON.parse(request.responseText);
                            if (obj.length == 0) {
                                return false;
                            }
                            if (obj.length <= page * 5)
                                return false;

                            for (var i = 1; i <= 5; i++) {
                                document.getElementById("sellername" + i).innerHTML = "";
                                document.getElementById("goodsname" + i).innerHTML = "";
                                document.getElementById("price" + i).innerHTML = "";
                                document.getElementById("num" + i).innerHTML = "";
                                document.getElementById("total" + i).innerHTML = "";
                                document.getElementById("begtime" + i).innerHTML = "";
                                document.getElementById("endtime" + i).innerHTML = "";
                            }
                            $("#tr1").hide();
                            $("#tr2").hide();
                            $("#tr3").hide();
                            $("#tr4").hide();
                            $("#tr5").hide();
                            page++;
                            var number;
                            if ((obj.length - (page - 1) * 5) >= 5)
                                number = 5;
                            else
                                number = (obj.length - (page - 1) * 5) % 5;

                            for (var i = 1; i <= number; i++) {
                              $("#tr" + i).show();
                            }

                            for (var i = 1; i <= number; i++) {
                                document.getElementById("sellername" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].sellername;
                                document.getElementById("goodsname" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].goodsname;
                                document.getElementById("price" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].price;
                                document.getElementById("num" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].num;
                                document.getElementById("total" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].total;
                                document.getElementById("begtime" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].begtime;
                                document.getElementById("endtime" + i).innerHTML = obj[i - 1 + 5 * (page - 1)].endtime;
                            }
                        }
                        else {
                            alert("发生错误：" + request.status);
                        }
                    }
                }
            });
        });
        $().ready(function () {
            // 提交时验证表单
            var validator = $("#form1").validate({
                errorPlacement: function (error, element) {
                    // Append error within linked label
                    $(element).closest("form").find("label[for='" + element.attr("id") + "']").append(error);
                },
                errorElement: "span",
                messages: {
                    newpassword: {
                        required: " (必需字段)",
                        minlength: " (亲，密码必须是6-12位哦)",
                        maxlength: " (亲，密码必须是6-12位哦)"
                    },
                    renewpassword: {
                        required: "请输入密码",
                        equalTo: "两次密码输入不一致"
                    }
                },
                rules: {
                    newpassword: {
                        required: true,
                        minlength: 6,
                        maxlength: 12
                    },
                    renewpassword: {
                        required: true,
                        equalTo: "#newpassword"
                    }
                },
                submitHandler: function (form) {  //通过之后回调
                    var request = new XMLHttpRequest();
                    request.open("POST", "editPass.php");
                    var data = "oldpassword=" + hex_md5(document.getElementById("oldpassword").value)
                            + "&newpassword=" + hex_md5(document.getElementById("newpassword").value)
                            + "&renewpassword=" + hex_md5(document.getElementById("renewpassword").value);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(data);
                    request.onreadystatechange = function () {
                        if (request.readyState === 4) {
                            if (request.status === 200) {
                                alert(request.responseText);
                            } else {
                                alert("发生错误：" + request.status);
                            }
                        }
                    }
                },
                invalidHandler: function (form, validator) {  //不通过回调
                    return false;
                }
            });
        });
    </script>
</head>
<body>
<div class="container">
    <div class="row" id="headline-container">
        <h1 class="col-md-1">
            <img src="images/yuantuwang.jpg" width="60" height="60" alt="some_text">
        </h1>
        <h1 class="col-md-2">
            <em><strong>远途网</strong></em>
        </h1>
    </div>
</div>
<hr style="height:3px;background-color: green">
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-3">
            <div class="span3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#27AE60;color:black;">
                        <h3 class="panel-title">信息管理</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <td><a href="#" id="mulu1">查看个人信息</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><a href="#" id="mulu2">修改个人信息</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><a href="#" id="mulu3">修改密码</a></td>
                            <td></td>
                        </tr>
                    </table>
                    <div class="panel-heading" style="background-color:#27AE60;color:black;">
                        <h3 class="panel-title">业务办理</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <td><a href="#" id="mulu4">账户充值</a></td>
                            <td></td>
                        </tr>
                    </table>
                    <div class="panel-heading" style="background-color:#27AE60;color:black;">
                        <h3 class="panel-title">业务查询</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <td><a href="#" id="mulu5">查询账户余额</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><a href="#" id="mulu6">查询消费记录</a></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="chakangerenxinxi">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#27AE60;color:black;">
                    <h3 class="panel-title">查看个人信息</h3>
                </div>
                <table class="table">
                    <tr>
                        <td>用户名</td>
                        <td id="username"></td>
                    </tr>
                    <tr>
                        <td>性别</td>
                        <td id="sex"></td>
                    </tr>
                    <tr>
                        <td>生日</td>
                        <td id="birthday"></td>
                    </tr>
                    <tr>
                        <td>电话号码</td>
                        <td id="telephone"></td>
                    </tr>
                    <tr>
                        <td>电子邮件</td>
                        <td id="email"></td>
                    </tr>
                    <tr>
                        <td>认证状态</td>
                        <td id="status"></td>
                    </tr>
                    <tr>
                        <td>真实姓名</td>
                        <td id="real_name"></td>
                    </tr>
                    <tr>
                        <td>身份证号</td>
                        <td id="IDcardNum"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-5" id="xiugaigerenxinxi">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#27AE60;color:black;">
                    <h3 class="panel-title">修改个人信息</h3>
                </div>
                <div>
                    <div class="container" style="padding:15px;">
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="mod_username" class="control-label">用户名：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <input type="text" id="mod_username" name="mod_username">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="mod_sex" class="control-label">性别：</label>
                            </div>
                            <div class="col-md-4">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="mod_sex" id="male"
                                               value="男"> 男
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="mod_sex" id="female"
                                               value="女">
                                        女
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="mod_birthday" class="control-label">生日：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <input type="text" id="mod_birthday" data-toggle="datepicker" value="">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="mod_telephone" class="control-label">电话号码：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <input type="text" id="mod_telephone" name="mod_telephone">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="mod_email" class="control-label">电子邮件：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <label for="mod_status" class="control-label" id="mod_email"></label>
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="mod_status" class="control-label">认证状态：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <label for="mod_status" class="control-label" id="mod_status"></label>
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="mod_real_name" class="control-label">真实姓名：</label>
                            </div>
                            <div class="col-md-4 controls" id="mod_real_name">
                                <input type="text" name="mod_real_name">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="mod_IDcardNum" class="control-label">身份证号：</label>
                            </div>
                            <div class="col-md-4 controls" id="mod_IDcardNum">
                                <input type="text" name="mod_IDcardNum">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <button class="button" id="xiugaigerenxinxi_tijiao" type="submit"
                                        style="vertical-align:middle">
                                    <span>确认</span></button>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <button class="button" id="xiugaigerenxinxi_chongzhi" type="submit"
                                        style="vertical-align:middle">
                                    <span>重置</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="xiugaimima">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#27AE60;color:black;">
                    <h3 class="panel-title">修改密码</h3>
                </div>
                <form class="cmxform" id="form1" method="post" action="editPass.php">
                    <div class="container" style="padding:15px;">
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="oldpassword" class="control-label">原密码：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <input type="password" id="oldpassword" name="oldpassword">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="newpassword" class="control-label">新密码：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <input type="password" id="newpassword" name="newpassword">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="renewpassword" class="control-label">重复密码：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <input type="password" id="renewpassword" name="renewpassword">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <button class="button" id="xiugaimima_tijiao" style="vertical-align:middle">
                                    <span>确认</span></button>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <button class="button" id="xiugaimima_chongzhi" style="vertical-align:middle">
                                    <span>重置</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5" id="zhanghuchongzhi">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#27AE60;color:black;">
                    <h3 class="panel-title">账户充值</h3>
                </div>
                <div>
                    <div class="container" style="padding:15px;">
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="chongzhipassword" class="control-label">密码：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <input type="password" id="chongzhipassword" name="chongzhipassword">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <label for="money" class="control-label">充值金额：</label>
                            </div>
                            <div class="col-md-4 controls">
                                <input type="text" id="money" name="money">
                            </div>
                        </div>
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-2">
                                <button class="button" id="zhanghuchongzhi_tijiao" style="vertical-align:middle;">
                                    <span>确认</span></button>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <button class="button" id="zhanghuchongzhi_chongzhi" style="vertical-align:middle;">
                                    <span>重置</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="chaxunzhanghuyue">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#27AE60;color:black;">
                    <h3 class="panel-title">查询账户余额</h3>
                </div>
                <table class="table">
                    <tr>
                        <td>账户余额:</td>
                        <td id="yue"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-5" id="chaxunxiaofeijilu">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#27AE60;color:black;">
                    <h3 class="panel-title">查询消费记录</h3>
                </div>
                <div class="panel-body">
                    <div class="container" style="padding:15px;">
                        <div class="row" style="border:15px; margin:15px;">
                            <div class="col-md-1">
                                <label>年份：</label>
                            </div>
                            <div class="col-md-1">
                                <select id="year">
                                    <option value="" selected>年份</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label>月份：</label>
                            </div>
                            <div class="col-md-1">
                                <select id="month">
                                    <option value="" selected>月份</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="button" id="chaxun" style="vertical-align:middle;">
                                    <span>查询</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <caption>消费记录</caption>
                        <thead>
                        <tr>
                            <th>卖家</th>
                            <th>商品</th>
                            <th>价格</th>
                            <th>数量</th>
                            <th>总价</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="tr1">
                            <td id="sellername1"></td>
                            <td id="goodsname1"></td>
                            <td id="price1"></td>
                            <td id="num1"></td>
                            <td id="total1"></td>
                            <td id="begtime1"></td>
                            <td id="endtime1"></td>
                        </tr>
                        <tr id="tr2">
                            <td id="sellername2"></td>
                            <td id="goodsname2"></td>
                            <td id="price2"></td>
                            <td id="num2"></td>
                            <td id="total2"></td>
                            <td id="begtime2"></td>
                            <td id="endtime2"></td>
                        </tr>
                        <tr id="tr3">
                            <td id="sellername3"></td>
                            <td id="goodsname3"></td>
                            <td id="price3"></td>
                            <td id="num3"></td>
                            <td id="total3"></td>
                            <td id="begtime3"></td>
                            <td id="endtime3"></td>
                        </tr>
                        <tr id="tr4">
                            <td id="sellername4"></td>
                            <td id="goodsname4"></td>
                            <td id="price4"></td>
                            <td id="num4"></td>
                            <td id="total4"></td>
                            <td id="begtime4"></td>
                            <td id="endtime4"></td>
                        </tr>
                        <tr id="tr5">
                            <td id="sellername5"></td>
                            <td id="goodsname5"></td>
                            <td id="price5"></td>
                            <td id="num5"></td>
                            <td id="total5"></td>
                            <td id="begtime5"></td>
                            <td id="endtime5"></td>
                        </tr>
                        </tbody>
                    </table>
                    <ul class="pager">
                        <li><a href="#" id="firstpage">首页</a></li>
                        <li><a href="#" id="lastpage">上一页</a></li>
                        <li><a href="#" id="nextpage">下一页</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4" id="yewutongzhi">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#27AE60;color:black;">
                    <h3 class="panel-title">业务通知</h3>
                </div>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="col-md-12" style="margin-top:10px;">
                            <ul>
                                <li>
                                    关于升级为VIP用户的通知
                                </li>
                                <li>

                                </li>
                                <li>

                                </li>
                                <li>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#xiugaigerenxinxi").hide();
        $("#xiugaimima").hide();
        $("#zhanghuchongzhi").hide();
        $("#chaxunzhanghuyue").hide();
        $("#chaxunxiaofeijilu").hide();
        $("#chakangerenxinxi").show();
        /*
         setCookie("username", "676748318@qq.com", 1);
         var cookie = getCookie("username");*/
        Get();
        function Get() {
            var request = new XMLHttpRequest();
            request.open("GET", "personInfoQuery.php");
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        obj = JSON.parse(request.responseText);
                        document.getElementById("username").innerHTML = obj.username;
                        document.getElementById("sex").innerHTML = obj.sex;
                        document.getElementById("birthday").innerHTML = obj.birthday;
                        document.getElementById("telephone").innerHTML = obj.telephone;
                        document.getElementById("email").innerHTML = obj.email;
                        document.getElementById("status").innerHTML = obj.status;
                        document.getElementById("real_name").innerHTML = obj.real_name;
                        document.getElementById("IDcardNum").innerHTML = obj.IDcardNum;
                    }
                    else {
                        alert("发生错误：" + request.status);
                    }
                }
            }
        }


        /*
         function setCookie(cname,cvalue,exdays)
         {
         var d = new Date();
         d.setTime(d.getTime()+(exdays*24*60*60*1000));
         var expires = "expires="+d.toGMTString();
         document.cookie = cname + "=" + cvalue + "; " + expires;
         }
         function getCookie(cname)
         {
         var name = cname + "=";
         var ca = document.cookie.split(';');
         for(var i=0; i<ca.length; i++)
         {
         var c = ca[i].trim();
         if (c.indexOf(name)==0) return c.substring(name.length,c.length);
         }
         return "";
         }*/
    </script>
</body>
</html>
