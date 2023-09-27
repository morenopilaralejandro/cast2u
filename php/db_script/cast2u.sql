/* delete tables */
drop table if exists usrcon;
drop table if exists console;
drop table if exists browser;
drop table if exists manufacturer;
drop table if exists country;
drop table if exists vidcat;
drop table if exists category;
drop table if exists video;
drop table if exists token;
drop table if exists usr;

/* create tables */
create table usr (
	id_usr int not null auto_increment,
	usr_name varchar(32) not null unique,
	pwd varchar(32),
	email varchar(120) unique,
	constraint pk_usr primary key (id_usr)
);
create table token (
	id_token int not null auto_increment,
	string_token varchar(255) unique,
    creation_date date,
	id_usr int,
	constraint pk_token primary key (id_token),
	constraint fk_token_usr foreign key (id_usr) 
        references usr(id_usr) on delete cascade
);
create table video(
	id_vid int not null auto_increment, 
	url varchar(2000), 
	img varchar(2000), 
	title varchar(32), 
	upload_date date,
    counter_enabled bool,
    counter_value int(4),
    order_value int,     
	id_usr int,
	constraint pk_vid primary key (id_vid),
	constraint fk_vid_usr foreign key (id_usr) 
        references usr(id_usr) on delete cascade
);
create table category(
	id_cat int not null auto_increment, 
	en_cat varchar(16), 
	es_cat varchar(16),
	constraint pk_cat primary key (id_cat)
);
create table vidcat(
	id_vid int not null, 
	id_cat int not null,
	constraint pk_cat primary key (id_vid, id_cat),
	constraint fk_vc_vid foreign key (id_vid) 
        references video(id_vid) on delete cascade,
	constraint fk_vc_cat foreign key (id_cat) 
        references category(id_cat) on delete cascade
);
create table country(
	id_country int not null auto_increment, 
	name varchar(10),
	constraint pk_country primary key (id_country)
);
create table manufacturer(
	id_manu int not null auto_increment,  
	name varchar(10), 
	president varchar(32), 
	id_country int,
	constraint pk_fab primary key (id_manu),
	constraint fk_fab_country foreign key (id_country) 
        references country(id_country) on delete cascade
);
create table browser(
	id_nav int not null auto_increment, 
	name varchar(32),
    userAgent varchar(32),
	constraint pk_nav primary key (id_nav)
);
create table console(
	id_con int not null auto_increment, 
	name varchar(32), 
	release_date date, 
	id_manu int, 
	id_nav int,
	constraint pk_con primary key (id_con),
	constraint fk_c_fab foreign key (id_manu) 
        references manufacturer(id_manu) on delete cascade,
	constraint fk_c_nav foreign key (id_nav) 
        references browser(id_nav) on delete cascade
);
create table usrcon(
	id_usr int not null, 
	id_con int not null,
	constraint pk_usrcon primary key (id_usr, id_con),
	constraint fk_uc_usr foreign key (id_usr) 
        references usr(id_usr) on delete cascade,
	constraint fk_uc_con foreign key (id_con) 
        references console(id_con) on delete cascade
);

/* delete records */
delete from usrcon;
delete from console;
delete from browser;
delete from manufacturer;
delete from country;
delete from vidcat;
delete from category;
delete from video;
delete from token;
delete from usr;

/* insert records */
/* usr pass -> admin1*/
insert into usr values (1, 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'aaaaaa@gmail.com');
insert into usr values (2, 'user2', 'clave2', 'eeeeeeeee@hotmail.com');

/* token */
insert into token values (1, '742c3acea37da48fd6d0f07958ba68e8', now(), 1);
insert into token values (2, '642c3acea37da48fd6d0f07958ba68e9', now(), 1);

/* video */
insert into video values (
    1, 
    'https://www.youtube.com/embed/CrO7vBqZaFQ?list=PL4rzcHfrDGhn1lnyTrBQa_LaolhBaGiZB', 
    'https://m.media-amazon.com/images/M/MV5BMDVlZDhmNDktNTVkYy00MTdmLTk0ZjAtYmRkMTgwYzViZDBkXkEyXkFqcGdeQXVyMjU0ODQ5NTA@._V1_FMjpg_UX746_.jpg', 
    'Kamen Rider Ryuki', '2021-12-20', false, 0, 0, 1);

insert into video values (
    2, 
    'http://185.53.89.183/hls/ssla.m3u8', 
    'https://i.pinimg.com/736x/09/15/03/0915032a2e8ff63bc374c84646fa9888.jpg',
    'La Liga', SYSDATE(), false, 0, 1, 1);

insert into video values (
    3, 
    'http://192.168.1.18:1234/storage/emulated/0/Download/revice.mp4', 
    'https://m.media-amazon.com/images/M/MV5BMmQwZWU1YjgtYzUzNi00YzE0LThmMTEtMmJmMzE4MDg3NzQxXkEyXkFqcGdeQXVyMTEzMTI1Mjk3._V1_.jpg',
    'Kamen Rider Revice', SYSDATE(), false, 0, 2, 1);

insert into video values (
    4, 
    'http://vid.com?v=7777', 
    'https://m.media-amazon.com/images/M/MV5BMmQwZWU1YjgtYzUzNi00YzE0LThmMTEtMmJmMzE4MDg3NzQxXkEyXkFqcGdeQXVyMTEzMTI1Mjk3._V1_.jpg',
    'Video4', SYSDATE(), false, 0, 0, 2);

/* category */
insert into category values (1, 'tokusatsu', 'tokusatsu');
insert into category values (2, 'action', 'accion');
insert into category values (3, 'comedy', 'comedia');
/* vidcat */
insert into vidcat values (1, 1);
insert into vidcat values (3, 3);
insert into vidcat values (3, 1);
/* country */
insert into country values (1, 'Japan');
insert into country values (2, 'USA');
/* manufacturer */
insert into manufacturer values (1, 'Microsoft',  'Phil Spencer', 2);
insert into manufacturer values (2, 'Sony',  'Jim Ryan', 1);
insert into manufacturer values (3, 'Sega',  'Haruki Satomi', 1);
insert into manufacturer values (4, 'Nintendo',  'Shuntaro Furukawa', 1);
/* browser */
insert into browser values (1, 'Firefox', 'Mozilla/5.0');
insert into browser values (2, 'Opera', 'Mozilla/5.0');
insert into browser values (3, 'Chome', 'Mozilla/5.0');
insert into browser values (5, 'Internet Explorer', 'Mozilla/4.0');
insert into browser values (6, 'Safari', 'iPhone');
insert into browser values (7, 'Wii U', 'Nintendo Wii');
insert into browser values (8, 'Unspecified', '');
/* console */
insert into console values (1, 'PS4', '2014-02-22', 2, 1);
insert into console values (2, 'PS3', '2006-11-11', 2, 1);
insert into console values (3, 'PS Vita', '2011-12-17', 2, 1);
insert into console values (4, 'Xbox One', '2013-11-22', 1, 1);
insert into console values (5, 'Xbox Series', '2020-11-10', 1, 1);
insert into console values (6, 'Wii U', '2012-12-08', 4, 2);
insert into console values (7, 'Nintendo 3DS', '2011-02-26', 4, 1);
insert into console values (8, 'Dreamcast', '1998-11-27', 3, 6);
/* usrcon */
insert into usrcon values (1,6);
insert into usrcon values (1,7);
insert into usrcon values (1,3);
insert into usrcon values (2,1);
insert into usrcon values (2,2);
