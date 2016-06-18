 var hotel_fliter = function (){
   a=$("#hotels>div");
   a.show();
   var price1=$('[value=100]');
   var price2=$('[value=200]');
   var price3=$('[value=300]');
   var price4=$('[value=500]');
   var price5=$('[value=500\\+]');//五个价格的筛选

   var point1=$('[value=3]');
   var point2=$('[value=4]');
   var point3=$('[value=5]');//三个评分的筛选框

   var hotel_name=$("#hotel-name").val();//查找的酒店名字

   var stars=parseInt($("#results").html())

   var price;
   var rank;
   var points;
   var name;
   var hotel_star;

   for(var i=0;i<a.length;i++){
        price=parseInt($(a[i]).find("price").text());
        rank= $(a[i]).find("img").length-2;
        points=parseFloat($(a[i]).find("points").text());
        name=$(a[i]).find(".package-name").html();
        hotel_star=$("#results").html();

        if(!price1.is(":checked")){
            if(price<100)
              $(a[i]).hide();
        }
         if(!price2.is(":checked")){
          if(price>=100&&price<200)
           $(a[i]).hide();
        }
         if(!price3.is(":checked")){
          if(price>=200&&price<300)
           $(a[i]).hide();
        }
         if(!price4.is(":checked")){
          if(price>=300&&price<500)
            $(a[i]).hide();
        }
        if(!price5.is(":checked")){
           if(price>500)
              $(a[i]).hide();
        }

        if(!point1.is(":checked")){
              if(points<4.5)
               $(a[i]).hide();
        }
         if(!point2.is(":checked")){
           if(points>=4.5&&points<5)
            $(a[i]).hide();
        }
         if(!point3.is(":checked")){
          if(points==5)
            $(a[i]).hide();
        }
       if(name.indexOf(hotel_name)==-1){
          console.log(name);
          console.log(hotel_name);
          $(a[i]).hide();
        }
        if(hotel_star==="")
          continue
        else if(rank<parseInt(hotel_star)){
          $(a[i]).hide();
        }
   }
   //return false;
}

var updowns={
        "price" : "up",
        "hot" : "down",
        "points": "down",
        "rank": "down"
     }

        $(function()
        {
            function reverseUpdown(sortKey) {
               if(updowns[sortKey]==="up"){
                  updowns[sortKey]="down";
                  $($("#"+sortKey+" img")).attr("src","/img/down.png");
               }
               else if(updowns[sortKey]==="down"){
                  updowns[sortKey]="up";
                  $($("#"+sortKey+" img")).attr("src","/img/up.png");
               }
            }

            $("#price").click(function(){
                a=$("#hotels>div");
                pa=$("#hotels");
                a.remove();
                a.sort(gsort("price",updowns["price"]));
                reverseUpdown("price");
                 for(var i=0;i<a.length;i++) {
                     pa.append(a[i]);
                 }
                return false;
            });

         $("#hot").click(function(){
                a=$("#hotels>div");
                pa=$("#hotels");
                a.remove();
                a.sort(gsort("hot",updowns["hot"]));
                reverseUpdown("hot");
                for(var i=0;i<a.length;i++){
                    pa.append(a[i])
                }
             return false;
            });

            $("#points").click(function(){
                a=$("#hotels>div");
                pa=$("#hotels");
                a.remove();
                a.sort(gsort("points",updowns["points"]));
                reverseUpdown("points");
                for(var i=0;i<a.length;i++){
                    pa.append(a[i]);
                }
                return false;
            });

            $("#rank").click(function(){
                a=$("#hotels>div");
                pa=$("#hotels");
                a.remove();
                a.sort(gsort("rank",updowns["rank"]));
                reverseUpdown("rank");
                for(var i=0;i<a.length;i++){
                    pa.append(a[i]);
                }
                return false;
            });

        $('[name=price]').click(hotel_fliter);

        $('[name=stars]').click(hotel_fliter);

        $("#fliter-hotel").click(hotel_fliter);

         $('#hotelstars').raty({
            hints: ["1星级","2星级","3星级","4星级","5星级"],
            path: "/img",
            click: hotel_fliter,
            target: '#results',
            targetKeep : true
        });
    });
            function gsort(key,updown){//生成排序函数的闭包
                return function(a,b){
                    if(key==="rank"){
                        var x=$(a).find("img").length;
                        var y=$(b).find("img").length;
                    }
                    else{
                        var x=parseFloat($(a).find(key).text());
                        var y=parseFloat($(b).find(key).text());
                    }
                    if(x===y){
                        return 0;
                    }
                    if(updown==="up")
                        return x<y? -1:1;
                    else(updown==="down")
                        return x<y? 1:-1;
                }
            };  