/* Querys - to change*/

alter table users
    add vitality int default 0 null after action_points;

alter table users
    add strength int default 0 null after vitality;

alter table users
    add dexterity int default 0 null after strength;

alter table users
    add intelligence int default 0 null after dexterity;

alter table users
    add charisma int default 0 null after intelligence;

alter table users
    modify action_points tinyint default 1 not null;

alter table users
    add health_current int default 100 null after charisma;

alter table users
    add health_max int default 100 null after health_current;

alter table users
    alter column action_points set default 100;