#!/bin/bash
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update
sudo apt-get install php7.3 php7.3-dev php7.3-xml -y --allow-unauthenticated
sudo curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
sudo curl https://packages.microsoft.com/config/ubuntu/18.04/prod.list > /etc/apt/sources.list.d/mssql-release.list
sudo apt-get update
sudo ACCEPT_EULA=Y apt-get install msodbcsql17 -y
sudo ACCEPT_EULA=Y apt-get install mssql-tools -y
sudo echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bash_profile
sudo echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
source ~/.bashrc
sudo apt-get install unixodbc-dev -y
sudo pecl install sqlsrv
sudo pecl install pdo_sqlsrv
sudo printf "; priority=20\nextension=sqlsrv.so\n" > /etc/php/7.3/mods-available/sqlsrv.ini
sudo printf "; priority=30\nextension=pdo_sqlsrv.so\n" > /etc/php/7.3/mods-available/pdo_sqlsrv.ini
sudo phpenmod -v 7.3 sqlsrv pdo_sqlsrv
sudo apt-get install libapache2-mod-php7.3 apache2
sudo a2dismod mpm_event
sudo a2enmod mpm_prefork
sudo a2enmod php7.3
sudo service apache2 restart
cd /var/www/html
sudo rm index.html
sudo wget https://raw.githubusercontent.com/JamesHsu333/ScaleSet/master/2.Build_LAMP_Structure_in_Azure_VM/database.php
sudo wget https://raw.githubusercontent.com/JamesHsu333/ScaleSet/master/2.Build_LAMP_Structure_in_Azure_VM/index.php
