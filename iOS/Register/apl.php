<?php
require_once 'init.php';

if(isset($_POST['submit'])){
  $name   = $user->checkInput($_POST['name']);
  $gender = $user->checkInput($_POST['gender']);
  $dob  = $user->checkInput($_POST['dob']);
  $desig  = $user->checkInput($_POST['desig']);
  $cat  = $user->checkInput($_POST['cat']);
  $email  = $user->checkInput($_POST['email']);
  $num  = $user->checkInput($_POST['num']);
  $clg  = $user->checkInput($_POST['clg']);
  $dept   = $user->checkInput($_POST['dept']);
  $usn  = $user->checkInput($_POST['usn']);

  $stmt = $user->runQuery("SELECT id from players where email = :email");
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
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $allowed= array("jpeg","jpg","png");

    if(in_array($ext,$allowed) === false){
     echo "extension not allowed, please choose a JPEG or PNG file.";
   } else if($file_size > 512000){
    echo "File should be leess than 512KB";
  } else {

    $sql = "SELECT max(id) as id FROM players ";
    $stmt = $user->runQuery($sql);
    $stmt->execute();
    $maxid = $stmt->fetch(PDO::FETCH_OBJ);
    $id = $maxid->id;
    if($id == NULL){
      $id = 1;
    } else {
      $id = $id + 1;
    }

    $uploaddir = '../apl/images/';
    $file_path = $uploaddir.$id.'.'.$ext;
    $file_url  = 'http://acharyahabba.in/apl/'.$file_path;
    if(move_uploaded_file($file_tmp,$file_path)){

      $stmt = $user->runQuery("INSERT INTO players (name,gender,dob,desig,cat,email,num,clg,dept,usn,image) values(:name, :gender, :dob, :desig, :cat, :email, :num, :clg, :dept, :usn, :url) ");

      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
      $stmt->bindParam(":dob", $dob, PDO::PARAM_STR);
      $stmt->bindParam(":desig", $desig, PDO::PARAM_STR);
      $stmt->bindParam(":cat", $cat, PDO::PARAM_STR);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":num", $num, PDO::PARAM_STR);
      $stmt->bindParam(":clg", $clg, PDO::PARAM_STR);
      $stmt->bindParam(":dept", $dept, PDO::PARAM_STR);
      $stmt->bindParam(":usn", $usn, PDO::PARAM_STR);
      $stmt->bindParam(":url", $file_url, PDO::PARAM_STR);
      if($stmt->execute()){
        $subject   = " APL Registration Confirmation";
        $header    = 'From: noreply@acharya.apl';
        $body      = "Dear Student,\n
        We are proud to inform you, that you have successfully registered for the APL 2018 volunteer program. You have taken the first step in a wonderful journey that is the APL. \n
        Thank you.";

        mail($email, $subject, $body, $header);
        ?>
        <script type="text/javascript">
          alert('You have been successfully registerd!');
        </script>
        <?php
      } else {
        ?>
        <script type="text/javascript">
          alert('Something went wrong!');
        </script>
        <?php
      }
      
    } else {
      echo "Something went Wrong 2";
    }
    
  }
}


}

