<!DOCTYPE html>
<html>
<head>
	<title>Student Marking System</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playball">
<style>
	body{
		font-family: Times New Roman;
		font-size: 20px;
		color: white;
		  background-image: linear-gradient(black, plum);
		  height: 55rem;
		  
	}
	.btn{
		color: plum;
		background-color: black;
		font-size: 20px;
		padding: 20px;
		border-radius: 10px;
		border-color: white;
	}
	.required_field{
	    color: red;
	    font-size: 20px;
	}
	.fliter_rows{
		background-color: red;
		color: white;
	}
	p{
		color: white;
		text-align: center;
		vertical-align: middle;
		font-size: 40px;
		font-family: serif;
		text-shadow: 2px 2px grey;
	}
	h1{
		color: white;
		text-align: center;
		font-family: Playball;
		text-shadow: 2px 2px grey;
	}
</style>
</head>
<body>
	<h1>Student Marking System</h1>
	<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
	<center>
	<table cellpadding="10" cellspacing="10">
		<tr>
			<td><input type="submit" name="insert" value="Insert Data" class="btn"></td>
			<td><input type="submit" name="delete" value="Delete Data" class="btn"></td>
			<td><input type="submit" name="display" value="Display Data" class="btn"></td>
			<td><input type="submit" name="filter" value="Filter Data" class="btn"></td>
		</tr>
	</table></center><br>

