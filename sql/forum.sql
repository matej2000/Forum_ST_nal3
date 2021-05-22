/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     20. 05. 2021 11:17:53                        */
/*==============================================================*/

drop database if exists forum;
create database forum;
use forum;

drop table if exists Category;

drop table if exists Post;

drop table if exists User;

/*==============================================================*/
/* Table: Category                                              */
/*==============================================================*/
create table Category
(
   IdC int(11) not null AUTO_INCREMENT,
   TitleC varchar(255) not null,
   DescriptionC varchar(255) not null,
   primary key (IdC)
);

/*==============================================================*/
/* Table: Post                                                  */
/*==============================================================*/
create table Post
(
   IdPost int(11) not null AUTO_INCREMENT,
   IdC int(11) not null,
   Pos_IdPost int(11),
   Id int(11) not null,
   Title varchar(255) not null,
   Content text not null,
   Date timestamp not null,
   Likes int(11) not null,
   primary key (IdPost)
);

/*==============================================================*/
/* Table: User                                                  */
/*==============================================================*/
create table User
(
   Id int(11) not null AUTO_INCREMENT,
   UserName varchar(255) not null,
   Email varchar(255) not null,
   Password varchar(255) not null,
   Birthday TIMESTAMP not null,
   primary key (Id)
);

ALTER TABLE post ADD FULLTEXT(Title, Content);

alter table Post add constraint FK_category foreign key (IdC)
      references Category (IdC) on delete restrict on update restrict;

alter table Post add constraint FK_comment foreign key (Pos_IdPost)
      references Post (IdPost) on delete restrict on update restrict;

alter table Post add constraint FK_post foreign key (Id)
      references User (Id) on delete restrict on update restrict;


insert into User (UserName, Email, Password) VALUES ("admin", "admin@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O");
insert into User (UserName, Email, Password) VALUES ("admin2", "admin2@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O");
insert into Category (TitleC, DescriptionC) VALUES ("Test", "Test dp");
insert into Category (TitleC, DescriptionC) VALUES ("General", "Genaral");
insert into Category (TitleC, DescriptionC) VALUES ("PHP", "Ask questions about php.");

insert into Post (IdC, Id, Title, Content, Date, Likes) values (1,1,"Prva objava", "Forum dela! Podajte vprešanja.", CURRENT_TIMESTAMP, 0);
insert into Post (IdC, Pos_IdPost, Id, Title, Content, Date, Likes) values (1,1,2,"Prva objava", "Forum dela! Podajte vprešanja.", CURRENT_TIMESTAMP, 0);