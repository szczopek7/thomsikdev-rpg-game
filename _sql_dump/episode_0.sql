create table sessions
(
    id int auto_increment
        primary key,
    user_id int null,
    session varchar(512) null,
    date_session timestamp default current_timestamp() null on update current_timestamp(),
    constraint sessions_pk2
        unique (id)
);
create table users
(
    id             int auto_increment
        primary key,
    role           tinyint default 1 null,
    login          varchar(128)      null,
    password       varchar(512)      null,
    character_name varchar(128)      null,
    experience     int     default 0 not null,
    money          int     default 0 not null,
    level          int     default 1 not null,
    city           int               null,
    action_points  int     default 1 not null,
    status         int     default 1 null,
    date_create    datetime          null,
    constraint users_pk2
        unique (id)
);