INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(1,'João','Antônio','1994-10-02','11856810607',4700.00,'Dentista');
INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(2,'Larissa','Carvalho','1992-08-29','31622058681',4700.00,'Dentista');
INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(3,'Anna Paula','Figueiredo','1987-10-12','14031864647',4800.00,'Dentista');
INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(4,'Renan','Fonseca','1982-11-01','29281171058',2400.00,'Auxiliar');
INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(5,'Luiza','Andrade','1979-01-12','38394735002',2300.00,'Auxiliar');
INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(6,'Daniela','Alcântara','1992-08-23','33164908091',2400.00,'Auxiliar');
INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(7,'Julia','Ferraz','1959-10-22','72840389002',1250.00,'Recepcionista');
INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(8,'Sabrina','Silva','1969-05-23','42667139089',1250.00,'Recepcionista');
INSERT INTO clinica_odontologica.funcionario (id,nome,sobrenome,nascimento,cpf,salario,cargo) VALUES
(9,'Rodrigo','Amaral','1992-03-28','22263483012',7000.00,'Administrador');


INSERT INTO clinica_odontologica.plano_dentario (id,nome,desconto) VALUES
(1,'Nenhum',0);
INSERT INTO clinica_odontologica.plano_dentario (id,nome,desconto) VALUES
(2,'Silver',20.0);
INSERT INTO clinica_odontologica.plano_dentario (id,nome,desconto) VALUES
(3,'Gold',35.0);
INSERT INTO clinica_odontologica.plano_dentario (id,nome,desconto) VALUES
(4,'Platinum',50.0);


INSERT INTO clinica_odontologica.paciente (id,nome,sobrenome,nascimento,cpf,plano_dentario_id) VALUES
(1,'Samuel','Nunes','1972-06-12','06098750009',2);
INSERT INTO clinica_odontologica.paciente (id,nome,sobrenome,nascimento,cpf,plano_dentario_id) VALUES
(2,'Samira','Luange','1998-02-19','17503953047',3);
INSERT INTO clinica_odontologica.paciente (id,nome,sobrenome,nascimento,cpf,plano_dentario_id) VALUES
(3,'Roberto','Siqueira','1984-10-21','58973322079',4); 
INSERT INTO clinica_odontologica.paciente (id,nome,sobrenome,nascimento,cpf,plano_dentario_id) VALUES
(4,'Clara','Nogueira','2000-03-01','17332270080',1);


INSERT INTO clinica_odontologica.dentista (funcionario_id,cro) VALUES
(1,'00001');
INSERT INTO clinica_odontologica.dentista (funcionario_id,cro) VALUES 
(2,'00002');
INSERT INTO clinica_odontologica.dentista (funcionario_id,cro) VALUES 
(3,'00003');


INSERT INTO clinica_odontologica.auxiliar (funcionario_id) VALUES
(4);
INSERT INTO clinica_odontologica.auxiliar (funcionario_id) VALUES 
(5);
INSERT INTO clinica_odontologica.auxiliar (funcionario_id) VALUES
(6);

INSERT INTO clinica_odontologica.recepcionista (funcionario_id,nome_usuario,senha) VALUES
(7,'juliaf','5f6955d227a320c7f1f6c7da2a6d96a851a8118f');
INSERT INTO clinica_odontologica.recepcionista (funcionario_id,nome_usuario,senha) VALUES
(8,'sabrinas','5f6955d227a320c7f1f6c7da2a6d96a851a8118f');

INSERT INTO clinica_odontologica.administrador (funcionario_id,nome_usuario,senha) VALUES
(9,'rodrigoa','5f6955d227a320c7f1f6c7da2a6d96a851a8118f');


INSERT INTO clinica_odontologica.especialidade (nome) VALUES
('Ortodontista');
INSERT INTO clinica_odontologica.especialidade (nome) VALUES
('Cirurgião');
INSERT INTO clinica_odontologica.especialidade (nome) VALUES
('Endodontista');

INSERT INTO clinica_odontologica.dentista_has_especialidade (dentista_id,especialidade_nome) VALUES
(1,'ortodontista');
INSERT INTO clinica_odontologica.dentista_has_especialidade (dentista_id,especialidade_nome) VALUES 
(2,'endodontista');
INSERT INTO clinica_odontologica.dentista_has_especialidade (dentista_id,especialidade_nome) VALUES
(3,'cirurgião');


