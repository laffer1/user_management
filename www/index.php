<html>

<head>
<title>CS ACT Login</title>
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
<h1 style="text-align: center;">CS ACT</h1>

<form id="cslogin" name="cslogin" method="POST" action="dashboard.php">
<fieldset><legend><strong>Authenticate</strong><br /></legend>
<table>
<tr>
    <td width="60%" style="text-align: right;">username</td>
    <td><input type="text" name="username" id="username" value="" /></td>
</tr>

<tr>
    <td style="text-align: right;">password</td>
    <td><input type="password" name="password" id="password" value="" /></td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td>
        <input type="submit" name="submit" id="submit" value="Login" />
    </td>
</tr>
</table>
</fieldset>
</form>
</div>

</body>

</html>
