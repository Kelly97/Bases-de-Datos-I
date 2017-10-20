--Crear nuevo usuario(esquema) con el password "PASSWORD" 
CREATE USER DB_FLIPBOARD
  IDENTIFIED BY "oracle"
  DEFAULT TABLESPACE USERS
  TEMPORARY TABLESPACE TEMP;
--asignar cuota ilimitada al tablespace por defecto  
ALTER USER DB_FLIPBOARD QUOTA UNLIMITED ON USERS;

--Asignar privilegios basicos
GRANT create session TO DB_FLIPBOARD;
GRANT create table TO DB_FLIPBOARD;
GRANT create view TO DB_FLIPBOARD;
GRANT create any trigger TO DB_FLIPBOARD;
GRANT create any procedure TO DB_FLIPBOARD;
GRANT create sequence TO DB_FLIPBOARD;
GRANT create materialized view TO DB_FLIPBOARD;
GRANT select any table TO DB_FLIPBOARD;
GRANT create synonym TO DB_FLIPBOARD;
