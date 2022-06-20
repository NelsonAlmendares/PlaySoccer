/*	CREATE DATABASE "PlaySoccer"
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    CONNECTION LIMIT = -1; */

CREATE TABLE PUBlIC."tb_reserva"(
	id_reserva SERIAL NOT NULL,
	fecha_reserva DATE NOT NULL,
	balones_alquilados INTEGER NOT NULL,
	observaciones CHARACTER VARYING(200) NOT NULL,
	chalecos_alquilados INTEGER NOT NULL,
	id_empleado INTEGER NOT NULL,
	id_cancha INTEGER NOT NULL,
	id_horario INTEGER NOT NULL,
	id_cliente INTEGER NOT NULL,
	id_asistencia INTEGER NOT NULL,
	id_tipoBalon INTEGER NOT NULL,
	id_chalecos INTEGER NOT NULL,
	PRIMARY KEY("id_reserva")
);
ALTER TABLE IF EXISTS PUBLIC."tb_reserva"
	OWNER TO postgres;

CREATE TABLE PUBlIC."tb_empleado"(
	id_empleado SERIAL NOT NULL,
	nombre_empleado CHARACTER VARYING(40) NOT NULL,
	apellido_empleado CHARACTER VARYING(40) NOT NULL,
	DUI_empleado CHARACTER VARYING(40) NOT NULL,
	celular_empleado INTEGER NOT NULL,
	correo_empleado CHARACTER VARYING(100) NOT	NULL,
	contrasena_empleado CHARACTER VARYING(10) NOT NULL,
	foto_empleado CHARACTER VARYING(100) NOT NULL,
	id_tipoEmpleado INTEGER NOT NULL,
	PRIMARY KEY("id_empleado")
);
ALTER TABLE IF EXISTS PUBLIC."tb_empleado"
	OWNER to postgres;

--Tabla para el tipo de empleados que se necesiten dentro de la lógica del sistema
CREATE TABLE PUBLIC."tb_tipoEmpleado"(
	id_tipoEmpleado SERIAL NOT NULL,
	tipoEmpleado CHARACTER VARYING(50) NOT NULL,
	PRIMARY KEY (id_tipoEmpleado)
);
ALTER TABLE IF EXISTS PUBLIC."tb_tipoEmpleado"
	OWNER to postgres;

CREATE TABLE PUBLIC."tb_cliente"(
	id_cliente SERIAL NOT NULL,
	nombre_cliente CHARACTER VARYING(40) NOT NULL,
	apelllido_cliente CHARACTER VARYING(40) NOT NULL,
	DUI_cliente CHARACTER VARYING(10) DEFAULT 'Registro menor de edad' NULL,
	celular_cliente CHARACTER VARYING(10) NOT NULL,
	correo_cliente CHARACTER VARYING(100) NOT NULL,
	contrasena_cliente CHARACTER VARYING(10) NOT NULL,
	foto_cliente CHARACTER VARYING(100) NOT NULL,
	PRIMARY KEY("id_cliente")
);
ALTER TABLE IF EXISTS PUBLIC."tb_cliente"
	OWNER to postgres;

CREATE TABLE PUBLIC."tb_cancha"(
	id_cancha SERIAL NOT NULL,
	numero_cancha INTEGER NOT NULL,
	tamano_cancha CHARACTER VARYING(100) NOT NULL,
	material_cancha CHARACTER VARYING(100) NOT NULL,
	costo_cancha FLOAT,
	PRIMARY KEY("id_cancha")
);
ALTER TABLE IF EXISTS PUBLIC."tb_cancha"
	OWNER to postgres;


CREATE TABLE PUBLIC."tb_horario"(
	id_horario SERIAL NOT NULL,
	hora_inicio TIME NOT NULL,
	hora_fin TIME NOT NULL,
	id_tipoHorario INTEGER NOT NULL,
	PRIMARY KEY("id_horario")
);
ALTER TABLE IF EXISTS PUBLIC."tb_horario"
	OWNER to postgres;

--Tabla para especificar el tipo de horario con el que se haga una reserva de una chancha
CREATE TABLE PUBLIC."tb_tipoHorario"(
	id_tipoHorario SERIAL NOT NULL,
	horario_reservacion CHARACTER VARYING(100) NOT NULL,
	PRIMARY KEY(id_tipoHorario)
);
ALTER TABLE IF EXISTS PUBLIC."tb_tipoHorario"
	OWNER to postgres;


CREATE TABLE PUBLIC."tb_tipoBalon"(
	id_tipoBalon SERIAL NOT NULL,
	costo_balon FLOAT,
	cantidadad_balones INTEGER NOT NULL,
	id_tamanoBalon INTEGER NOT NULL,
	PRIMARY KEY(id_tipoBalon)
);
ALTER TABLE IF EXISTS PUBLIC."tb_tipoBalon"
	OWNER to postgres;
	
--Tabla para definir el tamanño de los balones que se han registrado antes
CREATE TABLE PUBlIC."tb_tamanoBalon"(
	id_tamanoBalon SERIAL NOT NULL,
	tamano_balon CHARACTER VARYING(60) NOT NULL,
	PRIMARY KEY(id_tamanoBalon)
);
ALTER TABLE IF EXISTS PUBLIC."tb_tamanoBalon"
	OWNER to postgres;

