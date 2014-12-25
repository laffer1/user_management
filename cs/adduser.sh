#!/bin/sh

# example
# adduser laffer1 7001 20 Lucas Holt pass /Users/laffer1 

user=$1
uid=$2
gid=$3
fname=$4
lname=$5
password=$6
homedir=$7

/usr/bin/dscl localhost << EOF
cd /LDAPv3/127.0.0.1/Users
auth diradmin binks43
create $user
create $user UserShell /bin/bash
create $user UniqueID $uid
create $user PrimaryGroupID $gid
create $user RealName $fname $lname
create $user LastName $lname
create $user NFSHomeDirectory $homedir
create $user HomeDirectory <home_dir><url>afp://od.cs.emich.edu/Home</url><path>$user</path></home_dir>
passwd $user $password
quit
EOF

/usr/bin/dscl localhost << EOF
cd /LDAPv3/127.0.0.1/Groups
auth diradmin mysecretpassword
append compsci GroupMembership $user
append students GroupMembership $user
quit
EOF

/usr/sbin/createhomedir -u $user
