alter table users
    alter column date_create set default (current_timestamp);

alter table users
    add date_action_points datetime null;

alter table users
    alter column date_action_points set default (current_timestamp());

create table if not exists game_settings
(
    exp_to_levelup              int      null,
    exp_multipler               int      null,
    money_multipler             int      null,
    action_points_per_5_minutes int      null,
    last_update_action_points   datetime null
);

