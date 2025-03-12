<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HealthCheckController extends Controller
{
    public function check(): JsonResponse
    {
        try {
            DB::connection()->getPdo();
            $dbStatus = 'ok';
        } catch (\Exception $e) {
            $dbStatus = 'error';
        }

        try {
            Redis::ping();
            $redisStatus = 'ok';
        } catch (\Exception $e) {
            $redisStatus = 'error';
        }

        return response()->json([
            'status' => 'ok',
            'database' => $dbStatus,
            'redis' => $redisStatus,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
