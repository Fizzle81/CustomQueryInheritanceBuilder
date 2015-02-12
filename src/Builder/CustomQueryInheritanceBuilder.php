<?php

namespace CustomQueryInheritance\Builder;

use Propel\Generator\Builder\Om\QueryInheritanceBuilder;
use Propel\Generator\Builder\Om\ClassTools;

/**
 * @author Christoph Quadt <quadt@united-domains.de>
 */
class CustomQuerySingleInheritanceBuilder extends QueryInheritanceBuilder {

    /**
     * returns class name to parent class
     *
     * @see \Propel\Generator\Builder\Om\QueryInheritanceBuilder::getParentClassName()
     *
     * @return string
     */
    protected function getParentClassName() {
        if (is_null($this->getChild()->getAncestor())) {
            return $this->getNewStubQueryBuilder($this->getTable())->getUnqualifiedClassName();
        }
        $ancestorClassName = ClassTools::classname($this->getChild()->getAncestor());
        if ($this->getDatabase()->hasTableByPhpName($ancestorClassName)) {
            $stub_builder = $this->getNewStubQueryBuilder($this->getDatabase()->getTableByPhpName($ancestorClassName));
            return $this->getClassNameFromBuilder($stub_builder);
        }
        // find the inheritance for the parent class
        foreach ($this->getTable()->getChildrenColumn()->getChildren() as $child) {
            if ($child->getClassName() == $ancestorClassName) {
                return $this->getNewStubQueryInheritanceBuilder($child)->getUnqualifiedClassName();
            }
        }
    }
}