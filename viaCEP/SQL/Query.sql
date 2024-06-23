CREATE TABLE IF NOT EXISTS cep (
    idCep INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    cep BIGINT NOT NULL,
    logradouro VARCHAR(50) NOT NULL,
    complemento VARCHAR(50) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    localidade VARCHAR(50) NOT NULL,
    uf CHAR(2) NOT NULL,
    ibge BIGINT NOT NULL,
    ddd CHAR(2) NOT NULL 
);