	<?php
	session_start();/*should be get started with session_start()*/
	
	if (! isset($_SESSION['name']) ) {
    die("ACCESS DENIED");
	}


	/*echo $_SESSION['name'];*/

	require_once "pdo.php";

	require "bootstrap.php";
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc',
		'fred', 'zap');

	$message = false;


		$stmt = $pdo->query("SELECT * FROM autos");
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

		

<!DOCTYPE html>
<html>
<head>
	<title>Vuong Nguyen 's Automobiles, Sessions, and POST-Redirect</title>
</head>
<body>

<div class="container">
			<h1>Tracking Autos for <?php echo $_SESSION['name'];?> </h1>

			<!-- result is announced here -->
			<?php 
/*
			if ( $message !== false ) {
    // Look closely at the use of single and double quotes
				echo $message;
			}*/

			if ( isset($_SESSION['success']) ) {

			echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");

			unset($_SESSION['success']);

			}


			?>


							<!-- <input type="submit" name = "ok" value="Add"> -->

							<a href="add.php">Add New</a>
							<a href="logout.php">Logout</a>
				
						<h2>Automobiles</h2>
						<table class="table" border="1">
						<thead>
						<tr>
							<th>Make</th>
							<th>Model</th>
							<th>Year</th>
							<th>Mileage</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
						
						</thead>
						<tbody>
						
						<?php 


						foreach ($rows as $rows) {

							
							echo '<tr>';
							echo '<td>'.htmlentities($rows['make']).'</td>';
							echo '<td>'.htmlentities($rows['model']).'</td>';
							echo '<td>'.$rows['year'].'</td>';
							echo '<td>'.$rows['mileage'].'</td>';
							echo "<td><a href='edit.php?id=".$rows['auto_id']."'>Edit</a></td>";
							echo "<td><a href='delete.php?id=".$rows['auto_id']."'>Delete</a></td>";
							echo '</tr>';
											
							
							
						}

						?>
						
						</tbody>
						</table>

					</div>
				</body>
				</html>


