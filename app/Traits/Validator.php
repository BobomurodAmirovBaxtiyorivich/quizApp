<?php

namespace App\Traits;

trait Validator {

    public function validate(array $data):void {
        $reauiredkeys = [];
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $_REQUEST) and !empty($_REQUEST[$key])) {
                continue;
            }
            $reauiredkeys[$key] = $key . ' is required';
        }
        if (!empty($reauiredkeys)){
            APIresponse(['errors' => $reauiredkeys], 400);
        }
    }
}

