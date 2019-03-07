
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/hideheader.php' ?>
<?php session_start(); ?>
<?php 

    $oldServing = "" ;
    $_SESSION['oldserving'] = "";
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev/assets/stylesheet/admin.css" >

<style type="text/css" scoped>
  *{
    zoom:97%;
  }
.next-number {
	font-size: 23pt;
}
  .card {
    margin-bottom: 20px;
    height: 450px;
  }

  .card-header {
    background-color: #a12c28;
    color: white;
    margin-bottom: -5px;
  }

.scroll-left {
  margin-top: -10px;
 height: 50px;  
 overflow: hidden;
 position: relative;
 background: transparent;
 color: white;
}
.scroll-left scope {
  font-size: 24pt;
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 50px;
 text-align: center;
 /* Starting position */
 -moz-transform:translateX(100%);
 -webkit-transform:translateX(100%);  
 transform:translateX(100%);
 /* Apply animation to this element */  
 -moz-animation: scroll-left 25s linear infinite;
 -webkit-animation: scroll-left 25s linear infinite;
 animation: scroll-left 30s linear infinite; /*how fast the text*/
}
/* Move it (define the animation) */
@-moz-keyframes scroll-left {
 0%   { -moz-transform: translateX(100%); }
 100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes scroll-left {
 0%   { -webkit-transform: translateX(100%); }
 100% { -webkit-transform: translateX(-100%); }
}
@keyframes scroll-left {
 0%   { 
 -moz-transform: translateX(100%); /* Browser bug fix */
 -webkit-transform: translateX(100%); /* Browser bug fix */
 transform: translateX(100%);     
 }
 100% { 
 -moz-transform: translateX(-100%); /* Browser bug fix */
 -webkit-transform: translateX(-100%); /* Browser bug fix */
 transform: translateX(-100%); 
 }
}

.GeneratedMarquee {
font-family:'Comic Sans MS';
font-size:2em;
line-height:1.3em;
color:#FFFFFF;
padding-bottom: 5px;

}


</style>

<script src="\pupwebdev\assets\javascript\jquery-3.3.1.min.js" type='text/javascript'>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

		<!---<meta http-equiv="refresh" content="1" > --->
        <div class="row">
          <div class="col">
            <div class="annoucement-box">
            
                <div class="card-header">
                 <h1>Now Serving</h1>
                 <div id="clockbox" style="font-size: 20pt;"></div>
                </div>
            
            </div>
          </div>
        </div>
		
		<!-- ANNOUNCEMENT HERE! -->
          <marquee class="GeneratedMarquee" direction="left" scrollamount="8" behavior="scroll" id = "announcement">
		
            
          </marquee>
		 <div id="display_info">
		 </div> 
<!--
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-center">Student <br> Services</h4></div>
                <div class="card-body text-center">
                  <h4>Queue Number</h4>
                    <span class="queue-number" style="font-size: 60px;">0001</span><br>
                </div>
              <div class="card-footer">
                <h5 class="card-title text-center">Up Next:<br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span><br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span></h5>
              </div>
            </div>
          </div> 

          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-center">Academic Services <br>Office</h4></div>
                <div class="card-body text-center">
                  <h4>Queue Number</h4>
                    <span class="queue-number" style="font-size: 40px;">0001</span><br>
                </div>
              <div class="card-footer">
                <h5 class="card-title text-center">Up Next:<br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span><br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span></h5>
              </div>
            </div>
          </div>

          
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title text-center" style="font-size: 24pt; margin: 15px 0px 15px 0px;">Library</h2></div>
                <div class="card-body text-center">
                  <h4>Queue Number</h4>
                    <span class="queue-number" style="font-size: 40px;">0001</span><br>
                </div>
              <div class="card-footer">
                <h5 class="card-title text-center">Up Next:<br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span><br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span></h5>
              </div>
            </div>
          </div>   -->
       

<!--
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-center">Admission and <br>Registrar</h4></div>
                <div class="card-body text-center">
                  <h4>Queue Number</h4>
                    <span class="queue-number" style="font-size: 40px;">0001</span><br>
                </div>
              <div class="card-footer">
                <h5 class="card-title text-center">Up Next:<br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span><br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span></h5>
              </div>
            </div>
          </div> 

          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-center">IT <br>Services</h4></div>
                <div class="card-body text-center">
                  <h4>Queue Number</h4>
                    <span class="queue-number" style="font-size: 40px;">0001</span><br>
                </div>
              <div class="card-footer">
                <h5 class="card-title text-center">Up Next:<br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span><br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span></h5>
              </div>
            </div>
          </div> 

          <div class="col">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center" style="margin-top: 10px;">Administrative Services and Property</h5></div>
                <div class="card-body text-center">
                  <h4>Queue Number</h4>
                    <span class="queue-number" style="font-size: 40px;">0001</span><br>
                </div>
              <div class="card-footer">
                <h5 class="card-title text-center">Up Next:<br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span><br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span></h5>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title text-center" style="font-size: 24pt; margin: 15px 0px 15px 0px;">Registrar</h2></div>
                <div class="card-body text-center">
                  <h4>Queue Number</h4>
                    <span class="queue-number" style="font-size: 40px;">0001</span><br>
                </div>
              <div class="card-footer">
                <h5 class="card-title text-center">Up Next:<br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span><br>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002 |</span>
                <span class="next-number">0002</span></h5>
              </div>
            </div>
          </div>
        </div> -->




<script type="text/javascript">
var tday=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var tmonth=["January","February","March","April","May","June","July","August","September","October","November","December"];

function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getFullYear();
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}

if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;

var clocktext=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
document.getElementById('clockbox').innerHTML=clocktext;
}

GetClock();
setInterval(GetClock,1000);
</script>
<script type="text/javascript">
		$(document).ready(function()
		{
			setInterval(function(){
			
				$('#display_info').load('php/RTQLoad.php').fadeIn("slow");
      }, 200);
      setInterval(function(){   
        $('#announcement').load('php/announcementLoad.php').fadeIn("slow");
      }, 200);
		});
    
</script>
<audio id="soundHandle" style="display: none;"></audio>
<script>
  soundHandle = document.getElementById('soundHandle');
  soundHandle.src = '/pupwebdev/auth/student/sound/dingdong.mp3';
</script>