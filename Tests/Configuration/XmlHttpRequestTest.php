<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\FrameworkExtraBundle\Tests\Configuration;

use Widop\FrameworkExtraBundle\Configuration\XmlHttpRequest;

/**
 * Xml http request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlHttpRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\FrameworkExtraBundle\Configuration\XmlHttpRequest */
    private $xmlHttpRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->xmlHttpRequest = new XmlHttpRequest(array());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->xmlHttpRequest);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(
            'Widop\FrameworkExtraBundle\Configuration\AbstractConfiguration',
            $this->xmlHttpRequest
        );
    }

    public function testConstant()
    {
        $this->assertSame('xml_http_request', XmlHttpRequest::ALIAS_NAME);
    }

    public function testAliasName()
    {
        $this->assertSame('xml_http_request', $this->xmlHttpRequest->getAliasName());
    }
}
