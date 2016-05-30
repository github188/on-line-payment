# on-line-payment

##Github 项目使用须知!!!
* 各小组成员都只能在属于自己的文件夹下以及common文件夹（公共函数、类、全局变量等）提交代码
* 如果小组之间需要进行代码协商可以在issue栏里面讨论，或移至teambition、QQ
* 开发IDE一般都集成Github的功能，如果没有可以用命令行或者git gui等图形化管理工具
* 如无必要，不用fork仓库，再提交pull request。可以直接git clone 到本地，然后直接提交到这个仓库
* 前端界面编写是否使用模板未定

###Git 常用命令
* git clone https://github.com/onlinePayment/on-line-payment.git    #克隆仓库到本地
* git add * 	
* git commit -m ""
* git push -u origin master 	#上面三条用来向远程仓库提交代码
* git pull 	#获取远程仓库的更新

##Module 1: Personal Account Management
* 登录注册页面
* 账户管理页面，修改密码，修改个人信息，充值
* 查询最近一个月的交易订单

##Module 2: Payment Transaction Processing
* 处理订单，已付款，未付款，已取消
* 购物车
* 交易历史

##Module 3: Online Booking
* 显示酒店和机票
* 给支付的提交订单
* 主要界面设计

##Module 4: Account Reconciliation and Audit
* 对账
* 核查商品信息

##Module 5: System Administration
* 后台界面
* 添加新的管理员
* 管理员的信息和用户信息，vip用户
* 管理所有人的数据


##各组文件名
1. PAM
2. Payment
3. Booking
4. Audit
5. Admin

##杂项
网址首页
http://115.159.36.21/payment/Booking/index.php

是否用php框架 函数类 接口分离 不用
面向对象的方法裸写

开发语言 php 5.4.45

##数据库表结构定义
* admin(a_id, name, password, type) //管理root,user,good
* seller(s_id, username, password, balance, sellType(hotel or flight), information, tel, email, real_name,
           sex, birthday, status)
* buyer(b_id, username, password, balance, real_name, email, tel, sex, birthday, status)
* hotel(h_id, s_id, name,  price, information, total)
* flight(f_id, s_id, name, price, information, from, to, time, total)
* order(o_id, seller_id, buyer_id, state, type, g_id, price, num, begintime, endtime)
* IDauthReq(u_id, userType, realName, ID, processed) 身份认证处理请求表


##时间计划
* 第二周 (5.12)周四讨论
* 第三周 (5.18)交初期报告

* 各小组完成自己的项目

* 第五周 周末挑个时间讨论
* 第六周 整合测试
