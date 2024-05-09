
# Laravel Project Setup

This README provides the necessary steps to get your Laravel application running for the first time. Please follow these steps carefully to ensure everything works as expected.

## Prerequisites

Before you start, ensure you have `composer` and `npm` installed on your system. These will be needed for setting up the dependencies.

## Installation

1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Install PHP dependencies:
   ```
   composer install
   ```
4. Install JavaScript dependencies:
   ```
   npm install
   ```
5. Copy the `.env.example` file to `.env` and modify the necessary environment variables:
   ```
   cp .env.example .env
   ```
6. Generate an application key:
   ```
   php artisan key:generate
   ```
7. Run database migrations (make sure your database configuration is correct in `.env` before running migrations):
   ```
   php artisan migrate
   ```

## Running the Application

Once installation and configuration are complete, you can start the servers needed to run the application:

1. Start the Laravel development server:
   ```
   php artisan serve
   ```
2. Start the queue worker:
   ```
   php artisan queue:work
   ```
3. Start the Laravel Echo server (for real-time events):
   ```
   laravel-echo-server start
   ```

## Additional Information

- Ensure all necessary ports are open and not being used by other processes.
- Check the Laravel and package documentation for additional server requirements.

Enjoy your Laravel experience!
