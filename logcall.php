<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Police Emergency Service System</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

	
<body>
<script>
function validate()
{
var JostonCaller=document.forms["JostonLogCall"]["JostonCaller"].value;
var JostonContact=document.forms["JostonLogCall"]["JostonContact"].value;
var JostonLocation=document.forms["JostonLogCall"]["JostonLocation"].value;
var incidentDesc=document.forms["JostonLogCall"]["incidentDesc"].value;

if (!JostonCaller || JostonCaller == "")
{
alert("Caller Name is Required.");
return false;
}

else
	
{
if (!isNaN(JostonCaller))
{
alert("Only Characters are allowed");
return false;
}
}

if (!JostonContact || JostonContact == "")
{
alert("Contact Number is Required.");
return false;
}
	
else
	
{
if(isNaN(JostonContact))
{
alert("Number only.");
return false; 
}
	
else
	
{
if (JostonContact.length != 8)
{
alert("8 numbers only");
return false;
}
}
}

if (!JostonLocation || JostonLocation=="")
{
alert("Location is Required.");
return false;
}

if (!incidentDesc || incidentDesc=="")
{
alert("Description is Required.");
return false;
}
}

</script>
<?php require 'nav.php';?>
<?php require 'db_config.php';
	
$mysqli = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);	

if ($mysqli->connect_errno)
{
	die("Unable to Run: ".$mysqli->connect_errno);
}
	
$sql = "SELECT * FROM incidenttype";
	
if(!($stmt = $mysqli->prepare($sql)))
{
	die("Unable to Run: ".$mysqli->errno);
}
	
if (!$stmt->execute())
{
	die("Unable to Run: ".$stmt->errno);
}

if (!($resultset = $stmt->get_result())) {
	die("Unable to get Results: ".$stmt->errno);
}
	
$incidentType;
	
while ($row = $resultset->fetch_assoc()) {
	
	$incidentType[$row['incidentTypeId']] = $row['incidentTypeDesc'];
}
	
$stmt->close();
	
$resultset->close();
	
$mysqli->close();
	
?> 
<fieldset>
<form name="JostonLogCall" method="post" action="dispatch.php" onSubmit="return validate();">
<table width="40%" border="1" align="center" cellpadding="4" cellspacing="4">
<tr>
<td width="50">Caller's Name :</td>
<td width="50"><input type="text" name="JostonCaller" id="JostonCaller"></td>
</tr>
<tr>
<td width="50">Contact No :</td>
<td width="50"><input type="text" name="JostonContact" id="JostonContact"></td>
</tr>
<tr>
<td width="50">Location :</td>
<td width="50"><input type="text" name="JostonLocation" id="JostonLocation"></td>
</tr>
<tr>
<td width="50">Incident Type :</td>
<td width="50"><select name="incidentType" id="incidentType">
<?php foreach($incidentType as $key => $value) {?>
<option value="<?php echo $key?>">
<?php echo $value ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td width="50">Description</td>
<td width="50"><textarea name="incidentDesc" id="incidentDesc" cols="45" rows="5"></textarea>
</td>
</tr>
<tr>
<td><input type="reset" name="resetButton" id="resetbutton" value="Reset"</td>
<td><input type="submit" name="submitButton" id="submitButton" value="Submit"</td>
</tr>
</table>	
</form>
</fieldset>
<br>
<br>
<br>
<br>
<hr>
<div align="center">
<p>&copy; Joston Lee PESS System. &nbsp; All Right Reserved</p>
<p>Develop and Done by: Joston Lee</p>
</div>
</body>
</html>