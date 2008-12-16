drop table if exists enum_params;

create table enum_params (
  id int not null auto_increment,
  enum_class varchar(30),
  enum_value int,
  enum_value_desc varchar(100),
  created_on datetime,
  updated_on datetime,
  primary key (id)
);

drop table if exists aktivitas;

create table aktivitas (
  id int not null auto_increment,
  name varchar(100),
  description varchar(500),
  eval_periond int,
  status int,
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
  created_on datetime,
  updated_on datetime,
  primary key (id)
);

