<?php

namespace App\Models;

class User {
    public static function all() {
        return [
            ['name' => 'John Doe'],
            ['name' => 'Jane Doe']
        ];
    }
}