CREATE TABLE PUBLIC."tb_chaleco"(
	id_chaleco SERIAL NOT NULL,
	costo_cheleco FLOAT,
	cantidad_chlecos INTEGER NOT NULL,
	id_colorChaleco INTEGER NOT NULL,
	talla_chaleco INTEGER NOT NULL,
	PRIMARY KEY(id_chaleco)
);
ALTER TABLE IF EXISTS PUBLIC."tb_chaleco"
 	OWNER to postgres;
--Tabla para definir los colores disponibles para los chalecos
CREATE TABLE PUBLIC."tb_colorChaleco"(
	id_color SERIAL NOT NULL,
	colorChaleco CHARACTER VARYING(50) NOT NULL,
	PRIMARY KEY(id_color)
);
ALTER TABLE IF EXISTS PUBLIC."tb_colorChaleco"
	OWNER to postgres;
	
--Tabla para definir las tallas disponibles para los chalecos
CREATE TABLE PUBLIC."tb_tallaChaleco"(
	id_talla SERIAL NOT NULL,
	tallaChaleco CHARACTER VARYING(50) NOT NULL,
	PRIMARY KEY(id_talla)
);
ALTER TABLE IF EXISTS PUBLIC."tb_tallaChaleco"
	OWNER to postgres;


CREATE TABLE PUBLIC."tb_asistencia"(
	id_asistencia SERIAL NOT NULL,
	descripcion_asistencia CHARACTER VARYING(100) NOT NULL,
	PRIMARY KEY(id_asistencia)
);
ALTER TABLE IF EXISTS PUBLIC."tb_asistencia"
	 OWNER to postgres;

-- --------------- Llaves foraneas para las uniones de las tablas padres-hijas ---------------------- --

--Unión de tabla Reserva con table Empleado
ALTER TABLE PUBLIC.tb_reserva
	ADD CONSTRAINT "FK_empleado" FOREIGN KEY ("id_empleado")
	REFERENCES PUBLIC.tb_empleado (id_empleado) MATCH SIMPLE
	ON UPDATE NO ACTION
	ON DELETE NO ACTION
	NOT VALID

--Unión de tabla Empleado con tabla TipoEmpleado
ALTER TABLE IF EXISTS public.tb_empleado
    ADD CONSTRAINT "FK_tipoEmpleado" FOREIGN KEY (id_tipoempleado)
    REFERENCES public."tb_tipoEmpleado" (id_tipoempleado) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

--Unión de la tabla reservas con la tabla Canchas
ALTER TABLE IF EXISTS public.tb_reserva
    ADD CONSTRAINT "FK_cancha" FOREIGN KEY (id_cancha)
    REFERENCES public.tb_cancha (id_cancha) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

--Unión de la tabla de reservas con la tabla de asistencia
ALTER TABLE IF EXISTS public.tb_reserva
    ADD CONSTRAINT "FK_asistencia" FOREIGN KEY (id_asistencia)
    REFERENCES public.tb_asistencia (id_asistencia) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

--Unión de la tabla de reservas con la tabla de Clientes
ALTER TABLE PUBLIC.tb_reserva
	ADD CONSTRAINT "FK_cliente" FOREIGN KEY (id_cliente)
	REFERENCES PUBLIC.tb_cliente (id_cliente) MATCH SIMPLE
	ON UPDATE NO ACTION 
	ON DELETE NO ACTION
	NOT VALID;

--Unión de la tabla de reservas con la tabla de Horario
ALTER TABLE PUBLIC.tb_reserva
	ADD CONSTRAINT "FK_horario" FOREIGN KEY (id_horario)
	REFERENCES PUBLIC.tb_horario (id_horario) MATCH SIMPLE
	ON UPDATE NO ACTION
	ON DELETE NO ACTION
	NOT VALID;

--Unión de la tabla de Horario con la tabla de TipoHorario
ALTER TABLE IF EXISTS public.tb_horario
    ADD CONSTRAINT "FK_tipoHorario" FOREIGN KEY (id_tipohorario)
    REFERENCES public."tb_tipoHorario" (id_tipohorario) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

--Unión de la tabla de tipoBalon a la tabla de reservas
ALTER TABLE IF EXISTS public.tb_reserva
    ADD CONSTRAINT "FK_tipoBalon" FOREIGN KEY (id_tipobalon)
    REFERENCES public."tb_tipoBalon" (id_tipobalon) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

--Unión de la tabla de tipoBalon con la tabla de TamañoBalon
ALTER TABLE IF EXISTS public."tb_tipoBalon"
    ADD CONSTRAINT "FK_tamanoBalon" FOREIGN KEY (id_tamanobalon)
    REFERENCES public."tb_tamanoBalon" (id_tamanobalon) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

--Unión de la tabla de reservas con la tabla de chalecos
ALTER TABLE IF EXISTS public.tb_reserva
    ADD CONSTRAINT "FK_chalecos" FOREIGN KEY (id_chalecos)
    REFERENCES public.tb_chaleco (id_chaleco) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

--Unión de la tabla de chalecos con la tabla de colorChalecos
ALTER TABLE IF EXISTS public.tb_chaleco
    ADD CONSTRAINT "FK_color" FOREIGN KEY (id_colorchaleco)
    REFERENCES public."tb_colorChaleco" (id_color) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

--Unión de la tabla de chalecon con la tabla de TallaChaleco
ALTER TABLE IF EXISTS public.tb_chaleco
    ADD CONSTRAINT "FK_talla" FOREIGN KEY (talla_chaleco)
    REFERENCES public."tb_tallaChaleco" (id_talla) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;