/*Criação do banco*/
CREATE DATABASE nucleo_estagio;
ALTER DATABASE nucleo_estagio CHARSET = UTF8 COLLATE = utf8_general_ci;

/*Criação das tabelas*/ 

CREATE TABLE nucleo_estagio.curso (
	curso_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    curso VARCHAR(45) NOT NULL,
    total_h_complement INT UNSIGNED NOT NULL,
    total_h_estagio INT UNSIGNED NOT NULL,
    PRIMARY KEY (curso_id)  
);

CREATE TABLE nucleo_estagio.aluno (
	aluno_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    matricula VARCHAR(9) NOT NULL UNIQUE,
    curso_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(aluno_id),
    FOREIGN KEY (curso_id) REFERENCES nucleo_estagio.curso (curso_id)
);

CREATE TABLE nucleo_estagio.estagio (
	estagio_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    contrato VARCHAR(45) NOT NULL,
    #status_relatorio VARCHAR(45) NOT NULL,
    #classifi_relatorio VARCHAR(45) NOT NULL,
    num_doc_convenio BIGINT(15) UNSIGNED,
    data_registro DATE NOT NULL,
    aluno_aluno_id INT UNSIGNED NOT NULL,
	PRIMARY KEY (estagio_id),
    FOREIGN KEY (aluno_aluno_id) REFERENCES nucleo_estagio.aluno (aluno_id)
);

CREATE TABLE nucleo_estagio.relatorio_de_estagio (
	relatorio_de_estagi_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    classificacao VARCHAR(45) NOT NULL,
    status_relatorio VARCHAR(45) NOT NULL,
    data_entrega DATE NOT NULL,
    estagio_estagio_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (relatorio_de_estagi_id),
    FOREIGN KEY (estagio_estagio_id) REFERENCES nucleo_estagio.estagio (estagio_id)
);


CREATE TABLE nucleo_estagio.horas_complementares (
	horas_complementares_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    evento VARCHAR(50) NOT NULL,
    entidade VARCHAR(45) NOT NULL,
    data_ocorrencia DATE NOT NULL,
    carga_horaria INT UNSIGNED NOT NULL,
    aluno_aluno_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (horas_complementares_id),
    FOREIGN KEY (aluno_aluno_id) REFERENCES nucleo_estagio.aluno(aluno_id)
);

CREATE TABLE nucleo_estagio.login_aluno (
	login_aluno_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    cpf BIGINT(11) UNSIGNED NOT NULL,
    senha VARCHAR(50) NOT NULL,
    aluno_aluno_id INT UNSIGNED NOT NULL ,
	PRIMARY KEY (login_aluno_id),
    FOREIGN KEY (aluno_aluno_id) REFERENCES nucleo_estagio.aluno(aluno_id)
);

CREATE TABLE nucleo_estagio.funcionario(
	funcionario_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    cod_funcio INT UNSIGNED,
    PRIMARY KEY (funcionario_id)
);

CREATE TABLE nucleo_estagio.login_funcionario (
	login_funcionario_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(50) NOT NULL,
	funcionario_funcionario_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (login_funcionario_id),
    FOREIGN KEY (funcionario_funcionario_id) REFERENCES nucleo_estagio.funcionario (funcionario_id)
);



/*Inserções da tabela curso*/
/*INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('', , );*/
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Admistrção', 240, 340);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Análise e Desevolvimento de Sistemas', 200, 160);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Arquitura e Urbanismo', 300, 300);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Ciências Contábeis', 240, 360);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Comunicação Social', 244, 360);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Publicidade e Propaganda', 244, 360);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Direito', 360, 360);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Educação Física', 210, 400);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Enfermagem', 200, 800);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Engenharia de Produção', 300, 300);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Engenharia Mecânica', 300, 300);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Fisioterapia', 200, 920);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('História', 200, 430);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Pedagogia', 200, 400);
INSERT INTO nucleo_estagio.curso (curso, total_h_complement, total_h_estagio) VALUES ('Psicologia', 360, 650);


/*Função para contar a quantidade de alunos cadastrados*/
USE nucleo_estagio;
DELIMITER $
CREATE PROCEDURE qtd_alunos_cadast()
BEGIN
	SELECT COUNT(aluno_id) FROM nucleo_estagio.aluno;
END $
DELIMITER ;

/*CALL qtd_alunos_cadast();*/ #ESTA É A CHAMADA DA FUNÇÃO ACIMA, ESTÁ COMENTADA SOMENTE PARA NÃO RODAR JUNTO AO CÓDIGO NA HORA DE CRIAR O BANCO.



/*Função para contar a quantidade de funcionários cadastrados*/
DELIMITER $
CREATE PROCEDURE qtd_funcio_cadast()
BEGIN
	SELECT COUNT(funcionario_id) FROM nucleo_estagio.funcionario;
END $
DELIMITER ;


/*CALL qtd_funcio_cadast();*/ #ESTA É A CHAMADA DA FUNÇÃO ACIMA, ESTÁ COMENTADA SOMENTE PARA NÃO RODAR JUNTO AO CÓDIGO NA HORA DE CRIAR O BANCO.


/*Função para calcular a quantidade de horas complementares*/
DELIMITER $
CREATE PROCEDURE soma_horas(id_aluno INT(10))
BEGIN
	SELECT 
		SUM(carga_horaria) AS 'Quantidade de horas'
	FROM
		nucleo_estagio.horas_complementares
    WHERE
		id_aluno = aluno_aluno_id;
END $
DELIMITER ;

/*CALL soma_horas((Necessita de parâmetro));*/ #ESTA É A CHAMADA DA FUNÇÃO ACIMA, ESTÁ COMENTADA SOMENTE PARA NÃO RODAR JUNTO AO CÓDIGO NA HORA DE CRIAR O BANCO.
