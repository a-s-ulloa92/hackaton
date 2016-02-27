CREATE TABLE Alumno (
  idAlumno INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  login VARCHAR(15) NULL,
  apass VARCHAR(20) NULL,
  listener BOOL NULL,
  PRIMARY KEY(idAlumno)
);

CREATE TABLE Examen (
  idExamen INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Maestro_idMaestro INTEGER UNSIGNED NOT NULL,
  fechaIni DATE NULL,
  fechaFin DATE NULL,
  clave VARCHAR(15) NULL,
  PRIMARY KEY(idExamen),
  INDEX Examen_FKIndex1(Maestro_idMaestro)
);

CREATE TABLE Maestro (
  idMaestro INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  login VARCHAR(15) NULL,
  mpass VARCHAR(20) NULL,
  PRIMARY KEY(idMaestro)
);

CREATE TABLE Preguntas (
  idPreguntas INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  Examen_idExamen INTEGER UNSIGNED NOT NULL,
  r1 VARCHAR(255) NULL,
  r2 VARCHAR(255) NULL,
  r3 VARCHAR(255) NULL,
  r4 VARCHAR(255) NULL,
  nPregunta INTEGER UNSIGNED NULL,
  texto VARCHAR(255) NULL,
  PRIMARY KEY(idPreguntas),
  INDEX Preguntas_FKIndex1(Examen_idExamen)
);

CREATE TABLE Preguntas_has_Alumno (
  Preguntas_idPreguntas INTEGER UNSIGNED NOT NULL,
  Alumno_idAlumno INTEGER UNSIGNED NOT NULL,
  opcion INTEGER UNSIGNED NULL,
  PRIMARY KEY(Preguntas_idPreguntas, Alumno_idAlumno),
  INDEX Preguntas_has_Alumno_FKIndex1(Preguntas_idPreguntas),
  INDEX Preguntas_has_Alumno_FKIndex2(Alumno_idAlumno)
);


