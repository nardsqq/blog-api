# Journey Blog - API

## Cloning the Repository

1. Beside the repository name, click and copy the clone URL (HTTPS).
2. Open your terminal.
3. Change the current working directory to the location where you want the cloned directory to be made.
4. Type `git clone`, and then paste the URL you copied in Step 2.
5. Press Enter. Your local clone will be created.

## Installing Dependencies

1. Run the following commands on Git CMD or Other Command Shells (Run within the project's folder):
    - `composer install` - To install required composer dependencies
2. Access XAMPP or other cross-platform web servers (WAMP, MAMP, EasyPHP etc).
3. Start your local server's Apache and MySQL services.

## Getting Started

### Environment
1. Run `cp .env.example .env` on the command shell to copy the existing `.env.example` file within the project folder. Fill in the fresh `.env` copy with your own configurations.
2. Generate a new APP_KEY via `php artisan key:generate` artisan command.

### Database

1. Type `localhost/phpMyAdmin` on you address bar. 
2. Create a new database with `phpMyAdmin`. I suggest that you use `db_journey` for your database name.
3. Open the command shell
4. Run `php artisan passport:install` to install and setup the API auth related tables.
4. Next, type `php artisan migrate` and hit enter to activate the artisan command.
5. This will migrate the database tables and it will make the database accessible through `localhost/phpMyAdmin`.

### Usage

1. After *migrating*, execute a separate command shell within the project folder.
2. Run `php artisan serve` on your command shell, just make sure you're within the directory of your local repository.
3. Open any modern browsers (Chrome, Firefox, Edge etc) and access the application by typing `http://localhost:8000` on your address bar.
4. To test the API without having to access the frontend, use the Insomnia REST Client and import this export [file](https://www.sendspace.com/file/sw3yum).