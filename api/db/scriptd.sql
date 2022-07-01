--
-- PostgreSQL database dump
--

-- Dumped from database version 14.1
-- Dumped by pg_dump version 14.1

-- Started on 2022-06-30 00:12:42

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 209 (class 1259 OID 66639)
-- Name: tb_asistencia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tb_asistencia (
    id_asistencia integer NOT NULL,
    descripcion_asistencia character varying(100) NOT NULL
);


ALTER TABLE public.tb_asistencia OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 66642)
-- Name: tb_asistencia_id_asistencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tb_asistencia_id_asistencia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tb_asistencia_id_asistencia_seq OWNER TO postgres;

--
-- TOC entry 3447 (class 0 OID 0)
-- Dependencies: 210
-- Name: tb_asistencia_id_asistencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tb_asistencia_id_asistencia_seq OWNED BY public.tb_asistencia.id_asistencia;


--
-- TOC entry 211 (class 1259 OID 66643)
-- Name: tb_cancha; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tb_cancha (
    id_cancha integer NOT NULL,
    numero_cancha integer NOT NULL,
    tamano_cancha character varying(100) NOT NULL,
    material_cancha character varying(100) NOT NULL,
    costo_cancha double precision
);


ALTER TABLE public.tb_cancha OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 66646)
-- Name: tb_cancha_id_cancha_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tb_cancha_id_cancha_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tb_cancha_id_cancha_seq OWNER TO postgres;

--
-- TOC entry 3448 (class 0 OID 0)
-- Dependencies: 212
-- Name: tb_cancha_id_cancha_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tb_cancha_id_cancha_seq OWNED BY public.tb_cancha.id_cancha;


--
-- TOC entry 213 (class 1259 OID 66647)
-- Name: tb_chaleco; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tb_chaleco (
    id_chaleco integer NOT NULL,
    costo_cheleco double precision,
    cantidad_chlecos integer NOT NULL,
    id_colorchaleco integer NOT NULL,
    talla_chaleco integer NOT NULL
);


ALTER TABLE public.tb_chaleco OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 66650)
-- Name: tb_chaleco_id_chaleco_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tb_chaleco_id_chaleco_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tb_chaleco_id_chaleco_seq OWNER TO postgres;

--
-- TOC entry 3449 (class 0 OID 0)
-- Dependencies: 214
-- Name: tb_chaleco_id_chaleco_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tb_chaleco_id_chaleco_seq OWNED BY public.tb_chaleco.id_chaleco;


--
-- TOC entry 215 (class 1259 OID 66651)
-- Name: tb_cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tb_cliente (
    id_cliente integer NOT NULL,
    nombre_cliente character varying(40) NOT NULL,
    apelllido_cliente character varying(40) NOT NULL,
    dui_cliente character varying(10) DEFAULT 'Registro menor de edad'::character varying,
    celular_cliente character varying(10) NOT NULL,
    correo_cliente character varying(100) NOT NULL,
    contrasena_cliente character varying(10) NOT NULL,
    foto_cliente character varying(100) NOT NULL
);


ALTER TABLE public.tb_cliente OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 66655)
-- Name: tb_cliente_id_cliente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tb_cliente_id_cliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tb_cliente_id_cliente_seq OWNER TO postgres;

--
-- TOC entry 3450 (class 0 OID 0)
-- Dependencies: 216
-- Name: tb_cliente_id_cliente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tb_cliente_id_cliente_seq OWNED BY public.tb_cliente.id_cliente;


--
-- TOC entry 217 (class 1259 OID 66656)
-- Name: tb_colorChaleco; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."tb_colorChaleco" (
    id_color integer NOT NULL,
    colorchaleco character varying(50) NOT NULL
);


ALTER TABLE public."tb_colorChaleco" OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 66659)
-- Name: tb_colorChaleco_id_color_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."tb_colorChaleco_id_color_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."tb_colorChaleco_id_color_seq" OWNER TO postgres;

