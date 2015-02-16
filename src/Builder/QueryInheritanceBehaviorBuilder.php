<?php

namespace QueryInheritance\Builder;

use Propel\Generator\Builder\Om\QueryInheritanceBuilder;
use Propel\Generator\Builder\Om\ClassTools;

/**
 * builder to provide behaviors for query inheritance objects
 *
 * @author Christoph Quadt <quadt@united-domains.de>
 */
class QueryInheritanceBehaviorBuilder extends QueryInheritanceBuilder {

    /**
     * returns class name to parent class
     *
     * @see \Propel\Generator\Builder\Om\QueryInheritanceBuilder::getParentClassName()
     *
     * @return string
     */
    protected function getParentClassName() {
        $parentClass = $this->getBehaviorContent('parentClass');
        if (!empty($parentClass)) {
            return $parentClass;
        }
        return parent::getParentClassName();
    }
}