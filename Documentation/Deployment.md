# Deployment

## Server
For iteration 2, we had the multi-page website hosted on 000webhost.com. You just need to drag and drop all the files in the second repository into the website/server's public_html folder.

## File/Folders
For all of our html files that have php and html, they are all in the same file. The system-connect.php contains the database login and password needed for all the MySQL calls to work.

## Start/Stop
To start the website, type in studentengagement.000webhostapp.com.

## Trouble Shoot
If you run into errors, your best bet will be to look at the server's console or the error log of the program running the php.

## Critical Pieces to Fail
The most critical piece that could fail would be "connect.php", because it is used by almost all the php pages or the chatbot becuase of the parameters have to be met exactly to ask a question.
