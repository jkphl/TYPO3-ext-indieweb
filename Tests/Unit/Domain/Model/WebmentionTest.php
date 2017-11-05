<?php

namespace Jkphl\Indieweb\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Joschi Kuphal <joschi@kuphal.net>, tollwerk GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \Jkphl\Indieweb\Domain\Model\Webmention.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Joschi Kuphal <joschi@kuphal.net>
 */
class WebmentionTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Jkphl\Indieweb\Domain\Model\Webmention
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Jkphl\Indieweb\Domain\Model\Webmention();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getSourceReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSource()
		);
	}

	/**
	 * @test
	 */
	public function setSourceForStringSetsSource() {
		$this->subject->setSource('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'source',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTargetReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTarget()
		);
	}

	/**
	 * @test
	 */
	public function setTargetForStringSetsTarget() {
		$this->subject->setTarget('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'target',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProcessedReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getProcessed()
		);
	}

	/**
	 * @test
	 */
	public function setProcessedForDateTimeSetsProcessed() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setProcessed($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'processed',
			$this->subject
		);
	}
}
