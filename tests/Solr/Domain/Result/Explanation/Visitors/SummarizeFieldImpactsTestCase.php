<?php

namespace Solr\Tests\Domain\Result\Explanation;

/**
 *
 * @author Timo Schmidt <timo.schmidt@aoemedia.de>
 */
class SummarizeFieldImpactsTestCase extends \Solr\Tests\Domain\Result\Explanation\AbstractExplanationTestCase{

	/**
	 * @return \Solr\Domain\Result\Explanation\Explain
	 */
	protected function getExplain($filename) {
		$fileContent = $this->getFixtureContent($filename.".txt");
		$content = new \Solr\Domain\Result\Explanation\Content($fileContent);
		$metaData = new \Solr\Domain\Result\Explanation\MetaData('P_164345','auto');
		$parser = new \Solr\Domain\Result\Explanation\Parser();

		$parser->injectExplain(new \Solr\Domain\Result\Explanation\Explain());
		$explain = $parser->parse($content,$metaData);

		return $explain;
	}

	/**
	 * @test
	 */
	public function testCanSummarizeFieldImpactFixture001() {
		$explain = $this->getExplain('3.0.001');
		$visitor = new \Solr\Domain\Result\Explanation\Visitors\SummarizeFieldImpacts();
		$explain->getRootNode()->visitNodes($visitor);

		$this->assertEquals(100.0,$visitor->getFieldImpact('name'));
		$this->assertEquals(array('name'),$visitor->getRelevantFieldNames());
	}

	/**
	 * @test
	 */
	public function testCanSummarizeFieldImpactFixture003() {
		$explain = $this->getExplain('3.0.003');
		$visitor = new \Solr\Domain\Result\Explanation\Visitors\SummarizeFieldImpacts();
		$explain->getRootNode()->visitNodes($visitor);

		$this->assertEquals(95.756597168764,$visitor->getFieldImpact('price'));
		$this->assertEquals(array('name','manu','price'),$visitor->getRelevantFieldNames());
	}

	/**
	 * @test
	 */
	public function testCanSummarizeFieldImpactFixture004() {
		$explain = $this->getExplain('3.0.004');
		$visitor = new \Solr\Domain\Result\Explanation\Visitors\SummarizeFieldImpacts();
		$explain->getRootNode()->visitNodes($visitor);

		$this->assertEquals(100.0,$visitor->getFieldImpact('name'));
		$this->assertEquals(array('name','price'),$visitor->getRelevantFieldNames());
	}

	/**
	 * @test
	 */
	public function testCanSummarizeCustomTieBreakerFixture() {
		$explain = $this->getExplain('custom.tieBreaker');
		$visitor = new \Solr\Domain\Result\Explanation\Visitors\SummarizeFieldImpacts();
		$explain->getRootNode()->visitNodes($visitor);

		$this->assertEquals(array('expandedcontent','content','doctype'),$visitor->getRelevantFieldNames());
		$this->assertEquals(47.9,round($visitor->getFieldImpact('doctype'),1));
		$this->assertEquals(47.9,round($visitor->getFieldImpact('expandedcontent'),1));
		$this->assertEquals(4.2,round($visitor->getFieldImpact('content'),1));
	}

	/**
	 * @test
	 */
	public function testCanSummarizeCustomTieBreaker2Fixture() {
		$explain = $this->getExplain('custom.tieBreaker2');
		$visitor = new \Solr\Domain\Result\Explanation\Visitors\SummarizeFieldImpacts();
		$explain->getRootNode()->visitNodes($visitor);

		$this->assertEquals(array('pr_title','doctype'),$visitor->getRelevantFieldNames());
		$this->assertEquals(0.07,round($visitor->getFieldImpact('doctype'),2));
		$this->assertEquals(99.93,round($visitor->getFieldImpact('pr_title'),2));
	}


	/**
	 * @test
	 */
	public function testCanSummarizeCustomTieBreaker3Fixture() {
		$explain = $this->getExplain('custom.tieBreaker3');
		$visitor = new \Solr\Domain\Result\Explanation\Visitors\SummarizeFieldImpacts();
		$explain->getRootNode()->visitNodes($visitor);

		$this->assertEquals(array('keywords','expandedcontent','content','description','doctype'),$visitor->getRelevantFieldNames());
		$this->assertEquals(0.00,round($visitor->getFieldImpact('keywords'),2));
		$this->assertEquals(7.55,round($visitor->getFieldImpact('expandedcontent'),2));
		$this->assertEquals(4.72,round($visitor->getFieldImpact('content'),2));
		$this->assertEquals(85.64,round($visitor->getFieldImpact('description'),2));
		$this->assertEquals(2.09, round($visitor->getFieldImpact('doctype'),2));
	}
}