<?php
namespace Famelo\Scheduler\Tasks;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Scheduler".      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Manipulate the context variable "objects", which we expect to be a QueryResultInterface;
 * taking the "page" context variable into account (on which page we are currently).
 *
 */
interface TaskInterface {
	/**
	 * Returns the Interval at which this task will be run
	 * The Syntax is equivalent to cron.
	 * Check the mtdowling/cron-expression package for more information:
	 *     https://github.com/mtdowling/cron-expression
	 *
	 * @return string $interval
	 */
	public function getInterval();

	/**
	 * Execute the Task
	 *
	 * @return void
	 */
	public function execute();
}
?>