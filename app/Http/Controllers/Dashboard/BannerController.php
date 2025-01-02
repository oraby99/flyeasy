<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('dashboard.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('dashboard.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('banners', 'public');

        Banner::create([
            'title' => $validated['title'],
            'image_path' => $path,
        ]);

        return redirect()->route('dashboard.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('dashboard.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $banner->update(['image_path' => $path]);
        }

        $banner->update(['title' => $validated['title']]);

        return redirect()->route('dashboard.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('dashboard.banners.index')->with('success', 'Banner deleted successfully.');
    }
}