<?php

namespace SolrExplain\Domain\Explanation;

class MetaData {

	/**
	 * @var string
	 */
	protected $documentId = '';

	/**
	 * @var string
	 */
	protected $mode = '';

	/**
	 * @param string $documentId
	 * @param string $mode
	 */
	public function __construct($documentId, $mode) {
		$this->setDocumentId($documentId);
		$this->setMode($mode);
	}

	/**
	 * @param string $documentId
	 */
	public function setDocumentId($documentId) {
		$this->documentId = $documentId;
	}

	/**
	 * @return string
	 */
	public function getDocumentId() {
		return $this->documentId;
	}

	/**
	 * @param string $mode
	 */
	public function setMode($mode) {
		$this->mode = $mode;
	}

	/**
	 * @return string
	 */
	public function getMode() {
		return $this->mode;
	}
}