--
-- TOC entry 3451 (class 0 OID 0)
-- Dependencies: 218
-- Name: tb_colorChaleco_id_color_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."tb_colorChaleco_id_color_seq" OWNED BY public."tb_colorChaleco".id_color;


--
-- TOC entry 219 (class 1259 OID 66660)
-- Name: tb_empleado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tb_empleado (
    id_empleado integer NOT NULL,
    nombre_empleado character varying(40) NOT NULL,
    apellido_empleado character varying(40) NOT NULL,
    dui_empleado character varying(40) NOT NULL,
    correo_empleado character varying(100) NOT NULL,
    contrasena_empleado character varying(300) NOT NULL,
    id_tipoempleado integer NOT NULL,
    celular_empleado character varying NOT NULL,
    foto_empleado character varying(100) DEFAULT '1.png'::character varying NOT NULL
);


ALTER TABLE public.tb_empleado OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 66663)
-- Name: tb_empleado_id_empleado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tb_empleado_id_empleado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tb_empleado_id_empleado_seq OWNER TO postgres;

--
-- TOC entry 3452 (class 0 OID 0)
-- Dependencies: 220
-- Name: tb_empleado_id_empleado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tb_empleado_id_empleado_seq OWNED BY public.tb_empleado.id_empleado;


--
-- TOC entry 221 (class 1259 OID 66664)
-- Name: tb_horario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tb_horario (
    id_horario integer NOT NULL,
    hora_inicio time without time zone NOT NULL,
    hora_fin time without time zone NOT NULL,
    id_tipohorario integer NOT NULL
);


ALTER TABLE public.tb_horario OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 66667)
-- Name: tb_horario_id_horario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tb_horario_id_horario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tb_horario_id_horario_seq OWNER TO postgres;

--
-- TOC entry 3453 (class 0 OID 0)
-- Dependencies: 222
-- Name: tb_horario_id_horario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tb_horario_id_horario_seq OWNED BY public.tb_horario.id_horario;


--
-- TOC entry 223 (class 1259 OID 66668)
-- Name: tb_reserva; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tb_reserva (
    id_reserva integer NOT NULL,
    fecha_reserva date NOT NULL,
    balones_alquilados integer NOT NULL,
    observaciones character varying(200) NOT NULL,
    chalecos_alquilados integer NOT NULL,
    id_empleado integer NOT NULL,
    id_cancha integer NOT NULL,
    id_horario integer NOT NULL,
    id_cliente integer NOT NULL,
    id_asistencia integer NOT NULL,
    id_tipobalon integer NOT NULL,
    id_chalecos integer NOT NULL
);


ALTER TABLE public.tb_reserva OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 66671)
-- Name: tb_reserva_id_reserva_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tb_reserva_id_reserva_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tb_reserva_id_reserva_seq OWNER TO postgres;

--
-- TOC entry 3454 (class 0 OID 0)
-- Dependencies: 224
-- Name: tb_reserva_id_reserva_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tb_reserva_id_reserva_seq OWNED BY public.tb_reserva.id_reserva;


--
-- TOC entry 225 (class 1259 OID 66672)
-- Name: tb_tallaChaleco; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."tb_tallaChaleco" (
    id_talla integer NOT NULL,
    tallachaleco character varying(50) NOT NULL
);


ALTER TABLE public."tb_tallaChaleco" OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 66675)
-- Name: tb_tallaChaleco_id_talla_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."tb_tallaChaleco_id_talla_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."tb_tallaChaleco_id_talla_seq" OWNER TO postgres;

--
-- TOC entry 3455 (class 0 OID 0)
-- Dependencies: 226
-- Name: tb_tallaChaleco_id_talla_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."tb_tallaChaleco_id_talla_seq" OWNED BY public."tb_tallaChaleco".id_talla;


--
-- TOC entry 227 (class 1259 OID 66676)
-- Name: tb_tamanoBalon; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."tb_tamanoBalon" (
    id_tamanobalon integer NOT NULL,
    tamano_balon character varying(60) NOT NULL
);


