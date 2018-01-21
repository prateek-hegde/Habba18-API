<?php
require_once './core_vol/class.user.php';
$user2 = new User();
if(isset($_POST['submit2'])){
    $name = $user2->checkInput($_POST['name']);
    $email= $user2->checkInput($_POST['email']);
    $num  = $user2->checkInput($_POST['num']);
    $clg  = $user2->checkInput($_POST['clg']);
    $dept = $user2->checkInput($_POST['dept']);
    $year = $user2->checkInput($_POST['year']);
    $usn  = $user2->checkInput($_POST['usn']);
    $exp  = $user2->checkInput($_POST['exp']);
    $skill= $user2->checkInput($_POST['skill']);
    $aboutme= $user2->checkInput($_POST['aboutme']);
    $suggest = $user2->checkInput($_POST['suggest']);

    $interest = array();
    if(!empty($_POST['interest'])){
        foreach($_POST['interest'] as $selected){
            array_push($interest, $selected);
        }
        $interest = implode(', ', $interest);
    }


    $stmt = $user2->runQuery("SELECT id from vol where email = :email");
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count >= 1){
        ?>
        <script type="text/javascript">
          alert('Sorry... You have already registerd!');
      </script>
      <?php
  } else {
    $stmt = $user2->runQuery("INSERT into vol (name,email,num,college,dept,year,usn,exp,interst,skill,aboutme,suggestion) values (:name, :email, :num, :clg, :dept, :year, :usn, :exp, :interst, :skill, :aboutme, :suggest) ");
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":num", $num, PDO::PARAM_STR);
    $stmt->bindParam(":clg", $clg, PDO::PARAM_STR);
    $stmt->bindParam(":dept", $dept, PDO::PARAM_STR);
    $stmt->bindParam(":year", $year, PDO::PARAM_STR);
    $stmt->bindParam(":usn", $usn, PDO::PARAM_STR);
    $stmt->bindParam(":exp", $exp, PDO::PARAM_STR);
    $stmt->bindParam(":interst", $interest, PDO::PARAM_STR);
    $stmt->bindParam(":skill", $skill, PDO::PARAM_STR);
    $stmt->bindParam(":aboutme", $aboutme, PDO::PARAM_STR);
    $stmt->bindParam(":suggest", $suggest, PDO::PARAM_STR);
    try {
        $stmt->execute();

        $subject   = " Voluteer Registration Confirmation";
        $header    = 'From: noreply@acharya.habba';
        $body      = "Dear Student,\n
        We are proud to inform you, that you have successfully registered for the Habba 18 volunteer program. You have taken the first step in a wonderful journey that is the Habba. \n
        Thank you.";

        mail($email, $subject, $body, $header);

        ?>
        <script type="text/javascript">
            alert('You have been successfully registerd!');
        </script>
        <?php

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}




}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="889253776941-35r6u0ahe2ohprhnv8c4c1rjngg4u58h.apps.googleusercontent.com">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Habba18</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->

  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <!-- Template styles -->
    <!-- <style rel="stylesheet">
        /* TEMPLATE STYLES */
        /* Necessary for full page carousel*/
       
        html,
        body,
        .view {
            height: 100%;
        }
        /* Navigation*/
       
        .navbar {
            background-color: transparent;
        }
       
        .scrolling-navbar {
            -webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
            -moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
            transition: background .5s ease-in-out, padding .5s ease-in-out;
        }
       
        .top-nav-collapse {
            background-color: #2b3f66;
        }
        .logopng{
           
            height: 25px;
 
        }
       
        footer.page-footer {
            background-color: #2b3f66;
 
            margin-top: 0;
        }
       
        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #2b3f66;
            }
        }
        /* Carousel*/
       
        .carousel,
        .carousel-item,
        .active {
            height: 100%;
        }
       
        .carousel-inner {
            height: 100%;
        }
        /*Caption*/
       
        .flex-center {
            color: #000;
        }
       
        @media (min-width: 776px) {
            .carousel .view ul li {
                display: inline;
            }
            .carousel .view .full-bg-img ul li .flex-item {
                margin-bottom: 1.5rem;
            }
        }
        .navbar .btn-group .dropdown-menu a:hover {
            color: #000 !important;
        }
        .navbar .btn-group .dropdown-menu a:active {
            color: #000 !important;
        }
        /*popup*/
        /* Popup container */
        .popup {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
 
        /* The actual popup (appears on top) */
        .popup .popuptext {
            visibility: hidden;
            width: 160px;
            background-color: #555;
            color: #000;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -80px;
        }
 
        /* Popup arrow */
        .popup .popuptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }
 
        /* Toggle this class when clicking on the popup container (hide and show the popup) */
        .popup .show {
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s
        }
 
        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
 
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity:1 ;}
        }
         @font-face {
            font-family: PremierSans;
            src: url("Utilities/Premier Sans.ttf");
            font-weight:400;
        }
 
        .sub:hover {
            border-color: #6CB670;
        }
    </style> -->

    <style type="text/css">

    .g-signin2 {
        margin-top: 18em;
        margin-left: 0em;
    }
    .data {
        display: none;
    }

    input[type="radio"] {
      background-color: transparent;
      border: .0625em solid rgba(103, 136, 249,.5);
      border-radius: 50%;
      box-shadow: inset 0 0 0 0 black;
      cursor: pointer;
      font: inherit;
      height: 1em;
      outline: none;
      width: 1em;
      -moz-appearance: none;
      -webkit-appearance: none;
  }
  input[type="radio"]:checked {
    background-color: #6c8bf9;
    box-shadow: inset 0 0 0 .1875em white;
    -webkit-transition: background .15s, box-shadow .1s; 
    transition: background .15s, box-shadow .1s; 
}

