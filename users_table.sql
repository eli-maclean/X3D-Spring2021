--create table statement
--pwdUsers will be hashed via the bcrypt algorithm. So in the database it will be a bunch of random numbers / letters.
CREATE TABLE `users` (
`idUsers` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
`uidUsers` TINYTEXT NOT NULL,
`emailUsers` TINYTEXT NOT NULL,
`pwdUsers` LONGTEXT NOT NULL
);