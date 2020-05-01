DECLARE

OID_RAFAEL INTEGER;
OID_MANUEL INTEGER;
OID_DIEGO INTEGER;
OID_USER INTEGER;
OID_DOC INTEGER;
OID_ESP INTEGER;

BEGIN

INSERTAR_PACIENTE('RAFAEL', 'SALAS CASTIZO', '29530695Y',DATE '1999-04-14', 'rafasalas27@gmail.com','Sevilla','c/Trastamara n�19 3�B',DATE '2017-03-06','privado',null,nulL );
OID_RAFAEL := SEC_PACIENTE_OID.CURRVAL;
INSERTAR_PACIENTE('MANUEL', 'RUIZ DE LOPERA', '34567898R',DATE '1994-07-16', 'MRLOPERA@gmail.com','Sevilla','c/Gravina n�19',DATE '2015-03-06','privado',null,null);
OID_MANUEL := SEC_PACIENTE_OID.CURRVAL;
INSERTAR_PACIENTE('DIEGO', 'RODRIGUEZ CAMINO', '34564455H',DATE '1999-12-18', 'scoobydoo27@gmail.com','Mairena','c/Albufeira n�23',DATE '2016-03-06','privado',654323456,null);
OID_DIEGO := SEC_PACIENTE_OID.CURRVAL;
INSERTAR_USUARIO('ra.sacas@hotmail.com','pass');
OID_USER := SEC_USUARIO_OID.CURRVAL;
INSERTAR_ESPECIALIDAD('ESPECIALIDAD');
OID_ESP := SEC_ESPECIALIDAD_OID.CURRVAL;
INSERTAR_DOCTORA('MANUEL', 'RUIZ DE LOPERA', '34567898R',DATE '1994-07-16','Sevilla','c/Gravina n�19',DATE '2015-03-06','600000000',1200,'MV1',1);
OID_DOC := SEC_DOCTORA_OID.CURRVAL;
ACTUALIZAR_DOCTORA(1,'RAUL', 'RUIZ DE LOPERA', '34567898R',DATE '1994-07-16','Sevilla','c/Gravina n�19',DATE '2015-03-06','600000000',1200,1);
COMMIT;

END;