# Kvest Room 

## Installation

1. Clone repository

    ```sh
    $ git clone https://github.com/Dimaskao/kvest-room.git
    ```
2. Install dependencies

    ```sh
    $ docker-compose exec php-fpm composer install
    ```

3. Configure database connection

    ```sh
    $ mv .env .env.local
    ```
   
4. Create and run docker containers

    ```sh
    $ docker-compose up -d --build
    ```
   
5. Create a database and run migrations

    ```sh
    $ docker-compose exec php-fpm bash
    $ ./bin/console doctrine:database:create
    $ ./bin/console doctrine:migrations:migrate
    ```    

## Using composer
Install composer dependencies
```sh
$ docker-compose exec php-fpm composer require <dependence>
```  
## Code style fixer

To check the code style just run the following command


```bash
$ docker-compose exec php-fpm composer cs-check
```


to fix the code style run next command

```bash
$ docker-compose exec php-fpm composer cs-fix
```

Tests
-----

To run unit tests just run the following command

```bash
$ docker-compose exec php-fpm ./bin/phpunit
```