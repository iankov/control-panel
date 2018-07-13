# Installation

```bash
 composer require iankov/control-panel
```

* Update guards, providers, passwords in `config/auth.php`

    ```php
    'guards' => [
        ...
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],
    'providers' => [
        ...
        'admins' => [
            'driver' => 'eloquent',
            'model' => Iankov\ControlPanel\Models\Admin::class,
        ],
    ],
    'passwords' => [
        ...
        'admins' => [
            'provider' => 'admins',
            'table' => 'admin_password_resets',
            'expire' => 60,
        ],
    ],
    ```

* Publish config file
    ```bash
    php artisan vendor:publish --tag=icp_config
    ```

* Publish public assets
    ```bash
    php artisan vendor:publish --tag=icp_public
    ```
    
* Publish migrations
    ```bash
    php artisan vendor:publish --tag=icp_migrations
    ```
        
* Publish seeds
    ```bash
    php artisan vendor:publish --tag=icp_seeds
    ```

* Run migrations

    ```bash
    php artisan migrate
    ```

* Run dump autoload
    ```bash
    composer dump-autoload
    ```
    
* Run seeder to insert initial admin user. Login: admin@admin.com, Password: admin

    ```bash
    php artisan db:seed --class=Admins
    ```

## Elfinder file manager integration

[Laravel elfinder package](https://github.com/barryvdh/laravel-elfinder) 

[Configuration options](https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1)

 * Add the ServiceProvider to the providers array in `app/config/app.php`

    ```php
    Barryvdh\Elfinder\ElfinderServiceProvider::class
    ``` 

 * You need to copy the assets to the public folder, using the following artisan command:

    ```bash
    php artisan elfinder:publish
    ```
 * Copy `vendor/iankov/control-panel/public/packages/barryvdh` to `public/barryvdh`.
    You can do this by publishing iankov/control-panel assets
    ```bash
    php artisan vendor:publish --tag=icp_public
    ```

 * Publish the config file

    ```bash
    php artisan vendor:publish --provider='Barryvdh\Elfinder\ElfinderServiceProvider' --tag=config
    ```

 * Change elfinder config

    ```php
        'route' => [
            'prefix' => 'control/elfinder',
            'middleware' => 'icp', //Set to null to disable middleware filter
        ],
        
        //required for default ckeditor integration: images/files browse/upload
        'roots' => [
            'images' => [
                'alias' => '/images',
                'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
                'path' => public_path('images'), // path to files (REQUIRED)
                'URL' => '/images', // URL to files (REQUIRED)
                'uploadOrder' => ['allow', 'deny'],
                'uploadAllow' => ['image'], # allow any images
            ],
            'root' => [
                'alias' => '/',
                'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
                'path' => public_path(''), // path to files (REQUIRED)
                'URL' => '/', // URL to files (REQUIRED)
            ]
        ],
        
        //default options for all roots
        'root_options' => array(
            'accessControl' => '', // filter callback (OPTIONAL)
            'tmbURL' => '/_tmb',
            'tmbPath' => public_path('_tmb').'/',
        ),
    ```

 * Create 'images' folder in your public dir to match `roots.images` config path

## Horizontal form groups

* Create horizontal group elements like this
```html
<div class="form-group ">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <input name="name" value="" placeholder="John Mitchel" type="text" class="form-control">
    </div>
</div>
```
When validation error occured, text of an error be shown in the bottom of the field. 
The field itself will have a red border.

* Required array fields:
    *    **name** - html field name attribute
    *    **label** - label text
    *    **value** - value of html element
    *    **items** - only for **icp::forms.horizontal.select-group**. Array/object of items for \<select> options

* Additional array fields:
    *    **attr** - array, any html attribute applied to html field
    *    **col1_class** - first column class (default: col-sm-2)
    *    **col1_class** - second column class (default: col-sm-10)
    *    **prepend** - the same as **items** only for **select-group**, but these elements stay in front of other options

* Example of form group usage.

    * Create \<input> element
        ```bash
        @include('icp::forms.horizontal.text-group', ['name' => 'title', 'label' => 'Title', 'value' => old('title', $article->title)])
        ```

    * Create \<select> element
        ```bash
        @include('icp::forms.horizontal.select-group', [
            'name' => 'category_id',
            'label' => 'Category',
            'value' => old('category_id', $article->category_id),
            'items' => $categories->pluck('title', 'id'),
            'prepend' => [0 => ' - ']
        ])
        ```

    * Create \<input type="checkbox"> element
        ```bash
        @include('icp::forms.horizontal.checkbox-group', ['name' => 'active', 'value' => old('active', $article->active), 'label' => 'Active'])
        ```
    * Create \<textarea> element
        ```bash
        @include('icp::forms.horizontal.textarea-group', ['name' => 'description', 'label' => 'Meta description', 'value' => old('description', $article->description)])
        ```
        
