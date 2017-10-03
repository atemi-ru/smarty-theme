Шаблон smarty для франшизы atemi
====================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist atemi/smarty-theme "*"
```

or add

```
"atemi/smarty-theme": "*"
```

Configuration app
----------

```php

'components' => [
    'view' => [
        'theme' =>
        [
            'pathMap' =>
            [
                '@app/views' =>
                [
                    '@atemi/themes/smarty/theme',
                ],
            ]
        ],
    ],
],

```

___

> [![skeeks!](https://skeeks.com/img/logo/logo-no-title-80px.png)](https://skeeks.com)  
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>  
[skeeks.com](https://skeeks.com) | [cms.skeeks.com](https://cms.skeeks.com)