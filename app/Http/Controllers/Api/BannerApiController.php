<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerApiController extends Controller
{
    public function index(): JsonResponse
    {
        $banners = Banner::orderBy('position')->get(['id', 'url', 'target_type', 'position']);

        return response()->json($banners);
    }

    public function viewBanner(Banner $banner): JsonResponse
    {
        $banner->incrementViews();
        return response()->json(['message' => 'View recorded']);
    }

    public function clickBanner(Banner $banner): JsonResponse
    {
        $banner->incrementClicks();
        return response()->json(['message' => 'Click recorded']);
    }
}
