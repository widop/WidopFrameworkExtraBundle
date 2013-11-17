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

use Widop\FrameworkExtraBundle\Configuration\JsonTemplate;

/**
 * Json template test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonTemplateTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\FrameworkExtraBundle\Configuration\JsonTemplate */
    private $jsonTemplate;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->jsonTemplate = new JsonTemplate(array());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->jsonTemplate);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(
            'Widop\FrameworkExtraBundle\Configuration\AbstractConfiguration',
            $this->jsonTemplate
        );
    }

    public function testConstant()
    {
        $this->assertSame('json_template', JsonTemplate::ALIAS_NAME);
    }

    public function testAliasName()
    {
        $this->assertSame('json_template', $this->jsonTemplate->getAliasName());
    }
}
