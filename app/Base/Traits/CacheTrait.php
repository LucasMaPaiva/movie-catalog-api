<?php

namespace App\Base\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheTrait {

    use HandlerLog;

    /**
     * @param string $key
     * @param callable $callback
     * @param int|null $minutes
     * @return mixed
     */
    public function cache(string $key, callable $callback, ?int $minutes = null): mixed {
        try {
            return Cache::remember($key, $minutes ?? config('api.cache.ttl'), $callback);
        } catch (\Predis\Connection\ConnectionException $exception) {
            self::registerLog(
                exception: $exception,
                message: 'CACHE - ' . $exception->getMessage(),
                status_code: 001
            );
            return $callback();
        }
    }

    /**
     * @param $user_id
     * @return void
     */
    public function clearUserCache($user_id): void {
        Cache::forget('user_id_' . $user_id);
    }

}
