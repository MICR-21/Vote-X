# Vote-X: An E-voting Web Application Based on Blockchain Technology

Vote-x is a web-based e-voting system that uses blockchain technology, which offers a decentralized and immutable ledger, to the electronic voting system to securely store, display election results that are tamper proof.

## Features

- User Authentication: Secure user authentication to ensure that only authorized voters can vote.

- Email Verification: Email verification is implemented to prevent fraudulent registrations.

## Technologies Incorporated

- Laravel: Backend framework for building the application.
- Node.js: Used for handling real-time features.
- Composer: Dependency manager for PHP.
- NPM: Package manager for Node.js.

## Installation

### Prerequisites

- PHP >= 10.48.10
- Composer
- Node.js
- MySQL Workbench
- Git

### STEPS

#### 1. Clone the Repository

Run the command: git clone <https://github.com/MICR-21/Vote-X.git>

#### 2. Install PHP Dependancies
  
Run command: composer update

#### 3. Copy environment file

run the code: cp .env.example .env

#### 4. Generate application key

Use code: php artisan key:generate

#### 5. Install Node.js dependencies

Use code: npm install

#### 6. Set up database

Create a database and update the .env file with your database credentials.
Run migrations to set up the database tables.

Run migration code: php artisan migrate

#### 7. Run the application

Use code: php artisan serve

#### 8. Run Node.js server

use code: node server.js

### How to Access the Application

- Register an account: Visit the registration page and create an account.

- Email Verification: Verify your email by clicking on the link sent to your email address.
- Login: Log in to the application using your credentials.
- Contributions:
To contribute, follow these steps below:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
