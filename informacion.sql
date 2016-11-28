INSERT INTO CINE ( comuna )
                       VALUES
                       ( 'Santiago');
INSERT INTO CINE ( comuna )
                       VALUES
                       ( 'La Florida');
INSERT INTO USUARIO ( user, password )
                       VALUES
                       ( 'eparedes', 1234 );
INSERT INTO USUARIO ( user, password )
                       VALUES
                       ( 'jvillar', 1234 );
INSERT INTO USUARIO ( user, password )
                       VALUES
                       ( 'cbaeza', 1234 );
INSERT INTO USUARIO ( user, password )
                       VALUES
                       ( 'jvaldes', 1234 );
INSERT INTO EMPLEADO ( USUARIO_user, nombre, CINE_id_cine )
                       VALUES
                       ( 'eparedes', 'Esteban Paredes', 1 );
INSERT INTO EMPLEADO ( USUARIO_user, nombre, CINE_id_cine )
                       VALUES
                       ( 'jvillar', 'Justo Villar', 1 );
INSERT INTO EMPLEADO ( USUARIO_user, nombre, CINE_id_cine )
                       VALUES
                       ( 'cbaeza', 'Claudio Baeza', 2 );
INSERT INTO EMPLEADO ( USUARIO_user, nombre, CINE_id_cine )
                       VALUES
                       ( 'jvaldes', 'Jaime Valdés', 2 );
INSERT INTO PROYECTADOR ( EMPLEADO_id_empleado )
                       VALUES
                       ( 1 );
INSERT INTO PROYECTADOR ( EMPLEADO_id_empleado )
                       VALUES
                       ( 3 );
INSERT INTO VENDEDOR ( EMPLEADO_id_empleado )
                       VALUES
                       ( 2 );
INSERT INTO VENDEDOR ( EMPLEADO_id_empleado )
                       VALUES
                       ( 4 );
INSERT INTO SALA ( n_sala, CINE_id_cine )
                       VALUES
                       ( 1, 1 );
INSERT INTO SALA ( n_sala, CINE_id_cine )
                       VALUES
                       ( 2, 1 );
INSERT INTO SALA ( n_sala, CINE_id_cine )
                       VALUES
                       ( 3, 1 );
INSERT INTO SALA ( n_sala, CINE_id_cine )
                       VALUES
                       ( 1, 2 );
INSERT INTO SALA ( n_sala, CINE_id_cine )
                       VALUES
                       ( 2, 2 );
INSERT INTO SALA ( n_sala, CINE_id_cine )
                       VALUES
                       ( 3, 2 );
INSERT INTO PELICULA ( titulo, genero, clasificacion )
                       VALUES
                       ( 'Dr. Strange', 'Fantasía', 'PG-13' );
INSERT INTO PELICULA ( titulo, genero, clasificacion )
                       VALUES
                       ( 'Arrival', 'Ciencia Ficción', 'PG-13' );
INSERT INTO ACTOR ( nombre )
                       VALUES
                       ( 'Benedict Cumberbatch' );
INSERT INTO ACTOR ( nombre )
                       VALUES
                       ( 'Rachel McAdams' );
INSERT INTO ACTOR ( nombre )
                       VALUES
                       ( 'Chiwetel Ejiofor' );
INSERT INTO ACTOR ( nombre )
                       VALUES
                       ( 'Mads Mikkelsen' );
INSERT INTO ACTOR ( nombre )
                       VALUES
                       ( 'Amy Adams' );
INSERT INTO ACTOR ( nombre )
                       VALUES
                       ( 'Jeremy Renner' );
INSERT INTO DIRECTOR ( nombre )
                       VALUES
                       ( 'Scott Derrickson' );
INSERT INTO DIRECTOR ( nombre )
                       VALUES
                       ( 'Denis Villeneuve' );
INSERT INTO ACTUA ( PELICULA_id_pelicula, ACTOR_nombre )
                       VALUES
                       ( 1, 'Benedict Cumberbatch' );
INSERT INTO ACTUA ( PELICULA_id_pelicula, ACTOR_nombre )
                       VALUES
                       ( 1, 'Rachel McAdams' );
INSERT INTO ACTUA ( PELICULA_id_pelicula, ACTOR_nombre )
                       VALUES
                       ( 1, 'Chiwetel Ejiofor' );
INSERT INTO ACTUA ( PELICULA_id_pelicula, ACTOR_nombre )
                       VALUES
                       ( 1, 'Mads Mikkelsen' );
INSERT INTO ACTUA ( PELICULA_id_pelicula, ACTOR_nombre )
                       VALUES
                       ( 2, 'Amy Adams' );
INSERT INTO ACTUA ( PELICULA_id_pelicula, ACTOR_nombre )
                       VALUES
                       ( 2, 'Jeremy Renner' );
INSERT INTO DIRIGE ( PELICULA_id_pelicula, DIRECTOR_nombre )
                       VALUES
                       ( 1, 'Scott Derrickson' );
INSERT INTO DIRIGE ( PELICULA_id_pelicula, DIRECTOR_nombre )
                       VALUES
                       ( 2, 'Denis Villeneuve' );
