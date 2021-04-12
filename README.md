# Заголовок

PHP Framework вдохновленный Yii и Laravel.

# Требования

Локальный сервер (Open Server, Xampp).

# Установка

git clone https://github.com/matcur/php-framework<br>
cd php-framework<br>
composer init<br>
composer dumpautoload<br>

???<br>
profit<br>

# Документация

## Маршрутизация

Для вызова метода контроллера нужно передать параметр controller и action в ссылке.<br>
Класс контроллера должен: именоваться в CamelCase, заканчиваться на Controller, наследоваться от класса Controller.<br>
Имя метода контроллера должно начинаться с action.<br>
Пространство имен, в котором должны находиться контроллеры, определяется константой<br>
CONTROLLER_NAMESPACE в классе RouteServiceProvider.

### Пример

Ссылка some-site.com/?controller=post&action=show<br>
вызывает метод actionShow класса PostController.

## Service Providers

Используй Service Provider для выполнения твоего кода до создания контроллера.<br>
Service Provider'ы должны наследоваться от класса ServiceProvider.<br>
После создания Service Provider, его нужно добавить в класс Configuration<br>
в поле serviceProviders в конструкторе передавая.

## Dependency Container

Используй DependencyContainer(можно получить через метод getDependecyContainer<br>
у поля $app, которое есть у всех контроллеров) для IoC(инверсия контроля).<br>
Для регистрациии зависимости используй метод addSingleton или addTransient.<br>
Наиболее подходящим местом для регистрации зависимости является ServiceProvider.<br>
Для получения зависимости нужно использовать метод resolve у DependencyContainer.

### Пример

Регистрация зависимоти в ServiceProvider'е<br>
$this->dependencies->addSingleton('logger', function () {<br>
  return new FileLogger(<br>
    new TodayFile($_SERVER['DOCUMENT_ROOT'] . '/../private/log')<br>
  );<br>
});<br>

Получение зависимости в контроллере
$this->logger = $this->dependencies->resolve('logger');
