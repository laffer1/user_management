<?php
    
session_start();

/* make sure user is authenticated */
if ( !isset($_SESSION['auth']))
{
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");
exit;
}

function listusers()
{
    global $errmsg;
    $myuser = "csusers";
    $mypass = '';

    $mydb = mysql_connect( 'localhost', $myuser, $mypass );
    mysql_select_db('csusers', $mydb);
    $query = "SELECT * FROM users order by csuser";

    $rs1 = mysql_query($query, $mydb) or die (mysql_error());

    $row_rs1 = mysql_fetch_assoc($rs1);
    echo "<table>";
    echo "<tr><th>cs username</th><th>first name</th><th>last name</th></tr>";
    do { 
        echo  "<tr><td>" . $row_rs1['csuser'] . "</td><td>" . $row_rs1['fname'] . "</td><td> " . $row_rs1['lname'] . "</tr>\n"; 
    } while ($row_rs1 = mysql_fetch_assoc($rs1)); 
    echo "</table>";

    mysql_free_result($rs1);
    mysql_close($mydb);
}
?>
<html>

<head>
<title>Create Computer Science Account</title>
<style type="text/css">
body {
    background: white;
    color: black;
    font: 12pt Helvetica, Arial, sans-serif;
    margin:50px 0; 
    padding: 0;
    text-align:center;
}

#content {
    margin: 0 auto;
    text-align: left;
    width: 600px;
    padding: 15px;
}

h1 { color: green; }

th { color: white; background: black; }
table { border: thin solid black; }

</style>
</head>

<body>

<div id="content">
<h1 style="text-align: center;">List Accounts</h1>

<?php listusers() ?>

</div>

</body>
</html>
