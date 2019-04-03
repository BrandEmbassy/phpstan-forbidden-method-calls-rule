# PHPStan Forbidden Method Calls Rule

> This PHPStan rule was created by Petr Morávek (https://github.com/xificurk).

## Usage

```bash
composer require --dev brandembassy/phpstan-forbidden-method-calls-rule 
```

And then in your `phpstan.neon` register service:

```
services:
    -
        class: BrandEmbassy\ForbiddenMethodCallsRule\ForbiddenMethodCallsRule
        setup:
            - addForbiddenMethod(Psr\Http\Message\StreamInterface, getContents)
        tags:
            - phpstan.rules.rule
```

## Example

```
 ------ ----------------------------------------------------------------- 
  Line   foo/Bar/Baz.php (in context of class Foo\Bar\Baz)  
 ------ ----------------------------------------------------------------- 
  95     Calling forbidden method                                                                                                                                        
         Psr\Http\Message\StreamInterface:getContents().                                                                                                                 
 ------ -----------------------------------------------------------------
```
