# COMING SOON!

# Pudel
flexible webapp for scheduling and polls

# Description
Pudel is a self-hosted WebApp based on PHP and MySql. It offers simple polls for scheduling events, but it's not limited to polling dates. You may also create polls to plan who's bringing the salad to your next BBQ party.  
Pudel is meant to be easy to use and offers all the relevant features you need for a scheduling poll - no more no less.  
    
Every created poll is accessible through an unique URL you can send to everyone you want to participate. The entries are displayed in a clear, simple way and can be removed or updated right in the poll.  
By the way, Pudel is quite customizable: You can edit all the strings and labels displayed in the app by changing them in the config.php file.  
Additionally, there is a cleanup-script that can be run via a cronjob. It will delete all the polls that haven't been changed for a certain number of days (you can set this up, too).  

# Features
- coming soon...
- coming soon...

# Requirements
- PHP 5.4 or higher  
- A MySql database  

# Installation
This is fairly easy *if* you know how to create a new MySql-database and how to upload files to your webserver. If you don't, try to find out how these things are done beforehand - it's easy to find tutorials on this on the internet!
- Create an empty MySql database on your server
- Download Pudel as .zip-archive from this repository
- Extract the contents of the archive into a new directory (e.g. "pudel")
- Edit the config.php file and insert the database's credentials (read comments!)
- Upload the pudel-directory to your server (root-directory or somewhere else)
- Access the install.php through your server (e.g. domain.com/pudel/install.php)
- If everything is fine, Pudel will tell you so.
- Delete the install.php from your server
- Enjoy

# Packaged Software/Media
Pudel makes use of the following software/media and says *Thank you!* to:
- [Medoo](https://github.com/catfan/Medoo)
- [Datepicker](https://github.com/fengyuanchen/datepicker)
- [jQuery](https://github.com/jquery/jquery)
- [clipboard.js](https://github.com/zenorocha/clipboard.js)
- [Icons from Iconmonstr.de](http://www.iconmonstr.de)

