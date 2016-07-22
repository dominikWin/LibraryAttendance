create database students;

create table students.students (id INT, fname VARCHAR(32), lname VARCHAR(32));

create database library;

create table library.visits (id INT AUTO_INCREMENT PRIMARY KEY, student_id INT, timestamp INT UNSIGNED);

create table library.admins (id INT AUTO_INCREMENT PRIMARY KEY, uname VARCHAR(32), passwd CHAR(120));

create table library.admin_sessions(user_id INT AUTO_INCREMENT PRIMARY KEY, hash CHAR(40), timestamp INT UNSIGNED, expire INT);

insert into `library`.`admins`(`id`, `uname`, `passwd`) values ('1','root','$2a$08$75usl/NNzioG9BxUdxiMwOkhESjx0iPhkZpfBzQww8wyRMPibpf0m');
