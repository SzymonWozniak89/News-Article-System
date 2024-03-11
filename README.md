News Article System
==============================

Requirements
------------

  * PHP 8.2.0 or higher;
  * PDO-MySQL PHP extension enabled;
  * Composer;
  * Docker (optional)

Installation
------------

**Option 1. (Docker and Symfony CLI)** 

Run this commands on your computer:

```bash
composer install

docker compose up -d

symfony server:start -d --no-tls
```

**Option 2. (External MySQL server)** 

Run this commands on your computer:

```bash
composer install

# load database dump file: news_articles_system.sql
# update .env file accordingly

symfony server:start -d --no-tls
```

Usage
-----
**WebApp**

Access the application in your browser at the given URL (<http://127.0.0.1:8000/news>).

**API**

Use this URL's in your favorite API client.
- Get article by some id: GET <http://127.0.0.1:8000/api/news/{id}>
- Get all articles for given author: GET <http://127.0.0.1:8000/api/news/author/{author_name}>
- Get top 3 authors that wrote the most articles last week: GET <http://127.0.0.1:8000/api/author/top>