?>
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
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <style type="text/css">
  .data {
    display: none;
  }

  .g-signin2 {
    margin-top: 18em;
    margin-left: 0em
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
  .borders {
    border-radius: 5px; 
    height: 50px; 
    padding-left: 1em; 
    border-bottom-color: #6c8bf9; 
    border-right-color:#6c8bf9; 
    border-top: none; 
    border-left: none;  
    border-width: 2px;
  }

  .spacing {
    margin-top: 0.5em;
    margin-bottom: 2em;
  }

  .colour {
    color: #6C8Bf9;
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
    <!-- <button onclick="signOut()" class="btn btn-danger">SignOut</button> -->
    <i class="fa fa-arrow-left fa-2x" style="color: #6C8Bf9" aria-hidden="true" onclick="signOut()"></i>
    <section id="contact-us" style="font-family: 'Oswald' , sans-serif;">
      <div class="container">
        <div class="">

          <!-- section title -->
          <div class="title text-center wow fadeIn" data-wow-duration="500ms" style="margin-top: 3em">
            <h2>APL <span class="colour">Registeration</span></h2>

          </div>
          <!-- /section title -->



          <!-- Contact Form -->
          <div class="contact-form col-md-8 wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms" style="margin-top: 3em">
            <form id="register-form" method="post" action="" enctype="multipart/form-data" onsubmit="return validateEmail()" >

              <div class="form-group colour">
                Name
                <input style="color:#000" type="text" placeholder="Enter Your Name" class="form-control borders spacing" name="name" id="name" required >
              </div>

              <div class="form-group colour">
                Email
                <input style="color:#000" type="email" placeholder="Enter Your Email ID" class="form-control borders spacing" name="email" id="email" required readonly >
              </div>
              <span class="colour">Gender</span>
              <div class="form-group spacing">

                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="gender" id="gender" value="male" required > Male
                </label>
                <label class="form-check-label" style="margin-left: 1em">
                  <input type="radio" class="form-check-input" name="gender" id="gender" value="female" required > Female
                </label>
                <!-- <input style="color:#000" type="text" placeholder="Gender" class="form-control" name="gender" id="gender"> -->
              </div>

              <div class="form-group colour">
                Date of Birth
                <input style="color:#000" type="date" placeholder="Date of Birth" class="form-control borders spacing" name="dob" id="dob" required > 
              </div>
              Designation
              <div class="form-group spacing">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="desig" id="desig1" value="Student" onchange="usnvaltrue()" required >Student<br>
                </label>
                <label class="form-check-label" style="margin-left: 1em">
                  <input type="radio" class="form-check-input" name="desig" id="desig2" value="Faculty" onchange="usnvalfalse()" required >Faculty<br>
                </label>
                <label class="form-check-label" style="margin-left: 1em">
                  <input type="radio" class="form-check-input" name="desig" id="desig3" value="Other" onchange="usnvalfalse()" required > Other
                </label>
              </div>
              <div id="hiddendiv1">
                <div class="form-group">
                  <select name="clg" id="clg" class="borders" onchange="nestspinner()" form="register-form" style="width: 100%">
                                      <!-- <option value="volvo">Volvo</option>
                                      <option value="saab">Saab</option>
                                      <option value="mercedes">Mercedes</option>
                                      <option value="audi">Audi</option> -->
                                    </select>   
                                  </div>
                                  <div class="form-group" >
                                    <select name="dept" class="borders" id="dept" form="register-form" style="width: 100%">
                                      <!-- <option value="volvo">Volvo</option>
                                      <option value="saab">Saab</option>
                                      <option value="mercedes">Mercedes</option>
                                      <option value="audi">Audi</option> -->
                                    </select>   
                                  </div>
                                  <div class="form-group">
                                    <input style="color:#000" type="text"  placeholder="USN" class="formgroup borders" name="usn" id="usn" required ></input>   
                                  </div>
                                </div>
                                <div class="form-group">
                                  <input style="color:#000;" type="number"  placeholder="Mobile Number" class="formgroup borders" name="num" id="num" required ></input>   
                                </div>
                                <div class="form-group" style="padding-top: 1em; padding-bottom: 1em">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="cat" id="cat" value="Batsman" required > Batsman
                                  </label>
                                  <label class="form-check-label"  style="margin-left: 1em">
                                    <input type="radio" class="form-check-input" name="cat" id="cat" value="Bowler" required > Bowler<br>
                                  </label>
                                  <label class="form-check-label" style="margin-left: 1em">
                                    <input type="radio" class="form-check-input" name="cat" id="cat" value="All Rounder" required > All Rounder
                                  </label>
                                </div>
                                <span class="colour">Upload your photo</span>
                                <div class="form-group spacing">
                                  <input type="file" class="form-control" name="image" id="image_path" style="outline: none; border: none"  required ><br>

                                </div>

                            <!-- <div id="mail-success" class="success">
                                Thank you. The Mailman is on His Way :)
                            </div>
                            
                            <div id="mail-fail" class="error">
                                Sorry, don't know what happened. Try later :(
                              </div> -->
                              <center>
                                <div id="cf-submit" style="margin-top: -1em">
                                  <input type="submit" id="contact-submit" class="btn btn-outline-primary sub" value="Submit" name="submit" style="border: 1px solid #6c8bf9; border-radius: 30px; width: 60%; color: #6C8Bf9">
                                </div>   
                              </center>



                            </form>
                          </div>
                          <!-- ./End Contact Form -->

                        </div> <!-- end row -->
                      </div> <!-- end container -->


                    </section> <!-- end section -->
                  </div>

                  <script
                  src="https://code.jquery.com/jquery-3.2.1.min.js"
                  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                  crossorigin="anonymous"></script>

                  <script type="text/javascript">

                    function onSignIn(googleUser) {
                      var profile = googleUser.getBasicProfile();
                      $('.g-signin2').css("display", "none");
                      $('#note').css("display", "none");
                      $(".data").css("display", "block");
                      $('body').css('background', 'white' );
                      $("#pic").attr('src', profile.getImageUrl());
                      $("#email").val(profile.getEmail());
          // $("#email").prop('disabled', true);
          $("#name").val(profile.getName());
          // $("#name").prop('disabled', true);
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
              alert("You have not entered a valid Acharya Mail ID. Please re-login with a valid Acharya Mail ID");
              return false;
            }
            else
              return true;
          }
        </script>
        <script type="text/javascript">
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
        </script>
        <script type="text/javascript">

          $("#hiddendiv1").hide();

        </script>
        <script type="text/javascript">
          function usnvalfalse(){
            $("#usn").val('null');
          }
          function usnvaltrue(){
            $("#usn").val('');
          }
        </script>


      </body>
      </html>