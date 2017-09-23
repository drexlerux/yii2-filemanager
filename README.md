Yii2 File Manager
=================
A file manager for Yii2. Allow you to dynamically manager images and files from any location. Also TinyMCE plugin included.


Installation
===============

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist drexlerux/yii2-filemanager "*"
```

or add

```
"drexlerux/yii2-filemanager": "*"
```

to the require section of your `composer.json` file.


<h5>3) Run Migrations</h5>
```
./yii migrate/up --migrationPath=@vendor/drexlerux/yii2-filemanager/migrations
```


Configure
===============

Add the module to the main configuration.

```
<?php
return [
    //...
    'modules' => [
        //...
        'filemanager' => [
            'class'         => 'drexlerux\filemanager\Module',
            'thumbnails'    => [[100,100]],                                              // Optional: array
            'path'          => '/images/uploads/',                                       // Default relative to your web directory or AWS
            'thumbPath'     => '/images/uploads/thumb/',                                 // Default relative to your web directory or AWS
            'url'           => '/',                                                      // either s3 buket URL or CloudFront (can be changed)
            'aws'           => [
                'enable'        => true,
                'key'           => 'YOURAWS_KEY',
                'secret'        => 'YOURAWS_SECRET',
                'bucket'        => 'your-bucket',
            ],
        ],
        //...
    ],
?>
```



Usage
===============

Once the extension is installed, you can access the Module by navigating to http://yourdomain.com/index.php?r=filemanager




Tiny MCE
===============

To use the File Manager with Tiny MCE you need to register the scripts with Yii.

Add Use to head of controller.
```
use drexlerux\filemanager\assets\FilemanagerTinyAssets;
```

Add Register to controller action.
```
FilemanagerTinyAssets::register($this->view);
```

Then add the 'filemanager' plugin to the Tiny MCE plugin. (Example using 2amigos Tiny MCE Package [found HERE](https://github.com/2amigos/yii2-tinymce-widget))

```
<?= $form->field($model, 'text')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'en',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste filemanager"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | filemanager"
    ]
]);?>
```


Notes
===============

Widget and other items still in development.
