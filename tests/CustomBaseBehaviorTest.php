<?php

namespace Bookstore;

use Propel\Generator\Util\QuickBuilder;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\ActiveQuery\ModelCriteria;

class CustomBaseBehaviorTest extends \PHPUnit_Framework_TestCase {
    public function setUp() {
        if (!class_exists('Book')) {
            $schema = <<<EOF
<database name="bookstore" defaultIdMethod="native" namespace="Bookstore">
    <table name="book">
        <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
        <column name="title" type="VARCHAR" required="true" />

        <behavior name="custom_base">
            <parameter name="base_query" value="Bookstore\MyCustomBaseQuery" />
        </behavior>
    </table>
</database>
EOF;
            $builder = new QuickBuilder();
            $config  = $builder->getConfig();
            $config->setBuildProperty('behavior.custom_base.class', __DIR__.'/../src/Behavior/CustomBaseBehavior');
            $builder->setConfig($config);
            $builder->setSchema($schema);
            $con = $builder->build();
        }
    }

    public function testCustomBase() {
        $this->assertEquals('Bookstore\\om\\BaseBookQuery', get_parent_class('Bookstore\\BookQuery'));
        $this->assertEquals('Bookstore\\MyCustomBaseQuery', get_parent_class('Bookstore\\om\\BaseBookQuery'));
        $this->assertEquals('ModelCriteria', get_parent_class('Bookstore\\MyCustomBaseQuery'));
    }
}

class MyCustomBaseQuery extends ModelCriteria
{

}
