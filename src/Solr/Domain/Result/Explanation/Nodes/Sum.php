<?php

namespace Solr\Domain\Result\Explanation\Nodes;

class Sum extends \Solr\Domain\Result\Explanation\Nodes\Explain {

	/**
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->setNodeType(self::NODE_TYPE_SUM);
	}
}