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

$errmsg = "";

function getform()
{
    global $errmsg;
    $goofy = trim($_POST['goofy']);
    $eid = trim($_POST['emichid']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);

    $myuser = "csusers";
    $mypass = '';

    if ( $goofy == 'ok' && 
        (strlen($firstname) < 2 || strlen($lastname) < 2 ||
         strlen($eid) < 2 ) )
    {
        $errmsg = "Not all required fields were filled in.";
    } else if ($firstname == '') {
        $errmsg = "First name not set";
    } else if ($lastname == '') {
        $errmsg = "Last name not set";
    } else if ($eid == '') {
        $errmsg = "my.emich id not set";
    } else {
        $mydb = mysql_connect( 'localhost', $myuser, $mypass );
        mysql_select_db('csusers', $mydb);
        $query = "INSERT INTO users (gid,fname,lname,emichuser, email, csuser, request_date, password) VALUES(20,'" . $firstname . 
                 "','" . $lastname . "','" . $eid . "','" . $eid . "@emich.edu', 'cs_" . $eid . "', now(), (SELECT LEFT(MD5(UUID()),10)) )";
        $rs1 = mysql_query($query, $mydb) or die (mysql_error());
        mysql_close($mydb);
        $errmsg = "Account created: cs_" . $eid;
    }
}

getform();
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

</style>
</head>

<body>

<div id="content">
<h1 style="text-align: center;">Create Accounts</h1>

<p style="color: red; font-weight: bold;"><?php echo $errmsg ?></p>

<form id="csadd" name="csadd" method="POST" action="create.php">
<fieldset><legend><strong>Account Information</strong><br /></legend>
<input type="hidden" name="goofy" value="ok" />
<table>
<tr>
    <td width="60%" style="text-align: right;"><label for="emichid">EMU username</label></td>
    <td><input type="text" name="emichid" id="emichid" value="<?php echo $_POST['emichid'] ?>" /></td>
</tr>

<tr>
    <td width="60%" style="text-align: right;"><label for="firstname">first name</label></td>
    <td><input type="text" name="firstname" id="firstname" value="<?php echo $_POST['firstname'] ?>" /></td>
</tr>

<tr>
    <td style="text-align: right;"><label for="lastname">last name</label></td>
    <td><input type="text" name="lastname" id="lastname" value="<?php echo $_POST['lastname'] ?>" /></td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td>
        <input type="submit" name="submit" id="submit" value="Create" />
    </td>
</tr>
</table>
</fieldset>
</form>

</div>

</body>
</html>
