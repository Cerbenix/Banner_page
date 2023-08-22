<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\RedirectResponse;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::orderBy('position')->get();
        $bannersByPosition = $banners->groupBy('position');

        $positionTitles = [
            1 => 'Slider',
            2 => 'Sidebar',
            3 => 'Footer Left',
            4 => 'Footer Middle',
            5 => 'Footer Right',
        ];

        return view('banner_management', compact('bannersByPosition', 'positionTitles'));
    }

    public function show(string $url): BinaryFileResponse
    {
        $banner = Banner::where('url', $url)->first();

        if (!$banner) {
            abort(404);
        }

        $imagePath = storage_path('app/public/' . $banner->image_path);

        return response()->file($imagePath);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif',
            'url' => 'required|string',
            'target_type' => 'required|in:same_window,new_window',
            'position' => 'required|integer',
        ]);

        $imagePath = $request->file('image')->store('banners', 'public');

        Banner::create([
            'image_path' => $imagePath,
            'url' => $validatedData['url'],
            'target_type' => $validatedData['target_type'],
            'position' => $validatedData['position'],
        ]);

        return redirect()->route('banners.index')
            ->with('success', 'Banner uploaded successfully.');
    }

    public function destroy(Request $request, Banner $banner): RedirectResponse
    {
        $banner->delete();

        return redirect()->back()->with('success', 'Banner deleted successfully.');
    }
}
