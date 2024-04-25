### Example

```php

$myClass = new class() {
    use PDFMacroableTrait;
};

$myClass::macro('concatenate', function(... $strings) {
   return implode('-', $strings);
});

$myClass->concatenate('one', 'two', 'three'); // returns 'one-two-three'

```

Callables passed to the **macro** function will be bound to the **class**

```php
$macroableClass = new class() {

    protected $name = 'myName';

    use PDFMacroableTrait;
};

$macroableClass::macro('getName', function() {
   return $this->name;
});

$macroableClass->getName(); // returns 'myName'

```
