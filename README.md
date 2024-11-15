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

_____


O modelo GestaoFrota_Doctrine tenta utilizar o Doctrine 2, mas não consegui prosseguir devido a alguns problemas na configuração. Realizei várias pesquisas, mas ainda assim não consegui finalizar a configuração para integrá-lo corretamente ao projeto. Se possível, gostaria de receber um feedback sobre as configurações do Doctrine para entender onde pode ter faltado algum ajuste para que ele funcione 100%.
