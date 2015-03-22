<?php

use App\AmbitiousMailSender\Base\ValueObjects\Email;

class EmailTest extends TestCase {

	/**
	 * @test
	 * @expectedException \App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function it_throws_an_exception_if_you_pass_a_blank_email_address()
	{
		new Email('');
	}

	/**
	 * @test
	 * @expectedException \App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function it_throws_an_exception_if_you_pass_an_invalid_email_address()
	{
		new Email('invalid');
	}

	/**
	 * @test
	 */
	function test_domain_returns_domain_part_of_email()
	{
		$email = new Email('alistairshaw@gmail.com');

		$this->assertEquals('gmail.com', $email->getDomain());
	}

	/**
	 * @test
	 */
	function it_returns_the_email_when_cast_as_string()
	{
		$email = new Email('alistairshaw@gmail.com');

		$this->assertEquals('alistairshaw@gmail.com', (string)$email);
	}

}