## Admin Cube ##

Admin panel and tools based on php framework Yii2.
This repository is development package.

#### Installing using Composer####

With Composer installed, you can then install the Cube using the following command:

    composer require cubiclab/admin-cube:"dev-master"

Add the following lines to your YII config:
```php
// app/config/web.php
return [
    'modules' => [
        'admin' => [
            'class' => 'yii\admincube\AdminCube',
        ],
    ],
];
```