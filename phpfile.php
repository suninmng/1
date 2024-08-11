<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"labs");
if(isset($_POST['submit1']))
{
    $name=$_POST['txtname'];
    $addr=$_POST['txtaddr1'];
    $city=$_POST['txtaddr2'];
    $email=$_POST['txtemail'];

    $query="insert into person values ('$name','$addr','$city','$email')";

    if(mysqli_query($con,$query))
        echo "<h1 align='center'>Inserted Successfully</h1>";
    else
        echo "<h1 align='center'>Insertion Failed</h1>";
}
else if(isset($_POST['submit2']))
{
    $sname=$_POST['searchname'];
    $query="select * from person where name='$sname'";
    $rslt=mysqli_query($con,$query);
    $num_rows=mysqli_num_rows($rslt);
    if(!$num_rows)
    {
        echo "<h1 align=center>No data found for the given search</h1>";
    }
    while($row=mysqli_fetch_row($rslt))
    {
        echo "<h4>Searched Info:</h4> <pre>
        Name         : $row[0] <br>
        Address1     : $row[1] <br>
        Address2     : $row[2] <br>
        Email        : $row[3] <br> </pre>";
    }
}
?>
