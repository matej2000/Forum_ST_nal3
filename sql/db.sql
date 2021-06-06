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



ALTER TABLE Post ADD FULLTEXT(Title, Content);

alter table Post add constraint FK_category foreign key (IdC)
      references Category (IdC) on delete restrict on update restrict;

alter table Post add constraint FK_comment foreign key (Pos_IdPost)
      references Post (IdPost) on delete restrict on update restrict;

alter table Post add constraint FK_post foreign key (Id)
      references User (Id) on delete restrict on update restrict;

insert into User (UserName, Email, Password,Birthday) VALUES ("admin", "admin@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O", CURRENT_TIMESTAMP);
insert into User (UserName, Email, Password,Birthday)  VALUES ("admin2", "admin2@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O", CURRENT_TIMESTAMP);

insert into User (UserName, Email, Password,Birthday) VALUES ("user1", "user1@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O", CURRENT_TIMESTAMP);
insert into User (UserName, Email, Password,Birthday) VALUES ("user2", "user2@gmail.com", "$2y$10$Em7XqNJ1zIq/eKMLo6WdWO7ipPuu05YTd/zUNhHjHj/ucAep3uO9O", CURRENT_TIMESTAMP);
insert into Category (TitleC, DescriptionC) VALUES ("Test", "Test pb");
insert into Category (TitleC, DescriptionC) VALUES ("General", "Genaral");
insert into Category (TitleC, DescriptionC) VALUES ("PHP", "Ask questions about php.");
insert into Category (TitleC, DescriptionC) VALUES ("Javascript", "Ask questions about Javascript.");
insert into Category (TitleC, DescriptionC) VALUES ("Lorem ipsum", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id dui porttitor, placerat risus iaculis, finibus nisl. Donec posuere pharetra magna. Sed ut ex volutpat.");

insert into Post (IdC, Id, Title, Content, Date, Likes) values (1,1,"Prva objava", "Forum dela! Podajte vprešanja.", CURRENT_TIMESTAMP, 0);
insert into Post (IdC, Pos_IdPost, Id, Title, Content, Date, Likes) values (1,1,2,"Prvi komentar", "Dodan, komentar", CURRENT_TIMESTAMP, 0);

insert into Post (IdC, Id, Title, Content, Date, Likes) values (5,2,"Lorem ipsum2", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed maximus dolor. Nullam id magna ut odio mattis congue id ac justo. Donec sit amet enim nec mauris commodo tincidunt. Cras erat risus, condimentum nec pretium quis, auctor vitae nisi. Nulla est dui, hendrerit ac tortor ut, finibus malesuada nisl. Etiam quis orci at ante sagittis lacinia vel dictum nunc. Phasellus nec sodales neque. Suspendisse quis scelerisque quam, vel tempor est. Duis justo lorem, iaculis eget massa id, dignissim fringilla elit. Nullam laoreet velit cursus consectetur porta. Nullam nec odio sed ex imperdiet semper sit amet vitae risus. Curabitur posuere viverra ultricies..", CURRENT_TIMESTAMP, 0);
insert into Post (IdC, Pos_IdPost, Id, Title, Content, Date, Likes) values (5,3,3,"Prvi komentar", "Dodan, komentar", CURRENT_TIMESTAMP, 0);
insert into Post (IdC, Pos_IdPost, Id, Title, Content, Date, Likes) values (5,3,4,"Drugi komentar", "Nullam id magna ut odio mattis congue id ac justo. Donec sit amet enim nec mauris commodo tincidunt.", CURRENT_TIMESTAMP, 0);

insert into Post (IdC, Id, Title, Content, Date, Likes) values (5,2,"Lorem ipsum", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed maximus dolor. Nullam id magna ut odio mattis congue id ac justo. Donec sit amet enim nec mauris commodo tincidunt. Cras erat risus, condimentum nec pretium quis, auctor vitae nisi. Nulla est dui, hendrerit ac tortor ut, finibus malesuada nisl. Etiam quis orci at ante sagittis lacinia vel dictum nunc. Phasellus nec sodales neque. Suspendisse quis scelerisque quam, vel tempor est. Duis justo lorem, iaculis eget massa id, dignissim fringilla elit. Nullam laoreet velit cursus consectetur porta. Nullam nec odio sed ex imperdiet semper sit amet vitae risus. Curabitur posuere viverra ultricies..", CURRENT_TIMESTAMP, 0);
insert into Post (IdC, Pos_IdPost, Id, Title, Content, Date, Likes) values (5,6,3,"Prvi komentar", "Dodan, komentar", CURRENT_TIMESTAMP, 0);
insert into Post (IdC, Pos_IdPost, Id, Title, Content, Date, Likes) values (5,6,4,"Drugi komentar", "Nullam id magna ut odio mattis congue id ac justo. Donec sit amet enim nec mauris commodo tincidunt.", CURRENT_TIMESTAMP, 0);