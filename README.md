# Welcome to the installation guide of MyJUB

MyJUB is a student developed web application made in HTML, CSS, JavaScript (JQuery) and PHP. Additionally, the application will use Apache (XAMPP) as a server and MySQL as a database.

No framework was used during the development. 

>This guide is designed for Linux machines, it was tested and deployed in Ubuntu 20.04

## Prerequisites:
- Local machine (preferably Ubuntu)
- This repository cloned locally
- Installed and running XAMPP server

### Clone the repository 

Move to the location where you want the project directory to be. 

```sh
git clone https://github.com/Mahdi-Ouchrahou/Mahdi-Ouchrahou.github.io.git 
```

### Install and set up XAMPP server

- First download XAMPP package for Linux from the Website : [https://www.apachefriends.org/download.html].
> It is recommended downloading version 8.2.4 / PHP 8.2.4

- Go to repository where the installer is, in most cases:
```sh 
cd Downloads
```

- Change the permission of the installer by running: 
```sh 
chmod 755 xampp-linux-*-installer.run
```

- Run the installer: 
```sh 
sudo ./xampp-linux-*-installer.run
```

- After running the last command the XAMPP set up wizard will open, follow the instructions for installing XAMPP for linux. 


- After installation run this command to open XAMPP :
```sh 
sudo /opt/lampp/./manager-linux-x64.run
```

- Use these two commands to start or stop XAMPP server : 
```sh 
sudo /opt/lampp/lampp start
```
```sh 
sudo /opt/lampp/lampp stop
```

- To properly set up XAMPP, you will have to chamge XAMPP localhost Directory to match your project directory.
To do so first move to  `/opt/lampp/etc/httpd.conf` using either the user interface or the terminal.
Once `httpd.conf` is opened, scroll until you find the two lines : 
> `DocumentRoot "/opt/lampp/htdocs" `
> `<Directory "/opt/lampp/htdocs">`

Modify the path in the two lines to :
> `DocumentRoot "/path/to/directory/Mahdi-Ouchrahou.github.io" `
> `<Directory "/path/to/directory/Mahdi-Ouchrahou.github.io">`

### Create the database and setting up the tables : 
- Make sure that XAMPP server is running 
```sh
sudo /opt/lampp/lampp start
```
> NOTE: make sure apache2 is not running at the same time 
> ```sudo service apache2 stop ```


- Once XAMPP is running Go to `http://localhost/phpmyadmin`


- To create the needed database and tables, import the file `db.sql` in `../setup/db.sql` using myphpadmin pannel. Once imported the database and the needed tables will be created. 

- A message should display showing success of the queries.

## Experiment with the application

- Now that the set-up is complete, to experiment with the project, go to `http://localhost/index.html` and enjoy all the functionalities.










