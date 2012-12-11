# Famelo.Scheduler

Setup a cronjob for the Scheduler:

```php
* * * * * /path/to/flow scheduler:run
```

Create a new Task:

```php
class MyTask implements \Famelo\Scheduler\Tasks\TaskInterface {
    /**
     * Returns the Interval at which this task will be run
     * The Syntax is equivalent to cron.
     * Check the mtdowling/cron-expression package for more information:
     *     https://github.com/mtdowling/cron-expression
     *
     * @return string $interval
     */
    public function getInterval() {
        return '*/15 * * * *';
    }

    /**
     * Execute the Task
     *
     * @return void
     */
    public function execute() {
        // Let's do something...
    }
}
?>
```
The Interval is based on [mtdowling/cron-expression](https://github.com/mtdowling/cron-expression) which is based on the cron syntax