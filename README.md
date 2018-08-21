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
        class: BrandEmbasssy\ForbiddenMethodCallsRule\ForbiddenMethodCallsRule
        setup:
            - addForbiddenMethod(Psr\Http\Message\StreamInterface, getContents)
        tags:
            - phpstan.rules.rule
```


