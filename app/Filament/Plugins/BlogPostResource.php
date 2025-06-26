<?php

namespace App\Filament\Plugins;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Resources\PostResource as BasePostResource;

class BlogPostResource extends BasePostResource
{
    /**
     * Override the form method to update the disk setting for file uploads.
     */
    public static function form(Form $form): Form
    {
        // Get the original schema from the Post model.
        $schema = Post::getForm();

        // Loop through each component in the schema.
        foreach ($schema as $index => $component) {
            // Check if the component is an instance of FileUpload.
            if ($component instanceof FileUpload) {
                // Update the disk using the value from your config file.
                $schema[$index] = $component->disk(config('filamentblog.disk', 'DO-SPACES'));
            }
        }

        // Return the modified schema.
        return $form->schema($schema);
    }
}
