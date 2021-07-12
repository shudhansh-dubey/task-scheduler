# Task Scheduler 

## Included
- Task Scheduler Component for schedulng and running predefined tasks
- Weather Data Fetcher Task for getting weather stats each 3 minute

## Usage
Import the `task_scheduler.sql` file into database and set the config details over
`~/config/database.php`

Run the following command over console 

```
crontab -e

* * * * * <PHP_PATH> <PROJECT_PATH>\tasks\routineTaskCheck.php
```

`routineTaskCheck.php` script will check for any scheduled tasks at every 1 minute.
If it finds one, it will trigger that task.

You may register configurations for any tasks over `schedules` table and save the script within `~/tasks/` folder.

## Weather Data Fetcher
By default, a Weather Data Fetcher Task is included which retrieves weather info for city 'London' each 3 minutes and save the temperature in celsius over `weather` table.

It uses `OpenWeatherAPI` for the purpose.


