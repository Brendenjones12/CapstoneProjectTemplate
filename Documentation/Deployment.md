# Deployment

## Type of Server Needed
Currently, you need an up-to-date Apache server that can run the latest version PHP *and* a MySQL database server.


## Where to put the Files
Currently, all the files are put into the same folder. 
- For XAMPP, the files go into a single folder inside the htdocs folder. 
- For a standard server setup, they all go into the public_html folder.


## How to Start and Stop the System
To start the website, you need to start the server with the files inside it. Then, do the opposite to shut it down by stopping the servers.
- For XAMPP, it means opening the control panel and launching the Apache and MySQL servers. Then stopping the servers if you wish to close the service.


## Trouble Shoot
The general advice is to check the error log sent to your browser or the error log on the console.
- In XAMPP, it will send the error code to your browser's webpage.

The most vulnerable piece to fail would be the system-connect.php, which as the database conenction settings. 

- Explaining how to troubleshoot if something goes wrong
- - Where to find the source of errors, if logged.
- - What are the most critical/vulnerable pieces that can fail?
