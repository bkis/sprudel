# in beta / feel free to try / not fully tested

![Sprudel Logo](https://raw.githubusercontent.com/bkis/sprudel/master/img/logo-dark.png)

# Sprudel
flexible webapp for scheduling and polls

# Description
Sprudel is a self-hosted WebApp based on PHP and MySql. It offers simple polls for scheduling events, but it's not limited to polling dates. You may also create polls to plan who's bringing bringing what for the buffet or how you should name your firstborn or whatever.  
Sprudel is meant to be easy to use and offers all the relevant features you need for a (scheduling) poll - no more no less.  

# Features
- easy, clean polls for events (dates) or anything you want, really
- yes/no/maybe options
- unique URL for sharing and accessing a poll
- entries can be removed or overridden
- commenting feature
- easily customizable: all the labels can be set to custom strings, so you can change the language and all
- cleanup-script included for deleting polls that have been inactive for more than X days (can be run via cronjob)
- one-click copying of the poll URL

# Requirements
- PHP 5.4 or higher  
- A MySql database  

# Installation
This is fairly easy *if* you know how to create a new MySql-database and how to upload files to your webserver. If you don't, try to find out how these things are done beforehand - it's easy to find tutorials on this on the internet!
- Create an empty MySql database on your server
- Download Sprudel as .zip-archive from this repository
- Extract the contents of the archive into a new directory (e.g. "sprudel")
- Edit the config.php file and insert the database's credentials (read comments!)
- Upload the sprudel-directory to your server (root-directory or somewhere else)
- Access the install.php through your browser (e.g. domain.com/sprudel/install.php)
- If everything is fine, Sprudel will tell you so.
- Delete the install.php from your server
- Enjoy

# Packaged Software/Media
Sprudel makes use of the following software/media and says *Thank you!* to:
- [Medoo](https://github.com/catfan/Medoo)
- [Datepicker](https://github.com/fengyuanchen/datepicker)
- [jQuery](https://github.com/jquery/jquery)
- [clipboard.js](https://github.com/zenorocha/clipboard.js)
- [Icons from iconmonstr.de](http://www.iconmonstr.de)

