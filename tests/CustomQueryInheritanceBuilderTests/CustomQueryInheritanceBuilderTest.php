<?php

namespace Bookstore;

use Propel\Generator\Util\QuickBuilder;
use Propel\Generator\Config\QuickGeneratorConfig;

class CustomQuerySingleInheritanceBuilderTest extends \PHPUnit_Framework_TestCase {

    /**
     * setup the unit test
     *
     * @see PHPUnit_Framework_TestCase::setUp()
     *
     * @return void
     */
    public function setUp() {
        if (!class_exists('Book')) {
            $schema = <<<EOF
<database name="bookstore" defaultIdMethod="native" namespace="Bookstore">
    <table name="book" phpName="Book">
        <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
        <column name="title" type="VARCHAR" required="true" />
        <column name="genre" phpName="Genre" type="INTEGER" size="11" required="true" defaultValue="0" inheritance="single">
        <inheritance key="1" class="FantasyBook" extends="Book" />
        <inheritance key="2" class="HorrorBook" extends="Book" />
        </column>
    </table>
</database>
EOF;
            $extraconf = array(
                'propel' => array(
                    'generator' => array(
                        'objectModel' => array(
                            'builders' => array(
                                'queryinheritance' => 'CustomQueryInheritance\\Builder\\CustomQuerySingleInheritanceBuilder'
                            )
                        )
                    )
                )
            );
            $config  = new QuickGeneratorConfig($extraconf);
            $builder = new QuickBuilder();
            $config  = $builder->setConfig($config);
            $builder->setSchema($schema);
            $con = $builder->build();
        }
    }

    /**
     * test insertion of generic query class
     *
     * @return void
     */
    public function testInsertQueryClass() {
        $this->assertEquals('Bookstore\\Base\\FantasyBookQuery', get_parent_class('Bookstore\\FantasyBookQuery'));
        $this->assertEquals('Bookstore\\BookQuery', get_parent_class('Bookstore\\Base\\FantasyBookQuery'));
        $this->assertEquals('Bookstore\\Base\\BookQuery', get_parent_class('Bookstore\\BookQuery'));
        $this->assertEquals('Propel\\Runtime\\ActiveQuery\\ModelCriteria', get_parent_class('Bookstore\\Base\\BookQuery'));
    }
}