ALTER TABLE public."tb_tamanoBalon" OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 66679)
-- Name: tb_tamanoBalon_id_tamanobalon_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."tb_tamanoBalon_id_tamanobalon_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."tb_tamanoBalon_id_tamanobalon_seq" OWNER TO postgres;

--
-- TOC entry 3456 (class 0 OID 0)
-- Dependencies: 228
-- Name: tb_tamanoBalon_id_tamanobalon_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."tb_tamanoBalon_id_tamanobalon_seq" OWNED BY public."tb_tamanoBalon".id_tamanobalon;


--
-- TOC entry 229 (class 1259 OID 66680)
-- Name: tb_tipoBalon; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."tb_tipoBalon" (
    id_tipobalon integer NOT NULL,
    costo_balon double precision,
    cantidadad_balones integer NOT NULL,
    id_tamanobalon integer NOT NULL
);


ALTER TABLE public."tb_tipoBalon" OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 66683)
-- Name: tb_tipoBalon_id_tipobalon_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."tb_tipoBalon_id_tipobalon_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."tb_tipoBalon_id_tipobalon_seq" OWNER TO postgres;

--
-- TOC entry 3457 (class 0 OID 0)
-- Dependencies: 230
-- Name: tb_tipoBalon_id_tipobalon_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."tb_tipoBalon_id_tipobalon_seq" OWNED BY public."tb_tipoBalon".id_tipobalon;


--
-- TOC entry 231 (class 1259 OID 66684)
-- Name: tb_tipoEmpleado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."tb_tipoEmpleado" (
    id_tipoempleado integer NOT NULL,
    tipoempleado character varying(50) NOT NULL
);


ALTER TABLE public."tb_tipoEmpleado" OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 66687)
-- Name: tb_tipoEmpleado_id_tipoempleado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."tb_tipoEmpleado_id_tipoempleado_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."tb_tipoEmpleado_id_tipoempleado_seq" OWNER TO postgres;

--
-- TOC entry 3458 (class 0 OID 0)
-- Dependencies: 232
-- Name: tb_tipoEmpleado_id_tipoempleado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."tb_tipoEmpleado_id_tipoempleado_seq" OWNED BY public."tb_tipoEmpleado".id_tipoempleado;


--
-- TOC entry 233 (class 1259 OID 66688)
-- Name: tb_tipoHorario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."tb_tipoHorario" (
    id_tipohorario integer NOT NULL,
    horario_reservacion character varying(100) NOT NULL
);


ALTER TABLE public."tb_tipoHorario" OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 66691)
-- Name: tb_tipoHorario_id_tipohorario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."tb_tipoHorario_id_tipohorario_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."tb_tipoHorario_id_tipohorario_seq" OWNER TO postgres;

--
-- TOC entry 3459 (class 0 OID 0)
-- Dependencies: 234
-- Name: tb_tipoHorario_id_tipohorario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."tb_tipoHorario_id_tipohorario_seq" OWNED BY public."tb_tipoHorario".id_tipohorario;


--
-- TOC entry 3224 (class 2604 OID 66692)
-- Name: tb_asistencia id_asistencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_asistencia ALTER COLUMN id_asistencia SET DEFAULT nextval('public.tb_asistencia_id_asistencia_seq'::regclass);


--
-- TOC entry 3225 (class 2604 OID 66693)
-- Name: tb_cancha id_cancha; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_cancha ALTER COLUMN id_cancha SET DEFAULT nextval('public.tb_cancha_id_cancha_seq'::regclass);


--
-- TOC entry 3226 (class 2604 OID 66694)
-- Name: tb_chaleco id_chaleco; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_chaleco ALTER COLUMN id_chaleco SET DEFAULT nextval('public.tb_chaleco_id_chaleco_seq'::regclass);


--
-- TOC entry 3228 (class 2604 OID 66695)
-- Name: tb_cliente id_cliente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_cliente ALTER COLUMN id_cliente SET DEFAULT nextval('public.tb_cliente_id_cliente_seq'::regclass);


