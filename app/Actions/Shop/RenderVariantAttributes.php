<?php

namespace App\Actions\Shop;

class RenderVariantAttributes
{
    /**
     * Format variant attributes for display
     *
     * @param  object  $variant  The variant object with attributes
     * @return array Formatted attributes as key-value pairs
     */
    public function execute(object $variant): array
    {
        $enumMappings = config('enums', []); // Retrieve mappings from config
        $output = [];

        foreach ($enumMappings as $key => $enumClass) {
            $value = $variant->$key ?? null; // Safely access value

            if ($value instanceof $enumClass) {
                $output[$key] = ucfirst($key).': '.$value->getLabel();
            } elseif (! is_null($value)) {
                $output[$key] = ucfirst($key).': '.$value;
            }
        }

        return $output;
    }
}
