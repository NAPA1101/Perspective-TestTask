Задача 1
В админ панели в разделе Store-Configuration на отдельной страничке создать компонент мультиселект, в котором будет
выводится список категорий в формате Имя(ID ). Для продуктов, выбранной администратором категории, сформировать строку в
формате: имя_категории_ID_SKU_продукта_type, и вывести на карточке продукта под его именем. Использовать плагин. В
админке предусмотреть вкл/выкл модуля.

Дополнительно 1: создать модуль на основе вышестоящей задачи и преобразовать задачу следующим образом:
добавить в админке поле для ввода даты окончания продаж
администратор выбирает категорию продуктов и дату окончания продаж
если до окончания продаж остается N дней и меньше в новом блоке, который расположен под названием товара
вывести: Продажа данного товара заканчивается … (указать дату) Для указания N - количества дней рекомендуется в
админ панели организовать специальное окно ввода. Можно разместить его непосредственно под выбором даты.
если выбранная дата меньше текущей, дополнительные сообщения на карточке товара отсутствуют;

Дополнительно 2: (использовать крон)
Каждый день с 8 до 10 утра выводить надпись "С 8 до 10 скидка 10%"
И еще сделать дополнительную надпись помимо обычной цены: "Цена по скидке - написать пониженную на 10%". Рекомендуется
добавить настройку размера скидки в админку.

Дополнительно 3: (желательно разобраться)
Доработать предыдущий пункт так, чтобы все это происходило не для всех покупателей, а для тех, кто относится к пенсионерам.
Сообщение “С 8 до 10 утра пенсионерам скидка 15%“ появляется только для группы кастомеров “Пенсионер”, а также новая цена
заменяет стандартную цену на пониженную