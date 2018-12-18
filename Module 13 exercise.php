<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="tools.css">
<title>Untitled Document</title>
</head>

<body>
	<form method="post" action="Show-Results.php" onsubmit="return this">
<p class="legend">Personal information</p>
<fieldset id="personal">
<label>Name:</label><input type="text" name="name" size="30" /> 
<br />
<label>Address:</label><input type="text" name="address" size="30" /> 
<br />
<label>Town/City:</label><input type="text" name="city" size="30" /> 
<br />
<label>State:</label><input type="text" name="state" size="2" maxlength="2" /><br /> 
<label>Zipcode:</label><input type="text" name="zip" size="5" maxlength="5" /> 
<br />
<label>Email:</label><input type="text" name="email" />
<br />
<label>Age:</label><input type="text" name="age" size="3" maxlength="3" />
</fieldset>
		<p id="buttons"><input type="submit" value="Submit Form"  />
<input type="reset" value="Start Over" /></p>
	</form>
	<?php
	// display in browser the value of $_POST associative array as initial test
// use echo function and its parameter needs to be a string and use . operator to combine strings
echo '<div id=\'feedback\'>';
echo ("LibraryBox = " . $_POST['tool1']);
echo ("<br/>");
echo ("Zotero = " . $_POST['tool2']);
echo ("<br/>");
echo ("LibKi = " . $_POST['tool3']);
echo ("<br/>");
echo ("Omeka = " . $_POST['tool4']);
echo ("<br/>");
echo ("Open Exhibits = " . $_POST['tool5']);
echo ("<br/>");
echo ("Alice = " . $_POST['tool6']);
echo ("<br/>");
echo ("Calibre = " . $_POST['tool7']);
echo ("<br/>");
echo ("Evergreen = " . $_POST['tool8']);
echo ("<br/>");
echo ("Wordseer = " . $_POST['tool9']);
echo ("<br/>");
echo ("CollectiveAccess = " . $_POST['tool10']);
echo ('<br />');  
echo '</div>';
'<br';	 

displayPostArray($_POST);


require_once "login_curtis.php"; 
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database) or die("Unable to select database: " . mysql_error()); 


if (isset($_POST['tool1']) &&
    isset($_POST['tool2']) &&
	isset($_POST['tool3']) &&
	isset($_POST['tool4']) &&
	isset($_POST['tool5']) &&
	isset($_POST['tool6']) &&
	isset($_POST['tool7']) &&
	isset($_POST['tool8']) &&
	isset($_POST['tool9']) &&
	isset($_POST['tool10'])
	) 

{  
	
	$tool1 = mysql_fix_string($_POST['tool1']);
	$tool2 = mysql_fix_string($_POST['tool2']);
	$tool3 = mysql_fix_string($_POST['tool3']);
	$tool4 = mysql_fix_string($_POST['tool4']);
	$tool5 = mysql_fix_string($_POST['tool5']);
	$tool6 = mysql_fix_string($_POST['tool6']);
	$tool7 = mysql_fix_string($_POST['tool7']);
	$tool8 = mysql_fix_string($_POST['tool8']);
	$tool9 = mysql_fix_string($_POST['tool9']);
	$tool10 = mysql_fix_string($_POST['tool10']);
	
	$query = "INSERT INTO tools (tool1, tool2, tool3, tool4, tool5, tool6, tool7, tool8, tool9, tool10) VALUES" .
        "('$tool1', '$tool2', '$tool3', '$tool4', '$tool5', '$tool6', '$tool7', '$tool8', '$tool9', '$tool10')";
	
	if (!mysql_query($query, $db_server))
            echo "INSERT failed: $query<br />" .
            mysql_error() . "<br /><br />";
}
'<br/>';	 

$query = "SELECT * FROM tools";
$result = mysql_query($query, $db_server);
if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);
	
	/*
for ($j = 0 ; $j < $rows ; ++$j){
	$row = mysql_fetch_row($result);
	
	echo '  Tool 1: ' . $row[0] . '<br>';
	echo '  Tool 2: ' . $row[1] . '<br>';
	echo '  Tool 3: ' . $row[2] . '<br>';
	echo '  Tool 4: ' . $row[3] . '<br>';
	echo '  Tool 5: ' . $row[4] . '<br>';
	echo '  Tool 6: ' . $row[5] . '<br>';
	echo '  Tool 7: ' . $row[6] . '<br>';
	echo '  Tool 8: ' . $row[7] . '<br>';
	echo '  Tool 9: ' . $row[8] . '<br>';
	echo '  Tool 10: ' . $row[9] . '<br>' .'<br />';
} 
	*/
'<br/>';	 
echo "Display AVERAGE SCORES for table = 'tools'.<br/><hr>";
	
$query = "SELECT SUM(tool1), SUM(tool2), SUM(tool3), SUM(tool4), SUM(tool5), SUM(tool6), SUM(tool7), SUM(tool8), SUM(tool9), SUM(tool10) FROM tools";

$result = mysql_query($query, $db_server);
if (!$result) die ("Database access failed: " . mysql_error());

$firstrow = mysql_fetch_row($result);

echo '<div class=\'resultStyle\'>'; 
echo '<span class="bold">LibraryBox</span> SUM: <span class="bold">' . $firstrow[0] . '</span> and AVG = <span class="bold">' . number_format($firstrow[0] / $rows, 2) . '</span><br />';
echo '<span class="bold">Zotero</span> SUM: <span class="bold">' . $firstrow[1] . '</span> and AVG = <span class="bold">' . number_format($firstrow[1] / $rows, 2) . '</span><br />';
echo '<span class="bold">Libki</span> SUM: <span class="bold">' . $firstrow[2] . '</span> and AVG = <span class="bold">' . number_format($firstrow[2] / $rows, 2) . '</span><br />';
echo '<span class="bold">Omeka</span> SUM: <span class="bold">' . $firstrow[3] . '</span> and AVG = <span class="bold">' . number_format($firstrow[3] / $rows, 2) . '</span><br />';
echo '<span class="bold">Open Exhibits</span> SUM: <span class="bold">' . $firstrow[4] . '</span> and AVG = <span class="bold">' . number_format($firstrow[4] / $rows, 2) . '</span><br />';
echo '<span class="bold">Alice</span> SUM: <span class="bold">' . $firstrow[5] . '</span> and AVG = <span class="bold">' . number_format($firstrow[5] / $rows, 2) . '</span><br />';
echo '<span class="bold">Calibre</span> SUM: <span class="bold">' . $firstrow[6] . '</span> and AVG = <span class="bold">' . number_format($firstrow[6] / $rows, 2) . '</span><br />';
echo '<span class="bold">Evergreen</span> SUM: <span class="bold">' . $firstrow[7] . '</span> and AVG = <span class="bold">' . number_format($firstrow[7] / $rows, 2) . '</span><br />';
echo '<span class="bold">Wordseer</span> SUM: <span class="bold">' . $firstrow[8] . '</span> and AVG = <span class="bold">' . number_format($firstrow[8] / $rows, 2) . '</span><br />';
echo '<span class="bold">CollectiveAccess</span> SUM: <span class="bold">' . $firstrow[9] . '</span> and AVG = <span class="bold">' . number_format($firstrow[9] / $rows, 2) . '</span><br />';  

echo '</div>'; 

function displayPostArray ($postarray) {

	foreach ($postarray as $tool => $score)
	{
		echo "$tool" . " = " . "$score<br/>";
	}
	
}
 

function mysql_fix_string($string)
{
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return mysql_real_escape_string($string);
}

?> 
</body>
</html>
