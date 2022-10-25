create table charts_files
(
    id int auto_increment
        primary key,
    filename varchar(255) null,
    sheets longtext collate utf8mb4_bin null,
    constraint sheets
        check (json_valid(`sheets`))
);

create table charts_images
(
    id int auto_increment
        primary key,
    file_id int null,
    sheet_name varchar(255) null,
    image mediumblob null,
    sheet_id int null,
    image_name varchar(255) null
);

create table charts_sheets
(
    id int auto_increment
        primary key,
    file_id int null,
    sheet longtext collate utf8mb4_bin null,
    sheet_name varchar(255) null,
    table_name varchar(255) null,
    sheet_index int null
);

create table charts_charts
(
    id int auto_increment
        primary key,
    charts longtext collate utf8mb4_bin null,
    file_id int null,
    sheet_id int null,
    sheet_name varchar(255) null,
    table_name varchar(255) null,
    sheet_index int null,
    constraint charts
        check (json_valid(`charts`))
);

