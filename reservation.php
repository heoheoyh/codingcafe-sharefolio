<?php
$con = mysql_connect("localhost", "root", "root");
if (!$con) {

	die('Could not connect:' . mysql_error());
}
mysql_select_db("reservation", $con);
?>

<?php





$sql="insert into reservation (reservation_date, name, room_type,  number_person ,email, phone_number) 
values('$_POST[reservation_date]', '$_POST[name]','$_POST[room_type]' , '$_POST[number_person]','$_POST[email]', '$_POST[phone_number]')";

if(!mysql_query($sql,$con))
{
	die('Error: ' . mysql_error());
}
echo "Success reservation! Thanks you:)";
echo "<br>";
echo "<br>";

$result = mysql_query('select * from reservation');

while ($row = mysql_fetch_array($result)){
	echo $row['reservation_date'];
	echo '<br>';
	echo $row['name'];
	echo '<br>';
	echo $row['room_type'];
	echo '<br>';
	echo $row['number_person'];
	echo '<br>';
	echo $row['email'];
	echo '<br>';
	echo $row['phone_number'];
	echo '<br>';
	echo '<br>';
}

mysql_close($con)




?>

