<?php
require_once 'init.php';
//$subc = $_SESSION['subc'];

if(isset($_GET['subc'])){
	$subc = $user->checkInput($_GET['subc']);
}

	if(isset($_POST['submit'])){
		//$subc  		= $_POST['subc'];
		$abt   		= $_POST['description'];
		$rules 		= $_POST['rules'];
		$eventhead 	= $_POST['eventhead'];
		$numb    	= $_POST['number'];
		$regamount 	= $_POST['regamount'];
		$pmoney    	= $_POST['pmoney'];
		$date 		= $_POST['date'];
		$time 		= $_POST['time'];
		$time24 	= date("H:i", strtotime($time));
		$venue     	= $_POST['venue'];

		switch ($venue) {
			case 'CS/IS Block':
			$lat = 13.085055;
			$lng = 77.484885;
			break;

			case 'Main Auditorium':
			$lat = 13.085430;
			$lng = 77.485331;
			break;

			case 'Mechanical Block':
			$lat = 13.084412;
			$lng = 77.484350;
			break;

			case 'EC/EEE Block':
			$lat = 13.084317;
			$lng = 77.483524;
			break;

			case 'MBA/MCA Block':
			$lat = 13.083887;
			$lng = 77.483989;
			break;

			case 'Civil Block':
			$lat = 13.08488;
			$lng = 77.485869;
			break;

			case 'AIGS Block':
			$lat = 13.084360;
			$lng = 77.484975;
			break;

			case 'Polytechnic Block':
			$lat = 13.083893;
			$lng = 77.484525;
			break;

			case 'Basket Ball Ground':
			$lat = 13.084816;
			$lng = 77.484213;
			break;

			case 'Main Stadium':
			$lat = 13.085420;
			$lng = 77.483068;
			break;

			case 'Architecture Block':
			$lat = 13.084151;
			$lng = 77.482348;
			break;

			case 'Pharmacy Block':
			$lat = 13.084601;
			$lng = 77.482376;
			break;
		}
		$status = 'active';
		$stmt = $user->runQuery("UPDATE subcat SET description = :abt, rules = :rules, eventhead = :eventhead, numb = :numb, amount = :amount, pmoney = :pmoney, date = :date, time = :time, venue = :venue, lat = :lat, lang = :lang, status = :status WHERE name = :subc");
		$stmt->bindParam(":abt", $abt, PDO::PARAM_STR);
		$stmt->bindParam(":rules", $rules, PDO::PARAM_STR);
		$stmt->bindParam(":eventhead", $eventhead, PDO::PARAM_STR);
		$stmt->bindParam(":numb", $numb, PDO::PARAM_INT);
		$stmt->bindParam(":amount", $regamount, PDO::PARAM_INT);
		$stmt->bindParam(":pmoney", $pmoney, PDO::PARAM_INT);
		$stmt->bindParam(":date", $date, PDO::PARAM_STR);
		$stmt->bindParam(":time", $time, PDO::PARAM_STR);
		$stmt->bindParam(":venue", $venue, PDO::PARAM_STR);
		$stmt->bindParam(":lat", $lat, PDO::PARAM_STR);
		$stmt->bindParam(":lang", $lng, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt->bindParam(":subc", $subc, PDO::PARAM_STR);

		$timestamp = $date.' '.$time24;
		$timeline = $user->runQuery("INSERT INTO timeline (content, date, timestamp) VALUES (:subc, :date, :timestamp)");
		$timeline->bindParam(":subc", $subc, PDO::PARAM_STR);
		$timeline->bindParam(":date", $date, PDO::PARAM_STR);
		$timeline->bindParam(":timestamp", $timestamp, PDO::PARAM_STR);
		
		try{
			$stmt->execute();
			//session_destroy();
			$timeline->execute();
			curl_exec($ch);
			curl_close($ch);
			?>
				<script type="text/javascript">
					alert("Event details have been updated");
					window.location.href = "http://acharyahabba.in/habba18/admin/subc.php";
					</script>
			<?php
		} catch(PDOException $e){
			echo $e->getMessage();
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
	
</head>
<body>
	<center> <strong>Event won't show in app unless you fill the data</strong>  </center>
	<div style="width: 35%; padding-top: 20px; float: left; padding-left: 150px;">
		
		<form method="POST" action="">

			<div class="form-group">
				<label for="exampleFormControlInput1">Event Name</label>
				<input type="text" class="form-control" id="exampleFormControlInput1" value="<?php if(isset($subc)){echo $subc;} ?>" readonly>
			</div>
		
			<div class="form-group">
				<label for="exampleFormControlTextarea1">description</label>
				<textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?php if(isset($abt)){echo $abt;} ?></textarea>
			</div>

			<div class="form-group">
				<label for="exampleFormControlTextarea1">Rules</label>
				<textarea name="rules" class="form-control" id="exampleFormControlTextarea1" rows="3" value="<?php if(isset($rules)){echo $rules;} ?>" required></textarea>
			</div>

			<div class="form-group">
				<label for="exampleFormControlInput1">Event Head</label>
				<input type="text" name="eventhead" class="form-control" id="exampleFormControlInput1" value="<?php if(isset($eventhead)){echo $eventhead;} ?>" required>
			</div>

			<div class="form-group">
				<label for="exampleFormControlInput1">Event Head Contact Number</label>
				<input type="number" name="number" class="form-control" value="<?php if(isset($number)){echo $number;} ?>" id="exampleFormControlInput1" required>
			</div>

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
						var date = $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
						//$( "#datepicker" ).datepicker();
					});
				</script>
				<label for="exampleFormControlSelect1">Date</label>
				<input class="form-control" name="date" id="datepicker" type="text" value="<?php if(isset($date)){echo $date;} ?>" placeholder="Pick Date">
			</div>
			<div class="form-group">
				<script type="text/javascript">
					$(document).ready(function(){
						$('#timepicker').timepicker();
					});
				</script>
				<label for="exampleFormControlSelect1">Time</label>
				<input class="form-control" id="timepicker" name="time" type="text" value="<?php if(isset($time)){echo $time;} ?>" placeholder="Pick Time">
			</div>
			<div class="form-group">
				<label for="exampleFormControlSelect1">Select Venue</label>
				<select class="form-control" name="venue" id="exampleFormControlSelect1">
					<option value="CS/IS Block">CS/IS Block</option>
					<option value="Main Auditorium">Main Auditorium</option>
					<option value="Mechanical Block">Mechanical Block</option>
					<option value="EC/EEE Block">EC/EEE Block</option>
					<option value="MBA/MCA Block">MBA/MCA Block</option>
					<option value="Civil Block">Civil Block</option>
					<option value="AIGS Block">AIGS Block</option>
					<option value="Polytechnic Block">Polytechnic Block</option>
					<option value="Basket Ball Ground">Basket Ball Ground</option>
					<option value="Main Stadium">Main Stadium</option>
					<option value="Architecture Block">Architecture Block</option>
					<option value="Pharmacy Block">Pharmacy Block</option>
				</select>
			</div>
			<button id="submit" name="submit" type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>
</body>
</html>
