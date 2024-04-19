@include('header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700');

body{
    font-family: 'Quicksand', sans-serif;
}

.screen{
  cursor: pointer;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    overflow: hidden;
    width: 330px;
    height: 360px;
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 2 12px 0 rgba(0,0,0,0.1);
    text-align: center;
    border: 1px solid #ECECEC;
    box-shadow: 0 2px 12px 0 rgba(0,0,0,0.1);
}

.screen #topIcon{
    position: absolute;
    left: 50%;
    top: 30%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.screen .border-top{
    position: absolute;
    top: 0;
    height: 10px;
    width: 100%;
    background-color: #5AE9BA;
}

.screen h3{
    font-weight: 700;
    font-size: 24px;
    color: #606060;
    letter-spacing: 0;
    position: absolute;
    left: 50%;
    top: 55%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.screen p{
    font-weight: 400;
    font-size: 16px;
    color: #616161;
    letter-spacing: 0.18px;
    position: absolute;
    left: 50%;
    top: 68%;
    width: 90%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.screen button{
    background: #5AE9BA;
    border: 1px solid #34E2A9;
    box-shadow: 0 3px 20px 0 rgba(90,233,186,0.60);
    border-radius: 100px;
    letter-spacing: 1.5px;
    font-weight: 500;
    color: #fff;
    padding-top: 2px;
    width: 186px;
    height: 40px;
    position: absolute;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    bottom: -20%;
    opacity: 0;
    font-size: 13px;
  cursor: pointer;
}

.screen button:focus{
    outline:0;
  
  : pointer;
}
#Bubbles{
    visibility: hidden;
}

.un{
    -webkit-user-select: none; /* Safari */        
    -moz-user-select: none; /* Firefox */
    -ms-user-select: none; /* IE10+/Edge */
    user-select: none; /* Standard */
}

.tr{
    -webkit-transition: all 0.2s ease-in;
    -moz-transition: all 0.2s ease-in;
    -ms-transition: all 0.2s ease-in;
    -o-transition: all 0.2s ease-in;
    transition: all 0.2s ease-in;
}

.btn-overlay{
    
    background-color: #43d0f1;
    border: 0;
    color: #fff;
    opacity: 0.6;
    padding: 10px 15px;
    border-radius: 100px;
    font-size: 12px;
    letter-spacing: 0.8px;
    z-index: 999;
    width: 100px
}

.btn-overlay:hover{
    opacity: 1;
}

#restart{
    position: fixed;
    right: 10px;
    top: 10px;
}

#invert{
    position: fixed;
    right: 10px;
    top: 55px;
}
</style>
<div class="screen un">
            <div class="border-top">
            </div>
            
            <span class="material-icons-outlined">

</span>
            
            <h3>送出成功!</h3>
            <p>點擊下方按鈕，即可回到首頁</p>
            
            <a href="{{url('/front')}}" ><button id="btnClick">繼續</button></a>

        </div>
<script>
    (function($){
    var red = "#F86969";
    var green = "#5AE9BA";
    var color = green;
    var tlScreen1 = new TimelineMax();
    
    tlScreen1
    .add("start")
    .set("#Bubbles", {visibility: "visible"})
    .from("#bottom-bubbles", 4, {opacity: 0, y:50, x: 40, ease: Elastic.easeOut.config(1, 0.8)})
    .from("#top-bubbles", 4, {opacity: 0, y: 50, x: 40, ease: Elastic.easeOut.config(1, 0.8)}, "start")
    .to("#btnClick", 3.5, {opacity: 1, y: -96, ease: Elastic.easeOut.config(1, 1)}, "-=3.5")
    
    $("#btnClick").mousedown(function() {
        $(this).css("box-shadow","unset");
    });
    
    $("#btnClick").mouseup(function() {
        
        if(color == green){
            $(this).css("box-shadow","0 3px 20px 0 rgba(90,233,186,0.60)");
        }
        else{
            $(this).css("box-shadow","0 3px 13px 0 rgba(248,105,105,0.60)");
        }
        
        
    });
    
    $("#restart").click(function() {
        tlScreen1.restart();
    });
    
    $("#invert").click(function() {
        
        if(color == green){
            tlScreen1.stop();
            
            $(".border-top").css("background-color",red);
            $("#blue-color").css("fill",red);
            $("#bluetooth").css("fill","#D74747");
            $("#Bubbles ellipse").css("fill",red);
            $(".screen button").css({
               'box-shadow' : '0 3px 13px 0 rgba(248,105,105,0.60)',
               'background-color' : red,
                'border-color' : red
            });
            $(".screen button").html("TRY AGAIN");
            $(".screen h3").html("FAILED!");
            $(".screen p").html("Your file has not been transferred successfully via bluetooth.");
            color = red;
            tlScreen1.restart();
            
        }
        else{
            tlScreen1.stop();
            $(".border-top").css("background-color",green);
            $("#blue-color").css("fill",green);
            $("#bluetooth").css("fill","#fff");
            $("#Bubbles ellipse").css("fill",green);
            $(".screen button").css({
               'box-shadow' : '0 3px 20px 0 rgba(90,233,186,0.60)',
               'background-color' : green,
                'border-color' : green
            });
            $(".screen button").html("CONTINUE");
            $(".screen h3").html("SUCCESS!");
            $(".screen p").html("You have successfully transferred your file via bluetooth.");
            color = green;
            tlScreen1.restart();
        }
        
        
    });
    
})(jQuery);
</script>