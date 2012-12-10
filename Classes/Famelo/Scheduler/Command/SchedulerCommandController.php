<?php
namespace Famelo\Scheduler\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Scheduler".      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Scheduler command controller for the Famelo.Scheduler package
 *
 * @Flow\Scope("singleton")
 */
class SchedulerCommandController extends \TYPO3\Flow\Cli\CommandController {
	/**
	 * @var \TYPO3\Flow\Reflection\ReflectionService
	 * @Flow\Inject
	 */
	protected $reflectionService;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * The logRepository
	 *
	 * @var \Famelo\Scheduler\Domain\Repository\LogRepository
	 * @Flow\Inject
	 */
	protected $logRepository;

	/**
	 * Run the Scheduler
	 *
	 * Use this command to run the Scheduler
	 *
	 * @param boolean $ignoreInterval
	 * @param string $task
	 * @return void
	 */
	public function runCommand($ignoreInterval = FALSE, $task = NULL) {
		if ($task === NULL) {
			$tasks = $this->getTasks();
			foreach ($tasks as $task) {
				$this->runTask($task, $ignoreInterval);
			}
		} else {
			$this->runTask(new $task, $ignoreInterval);
		}
	}

	/**
	 * List Tasks
	 *
	 * List tasks with their interval
	 *
	 * @return void
	 */
	public function listCommand() {
		$tasks = $this->getTasks();
		foreach ($tasks as $task) {
			$this->outputLine(get_class($task) . ': ' . $task->getInterval());
		}
	}

	/**
	 * Run a single command
	 * @param  object  $task
	 * @param  boolean $ignoreInterval
	 * @return void
	 */
	public function runTask($task, $ignoreInterval = FALSE) {
		$taskName = $this->reflectionService->getClassNameByObject($task);
		$lastRun = $this->logRepository->findLastByTask($taskName);
		$cron = \Cron\CronExpression::factory($task->getInterval());
		if ($lastRun === NULL || $lastRun->getCreated() < $cron->getPreviousRunDate() || $ignoreInterval) {
			$log = new \Famelo\Scheduler\Domain\Model\Log();
			$log->setTask($taskName);
			$result = $task->execute();
			if ($result !== NULL) {
				$log->setData(serialize($result));
			}
			$this->persistenceManager->add($log);
		}
	}

	/**
	 * Return all Tasks implementing the TaskInterface
	 *
	 * @return array
	 */
	public function getTasks() {
		$taskClasses = $this->reflectionService->getAllImplementationClassNamesForInterface('\Famelo\Scheduler\Tasks\TaskInterface');
		$tasks = array();
		foreach ($taskClasses as $taskClass) {
			$tasks[] = new $taskClass();
		}
		return $tasks;
	}
}

?>