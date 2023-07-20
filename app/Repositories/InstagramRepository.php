<?php

namespace App\Repositories;

use App\Models\Instagram;
use GuzzleHttp\Client;

class InstagramRepository
{
    public function refresh($instagram)
    {
        try {
            if (is_string($instagram)) {
                $instagram = Instagram::where('uuid', $instagram)->first();
            } else if (is_numeric($instagram)) {
                $instagram = Instagram::find($instagram);
            }
            if (!($instagram instanceof Instagram)) {
                return ['code' => 404, 'message' => 'Instagram not found'];
            }
            return ['code' => 200, 'message' => 'OK'];
        } catch (\Exception $e) {
            return ['code' => 500, $e->getMessage()];
        }
    }
}
