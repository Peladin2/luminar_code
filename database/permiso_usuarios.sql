CREATE USER IF NOT EXISTS 'luminar_usuario'@'localhost'
    IDENTIFIED BY 'luminar_usuario12345';

GRANT SELECT, INSERT, UPDATE, DELETE
    ON centro_educativo_db.*
    TO 'luminar_usuario'@'localhost';


CREATE USER IF NOT EXISTS 'luminar_admin'@'localhost'
    IDENTIFIED BY 'luminar_admin54321';

GRANT ALL PRIVILEGES
    ON centro_educativo_db.*
    TO 'luminar_admin'@'localhost';

FLUSH PRIVILEGES;
