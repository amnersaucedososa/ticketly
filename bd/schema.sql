/*
* Supportix Database
* @author Evilnapsis
*/
create database supportix;
use supportix; 
set sql_mode='';
create table user (
	id int not null auto_increment primary key,
	username varchar(50),
	name varchar(50),
	-- lastname varchar(50),
	email varchar(255),
	password varchar(60),
	profile_pic varchar(250),
	is_active boolean not null default 1,
	kind int not null default 1,
	created_at datetime
);

insert into user (username,password,kind,is_active,created_at) value ("admin",sha1(md5("admin")),1,1,NOW());

create table project (
	id int not null auto_increment primary key,
	name varchar(200),
	description text
	);


create table category (
	id int not null auto_increment primary key,
	name varchar(200)
	);

create table kind (
	id int not null auto_increment primary key,
	name varchar(100)
);

insert into kind (id,name) values (1,"Ticket"), (2,"Bug"),(3,"Sugerencia"),(4,"Caracteristica");


create table status (
	id int not null auto_increment primary key,
	name varchar(100)
);

insert into status (id,name) values (1,"Pendiente"), (2,"En Desarrollo"),(3,"Terminado"),(4,"Cancelado");

create table priority (
	id int not null auto_increment primary key,
	name varchar(100)
);

insert into priority (id,name) values  (1,"Alta"),(2,"Media"),(3,"Baja");

create table ticket(
	id int not null auto_increment primary key,
	title varchar(100),
	description text,
	updated_at datetime,
	created_at datetime,
	kind_id int not null,
	user_id int not null,
	asigned_id int,
	project_id int,
	category_id int,
	priority_id int not null default 1,
	foreign key (priority_id) references priority(id),
	status_id int not null default 1,
	foreign key (status_id) references status(id),
	foreign key (user_id) references user(id),
	foreign key (kind_id) references kind(id),
	foreign key (category_id) references category(id),
	foreign key (project_id) references project(id)
);
