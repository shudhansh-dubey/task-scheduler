# Task Scheduler 

## Included

- Task Scheduler Component for schedulng and running predefined tasks
- Weather Data Fetcher Task for getting weather stats each 3 minute

## Installation ( Setup )

- Make sure you have PHP development environemt like XAMPP, WAMP or any Apache Server along with the MySQL DBMS, installed on your system.

- Installation if `Composer` globally will be recommended. 

- All the scheduling commands use PHP installation path for running PHP scripts. 
  For example if XAMPP is installed on your local Windows machine in `C:\xampp\` folder, PHP installation path will be `C:\xampp\php\`  and the executing file will be `C:\xampp\php\php.exe`.

  This complete path `C:\xampp\php\php.exe` is termed as PHP Execution Path.

- Now start the Apache and MySQL server.

- Within your server public directory ( `C:\xampp\htdocs\` in the case of XAMPP ), you have to install the git repository of project by any one of below methods:

    1. If you have `Git-Bash` installed on your system, 
        open the git bash terminal and run the following commands:

        - Move into the public directory:
            `cd C:/xampp/htdocs/`

        - Clone the git repository
            `git clone https://github.com/shudhansh-dubey/task-scheduler`

        - After installation, update composer
            `composer update`

        - All required files will be added and installed in the folder `C:\xampp\htdocs\task-scheduler\` as  it will create a folder named `task-scheduler` by itself.

    2. Alternately, you may download the zip file of the project from url: https://github.com/shudhansh-dubey/task-scheduler/archive/refs/heads/main.zip and extract it over folder `C:\xampp\htdocs\` which will create the project in a folder named: `C:\xampp\htdocs\task-scheduler-main`.

        - Open any Command Prompt terminal

        - Now move into the project directory
            `cd C:/xampp/htdocs/`

        - Update composer
            `composer update`

- Database Configuration
    
    - Assuming, you have installed the project in XAMPP within folder `C:\xampp\htdocs\task-scheduler\`

    - Create a database from `phpMyAdmin` portal. 
        
        - For example, within local environment, hit url: `http://localhost/phpmyadmin/` from browser.

        - If you have credentials set over the DBMS, enter the same.

        - Now within left sidebar, click over `New` link and by entering a database name within the form, Hit `Go` button given below. Database will be created.

    - Import the `C:\xampp\htdocs\task-scheduler\task_scheduler.sql` mysql dump file into database
    
    - Set the config details over `C:\xampp\htdocs\task-scheduler\config\database.php` in the `DEFAULT_DB` array like:
        ```php 
            'user'=>'root', // Database username
            'password' => '', // Database password
            'host' => 'localhost', // Address of the server host 
            'dbname' => 'task_scheduler', // Name of the database
            
            'driver' =>  'pdo_mysql' // By default it will be PDO Driver, No need to change
        ```
    
    - There are three tables which will be imported named: `cron_logs`, `schedules`, `weather`

        - `cron_logs` table includes all triggered cron entries with all possible details of response.
        
        - `schedules` table is used for registering the schedule configuration of all tasks.
            It requires following configurations for a unique task:

            - `schedule_uid` : A unique encrypted string to uniquely identify the schedule
            
            - `name` : Name of the cron task
            
            - `enabled` : It specifies the activation status of a cron task. If set to 0, this task will not be triggered by scheduler component.
            
            - `minute` : Cron Sytnax for specifying the minute frequency ( default : `NULL` equivalent of `*` )
            
            - `hour` : Cron Sytnax for specifying the hourly frequency ( default : `NULL` equivalent of `*` )
            
            - `day` : Cron Sytnax for specifying the daily frequency ( default : `NULL` equivalent of `*` )
            
            - `month` : Cron Sytnax for specifying the monthly frequency ( default : `NULL` equivalent of `*` )
            
            - `weekday` : Cron Sytnax for specifying the week day frequency ( default : `NULL` equivalent of `*` )

            - `command` : This column is used to define a command which includes the path of    script. Syntax of the command should be like: 

                <PHP_INSTALLATION_PATH> <PROJECT_PATH>\tasks\<SCRIPT_FILE> ( If PHP script is to be run )

                For example, if your project is installed in a XAMPP server within 
                `C:\xampp\htdocs\projects\task-scheduler\` folder, and the script to be run is `C:\xampp\htdocs\projects\task-scheduler\tasks\weatherDataFetcher.php` file, command would be like:

                `C:\xampp\php\php.exe C:\xampp\htdocs\projects\task-scheduler\tasks\weatherDataFetcher.php`
            
            In case, you have no custom scripts to be run, you do not need to insert or configure any other custom query in database, as `Weather Data Fetcher` task is already included within database.
            BUT you will be needed to update the <PHP_INSTALLATION_PATH> and <PROJECT_PATH> within the first and second row of `schedules` database table in `command` columnn, unless it will trigger an error.

## Scheduling a Task

- To schedule a task for cron follow these steps: 

    - Assuming, you have completed your setup within folder `C:\xampp\htdocs\projects\task-scheduler\`.

    - Develop and create your custom script file within folder `C:\xampp\htdocs\projects\task-scheduler\tasks\` with unique identifying name. For example `weatherDataFetcher.php` task script is already included within the `tasks` folder.

    - Now write the command `<PHP_PATH> <PROJECT_PATH>\tasks\<SCRIPT_FILE>` and copy it in a text file.
        Make sure no spaces remain before and after the command.
        For example, as previously discussed, if task script is saved as `C:\xampp\htdocs\projects\task-scheduler\tasks\weatherDataFetcher.php`, command would be:

        `C:\xampp\php\php.exe C:\xampp\htdocs\projects\task-scheduler\tasks\weatherDataFetcher.php`

    - Within database table `schedules`, insert the task entry by following the schedule configuration steps as mentioned above in `Database Configuration` section.

    - FOR NOW, you do not need to run any specific command over any terminal for your custom script.

- MANDATORY STEPS:

    - By default there is a cron service named : `C:\xampp\htdocs\projects\task-scheduler\tasks\routineTaskCheck.php`, which checks if any task is to be triggered at any moment.

    - You will have to run the crontab command for the default cron service as follow:
        
        Run the following command over console 

        ( On linux )
        ```
        crontab -e

        * * * * * <PHP_INSTALLATION_PATH> <PROJECT_PATH>\tasks\routineTaskCheck.php
        ```
        or you may include the command

        ``` * * * * * <PHP_PATH> <PROJECT_PATH>\tasks\routineTaskCheck.php ``` in whatever shceduler applications you require.

        for example, ``` * * * * * C:\xampp\php\php.exe C:\xampp\htdocs\projects\task-scheduler\tasks\routineTaskCheck.php ```.

    - The default cron service will run each minute and trigger all other custom tasks defined in the `schedules` table as per configuration.

- For Dry Run over the web: 

    Hit the url :  `http://localhost/<PROJECT_NAME>/tasks/routineTaskCheck.php` ( For example, http://localhost/projects/task-scheduler/tasks/routineTaskCheck.php ) every minute and all the tasks will be automatically executed as per configurations.

            
