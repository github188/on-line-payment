# on-line-payment

##Module 1: Personal Account Management
登录注册页面
账户管理页面，修改密码，修改个人信息，充值
查询最近一个月的交易订单

##Module 2: Payment Transaction Processing
处理订单，已付款，未付款，已取消
购物车
交易历史

##Module 3: Online Booking
显示酒店和机票
给支付的提交订单
主要界面设计

##Module 4: Account Reconciliation and Audit
对账
核查商品信息

##Module 5: System Administration
后台界面
添加新的管理员
管理员的信息和用户信息，vip用户
管理所有人的数据

开发语言 php 5.4.45

##各组文件名
PAM
Payment
Booking
Audit
Admin

网址首页
http://115.159.36.21/payment/Booking/index.php

是否用php框架 函数类 接口分离 不用
面向对象的方法裸写

##数据库表结构定义
admin(a_id, name, password, type) //管理root,user,good
seller(s_id, name, password, account, type, information, tel, email, real_name)
buyer(b_id, name, password, real_name, email, tel, account)
hotel(h_id, name,  price, information, total)
flight(f_id, name, price, information, from, to, time, total)
order(o_id, seller_id, buyer_id, state, type, g_id, price, num)


##时间计划
第二周 (5.12)周四讨论
第三周 (5.18)交初期报告

各小组完成自己的项目

第五周 周末挑个时间讨论
第六周 整合测试
