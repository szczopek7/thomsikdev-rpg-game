create table city
(
    id        int auto_increment,
    city_name varchar(255) null,
    constraint city_pk
        primary key (id)
);

alter table users
    alter column city set default 1;

alter table city
    add type_of_city varchar(128) default "village" null;

alter table city
    add status int default 1 null;

alter table city
    add city_image varchar(255) null after type_of_city;

create table if not exists job_worth
(
    id          int auto_increment
        primary key,
    user_id     int                                  null,
    giv_money   int                                  null,
    date_start  datetime                             null,
    date_end    datetime                             null,
    type        tinyint                              null,
    date_create datetime default current_timestamp() null
);




