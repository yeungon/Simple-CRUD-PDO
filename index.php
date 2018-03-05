
<?php 
session_start();

require_once "bootstrap.php";

require_once "pdo.php";

require "bootstrap.php";

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc',
		'fred', 'zap'); 
$stmt = $pdo->query("SELECT * FROM autos");

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo md5('XyZzy12*_php123');

?>

<!DOCTYPE html>
<html>
<head>
<title>Vuong Nguyen 0b24d846</title>

</head>
<body>
<div class="container">
<h1>Welcome <?php if(isset($_SESSION['name'])){ echo $_SESSION['name'];} ?> to Automobiles, Sessions, and POST-Redirect by Vuong Nguyen</h1>


<?php


if ( isset($_SESSION['success']) ) {
echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");

unset($_SESSION['success']);
}



if(!isset($_SESSION['name'])){
	echo "<p><a href='login.php'>Please log in</a></p>";
	
	echo "<p>Attempt to go to <a href='add.php'>add.php</a> without logging in - it should fail with an error message.</p>";

}else{

		echo "<table class='table' border='4'>";
						echo "<thead>";
						echo "<tr>";
							echo "<th>Make</th>";
							echo "<th>Model</th>";
							echo "<th>Year</th>";
							echo "<th>Mileage</th>";
							echo "<th>Edit</th>";
							echo "<th>Delete</th>";
						echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
					
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

						
						
						echo "</tbody>";
						echo "</table>";


echo "<a href='add.php'>Add New Entry</a><br>";
echo "<a href='logout.php'>Logout</a>";

}

?>


					


</div>
</body>


