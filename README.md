
# Gestão de Frota 🚗

Uma aplicação desenvolvida para atender às necessidades de gestão de frota e condutores da **Roboplan**. Este projeto é também a minha Prova de Aptidão Profissional.

## Sobre o Projeto 🛠️

O objetivo é oferecer uma solução personalizada para a **EPEP Roboplan**, facilitando a gestão de:
- Revisões e manutenções;
- Requisição de veículos e condutores;
- Registro de abastecimentos e relatórios de avarias.

A aplicação utiliza tecnologias modernas como **Laravel**, **Vue.js**, **Vite** e **Docker**, garantindo desempenho, escalabilidade e facilidade de manutenção.

---

## Recursos Principais ✨
- 📅 **Agenda interativa** para requisição de veículos.
- 🚘 Gestão de **veículos** e seus dados.
- 👤 Registro e controle de **condutores**.
- 🔧 Gerenciamento de **manutenções e revisões**.
- ⛽ Registro de **abastecimentos**.
- ⚠️ Relatório de **avarias**.

---

## Tecnologias Utilizadas 🖥️

- **Vue.js 3**: Para criação de interfaces interativas e dinâmicas.  
- **Laravel 10**: Framework PHP robusto e eficiente para back-end.  
- **Inertia.js**: Permite criar aplicações de página única (_SPA_) sem APIs REST.  
- **Vite 5**: Ferramenta de _build_ moderna e rápida.  
- **Docker (Laravel Sail)**: Proporciona consistência no ambiente de desenvolvimento.  
- **DBeaver**: Gerenciamento de bases de dados.

---

## Configuração do Ambiente de Desenvolvimento ⚙️

Siga as etapas abaixo para configurar e executar o projeto localmente:

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/m0tay/gestao-de-frota.git
   ```

2. **Instale as dependências**:
   ```bash
   cd <endereço-do-projeto>
   npm install
   composer install
   ```

3. **Configure o ambiente**:
   Copie o arquivo `.env.example` e renomeie para `.env`. Edite as variáveis conforme necessário.

4. **Inicie o ambiente de desenvolvimento**:
   ```bash
   ./vendor/bin/sail up -d
   ```

5. **Execute migrações e _seeders_**:
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

---

## Contribuindo 💡

Contribuições são bem-vindas!  
Siga as diretrizes de contribuição antes de enviar um _pull request_ e certifique-se de que todos os testes locais passaram com sucesso.

---

## Licença 📜

Este projeto está licenciado sob a [Licença MIT](LICENSE).

---

Desenvolvido com ❤️ por [m0tay](https://github.com/m0tay).
