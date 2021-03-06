PGDMP     *    ;                z         
   PlaySoccer    14.1    14.1 k    t           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            u           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            v           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            w           1262    66638 
   PlaySoccer    DATABASE     h   CREATE DATABASE "PlaySoccer" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE "PlaySoccer";
                postgres    false            ?            1259    66639    tb_asistencia    TABLE     ?   CREATE TABLE public.tb_asistencia (
    id_asistencia integer NOT NULL,
    descripcion_asistencia character varying(100) NOT NULL
);
 !   DROP TABLE public.tb_asistencia;
       public         heap    postgres    false            ?            1259    66642    tb_asistencia_id_asistencia_seq    SEQUENCE     ?   CREATE SEQUENCE public.tb_asistencia_id_asistencia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.tb_asistencia_id_asistencia_seq;
       public          postgres    false    209            x           0    0    tb_asistencia_id_asistencia_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.tb_asistencia_id_asistencia_seq OWNED BY public.tb_asistencia.id_asistencia;
          public          postgres    false    210            ?            1259    66643 	   tb_cancha    TABLE     ?   CREATE TABLE public.tb_cancha (
    id_cancha integer NOT NULL,
    numero_cancha integer NOT NULL,
    tamano_cancha character varying(100) NOT NULL,
    material_cancha character varying(100) NOT NULL,
    costo_cancha double precision
);
    DROP TABLE public.tb_cancha;
       public         heap    postgres    false            ?            1259    66646    tb_cancha_id_cancha_seq    SEQUENCE     ?   CREATE SEQUENCE public.tb_cancha_id_cancha_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tb_cancha_id_cancha_seq;
       public          postgres    false    211            y           0    0    tb_cancha_id_cancha_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.tb_cancha_id_cancha_seq OWNED BY public.tb_cancha.id_cancha;
          public          postgres    false    212            ?            1259    66647 
   tb_chaleco    TABLE     ?   CREATE TABLE public.tb_chaleco (
    id_chaleco integer NOT NULL,
    costo_cheleco double precision,
    cantidad_chlecos integer NOT NULL,
    id_colorchaleco integer NOT NULL,
    talla_chaleco integer NOT NULL
);
    DROP TABLE public.tb_chaleco;
       public         heap    postgres    false            ?            1259    66650    tb_chaleco_id_chaleco_seq    SEQUENCE     ?   CREATE SEQUENCE public.tb_chaleco_id_chaleco_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tb_chaleco_id_chaleco_seq;
       public          postgres    false    213            z           0    0    tb_chaleco_id_chaleco_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tb_chaleco_id_chaleco_seq OWNED BY public.tb_chaleco.id_chaleco;
          public          postgres    false    214            ?            1259    66651 
   tb_cliente    TABLE     ?  CREATE TABLE public.tb_cliente (
    id_cliente integer NOT NULL,
    nombre_cliente character varying(40) NOT NULL,
    apelllido_cliente character varying(40) NOT NULL,
    dui_cliente character varying(10) DEFAULT 'Registro menor de edad'::character varying,
    celular_cliente character varying(10) NOT NULL,
    correo_cliente character varying(100) NOT NULL,
    contrasena_cliente character varying(10) NOT NULL,
    foto_cliente character varying(100) NOT NULL
);
    DROP TABLE public.tb_cliente;
       public         heap    postgres    false            ?            1259    66655    tb_cliente_id_cliente_seq    SEQUENCE     ?   CREATE SEQUENCE public.tb_cliente_id_cliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tb_cliente_id_cliente_seq;
       public          postgres    false    215            {           0    0    tb_cliente_id_cliente_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tb_cliente_id_cliente_seq OWNED BY public.tb_cliente.id_cliente;
          public          postgres    false    216            ?            1259    66656    tb_colorChaleco    TABLE     z   CREATE TABLE public."tb_colorChaleco" (
    id_color integer NOT NULL,
    colorchaleco character varying(50) NOT NULL
);
 %   DROP TABLE public."tb_colorChaleco";
       public         heap    postgres    false            ?            1259    66659    tb_colorChaleco_id_color_seq    SEQUENCE     ?   CREATE SEQUENCE public."tb_colorChaleco_id_color_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public."tb_colorChaleco_id_color_seq";
       public          postgres    false    217            |           0    0    tb_colorChaleco_id_color_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public."tb_colorChaleco_id_color_seq" OWNED BY public."tb_colorChaleco".id_color;
          public          postgres    false    218            ?            1259    66660    tb_empleado    TABLE     ?  CREATE TABLE public.tb_empleado (
    id_empleado integer NOT NULL,
    nombre_empleado character varying(40) NOT NULL,
    apellido_empleado character varying(40) NOT NULL,
    dui_empleado character varying(40) NOT NULL,
    correo_empleado character varying(100) NOT NULL,
    contrasena_empleado character varying(300) NOT NULL,
    id_tipoempleado integer NOT NULL,
    celular_empleado character varying NOT NULL,
    foto_empleado character varying(100) DEFAULT '1.png'::character varying
);
    DROP TABLE public.tb_empleado;
       public         heap    postgres    false            ?            1259    66663    tb_empleado_id_empleado_seq    SEQUENCE     ?   CREATE SEQUENCE public.tb_empleado_id_empleado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.tb_empleado_id_empleado_seq;
       public          postgres    false    219            }           0    0    tb_empleado_id_empleado_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.tb_empleado_id_empleado_seq OWNED BY public.tb_empleado.id_empleado;
          public          postgres    false    220            ?            1259    66664 
   tb_horario    TABLE     ?   CREATE TABLE public.tb_horario (
    id_horario integer NOT NULL,
    hora_inicio time without time zone NOT NULL,
    hora_fin time without time zone NOT NULL,
    id_tipohorario integer NOT NULL
);
    DROP TABLE public.tb_horario;
       public         heap    postgres    false            ?            1259    66667    tb_horario_id_horario_seq    SEQUENCE     ?   CREATE SEQUENCE public.tb_horario_id_horario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tb_horario_id_horario_seq;
       public          postgres    false    221            ~           0    0    tb_horario_id_horario_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tb_horario_id_horario_seq OWNED BY public.tb_horario.id_horario;
          public          postgres    false    222            ?            1259    66668 
   tb_reserva    TABLE     ?  CREATE TABLE public.tb_reserva (
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
    DROP TABLE public.tb_reserva;
       public         heap    postgres    false            ?            1259    66671    tb_reserva_id_reserva_seq    SEQUENCE     ?   CREATE SEQUENCE public.tb_reserva_id_reserva_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tb_reserva_id_reserva_seq;
       public          postgres    false    223                       0    0    tb_reserva_id_reserva_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tb_reserva_id_reserva_seq OWNED BY public.tb_reserva.id_reserva;
          public          postgres    false    224            ?            1259    66672    tb_tallaChaleco    TABLE     z   CREATE TABLE public."tb_tallaChaleco" (
    id_talla integer NOT NULL,
    tallachaleco character varying(50) NOT NULL
);
 %   DROP TABLE public."tb_tallaChaleco";
       public         heap    postgres    false            ?            1259    66675    tb_tallaChaleco_id_talla_seq    SEQUENCE     ?   CREATE SEQUENCE public."tb_tallaChaleco_id_talla_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public."tb_tallaChaleco_id_talla_seq";
       public          postgres    false    225            ?           0    0    tb_tallaChaleco_id_talla_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public."tb_tallaChaleco_id_talla_seq" OWNED BY public."tb_tallaChaleco".id_talla;
          public          postgres    false    226            ?            1259    66676    tb_tamanoBalon    TABLE        CREATE TABLE public."tb_tamanoBalon" (
    id_tamanobalon integer NOT NULL,
    tamano_balon character varying(60) NOT NULL
);
 $   DROP TABLE public."tb_tamanoBalon";
       public         heap    postgres    false            ?            1259    66679 !   tb_tamanoBalon_id_tamanobalon_seq    SEQUENCE     ?   CREATE SEQUENCE public."tb_tamanoBalon_id_tamanobalon_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public."tb_tamanoBalon_id_tamanobalon_seq";
       public          postgres    false    227            ?           0    0 !   tb_tamanoBalon_id_tamanobalon_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public."tb_tamanoBalon_id_tamanobalon_seq" OWNED BY public."tb_tamanoBalon".id_tamanobalon;
          public          postgres    false    228            ?            1259    66680    tb_tipoBalon    TABLE     ?   CREATE TABLE public."tb_tipoBalon" (
    id_tipobalon integer NOT NULL,
    costo_balon double precision,
    cantidadad_balones integer NOT NULL,
    id_tamanobalon integer NOT NULL
);
 "   DROP TABLE public."tb_tipoBalon";
       public         heap    postgres    false            ?            1259    66683    tb_tipoBalon_id_tipobalon_seq    SEQUENCE     ?   CREATE SEQUENCE public."tb_tipoBalon_id_tipobalon_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public."tb_tipoBalon_id_tipobalon_seq";
       public          postgres    false    229            ?           0    0    tb_tipoBalon_id_tipobalon_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public."tb_tipoBalon_id_tipobalon_seq" OWNED BY public."tb_tipoBalon".id_tipobalon;
          public          postgres    false    230            ?            1259    66684    tb_tipoEmpleado    TABLE     ?   CREATE TABLE public."tb_tipoEmpleado" (
    id_tipoempleado integer NOT NULL,
    tipoempleado character varying(50) NOT NULL
);
 %   DROP TABLE public."tb_tipoEmpleado";
       public         heap    postgres    false            ?            1259    66687 #   tb_tipoEmpleado_id_tipoempleado_seq    SEQUENCE     ?   CREATE SEQUENCE public."tb_tipoEmpleado_id_tipoempleado_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 <   DROP SEQUENCE public."tb_tipoEmpleado_id_tipoempleado_seq";
       public          postgres    false    231            ?           0    0 #   tb_tipoEmpleado_id_tipoempleado_seq    SEQUENCE OWNED BY     o   ALTER SEQUENCE public."tb_tipoEmpleado_id_tipoempleado_seq" OWNED BY public."tb_tipoEmpleado".id_tipoempleado;
          public          postgres    false    232            ?            1259    66688    tb_tipoHorario    TABLE     ?   CREATE TABLE public."tb_tipoHorario" (
    id_tipohorario integer NOT NULL,
    horario_reservacion character varying(100) NOT NULL
);
 $   DROP TABLE public."tb_tipoHorario";
       public         heap    postgres    false            ?            1259    66691 !   tb_tipoHorario_id_tipohorario_seq    SEQUENCE     ?   CREATE SEQUENCE public."tb_tipoHorario_id_tipohorario_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public."tb_tipoHorario_id_tipohorario_seq";
       public          postgres    false    233            ?           0    0 !   tb_tipoHorario_id_tipohorario_seq    SEQUENCE OWNED BY     k   ALTER SEQUENCE public."tb_tipoHorario_id_tipohorario_seq" OWNED BY public."tb_tipoHorario".id_tipohorario;
          public          postgres    false    234            ?           2604    66692    tb_asistencia id_asistencia    DEFAULT     ?   ALTER TABLE ONLY public.tb_asistencia ALTER COLUMN id_asistencia SET DEFAULT nextval('public.tb_asistencia_id_asistencia_seq'::regclass);
 J   ALTER TABLE public.tb_asistencia ALTER COLUMN id_asistencia DROP DEFAULT;
       public          postgres    false    210    209            ?           2604    66693    tb_cancha id_cancha    DEFAULT     z   ALTER TABLE ONLY public.tb_cancha ALTER COLUMN id_cancha SET DEFAULT nextval('public.tb_cancha_id_cancha_seq'::regclass);
 B   ALTER TABLE public.tb_cancha ALTER COLUMN id_cancha DROP DEFAULT;
       public          postgres    false    212    211            ?           2604    66694    tb_chaleco id_chaleco    DEFAULT     ~   ALTER TABLE ONLY public.tb_chaleco ALTER COLUMN id_chaleco SET DEFAULT nextval('public.tb_chaleco_id_chaleco_seq'::regclass);
 D   ALTER TABLE public.tb_chaleco ALTER COLUMN id_chaleco DROP DEFAULT;
       public          postgres    false    214    213            ?           2604    66695    tb_cliente id_cliente    DEFAULT     ~   ALTER TABLE ONLY public.tb_cliente ALTER COLUMN id_cliente SET DEFAULT nextval('public.tb_cliente_id_cliente_seq'::regclass);
 D   ALTER TABLE public.tb_cliente ALTER COLUMN id_cliente DROP DEFAULT;
       public          postgres    false    216    215            ?           2604    66696    tb_colorChaleco id_color    DEFAULT     ?   ALTER TABLE ONLY public."tb_colorChaleco" ALTER COLUMN id_color SET DEFAULT nextval('public."tb_colorChaleco_id_color_seq"'::regclass);
 I   ALTER TABLE public."tb_colorChaleco" ALTER COLUMN id_color DROP DEFAULT;
       public          postgres    false    218    217            ?           2604    66697    tb_empleado id_empleado    DEFAULT     ?   ALTER TABLE ONLY public.tb_empleado ALTER COLUMN id_empleado SET DEFAULT nextval('public.tb_empleado_id_empleado_seq'::regclass);
 F   ALTER TABLE public.tb_empleado ALTER COLUMN id_empleado DROP DEFAULT;
       public          postgres    false    220    219            ?           2604    66698    tb_horario id_horario    DEFAULT     ~   ALTER TABLE ONLY public.tb_horario ALTER COLUMN id_horario SET DEFAULT nextval('public.tb_horario_id_horario_seq'::regclass);
 D   ALTER TABLE public.tb_horario ALTER COLUMN id_horario DROP DEFAULT;
       public          postgres    false    222    221            ?           2604    66699    tb_reserva id_reserva    DEFAULT     ~   ALTER TABLE ONLY public.tb_reserva ALTER COLUMN id_reserva SET DEFAULT nextval('public.tb_reserva_id_reserva_seq'::regclass);
 D   ALTER TABLE public.tb_reserva ALTER COLUMN id_reserva DROP DEFAULT;
       public          postgres    false    224    223            ?           2604    66700    tb_tallaChaleco id_talla    DEFAULT     ?   ALTER TABLE ONLY public."tb_tallaChaleco" ALTER COLUMN id_talla SET DEFAULT nextval('public."tb_tallaChaleco_id_talla_seq"'::regclass);
 I   ALTER TABLE public."tb_tallaChaleco" ALTER COLUMN id_talla DROP DEFAULT;
       public          postgres    false    226    225            ?           2604    66701    tb_tamanoBalon id_tamanobalon    DEFAULT     ?   ALTER TABLE ONLY public."tb_tamanoBalon" ALTER COLUMN id_tamanobalon SET DEFAULT nextval('public."tb_tamanoBalon_id_tamanobalon_seq"'::regclass);
 N   ALTER TABLE public."tb_tamanoBalon" ALTER COLUMN id_tamanobalon DROP DEFAULT;
       public          postgres    false    228    227            ?           2604    66702    tb_tipoBalon id_tipobalon    DEFAULT     ?   ALTER TABLE ONLY public."tb_tipoBalon" ALTER COLUMN id_tipobalon SET DEFAULT nextval('public."tb_tipoBalon_id_tipobalon_seq"'::regclass);
 J   ALTER TABLE public."tb_tipoBalon" ALTER COLUMN id_tipobalon DROP DEFAULT;
       public          postgres    false    230    229            ?           2604    66703    tb_tipoEmpleado id_tipoempleado    DEFAULT     ?   ALTER TABLE ONLY public."tb_tipoEmpleado" ALTER COLUMN id_tipoempleado SET DEFAULT nextval('public."tb_tipoEmpleado_id_tipoempleado_seq"'::regclass);
 P   ALTER TABLE public."tb_tipoEmpleado" ALTER COLUMN id_tipoempleado DROP DEFAULT;
       public          postgres    false    232    231            ?           2604    66704    tb_tipoHorario id_tipohorario    DEFAULT     ?   ALTER TABLE ONLY public."tb_tipoHorario" ALTER COLUMN id_tipohorario SET DEFAULT nextval('public."tb_tipoHorario_id_tipohorario_seq"'::regclass);
 N   ALTER TABLE public."tb_tipoHorario" ALTER COLUMN id_tipohorario DROP DEFAULT;
       public          postgres    false    234    233            X          0    66639    tb_asistencia 
   TABLE DATA           N   COPY public.tb_asistencia (id_asistencia, descripcion_asistencia) FROM stdin;
    public          postgres    false    209   ??       Z          0    66643 	   tb_cancha 
   TABLE DATA           k   COPY public.tb_cancha (id_cancha, numero_cancha, tamano_cancha, material_cancha, costo_cancha) FROM stdin;
    public          postgres    false    211   ?       \          0    66647 
   tb_chaleco 
   TABLE DATA           q   COPY public.tb_chaleco (id_chaleco, costo_cheleco, cantidad_chlecos, id_colorchaleco, talla_chaleco) FROM stdin;
    public          postgres    false    213   "?       ^          0    66651 
   tb_cliente 
   TABLE DATA           ?   COPY public.tb_cliente (id_cliente, nombre_cliente, apelllido_cliente, dui_cliente, celular_cliente, correo_cliente, contrasena_cliente, foto_cliente) FROM stdin;
    public          postgres    false    215   ??       `          0    66656    tb_colorChaleco 
   TABLE DATA           C   COPY public."tb_colorChaleco" (id_color, colorchaleco) FROM stdin;
    public          postgres    false    217   \?       b          0    66660    tb_empleado 
   TABLE DATA           ?   COPY public.tb_empleado (id_empleado, nombre_empleado, apellido_empleado, dui_empleado, correo_empleado, contrasena_empleado, id_tipoempleado, celular_empleado, foto_empleado) FROM stdin;
    public          postgres    false    219   y?       d          0    66664 
   tb_horario 
   TABLE DATA           W   COPY public.tb_horario (id_horario, hora_inicio, hora_fin, id_tipohorario) FROM stdin;
    public          postgres    false    221   ??       f          0    66668 
   tb_reserva 
   TABLE DATA           ?   COPY public.tb_reserva (id_reserva, fecha_reserva, balones_alquilados, observaciones, chalecos_alquilados, id_empleado, id_cancha, id_horario, id_cliente, id_asistencia, id_tipobalon, id_chalecos) FROM stdin;
    public          postgres    false    223   ??       h          0    66672    tb_tallaChaleco 
   TABLE DATA           C   COPY public."tb_tallaChaleco" (id_talla, tallachaleco) FROM stdin;
    public          postgres    false    225   Ї       j          0    66676    tb_tamanoBalon 
   TABLE DATA           H   COPY public."tb_tamanoBalon" (id_tamanobalon, tamano_balon) FROM stdin;
    public          postgres    false    227   ??       l          0    66680    tb_tipoBalon 
   TABLE DATA           g   COPY public."tb_tipoBalon" (id_tipobalon, costo_balon, cantidadad_balones, id_tamanobalon) FROM stdin;
    public          postgres    false    229   
?       n          0    66684    tb_tipoEmpleado 
   TABLE DATA           J   COPY public."tb_tipoEmpleado" (id_tipoempleado, tipoempleado) FROM stdin;
    public          postgres    false    231   '?       p          0    66688    tb_tipoHorario 
   TABLE DATA           O   COPY public."tb_tipoHorario" (id_tipohorario, horario_reservacion) FROM stdin;
    public          postgres    false    233   K?       ?           0    0    tb_asistencia_id_asistencia_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.tb_asistencia_id_asistencia_seq', 1, false);
          public          postgres    false    210            ?           0    0    tb_cancha_id_cancha_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tb_cancha_id_cancha_seq', 1, false);
          public          postgres    false    212            ?           0    0    tb_chaleco_id_chaleco_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tb_chaleco_id_chaleco_seq', 1, false);
          public          postgres    false    214            ?           0    0    tb_cliente_id_cliente_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tb_cliente_id_cliente_seq', 1, false);
          public          postgres    false    216            ?           0    0    tb_colorChaleco_id_color_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public."tb_colorChaleco_id_color_seq"', 1, false);
          public          postgres    false    218            ?           0    0    tb_empleado_id_empleado_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.tb_empleado_id_empleado_seq', 1, true);
          public          postgres    false    220            ?           0    0    tb_horario_id_horario_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tb_horario_id_horario_seq', 1, false);
          public          postgres    false    222            ?           0    0    tb_reserva_id_reserva_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tb_reserva_id_reserva_seq', 1, false);
          public          postgres    false    224            ?           0    0    tb_tallaChaleco_id_talla_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public."tb_tallaChaleco_id_talla_seq"', 1, false);
          public          postgres    false    226            ?           0    0 !   tb_tamanoBalon_id_tamanobalon_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public."tb_tamanoBalon_id_tamanobalon_seq"', 1, false);
          public          postgres    false    228            ?           0    0    tb_tipoBalon_id_tipobalon_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public."tb_tipoBalon_id_tipobalon_seq"', 1, false);
          public          postgres    false    230            ?           0    0 #   tb_tipoEmpleado_id_tipoempleado_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public."tb_tipoEmpleado_id_tipoempleado_seq"', 1, true);
          public          postgres    false    232            ?           0    0 !   tb_tipoHorario_id_tipohorario_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public."tb_tipoHorario_id_tipohorario_seq"', 1, false);
          public          postgres    false    234            ?           2606    66706     tb_asistencia tb_asistencia_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.tb_asistencia
    ADD CONSTRAINT tb_asistencia_pkey PRIMARY KEY (id_asistencia);
 J   ALTER TABLE ONLY public.tb_asistencia DROP CONSTRAINT tb_asistencia_pkey;
       public            postgres    false    209            ?           2606    66708    tb_cancha tb_cancha_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tb_cancha
    ADD CONSTRAINT tb_cancha_pkey PRIMARY KEY (id_cancha);
 B   ALTER TABLE ONLY public.tb_cancha DROP CONSTRAINT tb_cancha_pkey;
       public            postgres    false    211            ?           2606    66710    tb_chaleco tb_chaleco_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tb_chaleco
    ADD CONSTRAINT tb_chaleco_pkey PRIMARY KEY (id_chaleco);
 D   ALTER TABLE ONLY public.tb_chaleco DROP CONSTRAINT tb_chaleco_pkey;
       public            postgres    false    213            ?           2606    66712    tb_cliente tb_cliente_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tb_cliente
    ADD CONSTRAINT tb_cliente_pkey PRIMARY KEY (id_cliente);
 D   ALTER TABLE ONLY public.tb_cliente DROP CONSTRAINT tb_cliente_pkey;
       public            postgres    false    215            ?           2606    66714 $   tb_colorChaleco tb_colorChaleco_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public."tb_colorChaleco"
    ADD CONSTRAINT "tb_colorChaleco_pkey" PRIMARY KEY (id_color);
 R   ALTER TABLE ONLY public."tb_colorChaleco" DROP CONSTRAINT "tb_colorChaleco_pkey";
       public            postgres    false    217            ?           2606    66716    tb_empleado tb_empleado_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.tb_empleado
    ADD CONSTRAINT tb_empleado_pkey PRIMARY KEY (id_empleado);
 F   ALTER TABLE ONLY public.tb_empleado DROP CONSTRAINT tb_empleado_pkey;
       public            postgres    false    219            ?           2606    66718    tb_horario tb_horario_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tb_horario
    ADD CONSTRAINT tb_horario_pkey PRIMARY KEY (id_horario);
 D   ALTER TABLE ONLY public.tb_horario DROP CONSTRAINT tb_horario_pkey;
       public            postgres    false    221            ?           2606    66720    tb_reserva tb_reserva_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT tb_reserva_pkey PRIMARY KEY (id_reserva);
 D   ALTER TABLE ONLY public.tb_reserva DROP CONSTRAINT tb_reserva_pkey;
       public            postgres    false    223            ?           2606    66722 $   tb_tallaChaleco tb_tallaChaleco_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public."tb_tallaChaleco"
    ADD CONSTRAINT "tb_tallaChaleco_pkey" PRIMARY KEY (id_talla);
 R   ALTER TABLE ONLY public."tb_tallaChaleco" DROP CONSTRAINT "tb_tallaChaleco_pkey";
       public            postgres    false    225            ?           2606    66724 "   tb_tamanoBalon tb_tamanoBalon_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public."tb_tamanoBalon"
    ADD CONSTRAINT "tb_tamanoBalon_pkey" PRIMARY KEY (id_tamanobalon);
 P   ALTER TABLE ONLY public."tb_tamanoBalon" DROP CONSTRAINT "tb_tamanoBalon_pkey";
       public            postgres    false    227            ?           2606    66726    tb_tipoBalon tb_tipoBalon_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public."tb_tipoBalon"
    ADD CONSTRAINT "tb_tipoBalon_pkey" PRIMARY KEY (id_tipobalon);
 L   ALTER TABLE ONLY public."tb_tipoBalon" DROP CONSTRAINT "tb_tipoBalon_pkey";
       public            postgres    false    229            ?           2606    66728 $   tb_tipoEmpleado tb_tipoEmpleado_pkey 
   CONSTRAINT     s   ALTER TABLE ONLY public."tb_tipoEmpleado"
    ADD CONSTRAINT "tb_tipoEmpleado_pkey" PRIMARY KEY (id_tipoempleado);
 R   ALTER TABLE ONLY public."tb_tipoEmpleado" DROP CONSTRAINT "tb_tipoEmpleado_pkey";
       public            postgres    false    231            ?           2606    66730 "   tb_tipoHorario tb_tipoHorario_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public."tb_tipoHorario"
    ADD CONSTRAINT "tb_tipoHorario_pkey" PRIMARY KEY (id_tipohorario);
 P   ALTER TABLE ONLY public."tb_tipoHorario" DROP CONSTRAINT "tb_tipoHorario_pkey";
       public            postgres    false    233            ?           2606    66731    tb_reserva FK_asistencia    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_asistencia" FOREIGN KEY (id_asistencia) REFERENCES public.tb_asistencia(id_asistencia) NOT VALID;
 D   ALTER TABLE ONLY public.tb_reserva DROP CONSTRAINT "FK_asistencia";
       public          postgres    false    209    223    3240            ?           2606    66736    tb_reserva FK_cancha    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_cancha" FOREIGN KEY (id_cancha) REFERENCES public.tb_cancha(id_cancha) NOT VALID;
 @   ALTER TABLE ONLY public.tb_reserva DROP CONSTRAINT "FK_cancha";
       public          postgres    false    3242    223    211            ?           2606    66741    tb_reserva FK_chalecos    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_chalecos" FOREIGN KEY (id_chalecos) REFERENCES public.tb_chaleco(id_chaleco) NOT VALID;
 B   ALTER TABLE ONLY public.tb_reserva DROP CONSTRAINT "FK_chalecos";
       public          postgres    false    213    3244    223            ?           2606    66746    tb_reserva FK_cliente    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_cliente" FOREIGN KEY (id_cliente) REFERENCES public.tb_cliente(id_cliente) NOT VALID;
 A   ALTER TABLE ONLY public.tb_reserva DROP CONSTRAINT "FK_cliente";
       public          postgres    false    223    215    3246            ?           2606    66751    tb_chaleco FK_color    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_chaleco
    ADD CONSTRAINT "FK_color" FOREIGN KEY (id_colorchaleco) REFERENCES public."tb_colorChaleco"(id_color) NOT VALID;
 ?   ALTER TABLE ONLY public.tb_chaleco DROP CONSTRAINT "FK_color";
       public          postgres    false    213    3248    217            ?           2606    66756    tb_reserva FK_empleado    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_empleado" FOREIGN KEY (id_empleado) REFERENCES public.tb_empleado(id_empleado) NOT VALID;
 B   ALTER TABLE ONLY public.tb_reserva DROP CONSTRAINT "FK_empleado";
       public          postgres    false    219    223    3250            ?           2606    66761    tb_reserva FK_horario    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_horario" FOREIGN KEY (id_horario) REFERENCES public.tb_horario(id_horario) NOT VALID;
 A   ALTER TABLE ONLY public.tb_reserva DROP CONSTRAINT "FK_horario";
       public          postgres    false    223    221    3252            ?           2606    66766    tb_chaleco FK_talla    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_chaleco
    ADD CONSTRAINT "FK_talla" FOREIGN KEY (talla_chaleco) REFERENCES public."tb_tallaChaleco"(id_talla) NOT VALID;
 ?   ALTER TABLE ONLY public.tb_chaleco DROP CONSTRAINT "FK_talla";
       public          postgres    false    225    3256    213            ?           2606    66771    tb_tipoBalon FK_tamanoBalon    FK CONSTRAINT     ?   ALTER TABLE ONLY public."tb_tipoBalon"
    ADD CONSTRAINT "FK_tamanoBalon" FOREIGN KEY (id_tamanobalon) REFERENCES public."tb_tamanoBalon"(id_tamanobalon) NOT VALID;
 I   ALTER TABLE ONLY public."tb_tipoBalon" DROP CONSTRAINT "FK_tamanoBalon";
       public          postgres    false    227    3258    229            ?           2606    66776    tb_reserva FK_tipoBalon    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_reserva
    ADD CONSTRAINT "FK_tipoBalon" FOREIGN KEY (id_tipobalon) REFERENCES public."tb_tipoBalon"(id_tipobalon) NOT VALID;
 C   ALTER TABLE ONLY public.tb_reserva DROP CONSTRAINT "FK_tipoBalon";
       public          postgres    false    229    3260    223            ?           2606    66781    tb_empleado FK_tipoEmpleado    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_empleado
    ADD CONSTRAINT "FK_tipoEmpleado" FOREIGN KEY (id_tipoempleado) REFERENCES public."tb_tipoEmpleado"(id_tipoempleado) NOT VALID;
 G   ALTER TABLE ONLY public.tb_empleado DROP CONSTRAINT "FK_tipoEmpleado";
       public          postgres    false    231    3262    219            ?           2606    66786    tb_horario FK_tipoHorario    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tb_horario
    ADD CONSTRAINT "FK_tipoHorario" FOREIGN KEY (id_tipohorario) REFERENCES public."tb_tipoHorario"(id_tipohorario) NOT VALID;
 E   ALTER TABLE ONLY public.tb_horario DROP CONSTRAINT "FK_tipoHorario";
       public          postgres    false    3264    221    233            X      x?????? ? ?      Z      x?????? ? ?      \      x?????? ? ?      ^      x?????? ? ?      `      x?????? ? ?      b      x?????? ? ?      d      x?????? ? ?      f      x?????? ? ?      h      x?????? ? ?      j      x?????? ? ?      l      x?????? ? ?      n      x?3?,??/?????? ??      p      x?????? ? ?     