input[type="checkbox"] {
  background-color: transparent;
  border: .0625em solid rgba(103, 136, 249,.5);
  border-radius: 50%;
  box-shadow: inset 0 0 0 0 black;
  cursor: pointer;
  font: inherit;
  height: 1em;
  outline: none;
  width: 1em;
  -moz-appearance: none;
  -webkit-appearance: none;
}
input[type="checkbox"]:checked {
    background-color: #6c8bf9;
    box-shadow: inset 0 0 0 .1875em white;
    -webkit-transition: background .15s, box-shadow .1s; 
    transition: background .15s, box-shadow .1s; 
}

#dept:focus {
    outline: none;
}

#clg:focus {
    outline: none;
}

.borders:focus {
    border-bottom-color:  #6c8bf9;

}

</style>

</head>

<body onload="nestspinner()" style="background: url('Signin-back.jpg') center no-repeat;">

    <center><div class="g-signin2" data-onsuccess="onSignIn" style="margin-top: 80vh;" data-theme="light"> </div></center>
    <div id="note">
      <div style="height: 1em; width: 100%"></div>
      <center style=" margin-top: -0.7em;"><cite title="Source Title" style="font-size: 14px; color: lightgrey; font-weight: bold;">Use Acharya Mail ID only</cite></center>
  </div>
  <div class="data">
    <i class="fa fa-arrow-left fa-2x" style="color: #6C8Bf9" aria-hidden="true" onclick="signOut()"></i>

   <!-- Srart Contact Us
    =========================================== -->    
    <section id="contact-us" style="font-family: 'Oswald' , sans-serif;">
        <div class="container">
            <div class="">

                <!-- section title -->
                <div class="title text-center wow fadeIn" data-wow-duration="500ms" style="margin-top: 3em">
                    <h2>Habba <span style="color: #6c8bf9">Registeration</span></h2>                    <!-- /section title -->
                </div>


                <!-- Contact Form -->
                <div class="contact-form col-md-12 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms" style="margin-top: 3em">
                    <form id="register-form" method="post" action="" onsubmit="return validateEmail()" >

                        <div class="form-group">
                            <span style="color: #6c8bf9">Name</span>
                            <input style="color:#000; width: 97%; padding-left: 0;" class="borders" type="text" placeholder="Enter Your Name" class="form-control" name="name" id="name"  required >
                        </div>

                        <div class="form-group">
                            <span style="color: #6c8bf9">Email ID</span>
                            <input style="color:#000; width: 97%; padding-left: 0" class="borders" type="email" placeholder="Enter Your Email ID" class="form-control" name="email" id="email" required readonly >
                        </div>

                        <div class="form-group">
                            <span style="color: #6c8bf9">USN</span>
                            <input style="color:#000; width: 97%; padding-left: 0" class="borders" type="text" placeholder="Enter Your USN" class="form-control" name="usn" id="usn" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your USN'" required >
                        </div>
                        <div class="form-group">
                            <span style="color: #6c8bf9">Mobile Number</span>
                            <input style="color:#000; width: 97%; padding-left: 0" class="borders" type="number"  placeholder="Enter Your Mobile Number" class="form-control" name="num" id="num" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your Mobile Number'" required ></input>  
                        </div>


                          <!--   Enter your Designation
                            <div class="form-group">
                                <input type="radio" class="form-control" name="desig" id="desig1" value="Student">Student<br>
                                <input type="radio" class="form-control" name="desig" id="desig2" value="Faculty">Faculty<br>
                                <input type="radio" class="form-control" name="desig" id="desig3" value="Other">Other
 
                            </div> -->
                            <span style="color: #6c8bf9">College</span>
                            <div class="form-group"  style="padding-top: 1em">
                                <select name="clg" id="clg" onchange="nestspinner()" form="register-form" style="border-radius: 5px; height: 50px; padding-left: 1em; border-bottom-color: #6c8bf9; border-right-color:#6c8bf9; border-top: none; border-left: none;  border-width: 2px; background-color: transparent; width: 106%">
                                      <!-- <option value="volvo">Volvo</option>
                                      <option value="saab">Saab</option>
                                      <option value="mercedes">Mercedes</option>
                                      <option value="audi">Audi</option> -->
                                  </select>  
                              </div>
                              <span style="color: #6c8bf9">Branch</span>
                              <div class="form-group"  style="padding-top: 1em">
                                <select name="dept" id="dept" form="register-form" style="border-radius: 5px; height: 50px; padding-left: 1em; border-bottom-color: #6c8bf9; border-right-color:#6c8bf9; border-top: none; border-left: none;  border-width: 2px; background-color: transparent; ">
                                      <!-- <option value="volvo">Volvo</option>
                                      <option value="saab">Saab</option>
                                      <option value="mercedes">Mercedes</option>
                                      <option value="audi">Audi</option> -->
                                  </select>  
                              </div>
                              <span style="color: #6c8bf9">Course Year</span>
                              <div class="form-group" style="padding-top: 1em;">
                                <label class="form-check-label">
                                 <input type="radio" class="form-check-input" name="year" id="desig1" value="1" required > 1
                             </label>
                             <label class="form-check-label" style="margin-left: 1em;">
                                 <input type="radio" class="form-check-input" name="year" id="desig2" value="2" required > 2
                             </label>
                             <label class="form-check-label" style="margin-left: 1em;">
                              <input type="radio" class="form-check-input" name="year" id="desig3" value="3" required > 3
                          </label>
                          <label class="form-check-label" style="margin-left: 1em;">
                           <input type="radio" class="form-check-input" name="year" id="desig4" value="4" required > 4
                       </label>
                       <label class="form-check-label" style="margin-left: 1em;">
                        <input type="radio" class="form-check-input" name="year" id="desig5" value="5" required >5
                    </label>    
                </div>
                <span style="color: #6c8bf9">Past Experience</span>
                <div class="form-group"  style="padding-top: 1em">
                    <label class="form-check-label" >
                     <input type="radio" class="form-check-input" name="exp" id="exp1" value="1" required >1<br>
                 </label>            
                 <label class="form-check-label" style="margin-left: 1em;">
                     <input type="radio" class="form-check-input" name="exp" id="exp2" value="2" required >2<br>
                 </label>
                 <label class="form-check-label" style="margin-left: 1em;">
                  <input type="radio" class="form-check-input" name="exp" id="exp3" value="3" required >3<br>
              </label>            
              <label class="form-check-label" style="margin-left: 1em;">
               <input type="radio" class="form-check-input" name="exp" id="exp4" value="4" required >4<br>
           </label>       
       </div>
       <span style="color: #6c8bf9">Fields Interested In</span>
       <div class="form-group" style="padding-top: 1em">
        <label class="form-check-label">
            <input style="color:#000" type="checkbox"
            value="Design and Artwork" class="form-check-input" name="interest[]" id="interest"> Design and Artwork
        </label>
        <label class="form-check-label" style="margin-left: 0.1em;">

            <input style="color:#000" type="checkbox"
            value="Content Writing" class="form-check-input" name="interest[]" id="interest"> Content Writing
        </label>
        <label class="form-check-label" style="margin-left: 0.1em;">

            <input style="color:#000" type="checkbox"
            value="Photography" class="form-check-input" name="interest[]" id="interest"> Photography
        </label>
        <label class="form-check-label" style="margin-left: 0.1em;">

            <input style="color:#000" type="checkbox"
            value="Sports" class="form-check-input" name="interest[]" id="interest"> Sports
        </label>
        <label class="form-check-label" style="margin-left: 0.1em;">

            <input style="color:#000" type="checkbox"
            value="Marketing" class="form-check-input" name="interest[]" id="interest"> Marketing
        </label>
        <label class="form-check-label" style="margin-left: 0.1em;">

            <input style="color:#000" type="checkbox"
            value="Media Handling" class="form-check-input" name="interest[]" id="interest"> Media Handling
        </label>
        <label class="form-check-label" style="margin-left: 0.1em;">

            <input style="color:#000" type="checkbox"
            value="Defence" class="form-check-input" name="interest[]" id="interest"> Defence
        </label>
        <label class="form-check-label" style="margin-left: 0.1em;">

            <input style="color:#000" type="checkbox"
            value="Digital Marketing" class="form-check-input" name="interest[]" id="interest"> Digital Marketing
        </label>
    </div>
    <span style="color: #6c8bf9">Skills Portrayed</span>

    <div class="form-group fg" style="padding-top: 1em">
        <textarea style="border-top: transparent; border-left: transparent; border-color: #6c8bf9; border-width: 2px; width: 104%" rows="5" class="form-control" name="skill" id="skill"></textarea>  
    </div>

    <span style="color: #6c8bf9">Describe yourself in a sentence</span>

    <div class="form-group fg" style="padding-top: 1em">
        <textarea style="border-top: transparent; border-left: transparent; border-color: #6c8bf9; border-width: 2px; width: 104%" rows="5" class="form-control" name="aboutme" id="aboutme"></textarea>  
    </div>

    <span style="color: #6c8bf9">Suggestions</span>
    <div class="form-group" style="padding-top: 1em">
        <textarea style="border-top: transparent; border-left: transparent; border-color: #6c8bf9; border-width: 2px; width: 104%"  rows="5" class="form-control" name="suggest" id="suggest"></textarea>  
    </div>
                                <!-- <div class="form-group">
                                    <input type="radio" class="form-control" name="cat" id="cat" value="Batsman">Batsman<br>
                                    <input type="radio" class="form-control" name="cat" id="cat" value="Bowler">Bowler<br>
                                    <input type="radio" class="form-control" name="cat" id="cat" value="All Rounder">All Rounder
                                </div> -->
                                <!-- Upload your photo
                                <div class="form-group">
                                    <input type="file" class="form-control" name="image" id="image_path" ><br>
                                   
                                </div> -->

                            <!-- <div id="mail-success" class="success">
                                Thank you. The Mailman is on His Way :)
                            </div>
                           
                            <div id="mail-fail" class="error">
                                Sorry, don't know what happened. Try later :(
                            </div> -->
                            <center>
                                <div id="cf-submit" style=" color: #6c8bf9; padding-top: 1em; ">
                                    <input type="submit" id="contact-submit" class="btn btn-outline-primary sub" value="Submit" name="submit2" style="border: 1px solid #6c8bf9; border-radius: 30px; width: 60%">
                                </div>  
                            </center>



                        </form>
                    </div>
                    <!-- ./End Contact Form -->

                </div> <!-- end row -->
            </div> <!-- end container -->


        </section> <!-- end section -->

        <!-- end Contact Area
    
 
   
            <!--Copyright-->


        </div>

        <!--/.Footer-->


        <!-- SCRIPTS -->

        <!-- JQuery -->
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

        <!-- Bootstrap dropdown -->
        <script type="text/javascript" src="js/popper.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
  <!--  
    <script type="text/javascript">
            $('#contact-form').submit(function () {
               $.post("test.php",$("#contact-form").serialize(), function(data){
               });
                return false;
            });
           
        </script> -->
   <!--  <script>
   
    function myFunction() {
        alert("I am an alert box!");
 
 
    }
