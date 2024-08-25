<?php

use LaraZeus\Bolt\Mail\FormSubmission;
use LaraZeus\Bolt\Models\Category;
use LaraZeus\Bolt\Models\Collection;
use LaraZeus\Bolt\Models\Field;
use LaraZeus\Bolt\Models\FieldResponse;
use LaraZeus\Bolt\Models\Form;
use LaraZeus\Bolt\Models\FormsStatus;
use LaraZeus\Bolt\Models\Section;

return [
    /**
     * set the default domain.
     */
    'domain' => null,

    /**
     * set the default path for the blog homepage.
     */
    'prefix' => 'bolt',

    /*
     * set database table prefix
     */
    'table-prefix' => 'bolt_',

    /**
     * the middleware you want to apply on all the blog routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    /**
     * you can overwrite any model and use your own
     * you can also configure the model per panel in your panel provider using:
     * ->skyModels([ ... ])
     */
    'models' => [
        'Category' => Category::class,
        'Collection' => Collection::class,
        'Field' => Field::class,
        'FieldResponse' => FieldResponse::class,
        'Form' => Form::class,
        'FormsStatus' => FormsStatus::class,
        'Response' => \LaraZeus\Bolt\Models\Response::class,
        'Section' => Section::class,
    ],

    'defaultMailable' => FormSubmission::class,

    'uploadDisk' => 'public',

    'uploadDirectory' => 'forms',

    'show_presets' => false,

    'allow_design' => false,
];
