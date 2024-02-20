create table report_action
(
id          int auto_increment,
user_id     int                                null,
report_text varchar(512)                       null,
date_create datetime default current_timestamp null,
date_modify datetime                           null on update current_timestamp(),
status      int(3)                             null,
constraint report_action_pk
primary key (id)
);