--
-- TOC entry 3229 (class 2604 OID 66696)
-- Name: tb_colorChaleco id_color; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_colorChaleco" ALTER COLUMN id_color SET DEFAULT nextval('public."tb_colorChaleco_id_color_seq"'::regclass);


--
-- TOC entry 3230 (class 2604 OID 66697)
-- Name: tb_empleado id_empleado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_empleado ALTER COLUMN id_empleado SET DEFAULT nextval('public.tb_empleado_id_empleado_seq'::regclass);


--
-- TOC entry 3232 (class 2604 OID 66698)
-- Name: tb_horario id_horario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_horario ALTER COLUMN id_horario SET DEFAULT nextval('public.tb_horario_id_horario_seq'::regclass);


--
-- TOC entry 3233 (class 2604 OID 66699)
-- Name: tb_reserva id_reserva; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva ALTER COLUMN id_reserva SET DEFAULT nextval('public.tb_reserva_id_reserva_seq'::regclass);


--
-- TOC entry 3234 (class 2604 OID 66700)
-- Name: tb_tallaChaleco id_talla; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tallaChaleco" ALTER COLUMN id_talla SET DEFAULT nextval('public."tb_tallaChaleco_id_talla_seq"'::regclass);


--
-- TOC entry 3235 (class 2604 OID 66701)
-- Name: tb_tamanoBalon id_tamanobalon; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tamanoBalon" ALTER COLUMN id_tamanobalon SET DEFAULT nextval('public."tb_tamanoBalon_id_tamanobalon_seq"'::regclass);


--
-- TOC entry 3236 (class 2604 OID 66702)
-- Name: tb_tipoBalon id_tipobalon; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tipoBalon" ALTER COLUMN id_tipobalon SET DEFAULT nextval('public."tb_tipoBalon_id_tipobalon_seq"'::regclass);


--
-- TOC entry 3237 (class 2604 OID 66703)
-- Name: tb_tipoEmpleado id_tipoempleado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tipoEmpleado" ALTER COLUMN id_tipoempleado SET DEFAULT nextval('public."tb_tipoEmpleado_id_tipoempleado_seq"'::regclass);


--
-- TOC entry 3238 (class 2604 OID 66704)
-- Name: tb_tipoHorario id_tipohorario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tipoHorario" ALTER COLUMN id_tipohorario SET DEFAULT nextval('public."tb_tipoHorario_id_tipohorario_seq"'::regclass);


--
-- TOC entry 3416 (class 0 OID 66639)
-- Dependencies: 209
-- Data for Name: tb_asistencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_asistencia (id_asistencia, descripcion_asistencia) FROM stdin;
\.


--
-- TOC entry 3418 (class 0 OID 66643)
-- Dependencies: 211
-- Data for Name: tb_cancha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_cancha (id_cancha, numero_cancha, tamano_cancha, material_cancha, costo_cancha) FROM stdin;
\.


--
-- TOC entry 3420 (class 0 OID 66647)
-- Dependencies: 213
-- Data for Name: tb_chaleco; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_chaleco (id_chaleco, costo_cheleco, cantidad_chlecos, id_colorchaleco, talla_chaleco) FROM stdin;
\.


--
-- TOC entry 3422 (class 0 OID 66651)
-- Dependencies: 215
-- Data for Name: tb_cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_cliente (id_cliente, nombre_cliente, apelllido_cliente, dui_cliente, celular_cliente, correo_cliente, contrasena_cliente, foto_cliente) FROM stdin;
\.


--
-- TOC entry 3424 (class 0 OID 66656)
-- Dependencies: 217
-- Data for Name: tb_colorChaleco; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."tb_colorChaleco" (id_color, colorchaleco) FROM stdin;
\.


