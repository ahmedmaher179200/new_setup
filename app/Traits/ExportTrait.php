<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ExportTrait
{
    public function exportToJSON($query, $columns)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(300);

        $results = [];
        
        $query->chunk(1000, function ($rows) use (&$results, $columns) {
            foreach ($rows as $row) {
                $item = [];
                foreach ($columns as $dbCol => $label) {
                    if (is_callable($label)) {
                        $item[$dbCol] = $label($row);
                    } else {
                        $item[$label] = $row->$dbCol;
                    }
                }
                $results[] = $item;
            }
        });

        return response()->json([
            'status' => 'success',
            'data' => $results
        ]);
    }
}