</script> -->
<script type="text/javascript">
        // function testpost(){
        //     var array12 = ['namevariable',$("#gender").val(),$("#dob").val(),$("#desig").val(),$("#cat").val(),'emailvariable',$("#num").val(),$("#clg").val(),$("#dpt").val(),$("#usn").val()];
        //     console.log(array12[0]+array12[1]+array12[2]+array12[3]+array12[4]+array12[5]+array12[6]+array12[7]+array12[8]+array12[9]);
        //     $.post("http://www.acharyahabba.in/apl/register.php",
        //         {
        //             name: array12[0],
        //             gender: array12[1],
        //             dob: array12[2],
        //             desig: array12[3],
        //             cat: array12[4],
        //             email: array12[5],
        //             num: array12[6],
        //             clg: array12[7],
        //             dept: array12[8],
        //             usn: array12[9]

        //         },
        //         function(){
        //             alert("Your form has been submitted");
        //         });
        //}
    </script>
   <!--  <script type="text/javascript">//get a reference to the select element
        $select = $('#clg');
        //request the JSON data and parse into the select element
       
        $.ajax({
          url: 'http://www.acharyahabba.in/habba18/events.php',
          dataType:'JSON',
          success:function(data){
            //clear the current content of the select
            $select.html('');
            //iterate over the data and append a select option
            $.each(data.result, function(key, val){
              $select.append('<option value="' + val.name + '">' + val.name + '</option>');
            })
          },
          error:function(){</strong>
            //if there is an error append a 'none available' option
            $select.html('<option value="none">none available</option>');
          }
        });
    </script> -->

    <script type="text/javascript">

        function onSignIn(googleuser) {
          var profile = googleuser.getBasicProfile();
          $('.g-signin2').css("display", "none");
          $('#note').css("display", "none");
          $(".data").css("display", "block");
          $('body').css('background', 'white' );
          $("#email").val(profile.getEmail());
          //$("#email").prop('disabled', true);

          $("#name").val(profile.getName());
      }

      function signOut() {
          var auth2 = gapi.auth2.getAuthInstance();
          auth2.signOut().then(function() {
            alert("You have been successfully signed out");
            $(".g-signin2").css("display", "block")
            $(".data").css("display", "none");
            document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://acharyahabba.in/register";
            $('body').css('background', "url('Signin-back.jpg') center center no-repeat" );
        })
      }

  </script>

  <script type="text/javascript">
