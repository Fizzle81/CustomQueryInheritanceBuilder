<?php

namespace chq81\QueryInheritance\Builder;

use Propel\Generator\Builder\Om\QueryInheritanceBuilder;

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
        $parentClass = $this->getBehaviorContentBase('parentClass', 'QueryBuilderModifier');
        if (!empty($parentClass)) {
            return $parentClass;
        }
        return parent::getParentClassName();
    }
}