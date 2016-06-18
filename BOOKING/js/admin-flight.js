$(function() {
    $('#startdate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        startDate: moment(),
    });

    $('.city-select').citySelect();

    $("#submit").click(function(){
      from=$("#fromcity").val();
      to=$("#tocity").val();
      window.location.href="flight.php?from="+from+"&to="+to;
    })

    $("#price").click(function(){
                flights=$("#flights>div");
                container=$("#flights");
                flights.remove();
                flights.sort(function(a,b){
                    pricea=parseInt($(a).find("price").html().slice(1));
                    priceb=parseInt($(b).find("price").html().slice(1));
                    if(a===b)
                        return 0;
                    if(updown==="down")
                        return pricea<priceb? -1:1;
                    if(updown==="up")
                        return pricea<priceb? 1:-1;
                });
                reverseUpdown("points");
                for(var i=0;i<flights.length;i++){
                    container.append(flights[i]);
                }
                return false;
            });

});

updown="down";//从小到大或者是从大到小
function reverseUpdown(){
    if(updown==="down"){
        updown="up";
        $($("#price img")).attr("src","/img/up.png");
    }
    else if(updown=="up"){
        updown="down";
        $($("#price img")).attr("src","/img/down.png");   
    }
}

var selectTime="all";//all,morning,noon,night
var company="all"//all,各个公司的名字
var cangwei="all"//all,jingji,tou,shangwu

function fliter_flight(){
       flights=$("#flights>div");//所有机票DOM节点
       flights.show();
       for(var i=0;i<flights.length;i++){
            if(!checkTime(flights[i])||!checkCompany(flights[i])||!checkCangwei(flights[i]))
                $(flights[i]).hide();
       }
}

function changeTime(value){
//console.log(value)
  selectTime=value;
  //console.log(selectTime);
  fliter_flight();
}

function changeCompany(value){
  //  console.log(value)
  company=value;
  fliter_flight();
}

function changeCangwei(value){
    //console.log(value)
  cangwei=value;
  fliter_flight();
}

function checkTime(flight){
    start=parseInt($($(flight).find("times")[0]).html());//找到开始的时间
    if(selectTime==="all")
        return true
    else if(selectTime==="morning")
        return 6<=start&&start<12;
    else if(selectTime==="noon")
        return 12<=start&&start<18;
    else if(selectTime==="night")
        return start>=18;
}

function checkCompany(flight){
    name=$(flight).find("com").html();
    if(company==="all")
        return true;
    else
        return name===company;
}

function checkCangwei(flight){
    name=$(flight).find("cangwei").html();
    if(cangwei==="all")
        return true
    else
        return name===cangwei;
}