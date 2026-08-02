# Team Submission Workflow

A Laravel 10 application for authenticated teams to create submissions, track versions, and discuss each version through comments. Laravel Breeze provides user authentication, while Backpack supplies administrative CRUD screens.

## Requirements

- PHP 8.1 or newer with the extensions required by Laravel
- Composer 2
- Node.js 18 or newer and npm
- MySQL, PostgreSQL, or SQLite

## Setup

```sh
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

Configure the database and mail settings in `.env` before migrating. On Unix-like systems, use `cp` instead of `copy`.

## Test

```sh
php artisan test
```

The feature tests cover team ownership, membership authorization, submission creation with an initial version, private submission access, and version comments, in addition to the Laravel Breeze authentication suite.

## Domain model

- A user belongs to many teams through `team_user`, with an `owner` or `member` role.
- A team owns many submissions.
- A submission owns ordered versions and has a workflow status.
- A submission version owns comments authored by users.
- Team membership is checked before viewing a team, creating or viewing submissions, and posting comments.

## Current limitations

The application creates metadata-only versions; binary file upload and durable object storage are not implemented. Team invitations, role management, submission status transitions, notifications, and explicit policies are also future work. Do not present those capabilities as complete until their authorization rules and tests exist.
