<?php

namespace CustomBaseBehavior\Behavior;

use Propel\Generator\Model\Behavior;
/**
 * custom base behavior for propel 2
 *
 * @author Christoph Quadt <christoph@quadtrilogy.de>
 */
class CustomBaseBehavior extends Behavior {

    // default parameters value
    protected $parameters = array(
        'base_query' => 'ModelCriteria',
    );

    /**
     * clean fully qualified class name
     *
     * @param string $fullyQualifiedClassName the fully qualified class name
     */
    protected function cleanfullyQualifiedClassName($fullyQualifiedClassName) {
        return trim(str_replace(array('.', '/'), '\\', $fullyQualifiedClassName), '\\');
    }

    /**
     * get class name
     *
     * @param string $fullyQualifiedClassName the fully qualified class name
     *
     * @return string
     */
    protected function getClassName($fullyQualifiedClassName) {
        $className = $fullyQualifiedClassName;
        if (($pos = strrpos($fullyQualifiedClassName, '\\')) !== false) {
            $className = substr($fullyQualifiedClassName, $pos + 1);
            $namespace = substr($fullyQualifiedClassName, 0, $pos);
        }
        return $className;
    }

    /**
     * get the parent class
     *
     * @param unknown $builder
     */
    public function parentClass($builder) {
        switch (get_class($builder)) {
            case 'QueryBuilder':
                $class = $this->getParameter('base_query');
                break;
        }

        if (!empty($class)) {
            $class = $this->cleanfullyQualifiedClassName($class);
            $builder->declareClass($class);

            return $this->getClassName($class);
        }
    }
}