INSERT INTO clinica_odontologica.auxiliar_auxilia_dentista (dentista_id,auxiliar_id) VALUES
(1,4);
INSERT INTO clinica_odontologica.auxiliar_auxilia_dentista (dentista_id,auxiliar_id) VALUES
(2,5);
INSERT INTO clinica_odontologica.auxiliar_auxilia_dentista (dentista_id,auxiliar_id) VALUES
(3,6);


INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(1,'Água 09/18','2018-09-13',78.25,'Despesa Geral','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(2,'Energia 09/18','2018-09-17',483.32,'Despesa Geral','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(3,'Salários 09/18','2018-09-01',30800.00,'Despesa com Funcionário','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(4,'Outros 09/18','2018-09-30',312.65,'Despesa Geral','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(5,'Água 10/18','2018-10-13',82.13,'Despesa Geral','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(6,'Energia 10/18','2018-10-17',441.79,'Despesa Geral','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(7,'Salários 10/18','2018-10-01',30800.00,'Despesa com Funcionário','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(8,'Outros 10/18','2018-10-30',320.81,'Despesa Geral','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
 (9,'Água 11/18','2018-11-13',80.96,'Despesa Geral','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(10,'Energia 11/18','2018-11-17',560.25,'Despesa Geral','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(11,'Salários 11/18','2018-11-01',30800.00,'Despesa com Funcionário','Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(12,'Outros 11/18','2018-11-30',331.85,'Despesa Geral','Não Pago',9);
INSERT INTO clinica_odontologica.despesa (id,nome,data,valor,tipo,situacao,administrador_id) VALUES
(13,'Salários 12/18','2018-12-01',30800.00,'Despesa com Funcionário','Não Pago',9);


INSERT INTO clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(1,1,1,'2018-09-25','15:00:00',160.0,'Pago','Colocar aparelho');
INSERT INTO clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(2,1,2,'2018-10-12','16:00:00',1200.0,'Pago','Implante');
INSERT into clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(3,1,3,'2018-11-20','14:00:00',48.0,'Não Pago','Checkup');
INSERT INTO clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(4,2,1,'2018-05-22','15:00:00',130.0,'Pago','Colocar aparelho');
INSERT INTO clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(5,2,2,'2018-06-18','16:00:00',975.0,'Pago','Implante');
INSERT into clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(6,2,3,'2018-07-20','14:00:00',39.0,'Pago','Checkup');
INSERT INTO clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(7,3,1,'2018-08-01','15:00:00',100.0,'Pago','Colocar aparelho');
INSERT INTO clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(8,3,2,'2018-10-13','16:00:00',750.0,'Pago','Implante');
INSERT into clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(9,3,3,'2018-11-10','14:00:00',30.0,'Não Pago','Checkup');
INSERT INTO clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(10,4,1,'2018-01-25','15:00:00',200.0,'Pago','Colocar aparelho');
INSERT INTO clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(11,4,2,'2018-02-12','16:00:00',1500.0,'Pago','Implante');
INSERT into clinica_odontologica.dentista_consulta_paciente (id,paciente_id,dentista_id,data,horario,valor,situacao,operacao) VALUES
(12,4,3,'2018-03-20','14:00:00',60.0,'Pago','Checkup');



INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(1,200.0,'2018-01-25','Dinheiro',7,4);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(2,1500.0,'2018-02-12','Débito',8,4);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(3,60.0,'2018-03-20','Crédito',7,4);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(4,200.0,'2018-05-22','Dinheiro',8,2);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES 
(5,1500.0,'2018-06-18','Débito',7,2);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(6,60.0,'2018-07-20','Crédito',8,2);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(7,200.0,'2018-08-01','Dinheiro',7,3);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(8,200.0,'2018-09-25','Débito',8,1);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(9,1500.0,'2018-10-12','Crédito',7,1);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(10,1500.0,'2018-10-13','Dinheiro',8,3);
INSERT INTO clinica_odontologica.recebimento (id,valor,data,modo_pagamento,recepcionista_id,paciente_id) VALUES
(11,100000.0,'2018-01-01','Dinheiro',7,3);