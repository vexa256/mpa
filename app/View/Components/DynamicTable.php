<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DynamicTable extends Component
{

    public $query;
    public $actions;
    public $ignoreColumns;
    public $headers;
    public $rows;

    public function __construct($query, $actions = true, $ignoreColumns = [])
    {
        $this->query         = $query;
        $this->actions       = $actions;
        $this->ignoreColumns = $ignoreColumns;
        $this->headers       = $this->generateHeaders();
        $this->rows          = $this->generateRows();
    }
    private function generateHeaders()
    {
        $headers = [];

        foreach ($this->rows[0] as $key => $value) {
            if (!in_array($key, $this->ignoreColumns)) {
                $headers[] = ucwords(str_replace('_', ' ', $key));
            }
        }

        return $headers;
    }

    private function generateRows()
    {
        $rows = [];

        $results = $this->query->get();

        if ($results->count() > 0) {
            foreach ($results as $result) {
                $row = [];

                foreach ($result as $key => $value) {
                    if (!in_array($key, $this->ignoreColumns)) {
                        $row[$key] = $value;
                    }
                }

                $rows[] = $row;
            }
        }

        return $rows;
    }

    public function render()
    {
        return view('components.dynamic-table');
    }
}