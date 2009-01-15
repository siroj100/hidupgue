/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

drop table if exists pengguna;

create table pengguna (
  id int not null auto_increment,
  user_name varchar(50) unique not null,
  password varchar(64) not null,
  salt varchar(64) not null,
  real_name varchar(100) not null,
  primary_kontak_id int,
  created_on timestamp DEFAULT 0,
  updated_on timestamp DEFAULT CURRENT_TIMESTAMP,
  constraint fk_pengguna_0 foreign key (primary_kontak_id) references kontak (id),
  primary key (id)
);

drop table if exists enum_params;

create table enum_params (
  id int not null auto_increment,
  enum_class varchar(30),
  enum_value int,
  enum_value_desc varchar(100),
  created_on timestamp DEFAULT 0,
  updated_on timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);

insert  into enum_params(id,enum_class,enum_value,enum_value_desc,created_on,updated_on) values (1,'TIPE_AKTIVITAS',1,'Future Activity',NULL,NULL),(2,'TIPE_AKTIVITAS',2,'Past Activity',NULL,NULL);

drop table if exists aktivitas;

create table aktivitas (
  id int not null auto_increment,
  name varchar(100),
  description varchar(500),
  eval_periond int,
  status int,
  activity_type int,
  start_target_date datetime,
  end_target_date datetime,
  start_executed_date datetime,
  end_executed_date datetime,
  created_on timestamp DEFAULT 0,
  updated_on timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);

drop table if exists catatan;

create table catatan (
  id int not null auto_increment,
  title varchar(100),
  teks text,
  created_on timestamp DEFAULT 0,
  updated_on timestamp DEFAULT CURRENT_TIMESTAMP,
  primary key (id)
);

drop table if exists kontak_email;
drop table if exists kontak_telepon;
drop table if exists kontak_alamat;
drop table if exists kontak;

create table kontak (
  id int not null auto_increment,
  name varchar(100),
  birth_date date,
  sex char(1),
  company varchar(100),
  pengguna_id int not null,
  created_on timestamp DEFAULT 0,
  updated_on timestamp DEFAULT CURRENT_TIMESTAMP,
  constraint fk_kontak_0 foreign key (pengguna_id) references pengguna (id),
  primary key (id)
);

create table kontak_email (
  id int not null auto_increment,
  email_address varchar(500),
  add_info varchar(100),
  contact_info_type int,
  kontak_id int not null,
  created_on timestamp DEFAULT 0,
  updated_on timestamp DEFAULT CURRENT_TIMESTAMP,
  constraint fk_kontak_email_0 foreign key (kontak_id) references kontak (id),
  primary key (id)
);

create table kontak_telepon (
  id int not null auto_increment,
  phone_number varchar(20),
  add_info varchar(100),
  contact_info_type int,
  kontak_id int not null,
  created_on timestamp DEFAULT 0,
  updated_on timestamp DEFAULT CURRENT_TIMESTAMP,
  constraint fk_kontak_telepon_0 foreign key (kontak_id) references kontak (id),
  primary key (id)
);

create table kontak_alamat (
  id int not null auto_increment,
  address varchar(500),
  add_info varchar(100),
  contact_info_type int,
  kontak_id int not null,
  created_on timestamp DEFAULT 0,
  updated_on timestamp DEFAULT CURRENT_TIMESTAMP,
  constraint fk_kontak_alamat_0 foreign key (kontak_id) references kontak (id),
  primary key (id)
);

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

