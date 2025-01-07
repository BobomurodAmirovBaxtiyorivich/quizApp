<?php

namespace Src;

use App\Models\DB;
class Auth {

    public static function check():true {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            APIresponse(['error' => 'Unauthorized'], 403);
        }

        if (!str_starts_with($headers['Authorization'], 'Bearer ')) {
            APIresponse(['error' => 'Authorization format is invalid, allowed format is Bearer'], 400);
        }
        $token = str_replace('Bearer ', '', $headers['Authorization']);

        $db = new DB();

        $conn = $db->getConnection();

        $query = "SELECT * FROM user_api_token WHERE token = :token";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':token' => $token,
            ]);
        $APItoken = $stmt->fetch();
        if (!$APItoken) {
            APIresponse([
                'error' => 'Unauthorized'
                ], 403);
        }
        return true;
    }
}