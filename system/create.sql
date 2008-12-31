drop table if exists enum_params;

create table enum_params (
  id int not null auto_increment,
  enum_class varchar(30),
  enum_value int,
  enum_value_desc varchar(100),
  created_on timestamp DEFAULT CURRENT_TIMESTAMP,
  updated_on timestamp DEFAULT 0,
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
  created_on datetime,
  updated_on datetime,
  primary key (id)
);

drop table if exists catatan;

create table catatan (
  id int not null auto_increment,
  title varchar(100),
  teks text,
  created_on timestamp,
  updated_on timestamp,
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
  created_on timestamp,
  updated_on timestamp,
  primary key (id)
);

create table kontak_email (
  id int not null auto_increment,
  email_address varchar(500),
  add_info varchar(100),
  contact_info_type int,
  kontak_id int,
  created_on timestamp,
  updated_on timestamp,
  constraint fk_kontak_email_0 foreign key (kontak_id) references kontak (id),
  primary key (id)
);

create table kontak_telepon (
  id int not null auto_increment,
  phone_number varchar(20),
  add_info varchar(100),
  contact_info_type int,
  kontak_id int,
  created_on timestamp,
  updated_on timestamp,
  constraint fk_kontak_telepon_0 foreign key (kontak_id) references kontak (id),
  primary key (id)
);

create table kontak_alamat (
  id int not null auto_increment,
  address varchar(500),
  add_info varchar(100),
  contact_info_type int,
  kontak_id int,
  created_on timestamp,
  updated_on timestamp,
  constraint fk_kontak_alamat_0 foreign key (kontak_id) references kontak (id),
  primary key (id)
);

