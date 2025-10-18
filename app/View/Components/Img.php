<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Img extends Component
{
    public ?string $path;
    public int|string|null $width;
    public int|string|null $height;
    public string $class;
    public string $alt;
    public string $name;

    public function __construct(?string $path = null, string $name = '', $width = 350, $height = 250, $class = 'img-rounded img-thumbnail', $alt = '')
    {
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
        $this->class = $class;
        $this->alt = $alt;
        $this->name = $name;
    }

    public function render()
    {
        $vcardPath = $this->path ?? null;
        $vcardFullPath = $vcardPath ? public_path('storage/' . $vcardPath) : null;

        $vcardUrl = ($vcardFullPath && file_exists($vcardFullPath))
            ? asset('storage/' . $vcardPath)
            : asset('storage/profile-photos/NoImage.jpg');

        return view('components.img', ['src' => $vcardUrl]);
    }
}
