CREATE TABLE public."tb_reservaCancha"
(
	"id_reserva" SERIAL,
    fecha_reserva DATE NOT NULL,
    balones_alquilados INTEGER NOT NULL,
    descripcion_asistencia CHARACTER VARYING (200) NOT NULL,
    id_empleado INTEGER NOT NULL,
    id_cancha INTEGER NOT NULL,
    id_cliente INTEGER NOT NULL,
    id_horario INTEGER NOT NULL,
    id_asistencia INTEGER NOT NULL,
    id_tipoBalon INTEGER NOT NULL,
    PRIMARY KEY ("id_reserva")
);
ALTER TABLE IF EXISTS public."tb_reservaCancha"
    OWNER to postgres;

CREATE TABLE public."tb_cliente" 
(
    "id_cliente" SERIAL,
    nombre_cliente CHARACTER VARYING (50) NOT NULL,
    apellido_cliente CHARACTER VARYING (50) NOT NULL,
    DUI_ciente CHARACTER  VARYING (10) NOT NULL,
    celular_cliente INTEGER NOT NULL,
    correo_cliente CHARACTER VARYING (100) NOT NULL,
    contrasena_cliente CHARACTER VARYING (10) NOT NULL,
    foto_cliente CHARACTER VARYING (50) NOT NULL,
    PRIMARY KEY ("id_cliente")
);
ALTER TABLE IF EXISTS public."tb_cliente"
    OWNER to postgres;

CREATE TABLE public."tb_horario"
(
    "id_horario" SERIAL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    "id_tipoHorario" INTEGER NOT NULL,
    PRIMARY KEY ("id_horario")
);
ALTER TABLE IF EXISTS public."tb_horario"
    OWNER to postgres;

CREATE TABLE public."tb_tipoHorario"
(
    "id_tipoHorario" SERIAL,
    tipoHorario CHARACTER VARYING (20) NOT NULL,
    PRIMARY KEY ("id_tipoHorario")
);
ALTER TABLE IF EXISTS public."tb_tipoHorario"
    OWNER to postgres;

CREATE TABLE public."tb_tipoBalon"(
    "id_tipoBalon" SERIAL,
    tipo_balon CHARACTER VARYING (30) NOT NULL,
    costo_balon DOUBLE PRECISION NOT NULL,
    cantidad_balones INTEGER,
    PRIMARY KEY ("id_tipoBalon")
);
ALTER TABLE IF EXISTS public."tb_tipoBalon"
    OWNER to postgres;

CREATE TABLE public."tb_empleado"
(
    "id_empleado" SERIAL,
    nombre_empleado CHARACTER VARYING (50) NOT NULL,
    apellido_empleado CHARACTER VARYING (50) NOT NULL,
    DUI_empleado CHARACTER VARYING (10) NOT NULL,
    celular_empleado INTEGER,
    contra_empleado CHARACTER VARYING (10) NOT NULL,
    foto_empleado CHARACTER VARYING (50) NOT NULL,
    id_tipoEmpleado INTEGER NOT NULL,
    PRIMARY KEY("id_empleado")
);
ALTER TABLE IF EXISTS public."tb_empleado"
    OWNER to postgres;

CREATE TABLE public."tb_tipoEmpleado"
(
    "id_tipoEmpleado" SERIAL,
	tipoEmpleado CHARACTER VARYING (25) NOT NULL,
    PRIMARY KEY ("id_tipoEmpleado")
);

ALTER TABLE IF EXISTS public."tb_tipoEmpleado"
    OWNER to postgres;

CREATE TABLE public."tb_cancha"
(
    "id_cancha" SERIAL,
    numero_cancha INTEGER NOT NULL,
    tamano_cancha CHARACTER VARYING (50) NOT NULL,
    clasificacion_cancha CHARACTER VARYING (50) NOT NULL,
    PRIMARY KEY("id_cancha")
);
ALTER TABLE IF EXISTS public."tb_cancha"
    OWNER to postgres;

