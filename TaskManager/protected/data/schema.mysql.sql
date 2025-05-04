CREATE TABLE tbl_user (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL
);

INSERT INTO tbl_user (username, password, email) VALUES ('admin', 'admin', 'admin@prova.com');
INSERT INTO tbl_user (username, password, email) VALUES ('user', 'user', 'user@prova.com');
