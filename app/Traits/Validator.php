<?php

namespace App\Traits;

trait Validator {

    public function validate(array $data):void {
        $requiredKeys = [];
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $_REQUEST) and !empty($_REQUEST[$key])) {
                continue;
            }
            $requiredKeys[$key] = $key . ' is required';
        }
        if (!empty($requiredKeys)){
            APIresponse(['errors' => $requiredKeys], 400);
        }
    }
}

