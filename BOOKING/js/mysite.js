    var priceupdown="up";
    var hotupdown="down";
    var rankupdown="down";

        $(function()
        {
            $("#search").submit(function(){
                var options=new Object();
                options.data="test";
                options.datatype="text";
                options.type="get";
                options.success=function (response){
                    $("#hotels>div>a").remove();
                    hotels=JSON.parse(response);
                    for(hotel in hotels){
                        $("#hotels>").append('<a href="/hotel.php?id='+hotels[hotel]['id']+`" class="package list-group-item" data-library-name="bootstrap" target="_blank" "><div class="row"><div class="col-md-3"><h4 class="package-name">`+hotel+'</h4><br /><img src="'+hotels[hotel]["picture"]+'" width="81px" height="81px" /></div><div class="col-md-9 hidden-xs><p class="package-description"><pr>'+hotels[hotel]["province"]+'</pr> <city>'+hotels[hotel]["city"]+'</city>  '+hotels[hotel]["location"]+'</p><span> <hot>'+hotels[hotel]["amount"]+'</hot>名用户曾经入住</span><br><span>房价： <price>'+hotels[hotel]["lowest price"]+'</price><i class="lowest">起</i></span><br><span></i> 评分： <strong><rank>'+hotels[hotel]["rank"]+'</rank>/5</strong></span><br><button type="button" class="btn btn-info navbar-btn">点击以查看更多信息 <img src="img/goto.png"></button></div></div></a>')
                    }
                };
                options.url="search.txt"
                $.ajax(options);
                return false;
            });


            function reverseUpdown(sortKey) {
                if(sortKey=="price"){
                    if(priceupdown=="up")
                            priceupdown="down";
                    else if(priceupdown=="down")
                            priceupdown="up";
                    $($("#"+sortKey).next()).attr("src","img/"+priceupdown+".png");
                }
                else if(sortKey=="hot"){
                    if(hotupdown=="up")
                        hotupdown="down";
                    else if(hotupdown=="down")
                        hotupdown="up";
                    $($("#"+sortKey).next()).attr("src","img/"+hotupdown+".png");
                }
                else if(sortKey=="rank"){
                    if(rankupdown=="up")
                        rankupdown="down";
                    else if(rankupdown=="down")
                        rankupdown="up";
                    $($("#"+sortKey).next()).attr("src","img/"+rankupdown+".png");
                }
            }

            $("#price").click(function(){
                a=$("#hotels>div>a");
                pa=$("#hotels>div");
                a.remove();
                a.sort(gsort("price",priceupdown));
                reverseUpdown("price");
                 for(var i=0;i<a.length;i++) {
                     pa.append(a[i]);
                 }
                return false;
            });

         $("#hot").click(function(){
                a=$("#hotels>div>a");
                pa=$("#hotels>div");
                a.remove();
                a.sort(gsort("hot",hotupdown));
                reverseUpdown("hot");//改变图像的显示
                for(var i=0;i<a.length;i++){
                    pa.append(a[i])
                }
             return false;
            });

            $("#rank").click(function(){
                a=$("#hotels>div>a");
                pa=$("#hotels>div");
                a.remove();
                a.sort(gsort("rank",rankupdown));
                reverseUpdown("rank");
                for(var i=0;i<a.length;i++){
                    pa.append(a[i]);
                }
                return false;
            });

            $('[name=price]').click(function(){
            var first=$('[value=100-]');
            var second=$('[value=200-]');
            var third=$('[value=200\\+]');
            var a=$("#hotels>div>a");
            var f;

            if(first.is(":checked")||second.is(":checked")||third.is(":checked")){
                for(var i=0;i<a.length;i++){
                    $(a[i]).hide();
                }
            }

            else{
                a.show()
            }

            if(first.is(":checked")){
                 f=gfliter("price",function(text){
                        return parseInt(text)<=100;
                    });
                for(var i=0;i<a.length;i++){
                   if(f(a[i])){
                        $(a[i]).show();
                   }
                }
            }
            if(second.is(":checked")){
                f=gfliter("price",function(text){
                        return parseInt(text)>100&&parseInt(text)<200;
                    });
                  for(var i=0;i<a.length;i++){
                   if(f(a[i])){
                        $(a[i]).show();
                   }
            }
        }

            if(third.is(":checked")){
                     f=gfliter("price",function(text){
                        return parseInt(text)>200;
                    });
                  for(var i=0;i<a.length;i++){
                   if(f(a[i])){
                        $(a[i]).show();
                   }
            }
        }
    });

            $("#search").submit();
    });

        

        function gfliter(type,what){//生成筛选函数的闭包,type的取值为city或者price,what是一个函数
            return function(a){
                return what($(a).find(type).text())
            };
        }
    
            function gsort(key,updown){//生成排序函数的闭包
                return function(a,b){
                    var x=parseInt($(a).find(key).text());
                    var y=parseInt($(b).find(key).text());
                    if(x===y){
                        return 0;
                    }
                    if(updown=="up")
                        return x<y? -1:1;
                    else(updown=="down")
                        return x<y? 1:-1;
                }
            };