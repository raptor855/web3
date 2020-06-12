CREATE TABLE application (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(128) NOT NULL DEFAULT '',
  email varchar(128) NOT NULL DEFAULT '',
  birth year(4) NOT NULL DEFAULT 2000,
  sex char(4) NOT NULL DEFAULT '',
  limbs int(8) NOT NULL DEFAULT 0,
  sverh text(128) NOT NULL DEFAULT '',
  bio text(128) NOT NULL ,
  consent boolean NOT NULL ,
  PRIMARY KEY (id)
);
