# How to init a PHP project from scratch

**Environment:**
- Windows OS
- Visual Studio Code
- Xampp

### Download and install Xampp

Get it from here: https://www.apachefriends.org/

Do not install Xampp into your Program Files folder! Instead install it directly on your main drive. So you have "C:\xampp\\".

### Download and install Composer

Available here: https://getcomposer.org/download/

If problems with the Windows installer occur, you can follow the *Command-line installation*.

### Create a root folder for your project
```
$ mkdir your_project
```

### Create composer.json file
The composer.json file must be in the root directory of your project. Create one with the command below.
```
$ cd your_project
$ composer init
```
Follow the instructions.

### Extend composer.json file

Open the composer.json file and add the "autoload" section to it. Provide the namespace and the directory of your class files.

Below is an example with a namespace "PHPSkeleton\App" and a path "lib".

```
// composer.json

{
    "autoload": {
        "psr-4": {
            "PHPSkeleton\\App\\": "lib/",
            // Add another namespaces here
        }
    }
}
```

### Update autoloader
```
$ composer update
```
Run this command whenever you´ve added a namespace.

### Enable autoloader
Assuming that *index.php* is the entry point of your app, add the following line at the very begining:
```
// index.php

require __DIR__ . '/vendor/autoload.php';
```

### Verify the PHPUnit testing framework
PHPUnit usually comes with Xampp. You can verify it by running this command:
```
$ phpunit --version
```
If you encounter an error, check if the Windows PATH variable is set:
**C:\xampp\phpunit\\**

If the PATH varaible is there and the error remains, please follow the steps below:

- Download the latest PHPUnit **phar** file from here https://phpunit.de/index.html.
- Rename it to **phpunit.phar** and place it in your Xampps "php" folder.
- Modify the last line in **phpunit.bat** which you find in the "php" folder inside your Xampp directory. Modify it, so it looks like this: 
    ```
    // c:\xampp\php\phpunit.bat

    "%PHPBIN%" "C:\xampp\php\phpunit.phar" %*
    ```
    Try again:
    ```
    $ phpunit --version
    ```
You should see:
*PHPUnit x.x.xx by Sebastian Bergmann and contributors.*

### Create a "tests" folder in the document root
```
$ mkdir tests
```
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

**Path to the PHPUnit binary: "C:\xampp\php\phpunit.phar"**

### Running the tests 
Now you can execute your tests either by entering the following commands in the terminal ...
```
$ phpunit tests/FooTest.php --testdox  // Test a specific file
$ phpunit tests --testdox  // Test all files in tests folder
```
or by using the **VSCode Panel** to the left of your screen.

### Download and install XDebug

Follow this instruction: https://github.com/xdebug/vscode-php-debug

Add the following section to your php.ini:
```
// c:\xampp\php\php.ini

[XDebug]
xdebug.mode=debug
xdebug.remote_enable=on
xdebug.start_with_request=yes
zend_extension=xdebug
```

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
            "program": "${workspaceFolder}\\index.php",
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
            "program": "${workspaceFolder}\\index.js",
            "skipFiles": [
                "<node_internals>/**"
            ]
        }

    ]
}
```