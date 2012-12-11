<?php
namespace Famelo\Scheduler\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Scheduler".      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Log
 *
 * @Flow\Entity
 */
class Log {

	/**
	 * The task
	 * @var string
	 */
	protected $task;

	/**
	 * The created
	 * @var \DateTime
	 */
	protected $created;

	/**
	 * The data
	 * @var string
	 */
	protected $data = '';

	public function __construct() {
		$this->created = new \DateTime();
	}

	/**
	 * Get the Log's task
	 *
	 * @return string The Log's task
	 */
	public function getTask() {
		return $this->task;
	}

	/**
	 * Sets this Log's task
	 *
	 * @param string $task The Log's task
	 * @return void
	 */
	public function setTask($task) {
		$this->task = $task;
	}

	/**
	 * Get the Log's created
	 *
	 * @return \DateTime The Log's created
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * Sets this Log's created
	 *
	 * @param \DateTime $created The Log's created
	 * @return void
	 */
	public function setCreated($created) {
		$this->created = $created;
	}

	/**
	 * Get the Log's data
	 *
	 * @return string The Log's data
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Sets this Log's data
	 *
	 * @param string $data The Log's data
	 * @return void
	 */
	public function setData($data) {
		$this->data = $data;
	}

}
?>