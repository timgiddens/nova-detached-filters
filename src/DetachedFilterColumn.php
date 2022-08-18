<?php

namespace OptimistDigital\NovaDetachedFilters;

use JsonSerializable;
use Laravel\Nova\Makeable;

class DetachedFilterColumn implements JsonSerializable
{
    use Makeable;

    public $filters = [];
    protected $width = 'w-auto';
    protected $name = 'detached-filter-column';
    protected $title = null;
    protected $subheader = null;

    public function __construct($filters, $width = 'w-auto', $title = null, $subheader = null)
    {
        $this->filters = $filters;
        $this->width = $width;
        $this->title = $title;
        $this->subheader = $subheader;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'width' => $this->width,
            'name' => $this->name,
            'title' => $this->title,
            'subheader' => $this->subheader,
            'filters' => collect(is_callable($this->filters) ? $this->filters() : $this->filters)->map(function ($filter) {
                return $filter->jsonSerialize();
            }),
        ];
    }
}
