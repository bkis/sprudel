# Pudel
flexible webapp for scheduling and polls

# Description
Pudel is a self-hosted WebApp based on PHP and MySql. It offers simple polls for scheduling events, but it's not limited to polling dates. You may also create polls to plan who's bringing the salad to your next BBQ party.  
Pudel is meant to be easy to use and offers all the relevant features you need for a scheduling poll - no more no less. Every created poll is accessible through an unique URL you can send to everyone you want to participate. The entries are displayed in a clear, simple way and can be removed or updated right in the poll.  
By the way, Pudel is quite customizable: You can edit all the strings and labels displayed in the app by changing them in the config.php file.  
Additionally, there is a cleanup-script that can be run via a cronjob. It will delete all the polls that haven't been changed for a certain number of days (you can set this up, too).  

# Requirements
PHP 5.4 or higher  
A MySql Database  
