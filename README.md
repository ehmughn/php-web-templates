# PHP Web Templates

To prevent lengthy coding, here are some php website templates to use. Just copy the directory/folder of your choice, or view them as your guidance on how to create one. All of them has database integration for a more realistic simulation.


## Templates List

- Simple user login and signup
- Login and signup system with email verification

## Requirements

- An IDE (Recommendation: VS Code)
- XAMPP (For database local server)

## General Instructions

1. **Download any folder of your choice** within this repository.
2. **Move the folder** to "C:\xampp\htdocs" or "D:\xampp\htdocs" or to where htdocs is located. "htdocs" allows to locally host your webpage with database integration.
3. **Within XAMPP** Start "Apache" and "MySQL" to start the website. Apache allows to run your webpage with local hosting, while MySQL is your database itself.
4. **Open 'http://localhost/phpmyadmin' in your browser** and **create a database** with any name you want.
5. **Go to connection.php** within the folder you have downloaded and **change 'db-php-web-templates'** within the $dbname variable **to the name you choice for your database**.
6. For more specific instructions, please **refer to the 'instructions.md'** file inside the folder you have downloaded, since the next steps are very specific.


## Notes
1. Templates are **not designed to work with each other**, meaning "simple-user-log-system" is not designed to work with "simple-news-feed" or "simple navigation".
2. **One database is used by all, but each templates use different tables**. You can refer to those tables in the 'instructions.md' of each folders.

## Made by
Emmanuel T. Bawalan
2025