<?php

class TestExample extends \WP_Mock\Tools\TestCase
{
	public function setUp(): void
	{
		\WP_Mock::setUp();
	}

	public function test_if_works()
	{
		$this->assertTrue(true);
	}

	public function tearDown(): void
	{
		\WP_Mock::tearDown();
	}
}
