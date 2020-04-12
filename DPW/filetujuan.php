<?php
parse_str($_POST['dataform'], $hasil);
$action = $_POST['action'];

$conn = new mysqli("localhost","root","","billing_address2");

if($action == 'create')
{
	$sql= "INSERT INTO `tbl_user`(`id_user`, `firstname`, `lastname`, `username`, `email`, `address`, `address2`, `Payment`, `Name_card`, `Credit_number`, `Expiration`, `CVV`, `Time_Insert`) VALUES ('','$hasil[firstname]','$hasil[lastname]'
	,'$hasil[username]','$hasil[email]','$hasil[address]','$hasil[address2]','$hasil[paymentMethod]','$hasil[Name_Card]','$hasil[Credit_Number]','$hasil[Expiration]','$hasil[CVV]',now())";
}
elseif ($action == 'update')
{
	$sql = "UPDATE tbl_user SET firstname =  '$hasil[firstname]', lastName = '$hasil[lastname]' where firstname = '$hasil[firstname]'";
}
elseif($action == 'delete')
{
	$sql = "DELETE from tbl_user where firstname = '$hasil[firstname]'";
}
elseif($action == 'read')
{
	$sql = "SELECT * from `tbl_user`";
}

else {
	echo "ERROR ACTION";
	exit();
}

if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}else{
  echo "Database connected. ";
}

if ($conn->query($sql) === TRUE) {
	echo "Query $action with syntax $sql suceeded !";

}
elseif ($conn->query($sql) === FALSE){
	echo "Error: $sql" .$conn -> error;
}
else
{
	$result = $conn->query($sql);
	if($result->num_rows > 0)

	{
		echo "<table id='tresult' class='table table-striped table-bordered' style='color :#60e600;'>";
		echo "<thead><th>Firstname</th><th>Lastname</th></th><th>Username</th></th><th>Email</th></th><th>Address</th><th>Address2</th><th>Name On Card</th><th>Credit Card Number</th>
		<th>Card Expire</th><th>CVV</th></thead>";
		while($row = $result->fetch_assoc())
		{
			echo "<tr>
			<td>".$row['firstname']."</td>
			<td>".$row['lastname']."</td>
			<td>".$row['username']."</td>
			<td>".$row['email']."</td>
			<td>".$row['address']."</td>
			<td>".$row['address2']."</td>
			<td>".$row['Name_card']."</td>
			<td>".$row['Credit_number']."</td>
			<td>".$row['Expiration']."</td>
			<td>".$row['CVV']."</td>
			</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
else
{
	echo "Data Not Available";
}
}
$conn->close();
?>
