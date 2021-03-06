<?php

use App\AmbitiousMailSender\Base\ValueObjects\DateTime;

class DateTimeTest extends TestCase {

	/**
	 * @test
	 */
	function it_accepts_a_timestamp_and_sets_the_date()
	{
		$startDate ='2015-05-01 12:32:17';
		$timestamp = strtotime($startDate);

		$dateTime = new DateTime($timestamp);

		$this->assertEquals($startDate, (string)$dateTime);
	}

	/**
	 * @test
	 * @expectedException App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function throws_exception_if_instantiated_with_empty_date()
	{
		new DateTime('');
	}

	/**
	 * @test
	 * @expectedException App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function throws_exception_if_instantiated_with_invalid_timestamp()
	{
		new DateTime('invalidTimestamp');
	}

	/**
	 * @test
	 */
	function it_accepts_a_date_string()
	{
		$startDate = '2015-05-01 12:32:17';
		$timestamp = strtotime($startDate);

		$dateTime = new DateTime($startDate);

		$this->assertEquals($startDate, (string)$dateTime);
	}

	/**
	 * @test
	 */
	function returns_a_nice_date()
	{
		$dateTime = new DateTime('2015-05-01 12:32:17');
		$this->assertEquals('1st May, 2015', $dateTime->niceDate(false));
		$this->assertEquals('1st May, 2015 12:32pm', $dateTime->niceDate(true));

		$dateTime = new DateTime('2015-05-01 05:32:17');
		$this->assertEquals('1st May, 2015', $dateTime->niceDate(false));
		$this->assertEquals('1st May, 2015 5:32am', $dateTime->niceDate(true));
	}

}