<?php	
	$conn = mysqli_connect("localhost","root","","student_marking_system");
	if(isset($_POST['insert'])){
?>
</form>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
	<center>
	<table cellpadding="10" cellspacing="10" align="center" style="border: 10px inset;font-family: georgia;">
		<tr>
			<td>Student-ID (Roll No)<span class="required_field">*</span></td>
			<td><input type="text" name="rollnum" value="<?php 
			echo isset($_POST['rollnum']) ? $_POST['rollnum'] : ''; ?>" required></td>
		</tr>
		<tr>
			<td>Your Name<span class="required_field">*</span></td>
			<td><input type="text" name="name" value="<?php 
			echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required></td>
		</tr>
		<tr>
			<td>Email-ID<span class="required_field">*</span></td>
			<td><input type="email" name="email" value="<?php 
			echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required></td>
		</tr>
		<tr>
			<td>Contact Number<span class="required_field">*</span></td>
			<td><input type="number" name="contact" value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : ''; ?>" required></td>
		</tr>
		<tr>
			<td>Subject-1 Marks (out of 100)<span class="required_field">*</span></td>
			<td><input type="number" name="sub1" value="<?php echo isset($_POST['sub1']) ? $_POST['sub1'] : ''; ?>" required></td>
		</tr>
		<tr>
			<td>Subject-2 Marks (out of 100)<span class="required_field">*</span></td>
			<td><input type="number" name="sub2" value="<?php echo isset($_POST['sub2']) ? $_POST['sub2'] : ''; ?>" required></td>
		</tr>
		<tr>
			<td>Subject-3 Marks (out of 100)<span class="required_field">*</span></td>
			<td><input type="number" name="sub3" value="<?php echo isset($_POST['sub3']) ? $_POST['sub3'] : ''; ?>" required></td>
		</tr>
		<tr>
			<td rowspan="2"></td>
			<td><input type="submit" name="insert" value="Submit Data" class="btn"></td>
		</tr>

		<?php
		if($_POST['insert'] == 'Submit Data'){

			$rollnum = $_POST['rollnum'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$contact = $_POST['contact'];
			$sub1 = $_POST['sub1'];
			$sub2 = $_POST['sub2'];
			$sub3 = $_POST['sub3'];
			$total = $sub1+$sub2+$sub3;

			if(!preg_match("/^[1-9]{2}[a-zA-Z]{3}[0-9]{3}$/", $rollnum)){
				echo '<script>alert("Your Roll number is not in a proper format.")</script>';
			}
			elseif(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
				echo "<script>alert('First Name is not valid.')</script>";
			}
			elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $email)) {
				echo "<script>alert('Your email is not valid.')</script>";
			}
			elseif(!preg_match("/^[0-9]{10}$/", $contact)){
				echo "<script>alert('Mobile Number is not valid. You must enter 10 digits only.')</script>";
			}
			else{

				$query = "INSERT INTO student VALUES('$rollnum','$name','$email',$contact,$sub1,$sub2,$sub3,$total)";

				$result = mysqli_query($conn, $query);

				if(!$result)
				{
					die("<br>Can't Insert Data : " .mysqli_error());
				}
				else{
					echo '<script>alert("Data Inserted Successfully:)");window.location="Student_Marking_System.php"</script>';	
				}
			}
			echo "</table></center></form>";
		}
	}

	if(isset($_POST['delete'])){
?>
	<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
		<center>
		<table cellpadding="10" cellspacing="10" align="center" style="border: 10px inset;font-family: georgia;">
			<tr>
				<td>Student-ID (Roll No)<span class="required_field">*</span></td>
				<td><input type="text" name="rollnum" required></td>
			</tr>

			<tr>
				<td>Email-ID<span class="required_field">*</span></td>
				<td><input type="email" name="email" required></td>
			</tr>

			<tr>
				<td rowspan="2"></td>
				<td><input type="submit" name="delete" value="  &nbsp;&nbsp; Delete &nbsp;&nbsp;  " class="btn"></td>
			</tr>

		<?php
			if($_POST['delete'] == 'Delete'){

				$rollnum = $_POST['rollnum'];
				$email = $_POST['email'];

				if(!preg_match("/^[1-10]{2}[a-zA-Z]{3}[0-9]{3}+$/", $rollnum)){
					echo '<script>alert("Your Roll number is not in proper format.")</script>';
				}
				else{
					$query = "DELETE FROM student WHERE rollnum='$rollnum' and email='$email'";

					$result = mysqli_query($conn, $query);

					if(!$result)
					{
						die("<br>Can't Delete Data : " .mysqli_error());
					}
					else{
						echo '<script>alert("Data Deleted Successfully:)");window.location="Student_Marking_System.php"</script>';	
					}
				}
				echo "</table></center></form>";
			}	
	}

	if(isset($_POST['display']) or isset($_POST['filter'])){

		$query = "SELECT * FROM student";

		$result = mysqli_query($conn,$query);

		if(mysqli_num_rows($result) > 0){
			
			echo "<center><table cellspacing='9' cellpadding='9' align='center' style='border: 10px inset;font-family: georgia;'>

					<tr>
						<th>Student-ID</th>
						<th>Your Name</th>
						<th>Email-ID</th>
						<th>Contact Number</th>
						<th>Subject-1 Marks</th>
						<th>Subject-2 Marks</th>
						<th>Subject-3 Marks</th>
						<th>Total</th>
					</tr>";
		
			if(isset($_POST['display'])){
				
				while ($row = mysqli_fetch_array($result)) {
					echo "<tr>
						<td>".$row['rollnum']."</td>
						<td>".$row['name']."</td>
						<td>".$row['email']."</td>
						<td>".$row['contact']."</td>
						<td>".$row['sub1']."</td>
						<td>".$row['sub2']."</td>
						<td>".$row['sub3']."</td>
						<td>".$row['total']."</td>
					  </tr>";
				}
			}

			if(isset($_POST['filter'])){

				while ($row = mysqli_fetch_array($result)) {
					if($row['sub1'] < 40 or $row['sub2'] < 40 or $row['sub3'] < 40){

					echo "<tr>
							<td class='fliter_rows'>".$row['rollnum']."</td>
							<td class='fliter_rows'>".$row['name']."</td>
							<td class='fliter_rows'>".$row['email']."</td>
							<td class='fliter_rows'>".$row['contact']."</td>
							<td class='fliter_rows'>".$row['sub1']."</td>
							<td class='fliter_rows'>".$row['sub2']."</td>
							<td class='fliter_rows'>".$row['sub3']."</td>	
							<td class='fliter_rows'>".$row['total']."</td>
						</tr>";		
						}					
					else{
						echo "<td>".$row['rollnum']."</td>
						<td>".$row['name']."</td>
						<td>".$row['email']."</td>
						<td>".$row['contact']."</td>
						<td>".$row['sub1']."</td>
						<td>".$row['sub2']."</td>
						<td>".$row['sub3']."</td>
						<td>".$row['total']."</td>";					
					}		
									
				}
			}
			
			echo "</table></center>";
		}
		else	
		{
			echo "<p>Oops! No Data Found"."&#128531;</p>";
		}		
	}

?>		
</body>
</html>