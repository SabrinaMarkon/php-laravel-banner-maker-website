<?php

namespace App\Http\Controllers;

use App\Models\Builder;
use App\Models\Builder_cat;
use App\Models\Builder_site;
use App\Http\Controllers\Controller;
use DB;

// Position ordering for downline builder categories.
trait BuildersTrait {

    /**
     * Gets the next available position number for ordering categories.
     *
     * @return mixed
     */
    public function getLast() {
        $last = DB::table('builder')->where('userid', 'sabrina')->max('positionnumber'); //////FIX THIS WHEN WE HAVE A USERID.
        return $last+1;
    }

    public function saveOrder($builders_id_order) {
        $builder_id_array = explode('&', $builders_id_order);
        $counter = 1;
        foreach ($builder_id_array as $builder_id) {
            $builder_id_array = explode('=', $builder_id);
            $id = $builder_id_array[1];
            DB::table('builder')->where('id', $id)->update(['positionnumber' => $counter]);
            $counter++;
        };
    }

}