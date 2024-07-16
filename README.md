# Vote-X: An E-voting Web Application Based on Blockchain Technology

Vote-X was a web-based e-voting system that used blockchain technology to offer a decentralized and immutable ledger for securely storing and displaying election results that were tamper-proof.

## Features

- **User Authentication:** Secure user authentication to ensure that only authorized voters could vote.
- **MetaMask Verification:** MetaMask verification was implemented to prevent fraudulent registrations.
- **Candidate Registration:** Candidates were added and displayed for voters to see.
- **Adding Election Module:** Elections were created with a timed duration and expired after a certain time.
- **Voter Registration and Authentication:** Voters were registered using MetaMask to ensure they did not vote multiple times.
- **Voting Module:** Voters could vote for their respective candidates securely.

## Technologies Incorporated

- [Laravel](https://laravel.com/): Backend framework for building the application.
- [Node.js](https://nodejs.org/): Used for handling real-time features.
- [Composer](https://getcomposer.org/): Dependency manager for PHP.
- [NPM](https://www.npmjs.com/): Package manager for Node.js.
- [MetaMask](https://metamask.io/): Used to register voters and ensure that they did not vote multiple times.
- [Ganache](https://trufflesuite.com/ganache/): Provided a development environment for testing and deploying the smart contract.
- [Truffle](https://trufflesuite.com/truffle/): Development framework for Ethereum.

## Installation

### Prerequisites

- [PHP >= 8.0](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/)
- [MySQL Workbench](https://www.mysql.com/products/workbench/)
- [Git](https://git-scm.com/downloads)
- [MetaMask](https://metamask.io/download.html)
- [Ganache](https://trufflesuite.com/ganache/)
- [Truffle](https://trufflesuite.com/truffle/)

### Steps

#### 1. Clone the Repository

Run the command: 
```bash
git clone https://github.com/MICR-21/Vote-X.git
```

#### 2. Install PHP Dependencies
  
Run command: 
```bash
composer update
```

#### 3. Copy Environment File

Run the code: 
```bash
cp .env.example .env
```

#### 4. Generate Application Key

Use code: 
```bash
php artisan key:generate
```

#### 5. Install Node.js Dependencies

Use code: 
```bash
npm install
```

#### 6. Set Up Database

Create a database and update the `.env` file with your database credentials. Run migrations to set up the database tables.

Run migration code: 
```bash
php artisan migrate
```

#### 7. Installing MetaMask

- **Chrome:** Go to the [Chrome Web Store](https://chrome.google.com/webstore) and click 'Add to Chrome' and follow the instructions to install the extension.
- **Brave:** Go to settings to enable MetaMask since it was already built into the Brave browser.
- **Firefox:** Go to the [Firefox Add-ons Store](https://addons.mozilla.org/en-US/firefox/) and click 'Add to Firefox' and follow the instructions to install the extension.

##### 7.1 Set Up MetaMask

- Open the MetaMask extension in your browser.
- Click get started.
- If you had an existing wallet, you could import it using your seed phrase. Otherwise, create a new wallet by following the on-screen instructions.
- Securely store your seed phrase as it was crucial for wallet recovery.

#### 8. Installing and Running Ganache

To install Ganache, you could download it from the [Ganache website](https://trufflesuite.com/ganache/).

Or run the following command to install it:
```bash
npm install -g ganache-cli
```

To run Ganache, run the command:
```bash
ganache-cli
```
or if you were using the application, open the GUI application.

#### 9. Compile and Deploy Smart Contracts with Truffle

1. Install Truffle globally:
    ```bash
    npm install -g truffle
    ```
2. Compile the smart contracts:
    ```bash
    truffle compile
    ```
3. Deploy the smart contracts to the development network:
    ```bash
    truffle migrate
    ```
4. Run Truffle tests:
    ```bash
    truffle test
    ```

#### 10. Run the Application

Use code: 
```bash
php artisan serve
```

#### 11. Run Node.js Server

Use code: 
```bash
node server.js
```

#### 12. Build Frontend Assets

Use code:
```bash
npm run dev
```

### How to Access the Application

- **Register an account:** Visit the registration page and create an account.
- **Email Verification:** Verify your email by clicking on the link sent to your email address.
- **Login:** Log in to the application using your credentials.

## Contributions

To contribute, follow these steps:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