CREATE TABLE public."tb_asistencia"
(
    "id_asistencia" SERIAL,
    confirmacion_asistencia CHARACTER VARYING (50) NOT NULL,
    PRIMARY KEY ("id_asistencia")
);
ALTER TABLE IF EXISTS public."tb_asistencia"
    OWNER to postgres;



ALTER TABLE IF EXISTS public."tb_reservaCancha"
    ADD CONSTRAINT "FK_empleado" FOREIGN KEY (id_empleado)
    REFERENCES public.tb_empleado (id_empleado) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

ALTER TABLE IF EXISTS public."tb_reservaCancha"
    ADD CONSTRAINT "FK_cancha" FOREIGN KEY (id_cancha)
    REFERENCES public.tb_cancha (id_cancha) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

ALTER TABLE IF EXISTS public."tb_reservaCancha"
    ADD CONSTRAINT "FK_cliente" FOREIGN KEY (id_cliente)
    REFERENCES public.tb_cliente (id_cliente) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

ALTER TABLE IF EXISTS public."tb_reservaCancha"
    ADD CONSTRAINT "FK_horario" FOREIGN KEY (id_horario)
    REFERENCES public.tb_horario (id_horario) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

ALTER TABLE IF EXISTS public."tb_reservaCancha"
    ADD CONSTRAINT "FK_asistencia" FOREIGN KEY(id_asistencia)
    REFERENCES public.tb_asistencia (id_asistencia) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

ALTER TABLE IF EXISTS public."tb_reservaCancha"
    ADD CONSTRAINT "FK_balon" FOREIGN KEY (id_tipobalon)
    REFERENCES public."tb_tipoBalon" ("id_tipoBalon") MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    NOT VALID;

-- insert de la base

INSERT INTO PUBLIC."tb_tipoEmpleado"
(tipoEmpleado)
VALUES('Administrador');

--PARTE NELSON

select id_reserva, fecha_reserva from public."tb_reservaCancha" where fecha_Reserva between '2021-01-01' AND '2022-01-01';

--INNER JOINS
select * from "tb_reservaCancha" inner join tb_cliente on "tb_reservaCacha".id_cliente = "tb_cliente".id_cliente;



--Reporte para ver reservas mensuales y semanales --
create view reporte_cliente
as
select id_reserva, fecha_reserva, confirmacion_asistencia, nombre_cliente, apellido_cliente
from "tb_reservaCancha" tr, tb_cliente tc
where tr.id_cliente = tc.id_cliente
--Datos
select * from reporte_cliente where fecha_reserva between '2020-01-01' AND '2022-01-01';

--filtos para consultas semanales y mensuales
select * from reporte_cliente where confirmacion_asistencia like '%Presente%';
select * from reporte_cliente where confirmacion_asistencia like '%Ausente%';

--Filtro para clientes frecuentes
select nombre_cliente,count(*)
from reporte_cliente
where dui_cliente like '%068372410%'
group by nombre_cliente;

--Actulizacioes
CREATE OR REPLACE VIEW public.reporte_cliente
    AS
     SELECT tr.id_reserva,
    tr.fecha_reserva,
    tr.confirmacion_asistencia,
    tc.nombre_cliente,
    tc.apellido_cliente,
    tc.dui_cliente
   FROM "tb_reservaCancha" tr,
    tb_cliente tc
  WHERE tr.id_cliente = tc.id_cliente;

  ALTER TABLE IF EXISTS public.tb_cliente
    RENAME dui_ciente TO dui_cliente;

--Reportes de equipo dispoible

-- Para la cantidad de chalecos existentes
create view reporte_chalecos
as
select costo_chaleco, cantidad_chaleco, color_chalecos
from tb_chalecos tb, tb_color_chalecos tc 
where tc."id_color_chalecos" = tb."id_Color_chaleco";

--para la cantidad de balones existentes
create view reporte_balones
as
select costo_balon, cantidad, tamano_balon
from tb_tipoBalon tp, tb_tamano_balon tm
where tp."id_tamano_balon" = tm."id_tamanoBalon";