--
-- TOC entry 3426 (class 0 OID 66660)
-- Dependencies: 219
-- Data for Name: tb_empleado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_empleado (id_empleado, nombre_empleado, apellido_empleado, dui_empleado, correo_empleado, contrasena_empleado, id_tipoempleado, celular_empleado, foto_empleado) FROM stdin;
26	Gaby	Carias	96857432-9	gaby.carias@gmail.com	$2y$10$EeG1B1rYVL69ejgNDX6o8uyeNbQg61/8NtZkmhys2.9ihiz1SAPHu	1	7598-8547	62bbc1e33e591.jpg
25	Elmer	Carias	65897421-9	elmer.carias@gmail.com	$2y$10$SIJeWFDPwqqgEM8el/Vsg.2QowEHa/IwIzPQFvcFDIITGiQcr1m3u	1	6427-0829	62bd09db3d618.jpg
31	Nelson	Almendares	98745632-7	nelson25@gmail.com	$2y$10$Cc6w.LSWY6elPrH1TyY33el/uZzz0O6BFFa/HKE/XQ.Vyu4TutteG	1	6587-9544	62bd16f235e33.jpg
\.


--
-- TOC entry 3428 (class 0 OID 66664)
-- Dependencies: 221
-- Data for Name: tb_horario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_horario (id_horario, hora_inicio, hora_fin, id_tipohorario) FROM stdin;
\.


--
-- TOC entry 3430 (class 0 OID 66668)
-- Dependencies: 223
-- Data for Name: tb_reserva; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_reserva (id_reserva, fecha_reserva, balones_alquilados, observaciones, chalecos_alquilados, id_empleado, id_cancha, id_horario, id_cliente, id_asistencia, id_tipobalon, id_chalecos) FROM stdin;
\.


--
-- TOC entry 3432 (class 0 OID 66672)
-- Dependencies: 225
-- Data for Name: tb_tallaChaleco; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."tb_tallaChaleco" (id_talla, tallachaleco) FROM stdin;
\.


--
-- TOC entry 3434 (class 0 OID 66676)
-- Dependencies: 227
-- Data for Name: tb_tamanoBalon; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."tb_tamanoBalon" (id_tamanobalon, tamano_balon) FROM stdin;
1	Número 5
\.


--
-- TOC entry 3436 (class 0 OID 66680)
-- Dependencies: 229
-- Data for Name: tb_tipoBalon; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."tb_tipoBalon" (id_tipobalon, costo_balon, cantidadad_balones, id_tamanobalon) FROM stdin;
\.


--
-- TOC entry 3438 (class 0 OID 66684)
-- Dependencies: 231
-- Data for Name: tb_tipoEmpleado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."tb_tipoEmpleado" (id_tipoempleado, tipoempleado) FROM stdin;
1	root
\.


--
-- TOC entry 3440 (class 0 OID 66688)
-- Dependencies: 233
-- Data for Name: tb_tipoHorario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."tb_tipoHorario" (id_tipohorario, horario_reservacion) FROM stdin;
\.


--
-- TOC entry 3460 (class 0 OID 0)
-- Dependencies: 210
-- Name: tb_asistencia_id_asistencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_asistencia_id_asistencia_seq', 1, false);


--
-- TOC entry 3461 (class 0 OID 0)
-- Dependencies: 212
-- Name: tb_cancha_id_cancha_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_cancha_id_cancha_seq', 1, false);


--
-- TOC entry 3462 (class 0 OID 0)
-- Dependencies: 214
-- Name: tb_chaleco_id_chaleco_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_chaleco_id_chaleco_seq', 1, false);


--
-- TOC entry 3463 (class 0 OID 0)
-- Dependencies: 216
-- Name: tb_cliente_id_cliente_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_cliente_id_cliente_seq', 1, false);


--
-- TOC entry 3464 (class 0 OID 0)
-- Dependencies: 218
-- Name: tb_colorChaleco_id_color_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."tb_colorChaleco_id_color_seq"', 1, false);


--
-- TOC entry 3465 (class 0 OID 0)
-- Dependencies: 220
-- Name: tb_empleado_id_empleado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_empleado_id_empleado_seq', 31, true);


