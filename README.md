<a name="readme-top"></a>

<!-- PROJETO LOGO -->
<br />
<div align="center">
  <a href="https://github.com/Tiago-Alves-dos-Santos/Covid19">
    <img src="public/img/favicon/list_100.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">MyList</h3>

  <p align="center">
    ToDoList. Sistema de criar lista de tarefas
  </p>

  [![portfolio][portfolio-shield]][portfolio-url]
  [![linkedin][linkedin-shield]][linkedin-url]
</div>




<!-- MENU -->
<details>
  <summary>MENU</summary>
  <ol>
    <li>
      <a href="#sobre">Sobre</a>
    </li>
    <li><a href="#funcionalidades">Funcionalidades</a></li>
    <li><a href="#tecnologias-utilizadas">Tecnologias Utilizadas</a></li>
    <li><a href="#instalação">Instalação</a></li>
    <li><a href="#versão-atual">Versão atual</a></li>
    <li><a href="#licença">Licença</a></li>
    <li><a href="#contato">Contato</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## Sobre
O sistema como finalidade demonstrar o uso de autenticação de dois fatores com multiguards usando o 'packpage fortify' do laravel 

<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>

<!-- FUNCIONALIDADES -->
## Funcionalidades

- [x] CRUD de tarefas
- [x] Controle de usuários
- [x] Controle de administradores
- [x] Impressão PDF de tarefas
- [x] Dashboard(básico)
- [x] Dados fakes e seed
    
<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>

## Tecnologias Utilizadas
1. FRONT-END
    * HTML 5
    * CSS 3
    * BOOTSTRAP ^5.2.3
    * BLADE (separado do vue)
    * VUE 3
    * NODE 18.17.1 (LTS)
    * NPM 9.6.7
2. BACK-END
    * PHP 8.1.9
    * LARAVEL 9
    * INERTIA ^0.6.9
3. DATABASE
    * PGSQL



<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>

<!-- GETTING STARTED -->
## Instalação

1. Certifique-se de ter instalado na sua máquina o php e node(npm) correto, se usa docker verficar a imagem
2. Clone do Projeto
    ~~~shell
    git clone <repo_url> -b <b_name or tag_name>
    ~~~
3. Duplique o arquivo `.env.example` e retire o `.example`
4. Configure as variaveis de conexao com o banco de dados
5. Instalar pacotes 
    ~~~shell
    composer install 
    ~~~
6. Caso queira fazer mudanças, com vite
    ~~~shell
    npm install && npm run dev
    ~~~ 
7. Gerar chave aplicação 
   ~~~ shell
    php artisan key:generate 
   ~~~ 
8. Rodar as migrations, com seed e fakers
   ~~~ shell
    php artisan migrate --seed
   ~~~ 
9. Execute servidor
    ~~~shell
    php artisan serve
    ~~~


<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>




## Versão atual
:heavy_check_mark:  v1.1.0-alpha


<!-- LICENÇA -->
## Licença
Licença MIT.

<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>



<!-- CONTACT -->
## Contato
Tiago Alves dos Santos

Formas de contato: 
<br>

[![Whatsapp][whatsapp-shield]][whatsapp-url]
[![Telegram][telegram-shield]][telegram-url]

<p align="right">(<a href="#readme-top">Voltar ao topo</a>)</p>

<!-- MARKDOWN LINKS BADGES -->
[whatsapp-shield]: https://img.shields.io/badge/WhatsApp-25D366?style=for-the-badge&logo=whatsapp&logoColor=white
[whatsapp-url]: https://wa.link/h5vlzo
[telegram-shield]: https://img.shields.io/badge/Telegram-2CA5E0?style=for-the-badge&logo=telegram&logoColor=white
[telegram-url]: https://t.me/TiagoAlves2001
[linkedin-shield]: https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white
[linkedin-url]: https://www.linkedin.com/in/tiago-alves-96699a189/
[portfolio-shield]: https://img.shields.io/badge/PORTFOLIO-%20CLIQUE%20AQUI%20-%20BLACK
[portfolio-url]: https://wa.link/h5vlzo

