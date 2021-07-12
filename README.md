# Task Scheduler 

## Included

- Task Scheduler Component for schedulng and running predefined tasks
- Weather Data Fetcher Task for getting weather stats each 3 minute

## Configuration

- Project Architecture

    - `app` : It includes all custom business and database logics.
        `repositeries` : It this project we use repositery pattern for running all database logics.
        This folder includes all those logics.
        
        A sample table repositery class will be like: 

        ```php
            <?php namespace App\Repositeries;

            use System\Persistance\DBRepositery;

            class DemoRepositery extends DBRepositery { 

                protected $table = 'demo'; // Name of the table

            }

            ?>
        ```

        Here `DemoRepositery` is the class which will be used to process any database operations.

        `$table` property is used to define the database table for a given repositery.

        All repositery classes should extend `DBRepositery` class, which is just a simple abstraction layer for all DB operations to simplify the codebase and speed up the development task.

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

- Database Configuration
    
    - Import the `task_scheduler.sql` file into database
    
    - Set the config details over `~/config/database.php` in the `DEFAULT_DB` array like:
        ```php 
            'user'=>'root', // Database username
            'password' => '', // Database password
            'host' => 'localhost', // Address of the server host 
            'dbname' => 'task_scheduler', // Name of the database
            
            'driver' =>  'pdo_mysql' // By default it will be PDO Driver, No need to change
        ```
    
    There are three tables which will be imported named: `cron_logs`, `schedules`, `weather`

    `cron_logs` table includes all triggered cron entries with all possible details of response.
    
    `schedules` table is used for registering the schedule configuration of all tasks.
    It requires following configurations for a unique task:

        `schedule_uid` : A unique encrypted string to uniquely identify the schedule
        `name` : Name of the cron task
        `enabled` : It specifies the activation status of a cron task. If set to 0, this task will not be triggered by scheduler component.
        `minute` : Cron Sytnax for specifying the minute frequency ( default : `NULL` equivalent of `*` )
        `hour` : Cron Sytnax for specifying the hourly frequency ( default : `NULL` equivalent of `*` )
        `day` : Cron Sytnax for specifying the daily frequency ( default : `NULL` equivalent of `*` )
        `month` : Cron Sytnax for specifying the monthly frequency ( default : `NULL` equivalent of `*` )
        `weekday` : Cron Sytnax for specifying the week day frequency ( default : `NULL` equivalent of `*` )

        `command` : This column is used to define a command which includes the path of script.
        Syntax of the command should be like: 

        <PHP_PATH> <PROJECT_PATH>\tasks\<SCRIPT_FILE> ( If PHP script is to be run )

        where <SCRIPT_FILE> is the script to be triggered.

        In other cases, follow the standard for running those specific scripts from console.


# Scheduling a Task

- To schedule a task for cron run follow these steps: 

    - Develop and create the script file within folder `~/tasks/` with unique identifying name. 

    - Now write the command `<PHP_PATH> <PROJECT_PATH>\tasks\<SCRIPT_FILE>` and copy it.

    - Within database table `schedules`, insert the task entry by following the schedule configuration steps as mentioned above in `Database Configuration` section.

    - By default, you do not need to run any specific command for your custom script.

- Default steps:

    - By default there is a cron service named : `~/tasks/routineTaskCheck.php`, which checks if any task is to be triggered at any moment.

    - You will have to run the crontab command for the default cron service as follow:
        
        Run the following command over console 

        ( On linux )
        ```
        crontab -e

        * * * * * <PHP_PATH> <PROJECT_PATH>\tasks\routineTaskCheck.php
        ```
        or you may include the command

        ``` * * * * * <PHP_PATH> <PROJECT_PATH>\tasks\routineTaskCheck.php ``` in whatever shceduler applications you require.

    - The default cron service will run each minute and trigger all other custom tasks defined in the `schedules` table as per configuration.

- For Dry Run over the web: 

    Hit the url :  `<PROJECT_PATH>\tasks\routineTaskCheck.php` every minute and all the tasks will be automatically executed.

## Weather Data Fetcher Task

A Weather Data Fetcher Task is already included with predefined configurations ( frequency: per 3 minutes ) in `weather` table, which retrieves weather info for city 'London' each 3 minutes and save the temperature in celsius within `weather` table.

Script for data fetcher task is: `~/tasks/weatherDataFetcher.php`

City name `London` is used for fetching all weather stats.

It uses `OpenWeatherAPI` for fetching live weather details.


