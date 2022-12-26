# Set up a LAMP Stack on Windows and initialise a PHP project from scratch

**Environment:**
- Windows OS
- Visual Studio Code
- WSL
- Ubuntu 22.04
- NodeJS
- PHP 8.1
- MySQL 8
- PHPUnit
- Composer
- Git

### Install WSL
Open Powershell as Administrator and run:

```
PS wsl --install
```

### Install Ubuntu:
Open Microsoft Store and search for "Ubuntu". Choose 22.xx or higher, download it, then click open. 

Follow the instructions in the terminal.

Enable SystemD:

	~$ sudo nano /etc/wsl.conf 

Enter:
```
[boot]
systemd=true
```
Exit an save file.

### Update Packages
```
~$ sudo apt update
~$ sudo apt full-upgrade
```

### Install NodeJS
```
~$ curl -fsSL https://deb.nodesource.com/setup_19.x | sudo -E bash - &&\
 > sudo apt-get install -y nodejs
```

### Install PHP 8.1
```
~$ sudo apt install --no-install-recommends php8.1
~$ sudo apt-get install -y php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath
```

### Download and install Composer
Download installer and verify hash:
```
~$ curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
~$ HASH=`curl -sS https://composer.github.io/installer.sig`
~$ echo $HASH
~$ php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
~$ sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

### Install MySQL
```
~$ sudo apt-get install -y mysql-server php-mysql
```
Important: Alter the root user first:
```
~$ sudo mysql    // Open MySQL prompt
mysql> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';    // Important step!
mysql> exit
```
Then run secure installation:
```
~$ mysql_secure_installation
    > Validate Password component? No
    > Change Root Password? No
    > Remove anonymous users? Yes		
    > Disallow Remote Login? Yes
    > Remove test database? Yes
    > Reload Provileg Tables? Yes
```

### Install PHPUnit
```
~$ wget -O phpunit https://phar.phpunit.de/phpunit-9.phar
~$ chmod +x phpunit
~$ ./phpunit --version
```

### Create a root folder for your projects
```
~$ mkdir dev
~$ sudo chmod -R 777 dev
```

### Create a folder for your Project
```
~$ cd dev
~$ mkdir your_project
~$ git clone https://github.com/dahas/PHPSkeleton.git
```

### Install XDebug
```
~$ php -S localhost:2400 -t public/
```
- Open `localhost:2400/info.php` in Web browser.
- Take a note of the path to the PHP.ini file. You´ll need it later.
- Copy everything and paste it here: https://xdebug.org/wizard
- Follow the instructions.

### Modify composer.json file
When ever you add or modify a path in `composer.json` you have to update the autoloader:
```
~$ cd application
~$ composer update
~$ cd ..
```

### Unit Testing
Put files you want to be tested into this folder. Add the suffix "*Test.php" to the file and "*Test" to the class name. 

PHPUnit tutorial: https://startutorial.com/view/phpunit-beginner-part-1-get-started
PHPUnit docs: https://phpunit.de/documentation.html

### Enable PHPUnit in VSCode
In the root folder of your project create a a file named **phpunit.xml** and paste the following content into it:
```
// phpunit.xml

<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/9.5/phpunit.xsd" bootstrap="vendor/autoload.php">
  <testsuites>
    <testsuite name="Default">
      <directory>tests</directory>
    </testsuite>
  </testsuites>
</phpunit>
```
Next, open the VSCode settings, search for "phpunit" and add the path to the phar file:

**Path to the PHPUnit binary: "~/phpunit.phar"**

### Running the tests 
Now you can execute your tests either by entering the following commands in the terminal ...
```
$ phpunit tests/FooTest.php --testdox  // Test a specific file
$ phpunit tests --testdox  // Test all files in tests folder
```
or by using the **VSCode Panel** to the left of your screen.

### Set up VSCode for Debugging
Create a configuration file for the debugger in VSCode and replace its content with the following:
```
// .vscode/launch.json

{
    "version": "0.2.0",
    "configurations": [

        //^^ Debug currently open PHP file
        {
            "name": "PHP File",
            "type": "php",
            "request": "launch",
            "program": "${file}",
            "args": [],
            "externalConsole": false,
            "port": 9003
        },

        //^^ Debug PHP App
        {
            "name": "PHP App",
            "type": "php",
            "request": "launch",
            "program": "${workspaceFolder}/public/index.php",
            "args": [],
            "externalConsole": false,
            "port": 9003
        },

        //^^ Debug currently open JS file
        {
            "name": "JS File",
            "type": "node",
            "request": "launch",
            "program": "${file}",
            "skipFiles": [
                "<node_internals>/**"
            ]
        },

        //^^ Debug JS App
        {
            "name": "JS App",
            "type": "node",
            "request": "launch",
            "program": "${workspaceFolder}/public/index.js",
            "skipFiles": [
                "<node_internals>/**"
            ]
        }

    ]
}
```