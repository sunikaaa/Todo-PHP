create database my_todo_app;

grant all on my_todo_app.* to dbuser@localhost
identified by 'fahdlA1312!';

use my_todo_app

create table todos
(
    id int not null
    auto_increment primary key,
    state TINYINT
    (1) DEFAULT 0,
    title text
)

    insert into todos
        (state,title)
    VALUES(0, 'todo 0'),
        (0, 'todo 1'),
        (1, 'todo 2');