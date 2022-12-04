create table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    uuid       varchar(255)                          not null,
    connection text                                  not null,
    queue      text                                  not null,
    payload    longtext                              not null,
    exception  longtext                              not null,
    failed_at  timestamp default current_timestamp() not null,
    constraint failed_jobs_uuid_unique
        unique (uuid)
)
    collate = utf8mb4_unicode_ci;

create table habits
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table media
(
    id         bigint unsigned auto_increment
        primary key,
    file_name  varchar(255) not null,
    alt        varchar(255) null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table password_resets
(
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create index password_resets_email_index
    on password_resets (email);

create table personal_access_tokens
(
    id             bigint unsigned auto_increment
        primary key,
    tokenable_type varchar(255)    not null,
    tokenable_id   bigint unsigned not null,
    name           varchar(255)    not null,
    token          varchar(64)     not null,
    abilities      text            null,
    last_used_at   timestamp       null,
    expires_at     timestamp       null,
    created_at     timestamp       null,
    updated_at     timestamp       null,
    constraint personal_access_tokens_token_unique
        unique (token)
)
    collate = utf8mb4_unicode_ci;

create index personal_access_tokens_tokenable_type_tokenable_id_index
    on personal_access_tokens (tokenable_type, tokenable_id);

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    username          varchar(255)    not null,
    first_name        varchar(255)    not null,
    middle_name       varchar(255)    null,
    last_name         varchar(255)    null,
    email             varchar(255)    not null,
    email_verified_at timestamp       null,
    password          varchar(255)    not null,
    remember_token    varchar(100)    null,
    created_at        timestamp       null,
    updated_at        timestamp       null,
    media_id          bigint unsigned null,
    constraint users_email_unique
        unique (email),
    constraint users_username_unique
        unique (username),
    constraint users_media_id_foreign
        foreign key (media_id) references media (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create table habit_user
(
    user_id  bigint unsigned not null,
    habit_id bigint unsigned not null,
    constraint habit_user_habit_id_foreign
        foreign key (habit_id) references habits (id)
            on delete cascade,
    constraint habit_user_user_id_foreign
        foreign key (user_id) references users (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create table posts
(
    id         bigint unsigned auto_increment
        primary key,
    caption    varchar(255)    null,
    created_at timestamp       null,
    updated_at timestamp       null,
    user_id    bigint unsigned not null,
    media_id   bigint unsigned not null,
    habit_id   bigint unsigned not null,
    constraint posts_habit_id_foreign
        foreign key (habit_id) references habits (id)
            on delete cascade,
    constraint posts_media_id_foreign
        foreign key (media_id) references media (id)
            on delete cascade,
    constraint posts_user_id_foreign
        foreign key (user_id) references users (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;


