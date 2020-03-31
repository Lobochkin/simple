## Настройки конфигурации PhpStorm
+ **PHP - стиль форматирования: PSR1/PSR2.** (File / Settings / Editor / Code Style / PHP / Set from... / Predefined Style / PSR1/PSR2)
+ **JavaScript - стиль форматирования:  Google JavaScript Style Guide.** (... / JavaScript / Set from... / Predefined Style / Google JavaScript Style Guide)
+ **JavaScript - форматиование табулиции и висячих запятых** - ( ./JavaScript / Tab and Indents / Tab size: 4, Indent: 4 ) ( ./JavaScript / Punctuation / Trailing comma: Remove )
+ **Line separator - Unix(\n).** (File / Settings / Editor / Code Style / Line separator: Unix and macOS(\n)).

## Настройка GIT
Для винды:
```
git config --global core.autocrlf true
```

Для *nix:

```
git config --global core.autocrlf input
```

## Требования к PHP
+ Писать код в стиле PSR-1 и PSR-2
+ В названии переменных использовать/свойств использовать венгерскую нотацию, либо ее альтернативу, позволяющую определить тип данных, содержащихся в переменной, по ее названию:

Тип | Префикс | Пример | Пояснение
--- | --- | --- | ---
string | str | $strCode | 
array | ar | $arResult | 
integer | int | $intCount | 
float / double | fl | $flPrice | 
numeric | num | $numQuantity | Используется, когда значение может быть numeric или float (к примеру извлекается из базы), но как сам факт - числом.
boolean | is | $isContinue | 
object | ob | $obOrder | 
resource | res | $resFileLog | 
callback / function | F | $FAddToLog | 
class | C | $CApplication | 
abstract class | AC | $ACApplication | 
interface | I | $IDataManager | 
глобальные переменные | g_ | $g_arResult | 
mixed | mix | $mixResult | Используется, когда невозможно заранее предугадать, какое будет итоговое значение. Чаще всего используется в качестве `return` значения в методах, от которых можно ожидать, к примеру, `array` или `null`.

+ Для всех самописных классов, интерфейсов и т.п. использовать PHPDoc с нормальным документированием, для чего класс, для чего методы и т.п.
+ Не создавать классы, интерфейсы и т.п. в глобальной области видимости - используйте namespace.
+ Не создавать глобальные функции - либо сделайте анонимную в переменную, либо создайте класс в своем namespace.
+ Все константы и ключи массивов должны быть в верхнем регистре! Разделяются слова символом нижнего подчеркивания.

## Что делать нужно:
### Требования к безопасности
+ Необходимо проверять ВСЕ данные, получаемые от пользователей, форм и иных запросов на иньекции, XXE и т.п.
+ Все ajax запросы должны содержать в себе данные csrf-токен битрикса, а принимающий скрипт должен проверят csrf-токен. Изучите что такое `check_bitrix_sessid()`, `bitrix_sessid_get()` и `bitrix_sessid_post()`.

**Мне абслютно не интересно, что проект находится в закрытой сети!** Если по каким либо причинам боевые данные утекут/пострадают из-за не соблюдения банальных правил защиты от иньекций, csrf, ssrf, XXE и т.п. атак - мы с вами все дружно сами окажимся в закрытой сети. Рыболовной сети. На дне Финского залива...

### Требование к отправке кода
 + Перед пушем коммита необходимо пройтись по всем файлам, которые будут переданы, и произвести реформатирование кода.
 + Напоминаю про настройку GIT конфигурации из начала документа!

## Что делать запрещено:
+ PHP: Использовать перемеренную переменной (`$$arResult`)
+ PHP: GOTO
+ GIT: `git push --force`. За это будет отдельный выговор с занесением в грудную клетку. Кто это сделает - тот потом и будет разгребать все, что натворил.
+ GIT: `git rebase`. Если достиг в использовании этой комманды дзена и используешь ее со временно изобретения машинного кода - можешь использовать. Если нет - не лезь, она тебя сожрет! 
+ PHP: Оставлять `dump()`, `print_r()` и т.п. в боевом коде.

## Немного данных по проекту
### Импорты и другие консольные команды.
Еще не так давно все импорты находились в **/external_data_import/**, потом они перехали в **/external_data_import/auto/** и начали запускаться через ```php external_data_import/auto/import.php```.
Но вот пришел Евген и открыл миру Symphony\Console.

Короче, у нас теперь появился единый консольный терминал - ```php local/console```.

Нужен функционал и хочешь запустить его через консоль - создай команду в **Local\Core\Console** по примеру  **\Local\Core\Console\Import\EksCommand**, добавь ее в **local/console** и используй на здоровье.