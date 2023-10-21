create table expedition
(
    id          int auto_increment
        primary key,
    user_id     int                                  not null,
    giv_money   int                                  null,
    giv_exp     int                                  null,
    giv_hp      int                                  null,
    date_start  datetime                             null,
    date_end    datetime                             null,
    type        tinyint                              null,
    date_create datetime default current_timestamp() null on update current_timestamp(),
    constraint expedition_pk2
        unique (id)
);

create table sessions
(
    id           int auto_increment
        primary key,
    user_id      int                                   null,
    session      varchar(512)                          null,
    date_session timestamp default current_timestamp() null on update current_timestamp(),
    constraint sessions_pk2
        unique (id)
);

create table users
(
    id             int auto_increment
        primary key,
    role           tinyint default 1   null,
    login          varchar(128)        null,
    password       varchar(512)        null,
    character_name varchar(128)        null,
    experience     int     default 0   not null,
    money          int     default 0   not null,
    level          int     default 1   not null,
    city           int                 null,
    action_points  tinyint default 100 not null,
    vitality       int     default 0   null,
    strength       int     default 0   null,
    dexterity      int     default 0   null,
    intelligence   int     default 0   null,
    charisma       int     default 0   null,
    health_current int     default 100 null,
    health_max     int     default 100 null,
    status         int     default 1   null,
    date_create    datetime            null,
    constraint users_pk2
        unique (id)
);