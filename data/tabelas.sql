CREATE SCHEMA gestao_frota;

-- Criação da tabela veiculos
CREATE TABLE veiculos (
    id_veiculo INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(7) NOT NULL,
    renavam VARCHAR(30),
    modelo VARCHAR(20) NOT NULL,
    marca VARCHAR(20) NOT NULL,
    ano INT NOT NULL,
    cor VARCHAR(20) NOT NULL
);

-- Criação da tabela motoristas
CREATE TABLE motoristas (
    id_motorista INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    rg VARCHAR(20) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    telefone VARCHAR(20),
    id_veiculo INT,
    CONSTRAINT fk_veiculo FOREIGN KEY (id_veiculo) REFERENCES veiculos(id_veiculo)
);
