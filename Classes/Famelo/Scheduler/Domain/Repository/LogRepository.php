<?php
namespace Famelo\Scheduler\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Famelo.Scheduler".      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Logs
 *
 * @Flow\Scope("singleton")
 */
class LogRepository extends \TYPO3\Flow\Persistence\Repository {
	public function findLastByTask($task) {
		$query = $this->createQuery();
		$query->setOrderings(array('created' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING));
		$query->setLimit(1);
		$results = $query->execute();
		if (count($results) > 0) {
			return $results->getFirst();
		}
		return NULL;
	}
}
?>