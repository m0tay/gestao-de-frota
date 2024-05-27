![Roboplan company](https://img.interempresas.net/fotos/3353727.jpeg)

# Gestão de Frota

A aplicação Gestão de Frota é um aplicação desenvolvida para atender às necessidades da empresa Roboplan, também sendo a minha Prova de Aptidão Profissional.

## Sobre o projeto

O objetivo deste projeto é prover uma soluação sob medida à EPEP Roboplan para gerir sua frota e condutores, por meio gestão e registo de revisões, requisição de veículos para serviços, veículos e condutores e os seus dados pertinentes. Alavancando com tecnologias modernas e reconhecidas pelo mercado como os _frameworks_ Laravel, Vue.js e o _build tool_ Vite.

## Recursos

- Agenda interativa para requisição de veículos;
- Gestão e registo de condutores e veículos;
- Gestão e registo de manutenções e revisões;
- Registo de abastecimentos;
- Relatar avarias;

## Uso pretendido

A aplicação ainda é embrionária e, no momento, visa-se a utilização apenas pela EPEP Roboplan. Destarte, a aplicação é feita à medida da EPEP para maior eficiência e satisfação.

## Desenvolvimento

Desenvolvi a aplicação Gestão de Frota utilizando uma combinação de tecnologias avançadas e modernas, assegurando um desempenho robusto e eficiente. No núcleo do desenvolvimento, utilizei os _frameworks_ Laravel (10.x) e Vue.js (3.x), conhecidos pela sua flexibilidade e poder de criação de interfaces ricas e interativas. Além disso, para garantir uma integração perfeita entre o front-end e o back-end, recorri ao Inertia.js (1.x), uma biblioteca que facilita a construção de aplicações monolíticas de página única (SPA) sem a complexidade habitual.

Para a gestão de recursos e a compilação de código, optei pelo Vite (5.x), uma ferramenta de _build_ extremamente rápida que melhora significativamente o tempo de desenvolvimento. E para assegurar que a aplicação pode ser executada em qualquer ambiente, de forma consistente e isolada, utilizei o Docker, permitindo-me criar contêineres que replicam com precisão o ambiente de produção.

Estas escolhas tecnológicas não só aumentaram a eficiência do processo de desenvolvimento, mas também garantiram que a aplicação Gestão de Frota é altamente escalável, fácil de manter e adaptável às necessidades futuras.

### Tecnologias utilizadas

- Vue.js 3: Um _framework_ progressivo para construir interfaces de utilizador.
- Laravel 10: Um _framework_ PHP para o desenvolvimento de aplicações web.
- Inertia: Uma biblioteca que permite construir aplicações de página única (SPAs) sem a necessidade de APIs REST.
- Vite: Uma ferramenta de _build_ de nova geração para projetos web modernos.
- Docker (Laravel Sail): Facilita a configuração e execução do ambiente de desenvolvimento.
- DBeaver: Ferramenta de gestão de bases de dados utilizada durante o desenvolvimento.

## Configurando o ambiente de desenvolvimento

Para configurar o ambiente de desenvolvimento e executar o projeto localmente, siga as etapas abaixo:

1. Clone este repositório em seu ambiente de desenvolvimento:
   
```bash
git clone https://github.com/m0tay/gestao-de-frota.git
```

2. Instale dependências de front-end e back-end:
   
```bash
cd <endereço-do-projeto>
npm install
composer install
```

3. Copie o arquivo de exemplo .env.example e renomeie-o para .env. Configure as variáveis ​​de ambiente conforme necessário.

4. Inicie o ambiente de desenvolvimento usando Docker (Laravel Sail):

```bash
./vendor/bin/sail up -d
```

5. Execute migrações e propagadores de banco de dados:
```bash
./vendor/bin/sail artisan migrate --seed
```

## Contribuindo
Se você quiser contribuir com melhorias ou correções para o projeto, sinta-se à vontade para enviar pull requests. Antes de enviar uma solicitação pull, certifique-se de seguir as diretrizes de contribuição e garantir que os testes locais foram executados com sucesso.

## Licença
Este projeto está licenciado sob a licença MIT.
