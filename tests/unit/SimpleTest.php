<?php

/**
 * TechDivision\Import\App\SimpleTest
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-app-simple
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\App;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Test class for the simple, single-threaded, importer implementation.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-app-simple
 * @link      http://www.techdivision.com
 */
class SimpleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * The instance to be tested.
     *
     * @var \TechDivision\Import\App\Simple
     */
    protected $instance;

    /**
     * Initializes the instance we want to test.
     *
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     * @see \PHPUnit_Framework_TestCase::setUp()
     */
    protected function setUp()
    {

        // create a mock container
        $mockContainer = $this->getMockBuilder('Symfony\Component\DependencyInjection\TaggedContainerInterface')
                              ->setMethods(get_class_methods('Symfony\Component\DependencyInjection\TaggedContainerInterface'))
                              ->getMock();

        // create a mock registry processor
        $mockRegistryProcessor = $this->getMockBuilder('TechDivision\Import\Services\RegistryProcessorInterface')
                                      ->setMethods(get_class_methods('TechDivision\Import\Services\RegistryProcessorInterface'))
                                      ->getMock();

        // create a mock import processor
        $mockImportProcessor = $this->getMockBuilder('TechDivision\Import\Services\ImportProcessorInterface')
                                    ->setMethods(get_class_methods('TechDivision\Import\Services\ImportProcessorInterface'))
                                    ->getMock();

        // create a mock configuration
        $mockConfiguration = $this->getMockBuilder('TechDivision\Import\ConfigurationInterface')
                                  ->setMethods(get_class_methods('TechDivision\Import\ConfigurationInterface'))
                                  ->getMock();

        // create a mock output
        $mockOutput = $this->getMockBuilder('Symfony\Component\Console\Output\OutputInterface')
                                  ->setMethods(get_class_methods('Symfony\Component\Console\Output\OutputInterface'))
                                  ->getMock();

        // mock the event emitter
        $mockEmitter = $this->getMockBuilder('League\Event\EmitterInterface')
                            ->setMethods(\get_class_methods('League\Event\EmitterInterface'))
                            ->getMock();

        // create the subject to be tested
        $this->instance = new Simple(
            $mockContainer,
            $mockRegistryProcessor,
            $mockImportProcessor,
            $mockConfiguration,
            $mockOutput,
            new ArrayCollection(),
            $mockEmitter,
            new ArrayCollection()
        );
    }

    /**
     * Test's the getOutput() method.
     *
     * @return void
     */
    public function testGetOutput()
    {
        $this->assertInstanceOf('Symfony\Component\Console\Output\OutputInterface', $this->instance->getOutput());
    }
}
