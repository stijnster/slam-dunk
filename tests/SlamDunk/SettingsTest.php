<?php

class SlamDunkSettingsTest extends \PHPUnit\Framework\TestCase{

	public function testClearGetAndSet(){
		\SlamDunk\Settings::clear();
		$this->assertNull(\SlamDunk\Settings::get('key1'));
		$this->assertNull(\SlamDunk\Settings::get('key2'));
		$this->assertNull(\SlamDunk\Settings::get('key3'));

		\SlamDunk\Settings::set('key1', 'value1');
		\SlamDunk\Settings::set('key2', 'value2');

		$this->assertEquals('value1', \SlamDunk\Settings::get('key1'));
		$this->assertEquals('value2', \SlamDunk\Settings::get('key2'));
		$this->assertNull(\SlamDunk\Settings::get('key3'));

		\SlamDunk\Settings::clear();
		$this->assertNull(\SlamDunk\Settings::get('key1'));
		$this->assertNull(\SlamDunk\Settings::get('key2'));
		$this->assertNull(\SlamDunk\Settings::get('key3'));

		$this->assertEquals(100, \SlamDunk\Settings::get('key3', [ 'default' => 100 ]));
	}

	public function testKeyNotation(){
		\SlamDunk\Settings::clear();
		\SlamDunk\Settings::set('api', [
			'url' => 'http://',
			'authentication' => [
				'type' => 'basic',
				'username' => 'stijn007',
				'keys' => [
					'one', 'two', 'three'
				]
			]
		]);

		$this->assertEquals('http://', \SlamDunk\Settings::get('api.url'));
		$this->assertEquals('basic', \SlamDunk\Settings::get('api.authentication.type'));
		$this->assertEquals('stijn007', \SlamDunk\Settings::get('api.authentication.username'));
		$this->assertEquals([ 'type' => 'basic', 'username' => 'stijn007', 'keys' => [ 'one', 'two', 'three' ] ], \SlamDunk\Settings::get('api.authentication'));
		$this->assertEquals([ 'one', 'two', 'three' ], \SlamDunk\Settings::get('api.authentication.keys'));
	}

}