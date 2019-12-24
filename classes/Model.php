<?php

namespace Neat\View;

interface Model
{
    /**
     * Get view template
     *
     * @return string
     */
    public function template(): string;

    /**
     * Get view data
     *
     * @return array
     */
    public function data(): array;
}
