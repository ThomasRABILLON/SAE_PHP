-- Generated by Mocodo 4.2.1
DROP TABLE IF EXISTS ALBUMS;
DROP TABLE IF EXISTS ARTISTES;
DROP TABLE IF EXISTS A_GENRE;
DROP TABLE IF EXISTS EST_DANS;
DROP TABLE IF EXISTS GENRE;
DROP TABLE IF EXISTS PLAYLIST;
DROP TABLE IF EXISTS SUIT;
DROP TABLE IF EXISTS UTILISATEURS;


CREATE TABLE UTILISATEURS (
  id_user NUMBER PRIMARY KEY NOT NULL,
  nom VARCHAR(42),
  prenom VARCHAR(42),
  date_naissance VARCHAR(42),
  mdp VARCHAR(42)
);

CREATE TABLE ARTISTES (
  id_art NUMBER PRIMARY KEY NOT NULL,
  nom_de_scene VARCHAR(42),
  nom VARCHAR(42),
  prenom VARCHAR(42)
);

CREATE TABLE GENRE (
  libelle_genre PRIMARY KEY VARCHAR(42)
);

CREATE TABLE ALBUMS (
  id_album NUMBER PRIMARY KEY NOT NULL,
  title VARCHAR(42),
  release_date DATE,
  img BLOB,
  id_art NUMBER NOT NULL,
  FOREIGN KEY (id_art) REFERENCES ARTISTES (id_art)
);

CREATE TABLE PLAYLIST (
  id_playlist NUMBER PRIMARY KEY NOT NULL,
  nom VARCHAR(42),
  id_user VARCHAR(42) NOT NULL,
  FOREIGN KEY (id_user) REFERENCES UTILISATEURS (id_user)
);

CREATE TABLE A_GENRE (
  id_album NUMBER NOT NULL,
  libelle_genre NUMBER NOT NULL,
  PRIMARY KEY (id_album, libelle_genre),
  FOREIGN KEY (id_album) REFERENCES ALBUMS (id_album),
  FOREIGN KEY (libelle_genre) REFERENCES GENRE (libelle_genre)
);

CREATE TABLE EST_DANS (
  id_playlist NUMBER NOT NULL,
  id_album NUMBER NOT NULL,
  PRIMARY KEY (id_playlist, id_album),
  FOREIGN KEY (id_playlist) REFERENCES PLAYLIST (id_playlist),
  FOREIGN KEY (id_album) REFERENCES ALBUMS (id_album)
);

CREATE TABLE SUIT (
  id_art NUMBER NOT NULL,
  id_user NUMBER NOT NULL,
  PRIMARY KEY (id_art, id_user),
  FOREIGN KEY (id_art) REFERENCES ARTISTES (id_art),
  FOREIGN KEY (id_user) REFERENCES UTILISATEURS (id_user)
);
