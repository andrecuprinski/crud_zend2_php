### Utilizado ambiente Docker executar o projeto

- Executar o Dockerfile
- Executar o comando: docker-compose up -d
- Acessar o container: docker exec -it zend-skeleton bash
- Acessar o diretório do projeto: cd /var/www/html
- Executar o comando: composer install

-----
## Estrutura do projeto

- /config: Arquivos de configuração
- /data: Arquivos de dados 
  - Contem as criaçãoes das tabelas no base de dados, e também tem inserts de dados pronto parar termos uma carga maior de dados para testar
- /module: Módulos do projeto
  - /Application:
    - /src
      - /Controller -> IndexController.php (Contém a lógica da tela /home (inicial) do projeto)
    - / view
      - /application
        - /index
          - index.phtml (Contém a view da tela /home (inicial) do projeto)
  
  - / GestaoFrota (Aqui contém toda a lógica do projeto)
    - /config
      - /module.config.php (Contém as rotas do projeto)
    - / Entity
      - / Veiculo.php (Contém a entidade Veiculo)
      - / Motorista.php (Contém a entidade Motorista)
    - / Model
      - / Veiculo.php (Contém a lógica de manipulação da entidade Veiculo)
      - / Motorista.php (Contém a lógica de manipulação da entidade Motorista)
    - / src
      - /GestaoFrota
        - /Controller
          - / VeiculoController.php (Contém a lógica da tela /veiculo)
          - / MotoristaController.php (Contém a lógica da tela /motorista)
        - / Service
          - / Veiculo.php (Contém a lógica de manipulação dos dados com a tabela Veiculo)
          - / Motorista.php (Contém a lógica de manipulação dos dados com a tabela Motorista)
        - / Helper
            - / format_helprs.php (Contem a formatacao do campo CPF, RG e Telegone para ficar mais apresentavel na view)
    - / view
      - / gestao-frota
        - / veiculo (Contem os layouts)
        - / motorista (Contem os layouts)
 - /public
   - /css (Contém os arquivos de estilo)
   - /js (Contém os arquivos de javascript)

------

O model GestaoFrota_Doctrine, tem uma tentativa de utilização do Doctrine 2, mas não consegui seguir,
pois tive alguns problemas ao configurar ele, realizei pesquisas, mas mesmo assim não consegui finalizar
a configuração dele para fluir no projeto, se for possível, gostaria de receber um feedback referente as configurações
do Doctrine para entender onde poderia ter faltado alguma configuração para fazer ele funcionar 100%