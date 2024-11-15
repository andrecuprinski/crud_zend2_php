/**
  DADOS GENERICOS PARA SEREM UTILIZADOS A FIM DE TESTE PARA AS CONSULTAS SQL
 */

--insere dados de veiculos
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('ABC1234', '123456789012345', 'Fusca', 'Volkswagen', 1975, 'Azul');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES('DEF5678', '234567890123456', 'Civic', 'Honda', 2020, 'Preto');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('GHI9101', '345678901234567', 'Corolla', 'Toyota', 2022, 'Branco');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('JKL1122', '456789012345678', 'Fiesta', 'Ford', 2018, 'Vermelho');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('MNO3344', '567890123456789', 'Sandero', 'Renault', 2019, 'Prata');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('PQR5566', '678901234567890', 'Onix', 'Chevrolet', 2021, 'Azul');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('STU7788', '789012345678901', 'Polo', 'Volkswagen', 2023, 'Verde');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('VWX9900', '890123456789012', 'Kicks', 'Nissan', 2020, 'Cinza');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('YZA2233', '901234567890123', 'Gol', 'Volkswagen', 2017, 'Amarelo');
INSERT INTO veiculos (placa, renavam, modelo, marca, ano, cor) VALUES ('BCD4455', '012345678901234', 'HB20', 'Hyundai', 2016, 'Branco');

--insere dados de motoristas
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Carlos Silva', '123456789', '12345678901', '1234-5678', 1);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Ana Souza', '987654321', '98765432100', '9876-5432', 2);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('João Pereira', '112233445', '11223344556', '4567-8901', 3);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Mariana Oliveira', '223344556', '22334455667', '5678-1234', 4);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Lucas Costa', '334455667', '33445566778', '6789-2345', 5);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Patrícia Almeida', '445566778', '44556677889', '7890-3456', 6);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Rafael Santos', '556677889', '55667788990', '8901-4567', 7);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Juliana Lima', '667788990', '66778899001', '9012-5678', 8);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Eduardo Rocha', '778899001', '77889900112', '0123-6789', 9);
INSERT INTO motoristas (nome, rg, cpf, telefone, id_veiculo) VALUES ('Fernanda Martins', '889900112', '88990011223', '1234-7890', 10);