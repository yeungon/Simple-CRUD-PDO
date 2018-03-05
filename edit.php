	<?php
	session_start();

	if ( ! isset($_SESSION['name']) ) {
		die("ACCESS DENIED");
	}

	require_once "pdo.php";

	require "bootstrap.php";
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc',
		'fred', 'zap');

	$id = $_GET['id'];

	$stmt = $pdo->query("SELECT * FROM autos WHERE auto_id = $id");

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);



	if(isset($_POST['ok'])){

// if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])){


		if ($_POST['make'] == NULL | $_POST['model'] == NULL |$_POST['year'] == NULL|$_POST['mileage'] == NULL  ) {

			$_SESSION['error'] = "All fields are required";

			header("Location: edit.php?id=$id");

			return;

		}else if (!is_numeric($_POST['year'])) {


			$_SESSION['error'] = "Year must be an integer";

			header("Location: edit.php?id=$id");

			return;

		}else if (!is_numeric($_POST['mileage'])) {


			$_SESSION['error'] = "Mileage must be an integer";

			header("Location: edit.php?id=$id");

			return;


		}else{


			$sql = "UPDATE autos SET make = :mk,
			model = :ml, year = :yr, mileage = :mi
			WHERE 	auto_id = $id";

			$stmt = $pdo->prepare($sql);


			$stmt->execute(array(
				':mk' => $_POST['make'],
				':ml' => $_POST['model'],
				':yr' => $_POST['year'],
				':mi' => $_POST['mileage'])

		); 


			$_SESSION['success'] = 'Record updated';

			header( 'Location: index.php' ) ;

			return;

			
		}

	}

	/*cancel button*/

	if(isset($_POST['cancel'])){

		header("Location: view.php");

		return;
	}



	?>



	<!DOCTYPE html>
	<html>
	<head>
		<title>Vuong Nguyen 's Automobiles, Sessions, and POST-Redirect</title>
	</head>
	<body>
		<div class="container">
			<h1>Tracking Autos by Vuong </h1>


			<?php

			if (isset($_SESSION['error']) ) {

				echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");

				unset($_SESSION['error']);

			}

			?>


			<form method="post">
				<p>Make:
					<input type="text" name="make" value ="<?php  foreach ($rows as $rows){echo $rows['make']; }?>" /></p>

					<p>Model:<input type="text" name="model" value ="<?php  echo $rows['model'];?>" /></p>
					<p>Year:
						<input type="text" name="year" value="<?php  echo $rows['year'];?>" /></p>
						<p>Mileage:
							<input type="text" name="mileage" value ="<?php echo $rows['mileage']; ?>" /></p>

							<input type="submit" name = "ok" value="Save">
							<input type="submit" name="cancel" value="Cancel">
						</form>

					</div>
				</body>
				</html>


