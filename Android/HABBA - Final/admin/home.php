<?php
 require_once 'init.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<style type="text/css">
		
	</style>
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
</head>
<body style="background-color: #e6ffff;">
<h1  style="text-align: center; padding-top: 50px;">Admin</h1> 
<hr>
<div class="container">
<a href="#"><button type="button" class="btn btn-danger btn-lg" style="float: right;"> Logout  </button> </a>
<span style="clear: both;"></span>
<div class="container">
<h2>Operations</h2>
<div class="container" style="margin-top: 20px; width: 200px; float: left;">
<a href="./mainc.php"><button type="button" class="btn btn-success btn-lg"> Add Main Category  </button> </a>
<hr>
<a href="./subc.php"><button type="button" class="btn btn-info btn-lg">Add Sub Category</button> </a>
<hr>
<a href="./update.php"><button type="button" class="btn btn-warning btn-lg">Update Events</button></a>

</div>
</div>

</div>




<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>

