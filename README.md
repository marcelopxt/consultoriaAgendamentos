# Sistema de Agendamentos para Consultoria

Um sistema CRUD (Create, Read, Update, Delete) simples para gerenciar agendamentos de uma consultoria, desenvolvido em PHP puro com banco de dados MySQL. Este projeto foi criado como solução para um desafio prático de desenvolvimento web.

## Funcionalidades

- **Listagem de Agendamentos:** Visualização clara de agendamentos futuros e passados.
- **Criação de Novos Agendamentos:** Formulário para adicionar novos compromissos.
- **Edição de Agendamentos:** Permite alterar os dados de um agendamento existente.
- **Exclusão de Agendamentos:** Remove um agendamento com um pop-up de confirmação para segurança.
- **Busca Dinâmica:** Filtra os agendamentos por título ou nome do cliente.
- **Validação de Dados:** Impede que um agendamento seja criado com uma data final anterior à data inicial.
- **Interface Responsiva:** Utiliza Bootstrap 5 para uma experiência agradável em desktops e dispositivos móveis.

## Tecnologias Utilizadas

- **Backend:** PHP 8+ (Puro, usando o servidor embutido)
- **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
- **Framework CSS:** Bootstrap 5
- **Banco de Dados:** MySQL

## Instruções de Instalação e Uso

Siga os passos abaixo para rodar o projeto em seu ambiente local.

### Pré-requisitos

- **PHP 8+** instalado em sua máquina e disponível no terminal (PATH do sistema).
- Um servidor **MySQL** rodando (pode ser via Docker, XAMPP, WAMP, etc.).
- [Git](https://git-scm.com/) instalado.

### Instalação

1.  **Clone o Repositório**
    Abra seu terminal ou prompt de comando, navegue até o diretório onde deseja salvar o projeto e execute o comando:
    ```bash
    git clone https://github.com/marcelopxt/consultoriaAgendamentos.git
    ```

2.  **Acesse a Pasta do Projeto**
    ```bash
    cd Consultoria_agendamentos
    ```

3.  **Crie e Popule o Banco de Dados**
    - Certifique-se de que seu servidor MySQL está rodando.
    - Usando seu cliente de banco de dados, importe o arquivo `db.sql` que está na raiz do projeto.
    - Este script irá criar o banco de dados `dbconsultoria`, a tabela `tb_agendamento` e inserir alguns dados de exemplo.

4.  **Configure a Conexão**
    - Abra o arquivo `config/Connection.php` em um editor de código como o VS Code.
    - **Ajuste as variáveis** `$host`, `$dbname`, `$username`, `$password` e a porta (`$mysql_port`) para corresponder às credenciais do seu servidor MySQL.

### Uso

1.  **Inicie o Servidor Embutido do PHP**
    Com o terminal aberto na raiz do projeto, execute o seguinte comando:
    ```bash
    php -S localhost:8000
    ```

2.  **Acesse a Aplicação**
    - Abra seu navegador web.
    - Acesse a URL: `http://localhost:8000`

## Imagens
<table align="center">
  <tr>
    <td colspan="2" align="center">
      <strong>Tela Principal</strong>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <img src="https://github.com/user-attachments/assets/4b555f99-1490-43fd-8833-0a76813ee8d9" alt="Tela Principal da Aplicação" width="80%">
    </td>
  </tr>
  
  <tr>
    <td align="center"><strong>Formulário de Criação</strong></td>
    <td align="center"><strong>Formulário de Edição (com dados preenchidos)</strong></td>
  </tr>
  <tr>
    <td align="center">
      <img src="https://github.com/user-attachments/assets/fe115c78-caf0-4d3b-8ee6-9bfca237bd97" alt="Tela de Criação de Agendamento" width="100%">
    </td>
    <td align="center">
      <img src="https://github.com/user-attachments/assets/b5fe1d92-b239-44e1-8452-2c96bc08886a" alt="Tela de Edição de Agendamento" width="100%">
    </td>
  </tr>
</table>

