# MovieVault

MovieVault is a single-user **Movie Catalogue & Review Manager** built with **Laravel 10** using the MVC architectural pattern.

The application allows movies to be organised into categories, reviewed, filtered, and validated using an external API.

---

## Project Features

### Static Pages
- Home page
- About page

### Dynamic Pages
- Categories listing and details
- Movies listing and details
- Reviews per movie

---

## Relationships (1-to-Many)

The project implements the following required relationships:

- **Category → Movies**
- **Movie → Reviews**

Each category can contain multiple movies, and each movie can have multiple reviews.

---

## CRUD Functionality

Full Create, Read, Update, and Delete (CRUD) functionality is implemented for:

- Categories
- Movies
- Reviews

All operations are handled through controllers, views, and routes following MVC principles.

---

## SEO-Friendly URLs

SEO-friendly URLs are implemented using **slugs**:

- Categories: `/categories/{slug}`
- Movies: `/movies/{slug}`

Slugs are generated automatically and enforced to be unique.

---

## Filtering and Sorting

Movies can be:

- Filtered by category
- Sorted by title or release year

Filtering and sorting logic is handled in controllers and rendered using Blade views and partials.

---

## External API Validation (OMDb)

The project integrates the **OMDb API** as part of form validation when creating or updating a movie.

When a movie is added:

- The OMDb API verifies that the movie exists
- The movie’s **release year** is automatically populated
- Invalid movie titles or IMDb IDs are rejected

This satisfies the assignment requirement for using an external API.

---

## Date Watched

Instead of manually entering a release year:

- Users enter an optional **date watched**
- The release year is retrieved automatically from OMDb

---

## Technology Stack

- Laravel 10
- PHP 8+
- MySQL
- Blade Templates
- Bootstrap (CRUD-based UI)
- OMDb API

---

## How to Run the Project

1. Clone the repository

2. Install dependencies:
   ```bash
   composer install
   npm install
   npm run build
3. Copy the environment file:
   ```bash
   cp .env.example .env
4. Configure database credentials in the .env file
5. Generate application key:
   ```bash
   php artisan key:generate
6. Run Migrations:
   ```bash
   php artisan migrate
7. Start the Server
   ```bash
   php artisan serve
---
