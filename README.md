# ZooParc

A PHP and MySQL website for a fictional zoological park. Visitors can browse animals and events, contact the park, and register as members, while admins get a dashboard to manage site content.

## Features

- **Public pages** - home, about, animals directory, contact form, and site-wide search
- **Member accounts** - registration and login (passwords hashed with `password_verify`)
- **Admin dashboard** - add, update, and delete events, education content, and other site data
- **MySQL-backed** - all content (animals, events, users) is stored in a database, with the schema included as a `.sql` dump

## Tech stack

- PHP (procedural, `mysqli`)
- MySQL
- HTML / CSS / vanilla JavaScript
- No frameworks - built from scratch for a web development module

## Project structure

```
zooparc/
├── about/              # About page
├── admin/              # Admin dashboard (events, education, uploads, login)
├── animals/             # Animals directory + validation
├── contact/             # Contact form
├── images/              # Site images
├── login/               # Member login / register / logout
├── index.php            # Home page
├── search.php            # Site search
├── script.js / style.css # Shared JS & styles
└── zooparc_db.sql        # Database schema (import this to set up the DB)
```

## Getting started

**Requirements:** PHP, MySQL, and a local server stack (e.g. XAMPP, MAMP, or `php -S`).

1. Import the database:
   ```bash
   mysql -u root -p < zooparc_db.sql
   ```
2. Check `admin/db_connect.php` matches your local MySQL setup (default is `root` with no password, database name `zooparc_db`):
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "zooparc_db";
   ```
3. Serve the project root with PHP, e.g.:
   ```bash
   php -S localhost:8000
   ```
4. Visit `http://localhost:8000/index.php` in your browser.

> The default DB credentials are for local development only - if you ever deploy this somewhere public, use a real username/password and don't commit them.

## License

No license specified - feel free to treat this as a personal portfolio/reference project.
