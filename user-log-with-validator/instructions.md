## Pre-requisite 

Before following the instructions, please do the general instructions under **README.md** from the repository, as they are necessary.

You'll also need to install **Composer**. You can follow [this video](https://www.youtube.com/watch?v=uRlYYXyPeaI) for a step-by-step guide on how to install it. It is a very straight-forward tutorial and poorly explained, but hey it works!

## Specific instructions

1. In the database, **create a new table** by going to the "SQL" tab and paste the following:
```sql
CREATE TABLE `user-with-validator` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `userId` bigint(11) NOT NULL UNIQUE,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verifyToken` varchar(100) NOT NULL,
  `createdAt` datetime NOT NULL
)
```
2. **Click 'Go'** and it should create a table successfully.
3. In the *functions.php* file, **modify** the following:
```php
$mail->Username   = 'your_email@gmail.com'; // Your Real Gmail address
$mail->Password   = 'your_password';    // Gmail App Password (not your Gmail password)
$mail->setFrom('your_email@gmail.com', 'App Name'); // Your Real Gamil address, Your App Name
```
Refer to the *Password Setup* below for more information on how to get your Gmail App Password.
4. Witihin your project folder in VS Code, **open the terminal** and run the following command:
```bash
composer require phpmailer/phpmailer
```
Make sure that you have restarted VS Code after installing Composer, otherwise it won't work.
5. **Open your webpage** in the browser with "http://localhost/user-log-with-validator/home/" and the project should now work normally.

## Password Setup
1. Go to your Gmail account and **enable 2-Step Verification**. You can do this by going to "Manage your Google Account" > "Security" > "2-Step Verification".
2. After enabling it, in the search bar above, search "App Passwords".
3. Click on "App Passwords" add your App Name that you have written in the:
```php
$mail->setFrom('your_email@gmail.com', 'App Name'); // The App name you wrote here
```
4. It will generate a password, put it in the:
```php
$mail->Password   = 'your_app_password';    // Put it here
```

## Additional Notes
1. This specific template uses *bootstrap*, which completely negates the use of .css files. If you are not familiar with *bootstrap*, there are a lot of tutorials online and refer to them. 
2. This is only the simple version of the user log system. You can refer to this if you only want to know the minimal codes to make a simple login/signup project, but I highly recommend checking out the other templates for login/signup.
3. The setup could be a bit tricky, but if you follow the instructions carefully, it should work. If you have any questions, feel free to ask.