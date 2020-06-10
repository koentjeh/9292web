
## Prerequisites

- Docker Desktop

- You need to update File Sharing configuration in your Docker for Windows app (there is a new security hardening in 2.2.0.0 which has agressive defaults). Add all folders you need and then restart Docker for Windows. *(Docker --> settings --> Resources --> File Sharing)*



## Build and run Docker containers

- Run `docker-compose up -d --build`

## View Project

- Open up your browser of choice to [http://localhost:8080](http://localhost:8080)

## Run Commands

Composer, NPM and Artisan each run their own container. Execute commands from the project root using:

- `docker-compose run --rm composer update`
- `docker-compose run --rm npm run dev`
- `docker-compose run --rm artisan migrate` 

Containers created and their ports (if used) are as follows:

- **nginx** - `:8080`
- **mysql** - `:3306`
- **php** - `:9000`
- **npm**
- **composer**
- **artisan**



