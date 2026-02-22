<?php
namespace App\Http\Services;

use Cache;

class CacheService
{
    public function clearCache(string $key_prefix)
    {
        for ($i = 1; $i <= 500; $i++) {
            $key = $key_prefix . $i;
            if (Cache::has($key)) {
                Cache::forget($key);
            } else {
                // Stop looping if the key for the page doesn't exist
                break;
            }
        }

    }
}
