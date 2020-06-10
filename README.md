
## Prerequisites

- Docker Desktop
- You need to update File Sharing configuration in your Docker for Windows app (there is a new security hardening in 2.2.0.0 which has agressive defaults). Add all folders you need and then restart Docker for Windows. *(Docker --> settings --> Resources --> File Sharing)*

## Build and run Docker containers

- Copy and rename `src/.env.example` to `src/.env`
- Add your API KEY to `NS_API_KEY=` in your .env file ([NS API-Portaal](https://apiportal.ns.nl/))
- Run `docker-compose up -d --build`

## Run Commands

Composer, NPM and Artisan each run their isolated container and handle commands without having to have these platforms installed on your local computer. Execute commands from the project root using:

- **REQUIRED** `docker-compose run --rm composer update`
- **REQUIRED** `docker-compose run --rm npm install`
- **REQUIRED** `docker-compose run --rm artisan key:generate` 

## View Project

- Open up your browser of choice to [http://localhost:8080](http://localhost:8080)

## Containers

Containers created and their ports (if used) are as follows:

- **nginx** - `:8080`
- **mysql** - `:3306`
- **php** - `:9000`
- **npm**
- **composer**
- **artisan**



