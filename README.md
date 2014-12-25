user_management
===============

User Management for accounts on an OS X server via PHP web interface

This application was written to manage computer science accounts at EMU
during my time as a student. It stored accounts in a MySQL database
so that we could recreate them (with passwords) in the even the 
OS X open directory server died. 

Anyone using this application should consider adding encryption
to the password storage. This was written in 2008 and in a hurry
so it's not the most secure thing in the world, but the add user
script might be handy for anyone trying to create new OS X 
accounts automatically.
