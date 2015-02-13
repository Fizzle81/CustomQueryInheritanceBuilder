CustomQueryInheritanceBuilder for Propel 2
==========================================

Propel 2 Builder to customize the inheritance for query objects in a single inheritance setup.

License
-------

MIT License

copyright (c) 2015 Christoph Quadt

Functionality
-------------
If there is a single inheritance set on a propel class, the current way of inheriting is:

FantasyBookQuery
    => BaseFantasyBookQuery
    => BaseBookQuery
    => ModelCriteria

This Builder provides the following setup:

FantasyBookQuery
    => BaseFantasyBookQuery
    => **BookQuery**
    => BaseBookQuery
    => ModelCriteria

Requirements
------------

This builder requires [Propel2](https://github.com/propelorm/Propel2) >= 2.0@dev

Installation
------------

To enable the builder, just reference it as a custom builder in the propel settings:

```ini
propel.generator.objectModel.builders.queryinheritance = CustomQueryInheritance\\Builder\\CustomQuerySingleInheritanceBuilder
```