//         $.getJSON('http://www.acharyahabba.in/habba18/events.php', function(data) {

//     console.log(JSON.stringify(data));
// });
$select = $('#clg');

$.get(
    "http://www.acharyahabba.in/apl/college.php",

    function(data) {
       console.log('page content: ' + data);
       console.log('extra: '+ data.result);
       var obj = jQuery.parseJSON( data );
        //alert( obj.result );
        $select.html('');
            //iterate over the data and append a select option
            $.each(obj.result, function(key, val){
              console.log(val.name);
              $id12=val.id;
              $select.append('<option id="' + val.id + '" value="' + val.name + '">' + val.name + '</option>');
          })
        }
        );
    </script>
    <script type="text/javascript">
        function nestspinner(){
            $select1 = $('#dept');
            $id1 = $('#clg').children(":selected").attr("id");
            console.log($id1);
            if($id1== null){
                $id1=1;
            }
            $.get(
                "http://www.acharyahabba.in/apl/dept.php",{cid:$id1},

                function(data) {
                   console.log('page content: ' + data);
                   console.log('extra: '+ data.result);
                   var obj = jQuery.parseJSON( data );
                // alert( obj.result );
                $select1.html('');
                    //iterate over the data and append a select option
                    $.each(obj.result, function(key, val){
                      console.log(val.dept_name);
                      $select1.append('<option value="' + val.dept_name + '">' + val.dept_name + '</option>');
                  })
                }
                );
        }
    </script>
    <script type="text/javascript">
        function validateEmail(){
            $mailid = $('#email').val();
            $boolval=$mailid.includes("@acharya.ac.in");
            console.log($boolval);
            if($boolval==false){
                alert("You have not entered a valid Acharya Mail ID.");
                return false;
            }
            else
                return true;
        }
    </script>
    <!-- <script type="text/javascript">
    $(document).ready(function(){
        $("#desig1").click(function(){
            $("#hiddendiv1").show();
        });
 
        $("#desig2").click(function(){
            $("#hiddendiv1").hide();
        });
        $("#desig3").click(function(){
            $("#hiddendiv1").hide();
        });
    });
</script> -->
   <!--  <script type="text/javascript">
       
            $("#hiddendiv1").hide();
       
        </script> -->
   <!--  <script type="text/javascript">
        $( function() {
        $("#dob").datepicker();
      } );
  </script> -->
    <!-- <script>
    new WOW().init();
</script> -->

</body>

</html>