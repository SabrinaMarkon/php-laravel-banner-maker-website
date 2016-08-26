<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use DB;

// first trait w00t! Position ordering for faq records.
trait FaqsTrait {

    /**
     * Gets the next available position number for ordering FAQs.
     *
     * @return mixed
     */
    public function getLast() {
        $last = DB::table('faqs')->max('positionnumber');
        return $last+1;
    }

    public function saveOrder($faq_id_order) {
        $faq_id_array = explode('&', $faq_id_order);
        $counter = 1;
        foreach ($faq_id_array as $faq_id) {
            $faq_id_array = explode('=', $faq_id);
            $id = $faq_id_array[1];
            DB::table('faqs')->where('id', $id)->update(['positionnumber' => $counter]);
            $counter++;
        };
    }

}