--
-- TOC entry 3466 (class 0 OID 0)
-- Dependencies: 222
-- Name: tb_horario_id_horario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_horario_id_horario_seq', 1, false);


--
-- TOC entry 3467 (class 0 OID 0)
-- Dependencies: 224
-- Name: tb_reserva_id_reserva_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_reserva_id_reserva_seq', 1, false);


--
-- TOC entry 3468 (class 0 OID 0)
-- Dependencies: 226
-- Name: tb_tallaChaleco_id_talla_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."tb_tallaChaleco_id_talla_seq"', 1, false);


--
-- TOC entry 3469 (class 0 OID 0)
-- Dependencies: 228
-- Name: tb_tamanoBalon_id_tamanobalon_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."tb_tamanoBalon_id_tamanobalon_seq"', 2, true);


--
-- TOC entry 3470 (class 0 OID 0)
-- Dependencies: 230
-- Name: tb_tipoBalon_id_tipobalon_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."tb_tipoBalon_id_tipobalon_seq"', 1, false);


--
-- TOC entry 3471 (class 0 OID 0)
-- Dependencies: 232
-- Name: tb_tipoEmpleado_id_tipoempleado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."tb_tipoEmpleado_id_tipoempleado_seq"', 1, true);


--
-- TOC entry 3472 (class 0 OID 0)
-- Dependencies: 234
-- Name: tb_tipoHorario_id_tipohorario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."tb_tipoHorario_id_tipohorario_seq"', 1, false);


--
-- TOC entry 3240 (class 2606 OID 66706)
-- Name: tb_asistencia tb_asistencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_asistencia
    ADD CONSTRAINT tb_asistencia_pkey PRIMARY KEY (id_asistencia);


--
-- TOC entry 3242 (class 2606 OID 66708)
-- Name: tb_cancha tb_cancha_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_cancha
    ADD CONSTRAINT tb_cancha_pkey PRIMARY KEY (id_cancha);


--
-- TOC entry 3244 (class 2606 OID 66710)
-- Name: tb_chaleco tb_chaleco_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_chaleco
    ADD CONSTRAINT tb_chaleco_pkey PRIMARY KEY (id_chaleco);


--
-- TOC entry 3246 (class 2606 OID 66712)
-- Name: tb_cliente tb_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_cliente
    ADD CONSTRAINT tb_cliente_pkey PRIMARY KEY (id_cliente);


--
-- TOC entry 3248 (class 2606 OID 66714)
-- Name: tb_colorChaleco tb_colorChaleco_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_colorChaleco"
    ADD CONSTRAINT "tb_colorChaleco_pkey" PRIMARY KEY (id_color);


--
-- TOC entry 3250 (class 2606 OID 66716)
-- Name: tb_empleado tb_empleado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_empleado
    ADD CONSTRAINT tb_empleado_pkey PRIMARY KEY (id_empleado);


--
-- TOC entry 3252 (class 2606 OID 66718)
-- Name: tb_horario tb_horario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_horario
    ADD CONSTRAINT tb_horario_pkey PRIMARY KEY (id_horario);


--
-- TOC entry 3254 (class 2606 OID 66720)
-- Name: tb_reserva tb_reserva_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT tb_reserva_pkey PRIMARY KEY (id_reserva);


--
-- TOC entry 3256 (class 2606 OID 66722)
-- Name: tb_tallaChaleco tb_tallaChaleco_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tallaChaleco"
    ADD CONSTRAINT "tb_tallaChaleco_pkey" PRIMARY KEY (id_talla);


--
-- TOC entry 3258 (class 2606 OID 66724)
-- Name: tb_tamanoBalon tb_tamanoBalon_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tamanoBalon"
    ADD CONSTRAINT "tb_tamanoBalon_pkey" PRIMARY KEY (id_tamanobalon);


--
-- TOC entry 3260 (class 2606 OID 66726)
-- Name: tb_tipoBalon tb_tipoBalon_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tipoBalon"
    ADD CONSTRAINT "tb_tipoBalon_pkey" PRIMARY KEY (id_tipobalon);


