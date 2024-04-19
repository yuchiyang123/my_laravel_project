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
    background-color: gray;
    border-radius: 15px;
    box-shadow: 0 2 12px 0 rgba(0,0,0,0.1);
    text-align: center;
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
            
            <svg width="166" height="150" id="topIcon"><g id="Shot" fill="none" fill-rule="evenodd"><g id="shot2" transform="translate(-135 -157)"><g id="success-card" transform="translate(48 120)"><g id="Top-Icon" transform="translate(99.9 47.7)"><g id="Bubbles" fill="#5AE9BA"><g id="bottom-bubbles" transform="translate(0 76)"><ellipse id="Oval-Copy-3" cx="12.8571429" cy="13.2605405" rx="12.8571429" ry="12.8432432"/><ellipse id="Oval-Copy-4" cx="25.0714286" cy="34.4518919" rx="8.35714286" ry="8.34810811"/><ellipse id="Oval-Copy-6" cx="42.4285714" cy="31.2410811" rx="7.71428571" ry="7.70594595"/></g><g id="top-bubbles" transform="translate(92)"><ellipse id="Oval" cx="13.4285714" cy="23.76" rx="12.8571429" ry="12.8432432"/><ellipse id="Oval-Copy" cx="37.8571429" cy="25.0443243" rx="5.14285714" ry="5.1372973"/><ellipse id="Oval-Copy-2" cx="30.1428571" cy="7.70594595" rx="7.71428571" ry="7.70594595"/></g></g><g id="Circle" transform="translate(18.9 11.7)"><ellipse id="blue-color" cx="56.341267" cy="54.0791109" fill="#5AE9BA" rx="51.2193336" ry="51.5039151"/><ellipse id="border" cx="51.2283287" cy="51.5039151" stroke="#3C474D" stroke-width="5" rx="51.2193336" ry="51.5039151"/><path id="bluetooth" fill="#FFF" fill-rule="nonzero" d="M51.2028096 52.9593352l12.1775292-9.6235055c.3644184-.2872475.5941296-.714554.6368262-1.1784596.0426967-.4637471-.111547-.924167-.4168832-1.2724131l-13.444407-15.2100186c-.4628885-.5249041-1.201336-.7047309-1.8545476-.4570927-.6532117.2492225-1.0831718.8780617-1.0831718 1.5794653v22.4403228l-7.2604808-6.778123c-.6729057-.6321664-1.739692-.5957257-2.3732097.0874576-.6335176.6849262-.5941295 1.7543806.0887019 2.3881314l8.3601956 7.8097108-8.2551082 6.5239889c-.7319878.575921-.8567692 1.6388795-.2856422 2.3732382.5744355.7361016 1.6379132.8598414 2.3599753.2839204L47.2181554 56.1067v21.3906731c0 .663537.3841124 1.2641743.9847016 1.5381131.2232516.1023508.4595799.1517833.6959083.1517833.4004979 0 .7943785-.1435445 1.1061744-.4174833l13.444407-11.8300673c.3578012-.315291.5678183-.7690566.5744355-1.2476968.0066172-.4786403-.1871721-.9374759-.538356-1.26259L51.2028096 52.9593352zM50.579092 31.546148l9.603625 10.6136051-9.603625 7.4127652V31.546148zm0 42.49073V57.2981056l8.9633833 8.6179286-8.9633833 8.1208438z"/></g></g></g></g></g></svg>
            
            <h3>SUCCESS!</h3>
            <p>You have successfully transferred your file via bluetooth.</p>
            
            <button id="btnClick">CONTINUE</button>

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