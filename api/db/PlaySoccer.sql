PGDMP     %    :        
        z         
   PlaySoccer    14.0    14.0 K    F           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            G           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            H           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            I           1262    50676 
   PlaySoccer    DATABASE     h   CREATE DATABASE "PlaySoccer" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE "PlaySoccer";
                postgres    false            �            1259    50734    tb_asistencia    TABLE     �   CREATE TABLE public.tb_asistencia (
    id_asistencia integer NOT NULL,
    confirmacion_asistencia character varying(50) NOT NULL
);
 !   DROP TABLE public.tb_asistencia;
       public         heap    postgres    false            �            1259    50733    tb_asistencia_id_asistencia_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_asistencia_id_asistencia_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public.tb_asistencia_id_asistencia_seq;
       public          postgres    false    226            J           0    0    tb_asistencia_id_asistencia_seq    SEQUENCE OWNED BY     c   ALTER SEQUENCE public.tb_asistencia_id_asistencia_seq OWNED BY public.tb_asistencia.id_asistencia;
          public          postgres    false    225            �            1259    50727 	   tb_cancha    TABLE     �   CREATE TABLE public.tb_cancha (
    id_cancha integer NOT NULL,
    numero_cancha integer NOT NULL,
    tamano_cancha character varying(50) NOT NULL,
    clasificacion_cancha character varying(50) NOT NULL
);
    DROP TABLE public.tb_cancha;
       public         heap    postgres    false            �            1259    50726    tb_cancha_id_cancha_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_cancha_id_cancha_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.tb_cancha_id_cancha_seq;
       public          postgres    false    224            K           0    0    tb_cancha_id_cancha_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.tb_cancha_id_cancha_seq OWNED BY public.tb_cancha.id_cancha;
          public          postgres    false    223            �            1259    50685 
   tb_cliente    TABLE     �  CREATE TABLE public.tb_cliente (
    id_cliente integer NOT NULL,
    nombre_cliente character varying(50) NOT NULL,
    apellido_cliente character varying(50) NOT NULL,
    dui_ciente character varying(10) NOT NULL,
    celular_cliente integer NOT NULL,
    correo_cliente character varying(100) NOT NULL,
    contrasena_cliente character varying(10) NOT NULL,
    foto_cliente character varying(50) NOT NULL
);
    DROP TABLE public.tb_cliente;
       public         heap    postgres    false            �            1259    50684    tb_cliente_id_cliente_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_cliente_id_cliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tb_cliente_id_cliente_seq;
       public          postgres    false    212            L           0    0    tb_cliente_id_cliente_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tb_cliente_id_cliente_seq OWNED BY public.tb_cliente.id_cliente;
          public          postgres    false    211            �            1259    50713    tb_empleado    TABLE     �  CREATE TABLE public.tb_empleado (
    id_empleado integer NOT NULL,
    nombre_empleado character varying(50) NOT NULL,
    apellido_empleado character varying(50) NOT NULL,
    dui_empleado character varying(10) NOT NULL,
    celular_empleado integer,
    contra_empleado character varying(10) NOT NULL,
    foto_empleado character varying(50) NOT NULL,
    id_tipoempleado integer NOT NULL
);
    DROP TABLE public.tb_empleado;
       public         heap    postgres    false            �            1259    50712    tb_empleado_id_empleado_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_empleado_id_empleado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.tb_empleado_id_empleado_seq;
       public          postgres    false    220            M           0    0    tb_empleado_id_empleado_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.tb_empleado_id_empleado_seq OWNED BY public.tb_empleado.id_empleado;
          public          postgres    false    219            �            1259    50692 
   tb_horario    TABLE     �   CREATE TABLE public.tb_horario (
    id_horario integer NOT NULL,
    hora_inicio time without time zone NOT NULL,
    hora_fin time without time zone NOT NULL,
    "id_tipoHorario" integer NOT NULL
);
    DROP TABLE public.tb_horario;
       public         heap    postgres    false            �            1259    50691    tb_horario_id_horario_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_horario_id_horario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.tb_horario_id_horario_seq;
       public          postgres    false    214            N           0    0    tb_horario_id_horario_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.tb_horario_id_horario_seq OWNED BY public.tb_horario.id_horario;
          public          postgres    false    213            �            1259    50678    tb_reservaCancha    TABLE     �  CREATE TABLE public."tb_reservaCancha" (
    id_reserva integer NOT NULL,
    fecha_reserva date NOT NULL,
    balones_alquilados integer NOT NULL,
    descripcion_asistencia character varying(200) NOT NULL,
    id_empleado integer NOT NULL,
    id_cancha integer NOT NULL,
    id_cliente integer NOT NULL,
    id_horario integer NOT NULL,
    id_asistencia integer NOT NULL,
    id_tipobalon integer NOT NULL
);
 &   DROP TABLE public."tb_reservaCancha";
       public         heap    postgres    false            �            1259    50677    tb_reservaCancha_id_reserva_seq    SEQUENCE     �   CREATE SEQUENCE public."tb_reservaCancha_id_reserva_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public."tb_reservaCancha_id_reserva_seq";
       public          postgres    false    210            O           0    0    tb_reservaCancha_id_reserva_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public."tb_reservaCancha_id_reserva_seq" OWNED BY public."tb_reservaCancha".id_reserva;
          public          postgres    false    209            �            1259    50706    tb_tipoBalon    TABLE     �   CREATE TABLE public."tb_tipoBalon" (
    "id_tipoBalon" integer NOT NULL,
    tipo_balon character varying(30) NOT NULL,
    costo_balon double precision NOT NULL,
    cantidad_balones integer
);
 "   DROP TABLE public."tb_tipoBalon";
       public         heap    postgres    false            �            1259    50705    tb_tipoBalon_id_tipoBalon_seq    SEQUENCE     �   CREATE SEQUENCE public."tb_tipoBalon_id_tipoBalon_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 6   DROP SEQUENCE public."tb_tipoBalon_id_tipoBalon_seq";
       public          postgres    false    218            P           0    0    tb_tipoBalon_id_tipoBalon_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public."tb_tipoBalon_id_tipoBalon_seq" OWNED BY public."tb_tipoBalon"."id_tipoBalon";
          public          postgres    false    217            �            1259    50720    tb_tipoEmpleado    TABLE     �   CREATE TABLE public."tb_tipoEmpleado" (
    "id_tipoEmpleado" integer NOT NULL,
    tipoempleado character varying(25) NOT NULL
);
 %   DROP TABLE public."tb_tipoEmpleado";
       public         heap    postgres    false            �            1259    50719 #   tb_tipoEmpleado_id_tipoEmpleado_seq    SEQUENCE     �   CREATE SEQUENCE public."tb_tipoEmpleado_id_tipoEmpleado_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 <   DROP SEQUENCE public."tb_tipoEmpleado_id_tipoEmpleado_seq";
       public          postgres    false    222            Q           0    0 #   tb_tipoEmpleado_id_tipoEmpleado_seq    SEQUENCE OWNED BY     q   ALTER SEQUENCE public."tb_tipoEmpleado_id_tipoEmpleado_seq" OWNED BY public."tb_tipoEmpleado"."id_tipoEmpleado";
          public          postgres    false    221            �            1259    50699    tb_tipoHorario    TABLE     �   CREATE TABLE public."tb_tipoHorario" (
    "id_tipoHorario" integer NOT NULL,
    tipohorario character varying(20) NOT NULL
);
 $   DROP TABLE public."tb_tipoHorario";
       public         heap    postgres    false            �            1259    50698 !   tb_tipoHorario_id_tipoHorario_seq    SEQUENCE     �   CREATE SEQUENCE public."tb_tipoHorario_id_tipoHorario_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public."tb_tipoHorario_id_tipoHorario_seq";
       public          postgres    false    216            R           0    0 !   tb_tipoHorario_id_tipoHorario_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public."tb_tipoHorario_id_tipoHorario_seq" OWNED BY public."tb_tipoHorario"."id_tipoHorario";
          public          postgres    false    215            �           2604    50737    tb_asistencia id_asistencia    DEFAULT     �   ALTER TABLE ONLY public.tb_asistencia ALTER COLUMN id_asistencia SET DEFAULT nextval('public.tb_asistencia_id_asistencia_seq'::regclass);
 J   ALTER TABLE public.tb_asistencia ALTER COLUMN id_asistencia DROP DEFAULT;
       public          postgres    false    225    226    226            �           2604    50730    tb_cancha id_cancha    DEFAULT     z   ALTER TABLE ONLY public.tb_cancha ALTER COLUMN id_cancha SET DEFAULT nextval('public.tb_cancha_id_cancha_seq'::regclass);
 B   ALTER TABLE public.tb_cancha ALTER COLUMN id_cancha DROP DEFAULT;
       public          postgres    false    223    224    224            �           2604    50688    tb_cliente id_cliente    DEFAULT     ~   ALTER TABLE ONLY public.tb_cliente ALTER COLUMN id_cliente SET DEFAULT nextval('public.tb_cliente_id_cliente_seq'::regclass);
 D   ALTER TABLE public.tb_cliente ALTER COLUMN id_cliente DROP DEFAULT;
       public          postgres    false    212    211    212            �           2604    50716    tb_empleado id_empleado    DEFAULT     �   ALTER TABLE ONLY public.tb_empleado ALTER COLUMN id_empleado SET DEFAULT nextval('public.tb_empleado_id_empleado_seq'::regclass);
 F   ALTER TABLE public.tb_empleado ALTER COLUMN id_empleado DROP DEFAULT;
       public          postgres    false    219    220    220            �           2604    50695    tb_horario id_horario    DEFAULT     ~   ALTER TABLE ONLY public.tb_horario ALTER COLUMN id_horario SET DEFAULT nextval('public.tb_horario_id_horario_seq'::regclass);
 D   ALTER TABLE public.tb_horario ALTER COLUMN id_horario DROP DEFAULT;
       public          postgres    false    213    214    214            �           2604    50681    tb_reservaCancha id_reserva    DEFAULT     �   ALTER TABLE ONLY public."tb_reservaCancha" ALTER COLUMN id_reserva SET DEFAULT nextval('public."tb_reservaCancha_id_reserva_seq"'::regclass);
 L   ALTER TABLE public."tb_reservaCancha" ALTER COLUMN id_reserva DROP DEFAULT;
       public          postgres    false    210    209    210            �           2604    50709    tb_tipoBalon id_tipoBalon    DEFAULT     �   ALTER TABLE ONLY public."tb_tipoBalon" ALTER COLUMN "id_tipoBalon" SET DEFAULT nextval('public."tb_tipoBalon_id_tipoBalon_seq"'::regclass);
 L   ALTER TABLE public."tb_tipoBalon" ALTER COLUMN "id_tipoBalon" DROP DEFAULT;
       public          postgres    false    217    218    218            �           2604    50723    tb_tipoEmpleado id_tipoEmpleado    DEFAULT     �   ALTER TABLE ONLY public."tb_tipoEmpleado" ALTER COLUMN "id_tipoEmpleado" SET DEFAULT nextval('public."tb_tipoEmpleado_id_tipoEmpleado_seq"'::regclass);
 R   ALTER TABLE public."tb_tipoEmpleado" ALTER COLUMN "id_tipoEmpleado" DROP DEFAULT;
       public          postgres    false    222    221    222            �           2604    50702    tb_tipoHorario id_tipoHorario    DEFAULT     �   ALTER TABLE ONLY public."tb_tipoHorario" ALTER COLUMN "id_tipoHorario" SET DEFAULT nextval('public."tb_tipoHorario_id_tipoHorario_seq"'::regclass);
 P   ALTER TABLE public."tb_tipoHorario" ALTER COLUMN "id_tipoHorario" DROP DEFAULT;
       public          postgres    false    215    216    216            C          0    50734    tb_asistencia 
   TABLE DATA           O   COPY public.tb_asistencia (id_asistencia, confirmacion_asistencia) FROM stdin;
    public          postgres    false    226   �_       A          0    50727 	   tb_cancha 
   TABLE DATA           b   COPY public.tb_cancha (id_cancha, numero_cancha, tamano_cancha, clasificacion_cancha) FROM stdin;
    public          postgres    false    224   �_       5          0    50685 
   tb_cliente 
   TABLE DATA           �   COPY public.tb_cliente (id_cliente, nombre_cliente, apellido_cliente, dui_ciente, celular_cliente, correo_cliente, contrasena_cliente, foto_cliente) FROM stdin;
    public          postgres    false    212   �_       =          0    50713    tb_empleado 
   TABLE DATA           �   COPY public.tb_empleado (id_empleado, nombre_empleado, apellido_empleado, dui_empleado, celular_empleado, contra_empleado, foto_empleado, id_tipoempleado) FROM stdin;
    public          postgres    false    220   �_       7          0    50692 
   tb_horario 
   TABLE DATA           Y   COPY public.tb_horario (id_horario, hora_inicio, hora_fin, "id_tipoHorario") FROM stdin;
    public          postgres    false    214   `       3          0    50678    tb_reservaCancha 
   TABLE DATA           �   COPY public."tb_reservaCancha" (id_reserva, fecha_reserva, balones_alquilados, descripcion_asistencia, id_empleado, id_cancha, id_cliente, id_horario, id_asistencia, id_tipobalon) FROM stdin;
    public          postgres    false    210   4`       ;          0    50706    tb_tipoBalon 
   TABLE DATA           c   COPY public."tb_tipoBalon" ("id_tipoBalon", tipo_balon, costo_balon, cantidad_balones) FROM stdin;
    public          postgres    false    218   Q`       ?          0    50720    tb_tipoEmpleado 
   TABLE DATA           L   COPY public."tb_tipoEmpleado" ("id_tipoEmpleado", tipoempleado) FROM stdin;
    public          postgres    false    222   �`       9          0    50699    tb_tipoHorario 
   TABLE DATA           I   COPY public."tb_tipoHorario" ("id_tipoHorario", tipohorario) FROM stdin;
    public          postgres    false    216   �`       S           0    0    tb_asistencia_id_asistencia_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.tb_asistencia_id_asistencia_seq', 1, false);
          public          postgres    false    225            T           0    0    tb_cancha_id_cancha_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.tb_cancha_id_cancha_seq', 1, false);
          public          postgres    false    223            U           0    0    tb_cliente_id_cliente_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tb_cliente_id_cliente_seq', 1, false);
          public          postgres    false    211            V           0    0    tb_empleado_id_empleado_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.tb_empleado_id_empleado_seq', 1, false);
          public          postgres    false    219            W           0    0    tb_horario_id_horario_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tb_horario_id_horario_seq', 1, false);
          public          postgres    false    213            X           0    0    tb_reservaCancha_id_reserva_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public."tb_reservaCancha_id_reserva_seq"', 1, false);
          public          postgres    false    209            Y           0    0    tb_tipoBalon_id_tipoBalon_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public."tb_tipoBalon_id_tipoBalon_seq"', 1, true);
          public          postgres    false    217            Z           0    0 #   tb_tipoEmpleado_id_tipoEmpleado_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public."tb_tipoEmpleado_id_tipoEmpleado_seq"', 2, true);
          public          postgres    false    221            [           0    0 !   tb_tipoHorario_id_tipoHorario_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public."tb_tipoHorario_id_tipoHorario_seq"', 1, false);
          public          postgres    false    215            �           2606    50739     tb_asistencia tb_asistencia_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.tb_asistencia
    ADD CONSTRAINT tb_asistencia_pkey PRIMARY KEY (id_asistencia);
 J   ALTER TABLE ONLY public.tb_asistencia DROP CONSTRAINT tb_asistencia_pkey;
       public            postgres    false    226            �           2606    50732    tb_cancha tb_cancha_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tb_cancha
    ADD CONSTRAINT tb_cancha_pkey PRIMARY KEY (id_cancha);
 B   ALTER TABLE ONLY public.tb_cancha DROP CONSTRAINT tb_cancha_pkey;
       public            postgres    false    224            �           2606    50690    tb_cliente tb_cliente_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tb_cliente
    ADD CONSTRAINT tb_cliente_pkey PRIMARY KEY (id_cliente);
 D   ALTER TABLE ONLY public.tb_cliente DROP CONSTRAINT tb_cliente_pkey;
       public            postgres    false    212            �           2606    50718    tb_empleado tb_empleado_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.tb_empleado
    ADD CONSTRAINT tb_empleado_pkey PRIMARY KEY (id_empleado);
 F   ALTER TABLE ONLY public.tb_empleado DROP CONSTRAINT tb_empleado_pkey;
       public            postgres    false    220            �           2606    50697    tb_horario tb_horario_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tb_horario
    ADD CONSTRAINT tb_horario_pkey PRIMARY KEY (id_horario);
 D   ALTER TABLE ONLY public.tb_horario DROP CONSTRAINT tb_horario_pkey;
       public            postgres    false    214            �           2606    50683 &   tb_reservaCancha tb_reservaCancha_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public."tb_reservaCancha"
    ADD CONSTRAINT "tb_reservaCancha_pkey" PRIMARY KEY (id_reserva);
 T   ALTER TABLE ONLY public."tb_reservaCancha" DROP CONSTRAINT "tb_reservaCancha_pkey";
       public            postgres    false    210            �           2606    50711    tb_tipoBalon tb_tipoBalon_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public."tb_tipoBalon"
    ADD CONSTRAINT "tb_tipoBalon_pkey" PRIMARY KEY ("id_tipoBalon");
 L   ALTER TABLE ONLY public."tb_tipoBalon" DROP CONSTRAINT "tb_tipoBalon_pkey";
       public            postgres    false    218            �           2606    50725 $   tb_tipoEmpleado tb_tipoEmpleado_pkey 
   CONSTRAINT     u   ALTER TABLE ONLY public."tb_tipoEmpleado"
    ADD CONSTRAINT "tb_tipoEmpleado_pkey" PRIMARY KEY ("id_tipoEmpleado");
 R   ALTER TABLE ONLY public."tb_tipoEmpleado" DROP CONSTRAINT "tb_tipoEmpleado_pkey";
       public            postgres    false    222            �           2606    50704 "   tb_tipoHorario tb_tipoHorario_pkey 
   CONSTRAINT     r   ALTER TABLE ONLY public."tb_tipoHorario"
    ADD CONSTRAINT "tb_tipoHorario_pkey" PRIMARY KEY ("id_tipoHorario");
 P   ALTER TABLE ONLY public."tb_tipoHorario" DROP CONSTRAINT "tb_tipoHorario_pkey";
       public            postgres    false    216            �           2606    50760    tb_reservaCancha FK_asistencia    FK CONSTRAINT     �   ALTER TABLE ONLY public."tb_reservaCancha"
    ADD CONSTRAINT "FK_asistencia" FOREIGN KEY (id_asistencia) REFERENCES public.tb_asistencia(id_asistencia) NOT VALID;
 L   ALTER TABLE ONLY public."tb_reservaCancha" DROP CONSTRAINT "FK_asistencia";
       public          postgres    false    210    3230    226            �           2606    50765    tb_reservaCancha FK_balon    FK CONSTRAINT     �   ALTER TABLE ONLY public."tb_reservaCancha"
    ADD CONSTRAINT "FK_balon" FOREIGN KEY (id_tipobalon) REFERENCES public."tb_tipoBalon"("id_tipoBalon") NOT VALID;
 G   ALTER TABLE ONLY public."tb_reservaCancha" DROP CONSTRAINT "FK_balon";
       public          postgres    false    218    3222    210            �           2606    50745    tb_reservaCancha FK_cancha    FK CONSTRAINT     �   ALTER TABLE ONLY public."tb_reservaCancha"
    ADD CONSTRAINT "FK_cancha" FOREIGN KEY (id_cancha) REFERENCES public.tb_cancha(id_cancha) NOT VALID;
 H   ALTER TABLE ONLY public."tb_reservaCancha" DROP CONSTRAINT "FK_cancha";
       public          postgres    false    224    210    3228            �           2606    50750    tb_reservaCancha FK_cliente    FK CONSTRAINT     �   ALTER TABLE ONLY public."tb_reservaCancha"
    ADD CONSTRAINT "FK_cliente" FOREIGN KEY (id_cliente) REFERENCES public.tb_cliente(id_cliente) NOT VALID;
 I   ALTER TABLE ONLY public."tb_reservaCancha" DROP CONSTRAINT "FK_cliente";
       public          postgres    false    210    3216    212            �           2606    50740    tb_reservaCancha FK_empleado    FK CONSTRAINT     �   ALTER TABLE ONLY public."tb_reservaCancha"
    ADD CONSTRAINT "FK_empleado" FOREIGN KEY (id_empleado) REFERENCES public.tb_empleado(id_empleado) NOT VALID;
 J   ALTER TABLE ONLY public."tb_reservaCancha" DROP CONSTRAINT "FK_empleado";
       public          postgres    false    220    210    3224            �           2606    50755    tb_reservaCancha FK_horario    FK CONSTRAINT     �   ALTER TABLE ONLY public."tb_reservaCancha"
    ADD CONSTRAINT "FK_horario" FOREIGN KEY (id_horario) REFERENCES public.tb_horario(id_horario) NOT VALID;
 I   ALTER TABLE ONLY public."tb_reservaCancha" DROP CONSTRAINT "FK_horario";
       public          postgres    false    214    210    3218            �           2606    50770    tb_empleado FK_tipoEmpleado    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_empleado
    ADD CONSTRAINT "FK_tipoEmpleado" FOREIGN KEY (id_empleado) REFERENCES public."tb_tipoEmpleado"("id_tipoEmpleado") NOT VALID;
 G   ALTER TABLE ONLY public.tb_empleado DROP CONSTRAINT "FK_tipoEmpleado";
       public          postgres    false    222    3226    220            �           2606    50775    tb_horario FK_tipoHorario    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_horario
    ADD CONSTRAINT "FK_tipoHorario" FOREIGN KEY (id_horario) REFERENCES public."tb_tipoHorario"("id_tipoHorario") NOT VALID;
 E   ALTER TABLE ONLY public.tb_horario DROP CONSTRAINT "FK_tipoHorario";
       public          postgres    false    216    3220    214            C      x������ � �      A      x������ � �      5      x������ � �      =      x������ � �      7      x������ � �      3      x������ � �      ;   '   x�3�t+-I��Q�;�+7�(_���T�Ҕӂ+F��� �Ce      ?   $   x�3�tL����,.)JL�/�2���/����� ��'      9      x������ � �     