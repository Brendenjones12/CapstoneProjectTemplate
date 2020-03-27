# Testing

## How to Test the Software:
To test the software, you need to have the latest version of PHPUnit installed and runnable directly in your command line (or another similar tool).
1) Make sure your MySQL server is running
2) Import the dummy data in the domain/MySQL directory into your MySQL server.
3) Navigate your command line to the project directory.
4) Run the command "phpunit test"
  - if this command fails, you'll have to run each test individually with the command "phpunit " followed by the test file name.
  - Also note, this is written from the perspective of a windows developer using the stock command line.

## Do You Need To Replicate The Environment?
- XAMPP
  - Needed to run the apache server and the mysql server.
- MySQL
  - Needed to host the dummy data that the testing classes rely on.
- PHPUnit
  - Needed to run the phpunit tests.