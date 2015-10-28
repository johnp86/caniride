<?php

use Mockery as m;

class RequestTest extends PHPUnit_Framework_TestCase
{
	public function testSettersAndGetters()
	{
		$r = $this->makeRequest();

		$r->setUrl('foo');
		$this->assertEquals('foo', $r->getUrl());
		
		$r->setMethod('post');
		$this->assertEquals('post', $r->getMethod());
		
		$r->setData(array('foo' => 'bar'));
		$this->assertEquals(array('foo' => 'bar'), $r->getData());
		
		$r->setOptions(array('bar' => 'baz'));
		$this->assertEquals(array('bar' => 'baz'), $r->getOptions());

		$r->setHeaders(array('baz' => 'foo'));
		$this->assertEquals(array('baz' => 'foo'), $r->getHeaders());

		$r->setHeader('bar', 'baz');
		$this->assertEquals(array('baz' => 'foo', 'bar' => 'baz'), $r->getHeaders());
	}

	public function testEncodeData()
	{
		$r = $this->makeRequest();

		$r->setData(array('foo' => 'bar', 'bar' => 'baz'));
		$this->assertEquals('foo=bar&bar=baz', $r->encodeData());

		$r->setEncoding(anlutro\cURL\Request::ENCODING_JSON);
		$this->assertEquals('{"foo":"bar","bar":"baz"}', $r->encodeData());

		$r->setEncoding(anlutro\cURL\Request::ENCODING_RAW);
		$r->setData('<rawData>ArbitraryValue</rawData>');
		$this->assertEquals('<rawData>ArbitraryValue</rawData>', $r->encodeData());
	}

	public function testJsonConvenienceMethod()
	{
		$r = $this->makeRequest();

		$r->setJson(true);
		$this->assertEquals(anlutro\cURL\Request::ENCODING_JSON, $r->getEncoding());
	}

	public function testFormatHeaders()
	{
		$r = $this->makeRequest();

		$r->setHeaders(array('foo' => 'bar', 'bar' => 'baz'));
		$this->assertEquals(array('foo: bar', 'bar: baz'), $r->formatHeaders());

		$r->setHeaders(array('foo: bar', 'bar: baz'));
		$this->assertEquals(array('foo: bar', 'bar: baz'), $r->formatHeaders());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testInvalidMethod()
	{
		$r = $this->makeRequest();

		$r->setMethod('foo');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testInvalidEncoding()
	{
		$r = $this->makeRequest();

		$r->setEncoding(999);
	}

	public function makeRequest($curl = null)
	{
		if ($curl === null) {
			// $curl = m::mock('anlutro\cURL\cURL');
			$curl = new anlutro\cURL\cURL;
		}

		return new anlutro\cURL\Request($curl);
	}
}