--
-- TOC entry 3262 (class 2606 OID 66728)
-- Name: tb_tipoEmpleado tb_tipoEmpleado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tipoEmpleado"
    ADD CONSTRAINT "tb_tipoEmpleado_pkey" PRIMARY KEY (id_tipoempleado);


--
-- TOC entry 3264 (class 2606 OID 66730)
-- Name: tb_tipoHorario tb_tipoHorario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tipoHorario"
    ADD CONSTRAINT "tb_tipoHorario_pkey" PRIMARY KEY (id_tipohorario);


--
-- TOC entry 3269 (class 2606 OID 66731)
-- Name: tb_reserva FK_asistencia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_asistencia" FOREIGN KEY (id_asistencia) REFERENCES public.tb_asistencia(id_asistencia) NOT VALID;


--
-- TOC entry 3270 (class 2606 OID 66736)
-- Name: tb_reserva FK_cancha; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_cancha" FOREIGN KEY (id_cancha) REFERENCES public.tb_cancha(id_cancha) NOT VALID;


--
-- TOC entry 3271 (class 2606 OID 66741)
-- Name: tb_reserva FK_chalecos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_chalecos" FOREIGN KEY (id_chalecos) REFERENCES public.tb_chaleco(id_chaleco) NOT VALID;


--
-- TOC entry 3272 (class 2606 OID 66746)
-- Name: tb_reserva FK_cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_cliente" FOREIGN KEY (id_cliente) REFERENCES public.tb_cliente(id_cliente) NOT VALID;


--
-- TOC entry 3265 (class 2606 OID 66751)
-- Name: tb_chaleco FK_color; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_chaleco
    ADD CONSTRAINT "FK_color" FOREIGN KEY (id_colorchaleco) REFERENCES public."tb_colorChaleco"(id_color) NOT VALID;


--
-- TOC entry 3273 (class 2606 OID 66756)
-- Name: tb_reserva FK_empleado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_empleado" FOREIGN KEY (id_empleado) REFERENCES public.tb_empleado(id_empleado) NOT VALID;


--
-- TOC entry 3274 (class 2606 OID 66761)
-- Name: tb_reserva FK_horario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_horario" FOREIGN KEY (id_horario) REFERENCES public.tb_horario(id_horario) NOT VALID;


--
-- TOC entry 3266 (class 2606 OID 66766)
-- Name: tb_chaleco FK_talla; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_chaleco
    ADD CONSTRAINT "FK_talla" FOREIGN KEY (talla_chaleco) REFERENCES public."tb_tallaChaleco"(id_talla) NOT VALID;


--
-- TOC entry 3276 (class 2606 OID 66771)
-- Name: tb_tipoBalon FK_tamanoBalon; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tb_tipoBalon"
    ADD CONSTRAINT "FK_tamanoBalon" FOREIGN KEY (id_tamanobalon) REFERENCES public."tb_tamanoBalon"(id_tamanobalon) NOT VALID;


--
-- TOC entry 3275 (class 2606 OID 66776)
-- Name: tb_reserva FK_tipoBalon; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_tipoBalon" FOREIGN KEY (id_tipobalon) REFERENCES public."tb_tipoBalon"(id_tipobalon) NOT VALID;


--
-- TOC entry 3267 (class 2606 OID 66781)
-- Name: tb_empleado FK_tipoEmpleado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_empleado
    ADD CONSTRAINT "FK_tipoEmpleado" FOREIGN KEY (id_tipoempleado) REFERENCES public."tb_tipoEmpleado"(id_tipoempleado) NOT VALID;


--
-- TOC entry 3268 (class 2606 OID 66786)
-- Name: tb_horario FK_tipoHorario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tb_horario
    ADD CONSTRAINT "FK_tipoHorario" FOREIGN KEY (id_tipohorario) REFERENCES public."tb_tipoHorario"(id_tipohorario) NOT VALID;


-- Completed on 2022-06-30 00:12:45

--
-- PostgreSQL database dump complete
--

