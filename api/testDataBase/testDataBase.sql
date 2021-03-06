toc.dat                                                                                             0000600 0004000 0002000 00000014135 14177753643 0014464 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP       5                    z            js    12.2    13.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                    0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                    0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                    1262    156165    js    DATABASE     _   CREATE DATABASE js WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Russian_Russia.1251';
    DROP DATABASE js;
                postgres    false         ?            1259    156166 	   candidate    TABLE     ?  CREATE TABLE public.candidate (
    id_candidate integer NOT NULL,
    profession character varying(100) NOT NULL,
    city character varying(100) NOT NULL,
    photo character varying(255),
    tel numeric(11,0) NOT NULL,
    full_name character varying(150) NOT NULL,
    email character varying(150) NOT NULL,
    birthday date NOT NULL,
    wage numeric NOT NULL,
    skills text NOT NULL,
    about text NOT NULL,
    status character varying(150) NOT NULL
);
    DROP TABLE public.candidate;
       public         heap    postgres    false         ?            1259    156172    candidate_id_candidate_seq    SEQUENCE     ?   CREATE SEQUENCE public.candidate_id_candidate_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.candidate_id_candidate_seq;
       public          postgres    false    202                    0    0    candidate_id_candidate_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.candidate_id_candidate_seq OWNED BY public.candidate.id_candidate;
          public          postgres    false    203         ?            1259    156174 	   education    TABLE       CREATE TABLE public.education (
    id_educ integer NOT NULL,
    id_candidate integer,
    degree character varying(25) NOT NULL,
    education_university character varying(255),
    faculty character varying(255),
    specialization character varying(255),
    year_end integer
);
    DROP TABLE public.education;
       public         heap    postgres    false         ?            1259    156180    education_id_educ_seq    SEQUENCE     ?   CREATE SEQUENCE public.education_id_educ_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.education_id_educ_seq;
       public          postgres    false    204                    0    0    education_id_educ_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.education_id_educ_seq OWNED BY public.education.id_educ;
          public          postgres    false    205         ?
           2604    156182    candidate id_candidate    DEFAULT     ?   ALTER TABLE ONLY public.candidate ALTER COLUMN id_candidate SET DEFAULT nextval('public.candidate_id_candidate_seq'::regclass);
 E   ALTER TABLE public.candidate ALTER COLUMN id_candidate DROP DEFAULT;
       public          postgres    false    203    202         ?
           2604    156183    education id_educ    DEFAULT     v   ALTER TABLE ONLY public.education ALTER COLUMN id_educ SET DEFAULT nextval('public.education_id_educ_seq'::regclass);
 @   ALTER TABLE public.education ALTER COLUMN id_educ DROP DEFAULT;
       public          postgres    false    205    204                   0    156166 	   candidate 
   TABLE DATA           ?   COPY public.candidate (id_candidate, profession, city, photo, tel, full_name, email, birthday, wage, skills, about, status) FROM stdin;
    public          postgres    false    202       2830.dat           0    156174 	   education 
   TABLE DATA           {   COPY public.education (id_educ, id_candidate, degree, education_university, faculty, specialization, year_end) FROM stdin;
    public          postgres    false    204       2832.dat            0    0    candidate_id_candidate_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.candidate_id_candidate_seq', 62, true);
          public          postgres    false    203                    0    0    education_id_educ_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.education_id_educ_seq', 20, true);
          public          postgres    false    205         ?
           2606    156185    candidate pk_candidate 
   CONSTRAINT     ^   ALTER TABLE ONLY public.candidate
    ADD CONSTRAINT pk_candidate PRIMARY KEY (id_candidate);
 @   ALTER TABLE ONLY public.candidate DROP CONSTRAINT pk_candidate;
       public            postgres    false    202         ?
           2606    156187    education pk_education 
   CONSTRAINT     Y   ALTER TABLE ONLY public.education
    ADD CONSTRAINT pk_education PRIMARY KEY (id_educ);
 @   ALTER TABLE ONLY public.education DROP CONSTRAINT pk_education;
       public            postgres    false    204         ?
           1259    156188    education_pk    INDEX     L   CREATE UNIQUE INDEX education_pk ON public.education USING btree (id_educ);
     DROP INDEX public.education_pk;
       public            postgres    false    204         ?
           1259    156189    have_fk    INDEX     E   CREATE INDEX have_fk ON public.education USING btree (id_candidate);
    DROP INDEX public.have_fk;
       public            postgres    false    204         ?
           2606    156190 $   education fk_educatio_have_candidate    FK CONSTRAINT     ?   ALTER TABLE ONLY public.education
    ADD CONSTRAINT fk_educatio_have_candidate FOREIGN KEY (id_candidate) REFERENCES public.candidate(id_candidate) ON UPDATE RESTRICT ON DELETE RESTRICT;
 N   ALTER TABLE ONLY public.education DROP CONSTRAINT fk_educatio_have_candidate;
       public          postgres    false    204    202    2698                                                                                                                                                                                                                                                                                                                                                                                                                                           2830.dat                                                                                            0000600 0004000 0002000 00000002227 14177753643 0014272 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Начальник Службы Безопасности	Воронеж	https://st.depositphotos.com/1049680/2502/i/950/depositphotos_25025655-stock-photo-portrait-of-happy-mature-man.jpg	82542223433	Соратников Михаил Борисович	soRat@google.ru	1967-07-05	160000	Защита, задержание, управление личным составом	Выслуга 15 лет	Новое резюме
61	Разработчик AI	Москва	https://st2.depositphotos.com/1743476/11581/i/950/depositphotos_115812486-stock-photo-pride-man-smiling.jpg	89912384	Семецкий Семён Фёдорович	SemSem@gmail.com	1990-01-11	340000	mysql, postgresql, python, django, c++, c#	Думаю о том, как думаю машины за вас	Назначено собеседование
57	Басс-Гитарист	Панино-Липецкое	https://cs5.pikabu.ru/images/big_size_comm/2014-04_5/1398276190149.jpg	9802676543	Мартынов Максим Антольевич	MMA@ya.ru	1988-10-04	44000	Могу много, но покажу подробно на собеседовании	Типичный Бассист	Отказ
\.


                                                                                                                                                                                                                                                                                                                                                                         2832.dat                                                                                            0000600 0004000 0002000 00000000514 14177753643 0014271 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        19	61	Высшее	МГТУ им. Н. Э. Баумана	Информатики	Исследование Искусственного Интелекта	2005
9	57	Среднее	\N	\N	\N	\N
20	1	Среднее специальное	ВИ МВД РФ\r\n	Защиты и Противоействия	Полицейский	1987
\.


                                                                                                                                                                                    restore.sql                                                                                         0000600 0004000 0002000 00000013062 14177753643 0015407 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 13.2

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

DROP DATABASE js;
--
-- Name: js; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE js WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Russian_Russia.1251';


ALTER DATABASE js OWNER TO postgres;

\connect js

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
-- Name: candidate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.candidate (
    id_candidate integer NOT NULL,
    profession character varying(100) NOT NULL,
    city character varying(100) NOT NULL,
    photo character varying(255),
    tel numeric(11,0) NOT NULL,
    full_name character varying(150) NOT NULL,
    email character varying(150) NOT NULL,
    birthday date NOT NULL,
    wage numeric NOT NULL,
    skills text NOT NULL,
    about text NOT NULL,
    status character varying(150) NOT NULL
);


ALTER TABLE public.candidate OWNER TO postgres;

--
-- Name: candidate_id_candidate_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.candidate_id_candidate_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.candidate_id_candidate_seq OWNER TO postgres;

--
-- Name: candidate_id_candidate_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.candidate_id_candidate_seq OWNED BY public.candidate.id_candidate;


--
-- Name: education; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.education (
    id_educ integer NOT NULL,
    id_candidate integer,
    degree character varying(25) NOT NULL,
    education_university character varying(255),
    faculty character varying(255),
    specialization character varying(255),
    year_end integer
);


ALTER TABLE public.education OWNER TO postgres;

--
-- Name: education_id_educ_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.education_id_educ_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.education_id_educ_seq OWNER TO postgres;

--
-- Name: education_id_educ_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.education_id_educ_seq OWNED BY public.education.id_educ;


--
-- Name: candidate id_candidate; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.candidate ALTER COLUMN id_candidate SET DEFAULT nextval('public.candidate_id_candidate_seq'::regclass);


--
-- Name: education id_educ; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.education ALTER COLUMN id_educ SET DEFAULT nextval('public.education_id_educ_seq'::regclass);


--
-- Data for Name: candidate; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.candidate (id_candidate, profession, city, photo, tel, full_name, email, birthday, wage, skills, about, status) FROM stdin;
\.
COPY public.candidate (id_candidate, profession, city, photo, tel, full_name, email, birthday, wage, skills, about, status) FROM '$$PATH$$/2830.dat';

--
-- Data for Name: education; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.education (id_educ, id_candidate, degree, education_university, faculty, specialization, year_end) FROM stdin;
\.
COPY public.education (id_educ, id_candidate, degree, education_university, faculty, specialization, year_end) FROM '$$PATH$$/2832.dat';

--
-- Name: candidate_id_candidate_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.candidate_id_candidate_seq', 62, true);


--
-- Name: education_id_educ_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.education_id_educ_seq', 20, true);


--
-- Name: candidate pk_candidate; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.candidate
    ADD CONSTRAINT pk_candidate PRIMARY KEY (id_candidate);


--
-- Name: education pk_education; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.education
    ADD CONSTRAINT pk_education PRIMARY KEY (id_educ);


--
-- Name: education_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX education_pk ON public.education USING btree (id_educ);


--
-- Name: have_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX have_fk ON public.education USING btree (id_candidate);


--
-- Name: education fk_educatio_have_candidate; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.education
    ADD CONSTRAINT fk_educatio_have_candidate FOREIGN KEY (id_candidate) REFERENCES public.candidate(id_candidate) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              