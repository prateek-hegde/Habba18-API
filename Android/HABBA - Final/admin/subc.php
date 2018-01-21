<?php
//session_start();
require_once 'init.php';
if(isset($_POST['submit'])){
	$mainc = $_POST['mainc'];
	$subc = $_POST['subc'];

	$stmt = $user->runQuery("SELECT id FROM events WHERE name = :name");
	$stmt->bindParam(":name", $mainc, PDO::PARAM_STR);
	$stmt->execute();
	$getElement = $stmt->fetch(PDO::FETCH_OBJ);
	$id = $getElement->id;

	//$_SESSION['subc'] = $subc;
	$rand = rand(1,51);
	$url = 'http://acharyahabba.in/app/images/'.$rand.'.jpg';
	$stmt = $user->runQuery("INSERT INTO subcat (name,mainc,cid,url) VALUES (:name, :mainc, :cid, :url) ");
  $stmt->bindParam(":name", $subc, PDO::PARAM_STR); //$_POST["subc"][$i]
  $stmt->bindParam(":mainc", $mainc, PDO::PARAM_STR);
  $stmt->bindParam(":cid", $id, PDO::PARAM_INT);
  $stmt->bindParam(":url", $url, PDO::PARAM_STR);
  $stmt->execute();
  header('Location: '.url.'/subc_add.php?subc='.$subc);
  exit();
}
?>
<!DOCTYPE html>
<html>

<head>
	
	<link rel="stylesheet" type="text/css" href="style_subc.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>   

</head>
<body>
	<center>
		<p id="heading">Add Subcategory</p>
		<div style="width: 30%">
		<div id="select_box">
			<form name="add_name" id="add_name" method="post" action=""> 
				<div class="form-group">
					<select name="mainc" class="form-control">
						<option>Select Main event</option>
						<?php
						$stmt = $user->runQuery("SELECT name FROM events");
						$stmt->execute();
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							echo "<option value=".$row['name']." >".$row['name']."</option>";
						}
						?>
					</select>
					<br><br>
					<div class="form-group">  
						<input type="text" name="subc" class="form-control" style="width: 80%" required> 
							</div>
						<br>
						<!-- <table class="table table-bordered" id="dynamic_field" width="30%">  
							<tr>  
								<td><input type="text" name="subc[]" placeholder="Enter your Name" class="form-control name_list" /></td>  
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
							</tr>  
						</table> -->  
						<input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />  
					</div>  
				</form>  
			</div>

		</div>     
	</center>
</body>
</html>
<script>  
	// $(document).ready(function(){  
	// 	var i=1;  
	// 	$('#add').click(function(){  
	// 		i++;  
	// 		$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="subc[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
	// 	});  
	// 	$(document).on('click', '.btn_remove', function(){  
	// 		var button_id = $(this).attr("id");   
	// 		$('#row'+button_id+'').remove();  
	// 	});  
	// 	$('#submit').click(function(){            
	// 		$.ajax({  
	// 			url:"addSubc.php",  
	// 			method:"POST",  
	// 			data:$('#add_name').serialize(),  
	// 			success:function(data)  
	// 			{  
	// 				alert(data);  
	// 				$('#add_name')[0].reset();  
	// 			}  
	// 		});  
	// 	});  
	// });  
</script>
