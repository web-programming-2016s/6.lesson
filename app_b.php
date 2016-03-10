<?php require_once("header.php"); ?>
<?php

	// require another php file
	// ../../../ => 3 folders back
	require_once("../../../config.php");

	$everything_was_okay = true;

	//*********************
	// TO field validation
	//*********************
	if(isset($_GET["to"])){ //if there is ?to= in the URL
		if(empty($_GET["to"])){ //if it is empty
			$everything_was_okay = false; //empty
			echo "Please enter the recipient! <br>"; // yes it is empty
		}else{
			echo "To: ".$_GET["to"]."<br>"; //no it is not empty
		}
	}else{
		$everything_was_okay = false; // do not exist
	}

	//check if there is variable in the URL
	if(isset($_GET["message"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		//if its empty
		if(empty($_GET["message"])){
			//it is empty
			$everything_was_okay = false;
			echo "Please enter the message! <br>";
		}else{
			//its not empty
			echo "Message: ".$_GET["message"]."<br>";
		}
		
	}else{
		//echo "there is no such thing as message";
		$everything_was_okay = false;
	}
	
	
	
	/***********************
	**** SAVE TO DB ********
	***********************/
	
	// ? was everything okay
	if($everything_was_okay == true){
		
		echo "Saving to database ... ";
		
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		// 1 servername
		// 2 username
		// 3 password
		// 4 database
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_romil");
		
		$stmt = $mysql->prepare("INSERT INTO messages_sample (recipient, message) VALUES (?,?)");
			
		//echo error
		echo $mysql->error;
		
		// we are replacing question marks with values
		// s - string, date or smth that is based on characters and numbers
		// i - integer, number
		// d - decimal, float
		
		//for each question mark its type with one letter
		$stmt->bind_param("ss", $_GET["to"], $_GET["message"]);
		
		//save
		if($stmt->execute()){
			echo "saved sucessfully";
		}else{
			echo $stmt->error;
		}
		
		
	}
	
	

?>

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">Brand</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
		  <ul class="nav navbar-nav">
			
			<li class="active">
				<a href="app_b.php">
					App page
				</a>
			</li>
			
			
			<li>
				<a href="table_b.php">
					Table
				</a>
			</li>
			
		  </ul> 
		  
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">

		<h1> This is the app page </h1>
		
		<form>
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<label for="to">To: </label>
						<input name="to" id="to" type="text" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<label for="message">Message: </label>
						<input name="message" id="message" type="text" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<input class="btn btn-success hidden-xs" type="submit" value="Save data 1">
					<input class="btn btn-success btn-block visible-xs-block" type="submit" value="Save data 2">
				</div>
			</div>
		</form>
		


  
	</div>
  
  </body>
</html>