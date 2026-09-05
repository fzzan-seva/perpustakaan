<?php

namespace App\View\Components;

use Illuminate\Support\Facades\File;
use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $name,
        public string $class = '',
    ) {}

    public function render(): string
    {
        $filePath = resource_path('icons/heroicons/'.$this->name.'.svg');

        if (! File::exists($filePath)) {
            return '<!-- icon not found: '.e($this->name).' -->';
        }

        $svg = File::get($filePath);
        $svg = trim(preg_replace('/^(<\?xml.+?\?>)/', '', $svg));

        if ($this->class) {
            $svg = preg_replace('/<svg/', '<svg class="'.e($this->class).'"', $svg, 1);
        }

        return $svg;
    }
}
