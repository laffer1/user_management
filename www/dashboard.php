<?php
    
session_start();

function setauth(){
    $auth = "ok";
    $_SESSION['auth'] = $auth;
    if (!isset($_SESSION['generated']))
        $_SESSION['generated'] = time();
}

if ( !isset($_SESSION['auth']))
{
    if ( $_POST['username'] != 'admin' || $_POST['password'] != 'averysecretpasswordCHANGEME' )
    {
        /* Redirect to a different page in the current directory that was requested */
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");
exit;
    }
    else
    {
        setauth();
    }
}
?>
<html>

<head>
<title>Computer Science Accounts </title>
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
<h1 style="text-align: center;">Manage Computer Science Accounts</h1>

<ul>
<li><a href="create.php">Create Accounts</a></li>
<li><a href="list.php">List Accounts</a></li>
</ul>
</div>

</body>

</html>
