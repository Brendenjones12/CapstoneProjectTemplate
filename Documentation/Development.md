# Development

## Tech Aspects of the Software
These are the technologies used in this software project:
- MySQL
- PHP
- HTML / CSS
- DialogFlow - Google API (Removed)


## Technologies Needed to Replicate the Development Environment
IDEs used:
- Visual Studio Community / Mac (2019)
  - Alternatively, PHPStorm
- DialogFlow's Inline Editor (Previously)


## How to Replicate the Development
### XAMPP
1. First, we installed the XAMPP platform. You need to get the installer from [their installer page](https://www.apachefriends.org/index.html). We used the windows version, so these instructions are only tested with that platform in mind.

1. Then open the installer and follow it through the installation process, using the default options or, at the very least, the following options: Apache, MySQL, PHP, and phpMyAdmin. 
![XAMPP][XAMPP1]

1. Choose an install folder and make sure to note it down somewhere for later use.  
![XAMPP][XAMPP2]

1. Once the install is finished, start up the xampp control panel. 
![XAMPP][XAMPP3]

1. After the control panel launches, start the Apache and MySQL servers. 
![XAMPP][XAMPP4]

1. Minimize the application but don't close it, XAMPP needs to be kept running to keep the Apache and MySQL servers online.

### Visual Studio Community 2019
1. Go to the [visual studio download page](https://visualstudio.microsoft.com/downloads/) and choose the "Community" link to download the installer. 
![Visual Studio Community 2019][VSC1]

1. Launch the installer and let it go through the setup process by clicking the "continue" button.

1. We didn't use any workloads for this project, so just click the install button on the bottom right. 
![Visual Studio Community 2019][VSC2]

1.  Once the installation is finished, click the launch button to enter the program proper. 
![Visual Studio Community 2019][VSC3]

1. Click on the "Clone or check out code" button, and copy the .git link into the Repository Location field. For this specific project, the github link is "https://github.com/Illuminubby/student-retention-webapp.git"
1. Then, using the XAMPP install location, change the "Local path" field to the following: "C:\[your xampp installation folder]\htdocs\student-retention-webapp". 
![Visual Studio Community 2019][VSC4]

1. Once the files are finished downloading, you can safely close Visual Studio Community 2019.

### Setting Up MySQL and Accessing the Website
1. Open your web browser of choice, and enter localhost/phpmyadmin/index.php into the address bar.

1. Click the Databases and then create one by filling out the Database name field with "student-engagement-retention" and clicking "Create".
![MySQL and Website][Website2]

1. On the PHPMyAdmin page, click the "IMPORT" button.
![MySQL and Website][Website2]

1. Then download the MySQL structure file, currently located here: [File Link](https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/MySQL%20Table%20Setup/MySQL_Structure.sql)
1. Then, if you would like it, download the dummy data for the database currently located here: [File Link](https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/MySQL%20Table%20Setup/Dummy_Data.sql)

1. You will then need to use "Choose File" to select the structure file, and then the "Go" button to add the structure to your server.
1. Again, after that, you can also choose to import the dummy data using the same step, but with the dummy data file instead.
![MySQL and Website][Website3]

1. Assuming you entered everything the same way we did, you should have successfully replicated the development environment. If you wish to access the website, enter into your browser's address bar "http://localhost/student-retention-webapp/".
![MySQL and Website][Website4]


### If the MySQL Database Wasn't Setup Exactly the Same
1. You will need reopen Visual Studio and enter into the config file (named "system-connect.php" this iteration) and change the values to match what matches your server's values.
![Code][Code]


## Folder Structure Explained
There's not really a folder structure to speak of for the current iteration (iteration 3), but there will be a revised and refactored code base for the next iteration. Otherwise, all the files are kept in the same folder, together.


## Important Files Explained
The important files are the system-connect.php and .htaccess.
- System-connect.php is what holds the database connection code.
- .htaccess has code that allows the server to hold session data between pages.


[XAMPP1]:	https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/XAMPP%201.png	"XAMPP"
[XAMPP2]:	https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/XAMPP%202.png	"XAMPP"
[XAMPP3]:	https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/XAMPP%203.png	"XAMPP"
[XAMPP4]:	https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/XAMPP%204.png	"XAMPP"
[VSC1]:		https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/VisualStudioComm2019%201.png	"Visual Studio Community 2019"
[VSC2]:		https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/VisualStudioComm2019%202.png	"Visual Studio Community 2019"
[VSC3]:		https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/VisualStudioComm2019%203.png	"Visual Studio Community 2019"
[VSC4]:		https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/VisualStudioComm2019%204.png	"Visual Studio Community 2019"
[Website1]:	https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/Website%201.png	"MySQL and Website"
[Website2]:	https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/Website%202.png	"MySQL and Website"
[Website3]:	https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/Website%203.png	"MySQL and Website"
[Website4]:	https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/Website%204.png	"MySQL and Website"
[Code]:		https://github.com/Brendenjones12/Student-Engagement-and-Retention-Tool/blob/master/Auxiliary%20Files/Pictures/Development/Code.png			"Code"