# Deployment

## Type of Server Needed
Currently, you need an up-to-date Apache server that can run both the latest version PHP *and* a MySQL database server.
Alternatively, you can use XAMPP to emulate both on a local machine.


## Where to put the Files
Currently, all the files are put into the same folder. 
- For XAMPP, the files go into a single project folder inside the htdocs folder. 
- For a standard server setup, they all go into the public_html folder.


## How to Start and Stop the System
To start the website, you need to start up the server with files in their designated folder -- there's no real special bootup sequence outside of making sure both the php interpreter and the mysql programs are running. There's no particular way to stop the website outside of stopping the server hosting it itself.
- For XAMPP, this means opening the control panel and launching the Apache and MySQL servers. Then stopping the servers if you wish to close the service.

### Database Variables
Make sure you navigate to the database/DatabaseVariables.php to put in the appropriate variables for your database.


## Trouble Shoot
The general advice is to check the error log sent to your browser or the error log on the console.
- In XAMPP, it will send you the immediate error code to the browser, while the XAMPP console gives a more detailed error report.

The most vulnerable pieces to fail would be:
- the Database_Variables.php, which stores all the database connection variables (username, password, database name, and url/port),
- each page creates a session, meaning the ability to store sessions on the machine must be enabled,
- each page requires many others to work, meaning the files must be kept in the same locations relative to the projcets.