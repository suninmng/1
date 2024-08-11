<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"labs");

$doc=new DOMdocument();
$doc->load('data7b.xml');
$stud=$doc->getElementsByTagName("student");

foreach($stud as $s)
{
	$id=$s->getElementsByTagName("id")->item(0)->nodeValue;
	$name=$s->getElementsByTagName("name")->item(0)->nodeValue;
	$college=$s->getElementsByTagName("college")->item(0)->nodeValue;

	$query="insert into studinfo values('$id','$name','$college')";
	$res=mysqli_query($con,$query);
}

print "<h3 style='color:blue' align='center'>Students Data Recorded</h3>";
print "<table border='1' align='center' cellpadding='10'>";
print "<tr bgcolor='lightgrey'>";
print "<th>ID</th>";
print "<th>Name</th>";
print "<th>College</th>";
print "</tr>";

$query="select * from studinfo";
$res=mysqli_query($con,$query);

while($row=mysqli_fetch_row($res))
{
	print "<tr>";
	print "<td>".$row[0]."</td>";
	print "<td>".$row[1]."</td>";
	print "<td>".$row[2]."</td>";
	print "</tr>";
}
print "</table>";
?>