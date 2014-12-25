#!/usr/bin/php
<?php

include "libmail.php";

$addscript = "/usr/local/cs/adduser.sh ";
$basepath = "/Network/Servers/od.cs.emich.edu/Volumes/Longboard/Users/";

function adduser()
{
    $myuser = 'csusers';
    $mypass = '';
    $myhost = 'cs.emich.edu';
    global $addscript;
    global $basepath;

    $mydb = mysql_connect( $myhost, $myuser, $mypass );
    mysql_select_db( 'csusers', $mydb );

    $query = "SELECT * FROM users WHERE created='n'";
    $rs1 = mysql_query($query, $mydb) or die (mysql_error());

    $row_rs1 = mysql_fetch_assoc($rs1);

    do {
        echo "Running for: " . $row_rs1['csuser'];
        system( $addscript . $row_rs1['csuser'] . " " . $row_rs1['uid'] . " " . $row_rs1['gid'] . " " . $row_rs1['fname'] . " " .  $row_rs1['lname'] . " " . $row_rs1['password'] . " " . $basepath . $row_rs1['csuser'] , $retval );

        if ($retval == 0)
        {
            $m= new Mail; // create the mail

            $m->From( $row_rs1['emichuser'] . "@emich.edu" );
            $m->To( $row_rs1['emichuser'] . "@emich.edu" );
            $m->Subject( "Computer Science: Account Created" );
            $m->Body( "Your account has been created: user is " .$row_rs1['csuser'] . " and password is " . $row_rs1['password'] . ". Please change your password." );    // set the body
            $m->Priority(3) ;
            $m->Send();     // send the mail

            $query2 = "UPDATE users SET created=\"y\" , created_date=now() WHERE uid=" . $row_rs1['uid'];
            echo "Executing: " . $query2;
            $mydb2 = mysql_connect( $myhost, $myuser, $mypass );
            mysql_select_db( 'csusers', $mydb2 );
            $rs2 = mysql_query( $query2, $mydb2 );
            mysql_close($mydb2);
        }
    }
    while ($row_rs1 = mysql_fetch_assoc($rs1));

    mysql_free_result($rs1);
    mysql_close($mydb);
}

adduser();

?>
