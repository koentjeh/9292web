## Prerequisites

- Docker

## Getting started

Build Docker image
```
docker build -t 9292web .
```

Run Docker image
```
docker run -p 8181:8181 9292web
```

View webapplication @ http://localhost:8181