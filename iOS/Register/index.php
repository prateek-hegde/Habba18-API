<?php
require_once 'init.php';

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css?family=Mada" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Consolas" rel="stylesheet">
    
	<style>
		.slidecontainer {
		    width: 90%;
			
		}

		.slider {
		    -webkit-appearance: none;
		    width: 100%;
		    height: 3em;
		    border-radius: 90px;
		    background: transparent;
		    border: 5px solid transparent;
		    outline: none;
		    opacity: 1;
		    -webkit-transition: .2s;
		    transition: opacity .2s;
		    background-color: #6A84DB

		}

		.slider:hover {
		    opacity: 1;
		}

		.slider::-webkit-slider-thumb {
		    -webkit-appearance: none;
		    appearance: none;
		    width: 7em;
		    height: 3em;
		    border-radius: 30px;
		    background: white;
		    cursor: pointer;
		    box-shadow: 0 0 10px 7px #6881ED;
		    
		}

		.slider::-moz-range-thumb {
		    width: 25px;
		    height: 25px;
		    border-radius: 50%;
		    background: url('http://ethiccoders.com/ethiccoders/wp-content/uploads/2013/11/android-icon.png');
		    cursor: pointer;
		}


	</style>

</head>
<body style="padding: 0; margin:0; overflow: hidden">

    <div class="jumbotron jumbotron-fluid" style="background-image: url('Group49.jpg'); background-size: cover; height: 100vh; padding: 0; margin: 0; width:100%; overflow:hidden">
      <div class="container">
      	<center><div style="padding-top: 50px;"> <img src="./Habba18-Logo.png" width="100px" height="100px"> </div></center>
        <h6 style="font-size: 1.2em; padding: 0; margin: 0; padding-top: 26%; color: white; text-align: center; font-family: 'Mada', sans-serif;">Habba &amp; APL Registrations are NOW OPEN</h6> <hr class="ani" style=" width: 0%; border: 0px; height: 4px; background-color: #DCEDFD;">
        <center><div class="slidecontainer" style="margin-top: 5.4em;">
		  	<input type="range" min="1" max="100" value="50" class="slider" id="myRange">
		  	<span id="habba" style="position: relative; top: -2em; left: -30%; color: white; opacity: .7; font-size: 20px">Habba</span>
		  	<span id="apl" style="position: relative; top: -2em; left: 30%; color: white; opacity: .7; font-size: 20px">APL</span>
		  <!-- <p>Value: <span id="demo"></span></p> -->
		</div></center>
        
      </div>
    </div>

    <script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script>
var slider = document.getElementById("myRange");
// var output = document.getElementById("demo");
// output.innerHTML = slider.value;
slider.value = 50;

slider.oninput = function() {
  // output.innerHTML = this.value;
  slider.ontouchend = function() {
  		if(this.value<40) {
		  	this.value = 0;
		  	window.location.href = "habba.php";
		  }
		else if(this.value>80) {
		  	this.value = 100;
		  	window.location.href = "apl.php";
		  }  
		else {
			this.value = 50;
		}
	}
}


</script>
    <script type="text/javascript">
        $('.ani').delay(1000).animate({width: "20%"},1200);

    </script>
  <script>
    if($(window).width() <= 1024){
            $('#mainHead').css({fontSize: "60px"});
      		
        }
        
  </script>
</body>
</html>
<!-- <center><div style="height: 8em; width: 8em; background: radial-gradient(#6F87C8, #6F89E6, #718CEC); border: 2px solid transparent; border-radius: 50%; box-shadow: 0 0 10px 10px #6480E5; margin-top: 6em;"> <center><img src="./Habba18-Logo.png"></center> </div></center> -->