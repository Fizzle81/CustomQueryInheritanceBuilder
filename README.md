QueryInheritanceBehaviorBuilder for Propel 2
==========================================

Propel 2 Builder to provide the possibility of customizing the base class for query inheritance objects

License
-------

MIT License

copyright (c) 2015 Christoph Quadt

Requirements
------------

This builder requires [Propel2](https://github.com/propelorm/Propel2) >= 2.0@dev

Installation
------------

To enable the builder, just reference it as a custom builder in the propel settings:

```ini
propel.generator.objectModel.builders.queryinheritance = QueryInheritance\\Builder\\QueryInheritanceBehaviorBuilder
```
