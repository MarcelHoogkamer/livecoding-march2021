CREATE TABLE `user` (
                             id INT UNSIGNED auto_increment NULL,
                             name varchar(100) NULL,
                             email varchar(100) NULL,
                             age TINYINT UNSIGNED NULL,
                             CONSTRAINT user_pk PRIMARY KEY (id)
)
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8
    COLLATE=utf8_general_ci;
