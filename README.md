<p align="center">
    <a href="https://sylius.com" target="_blank">
        <picture>
          <img alt="Sylius Logo" src="https://media.sylius.com/sylius-logo-800.png" height="100">
        </picture>
    </a>
    <a href="https://commerceweavers.com" target="_blank">
        <picture>
          <img alt="CW Logo" height="100" src="https://github.com/CommerceWeavers/SyliusWorkshopWarsaw24/blob/main/assets/images/cw-logo.png?raw=true">
        </picture>
    </a>
</p>

<h1 align="center">Sylius Workshop Warsaw 24'</h1>

<p align="center">This is repository for Sylius Fundamentals workshop that took place in Warsaw on 16th of May 2024</p>

## Installation

### Traditional
```bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar create-project sylius/sylius-standard project
$ cd project
$ yarn install
$ yarn build
$ php bin/console sylius:install
$ symfony serve
$ open http://localhost:8000/
```

For more detailed instruction please visit [installation chapter in our docs](https://docs.sylius.com/en/latest/book/installation/installation.html).

### Docker

#### Development

Make sure you have installed [Docker](https://docs.docker.com/get-docker/) on your local machine.
Execute `make init` in your favorite terminal and wait some time until the services will be ready.
Then enter `localhost` in your browser or execute `open localhost` in your terminal.
