Описания для плагина Particles Background Ultimate by DDG - site go-studio.pro на русском и английском языках:

[RU]

=== Particles Background Ultimate от DDG ===
Участники: go-studio.pro
Теги: частицы, фон, анимация, холст, эффекты
Требуется как минимум: WordPress 5.6
Протестировано до: WordPress 6.5
Стабильный тег: 1.6
Лицензия: GPLv2 или более поздняя версия
URI лицензии: https://www.gnu.org/licenses/gpl-2.0.html

Создавайте потрясающие интерактивные фоны из частиц с полными возможностями настройки.

== Описание ==

Профессиональная система частиц для WordPress, которая создает динамические интерактивные фоны. Идеально подходит для креативных веб-сайтов, портфолио и целевых страниц.

**Основные особенности:**
- 🎨 3 настраиваемых цвета частиц
- ↔️ Регулируемые соединительные линии (вкл./выкл., цвет, ширина)
- 🚀 Управление количеством частиц (10–500) и скоростью
- 🌈 Поддержка градиентного фона с контролем угла
- 📌 Отображение только на выбранных страницах
- 🖱️ Интерактивные эффекты мыши (наведение/щелчок)
- 📱 Полностью адаптивный дизайн

== Установка ==

1. Загрузите папку `particles-background` в `/wp-content/plugins/`
2. Активируйте плагин через меню «Плагины» в WordPress
3. Перейдите в Настройки → Частицы от DDG для настройки

== Часто задаваемые вопросы ==

= Как изменить цвета частиц? =
Перейдите в Настройки → Частицы от DDG и используйте палитры цветов для Первичных, Вторичных и Третичных цветов.

= Могу ли я использовать градиенты для фона? =
Да! Выберите «Градиент» в качестве типа фона и задайте цвета + угол (0-360°).

= Почему я не вижу частицы на своей странице? =
1. Проверьте, выбрана ли страница в настройках плагина
2. Убедитесь, что в вашей теме есть хук `wp_body_open()`
3. Временно отключите все плагины кэширования

= Как добавлять частицы только на определенные страницы? =
В настройках плагина выберите страницы из раскрывающегося списка с множественным выбором (удерживайте CTRL для выбора нескольких).

== Скриншоты ==
1. Страница настроек плагина — настройка всех параметров частиц
2. Демонстрация внешнего интерфейса — Интерактивные частицы с соединительными линиями
3. Мобильный вид — Полностью адаптивная система частиц

== Журнал изменений ==

= 1.6 =
* Добавлен контроль угла градиента
* Исправлена ​​адаптивность мобильных устройств
* Улучшена производительность

= 1.5 =
* Добавлена ​​3-цветная система для частиц
* Управление соединением линий
* Совместимость с WordPress 6.5

= 1.0 =
* Первоначальный выпуск с базовой системой частиц

== Уведомление об обновлении ==
1.6 включает критические улучшения производительности — рекомендуется для всех пользователей.

== Настройка ==
Добавьте это в файл functions.php вашей темы для расширенного управления:

php
add_filter('ddg_particles_config', function($config) {
$config['particles']['shape']['type'] = 'triangle'; // Изменить форму
return $config;
});

Descriptions for the Particles Background Ultimate by DDG plugin - site go-studio.pro in Russian and English:

[EN]

=== Particles Background Ultimate by DDG ===
Contributors: go-studio.pro
Tags: particles, background, animation, canvas, effects
Requires at least: WordPress 5.6
Tested up to: WordPress 6.5
Stable tag: 1.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create stunning interactive particle backgrounds with full customization options.

== Description ==

Professional particle system for WordPress that creates dynamic, interactive backgrounds. Perfect for creative websites, portfolios, and landing pages.

**Key Features:**
- 🎨 3 customizable particle colors
- ↔️ Adjustable connection lines (on/off, color, width)
- 🚀 Control particle count (10-500) and speed
- 🌈 Gradient background support with angle control
- 📌 Display on selected pages only
- 🖱️ Interactive mouse effects (hover/click)
- 📱 Fully responsive design

== Installation ==

1. Upload the `particles-background` folder to `/wp-content/plugins/`
2. Activate the plugin through 'Plugins' menu in WordPress
3. Go to Settings → Particles by DDG to configure


== Frequently Asked Questions ==

= How do I change particle colors? =
Go to Settings → Particles by DDG and use the color pickers for Primary, Secondary and Tertiary colors.

= Can I use gradients for background? =
Yes! Select "Gradient" as background type and set your colors + angle (0-360°).

= Why don't I see particles on my page? =
1. Check if the page is selected in plugin settings
2. Ensure your theme has `wp_body_open()` hook
3. Disable any caching plugins temporarily

= How to add particles to specific pages only? =
In plugin settings, select pages from the multi-select dropdown (hold CTRL for multiple).

== Screenshots ==
1. Plugin settings page - Configure all particle parameters
2. Frontend demo - Interactive particles with connection lines
3. Mobile view - Fully responsive particle system

== Changelog ==

= 1.6 =
* Added gradient angle control
* Fixed mobile responsiveness
* Improved performance

= 1.5 =
* Added 3-color system for particles
* Line connection controls
* WordPress 6.5 compatibility

= 1.0 =
* Initial release with basic particle system

== Upgrade Notice ==
1.6 includes critical performance improvements - recommended for all users.

== Customization ==
Add this to your theme's functions.php for advanced control:

```php
add_filter('ddg_particles_config', function($config) {
    $config['particles']['shape']['type'] = 'triangle'; // Change shape
    return $config;
});

