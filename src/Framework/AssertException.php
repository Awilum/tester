<?php

/**
 * This file is part of the Nette Tester.
 * Copyright (c) 2009 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Tester;


/**
 * Assertion exception.
 */
class AssertException extends \Exception
{
	public $origMessage;

	public $actual;

	public $expected;

	public $outputName;


	public function __construct(string $message, $expected, $actual, \Throwable $previous = null)
	{
		parent::__construct('', 0, $previous);
		$this->expected = $expected;
		$this->actual = $actual;
		$this->setMessage($message);
	}


	public function setMessage(string $message): self
	{
		$this->origMessage = $message;
		$this->message = strtr($message, [
			'%1' => Dumper::toLine($this->actual),
			'%2' => Dumper::toLine($this->expected),
		]);
		return $this;
	}
}
