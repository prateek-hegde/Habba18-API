<?php
require_once 'init.php';
if(isset($_GET['submit1'])){
	$name = $_GET['name'];
	$stmt = $user->runQuery("SELECT * FROM habba17 WHERE name = :name");
	$stmt->bindParam(":name", $name, PDO::PARAM_STR);
	$stmt->execute();
	$obj = $stmt->fetch(PDO::FETCH_OBJ);
	$abt = $obj->about;
	$rules = $obj->rules;
	$eventhead = $obj->eventhead;
	$number = $obj->number;
	$regamount = $obj->amount;
	$pmoney = $obj->pmoney;
	$date = $obj->date;


	if(isset($_POST['submit'])){
		$abt   		= $_POST['about'];
		$rules 		= $_POST['rules'];
		$eventhead 	= $_POST['eventhead'];
		//$numb    	= $_POST['number'];
		$regamount 	= $_POST['regamount'];
		$pmoney    	= $_POST['pmoney'];
		$date 		= $_POST['date'];
		$date 		= date_create($date);
		$date 		= date_format($date, "y-m-d");
		$date 		= '20'.$date;
		$time 		= $_POST['time'];
		$dt 		= $date."\n".$time;
		$status = 'active';
		$stmt = $user->runQuery("UPDATE habba17 SET about = :abt, rules = :rules, eventhead = :eventhead,  amount = :amount, pmoney = :pmoney  WHERE name = :name");
		$stmt->bindParam(":abt", $abt, PDO::PARAM_STR);
		$stmt->bindParam(":rules", $rules, PDO::PARAM_STR);
		$stmt->bindParam(":eventhead", $eventhead, PDO::PARAM_STR);
		//$stmt->bindParam(":numb", $numb, PDO::PARAM_INT);
		$stmt->bindParam(":amount", $regamount, PDO::PARAM_INT);
		$stmt->bindParam(":pmoney", $pmoney, PDO::PARAM_INT);
		//$stmt->bindParam(":date", $dt, PDO::PARAM_STR);
		// $stmt->bindParam(":time", $time, PDO::PARAM_STR);
		// $stmt->bindParam(":time24", $time24, PDO::PARAM_STR);
		// $stmt->bindParam(":lat", $lat, PDO::PARAM_STR);
		// $stmt->bindParam(":lang", $lng, PDO::PARAM_STR);
		//$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt->bindParam(":name", $name, PDO::PARAM_STR);

		try{
			$stmt->execute();
			
			header('Location: update.php');
			exit();
		} catch(PDOException $e){
			echo $e->getMessage();
		}


	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Events Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="./datepicker/picker.date.js"></script> <!-- datepicker js file -->	
	<script src="./datepicker/picker.time.js"></script>
	<script type="text/javascript">
		function fetch_select(val)
		{
			$.ajax({
				type: 'post',
				url: 'fetch.php',
				data: { 
					get_option:val
				},
				success: function (response) {
					document.getElementById("new_select").innerHTML=response; 
				}
			});
		}

	</script>
	<script type="text/javascript">
		
	</script>
	
	
</head>
<body>
	<div style="width: 35%; padding-top: 20px; float: left; padding-left: 150px;">
		
		<form method="GET" action="">
			<div id="select_box"> <!-- select box div starts -->
				<div class="form-group">
					<select name="name" class="form-control" id="mainc" onchange="fetch_select(this.value);">
						<option>Select Main event</option>
						<?php
						$stmt = $user->runQuery("SELECT name FROM habba17");
						$stmt->execute();
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

							echo "<option value=".$row['name']." >".$row['name']."</option>";
						}
						?> 
					</select>
				</div>
				
			</div> <!-- select box div ends -->
			<button id="submit" name="submit1" type="submit" class="btn btn-warning">Submit</button>
		</form>
		<form method="post" action="">
			<div class="form-group">
				<label for="exampleFormControlTextarea1">About</label>
				<textarea name="about" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?php if(isset($abt)){echo $abt;} ?></textarea>
			</div>

			<div class="form-group">
				<label for="exampleFormControlTextarea1">Rules</label>
				<textarea name="rules" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?php if(isset($rules)){echo $rules;} ?></textarea>
			</div>

			<!-- <div class="form-group">
				<label for="exampleFormControlInput1">Event Head</label>
				<input type="text" name="eventhead" class="form-control" id="exampleFormControlInput1" value="<?php if(isset($eventhead)){echo $eventhead;} ?>" required>
			</div> -->


		</div>

		<div style="width: 35%; padding-top: 25px; float: right; margin-right: 250px;">
			
			<div class="form-group">
				<label for="exampleFormControlInput1">Registration Amount</label>
				<input type="text" name="regamount" class="form-control" id="exampleFormControlInput1" value="<?php if(isset($regamount)){echo $regamount;} ?>" required>
			</div>

			<div class="form-group">
				<label for="exampleFormControlInput1">Prize Money</label>
				<input type="text" name="pmoney" class="form-control" id="exampleFormControlInput1" value="<?php if(isset($pmoney)){echo $pmoney;} ?>" required>
			</div>

			<div class="form-group">
				<script>
					$( function() {
						$( "#datepicker" ).datepicker();
					});
				</script>
				<label for="exampleFormControlSelect1">Date</label>
				<input class="form-control" name="date" id="datepicker" type="text" value="<?php if(isset($date)){echo $date;} ?>" placeholder="Pick Date">
			</div>
			<!-- <div class="form-group">
				<script type="text/javascript">
					$(document).ready(function(){
						$('#timepicker').timepicker();
					});
				</script>
				<label for="exampleFormControlSelect1">Time</label>
				<input class="form-control" id="timepicker" name="time" type="text" value="<?php if(isset($time)){echo $time;} ?>" placeholder="Pick Time">
			</div> -->
			<button id="submit" name="submit" type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>
</body>
</html>
