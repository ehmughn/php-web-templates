## Pre-requisite 

Before following the instructions, please do the general instructions under **README.md** from the repository, as they are necessary.

## Specific instructions

1. In the database, **create a new table** by going to the "SQL" tab and paste the following:
```sql
CREATE TABLE `simple-users` (
  `id` int(11) NOT NULL,
  `userId` bigint(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `createdAt` datetime NOT NULL
)
```
2. **Click 'Go'** and it should create a table successfully.
3. **Open your webpage** in the browser with "http://localhost/simple-user-log-system/home/" and the project should now work normally.

## Additional Notes
1. This specific template uses *bootstrap*, which completely negates the use of .css files. If you are not familiar with *bootstrap*, there are a lot of tutorials online and refer to them. 
2. This is only the simple version of the user log system. You can refer to this if you only want to know the minimal codes to make a simple login/signup project, but I highly recommend checking out the other templates for login/signup.