## Project Architecture

- Architecture

    - `app` : It includes all custom business and database logics.
        `repositories` : It this project we use repository pattern for running all database logics.
        This folder includes all those logics.
        
        A sample table repository class will be like: 

        ```php
            <?php namespace App\Repositories;

            use System\Persistance\DBRepository;

            class DemoRepository extends DBRepository { 

                protected $table = 'demo'; // Name of the table

            }

            ?>
        ```

        Here `DemoRepository` is the class which will be used to process any database operations.

        `$table` property is used to define the database table for a given repository.

        All repository classes should extend `DBRepository` class, which is just a simple abstraction layer for all DB operations to simplify the codebase and speed up the development task.

    - `bootstrap` : This folder is used to include all autoloaded components in the project along with creating all the singleton instances to be used throughout the project.
    Any script which is to be developed should include the file `~/bootstrap/application.php` at the top of code.

    - `config` : 
        `api.php` : this file is used to define all the third party API credentials
        `constants.php` : this file is used to define all custom constants to be used in the project
        `database.php` : For database configuration  

        All config files are loaded via PSR-4 autoloader

    - `src` : This folder includes the source code for all the custom services, components and libraries which are to to be used for project.
        For now, two services/components are added:
        `Scheduler` : Component created for handling all cron scheduling tasks
        `Persistance` : Component created as an abstraction layer for database operations

    - `tasks` : This folder is used specifically to develop all cron schedule scripts.
        Each file is used as the endpoint script for all custom tasks. 

## Weather Data Fetcher Task

A Weather Data Fetcher Task is already included with predefined configurations ( frequency: per 3 minutes ) in `weather` table, which retrieves weather info for city 'London' each 3 minutes and save the temperature in celsius within `weather` table.

Assuming you have completed your setup within folder `C:\xampp\htdocs\projects\task-scheduler\`, Script for weather data fetcher task is: `C:\xampp\htdocs\projects\task-scheduler\tasks\weatherDataFetcher.php`

City name `London` is used for fetching all weather stats.

It uses `OpenWeatherAPI` for fetching live weather details.


