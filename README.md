# HOMEWORK 2

## Zadání

Zadání

Napište unit testy ve vašem oblíbeném testovacím frameworku (PHPUnit, Netter teste, Atoum, apod.) pro třídy Calculator, DateFormatter definované v souborech Calculator.php a DateFormatter.php V případě třídy DateFormatter navrhněte změny, které umožní její testovaní s minimální změnou signatur jednotlivých metod.

**Bonus**

Napište unit testy pro třídu Service v souboru Service.php bez toho aniž by kód posílal HTTP požadavky na server. Otestujte všechny možné chybové stavy. Tip - použijte některý z dostupných nástrojů pro stubovaní/mokování (Mockery, phpunit-mock-objects apod.).

## Scripty

Vytvoření služeb

``docker-compose build``

Spuštění testů

``docker-compose up``

Kontrola kódu (PHPStan level 9)

``composer stan``

Kontrola formátu kódu (PSR-12)

``composer phpcs``

Oprava formátu kódu (PSR-12)

``composer phpcbf``

## Technologie a knihovny

- Docker
- PHP 8
- PHPUnit
- PHPStan
- PHP Codesniffer