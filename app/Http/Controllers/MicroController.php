<?php

namespace App\Http\Controllers;

use App\Models\Img;
use App\Models\Micro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MicroController extends Controller
{
    public function index()
    {
        $micros = Micro::with('imgs')->latest()->get();

        return view('micros.index', compact('micros'));
    }

    public function create()
    {
        return view('micros.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:micros,name',
            'type' => 'required|string|max:255',
            'image' => 'required|image|max:4096',
        ]);

        $micro = Micro::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
        ]);

        $path = $request->file('image')->store('micros', 'public');

        $micro->imgs()->create([
            'type' => Img::TYPE_ICON,
            'path' => $path,
        ]);

        return redirect()->route('micro.index')->with('alert-success', 'میکرو با موفقیت ایجاد شد.');
    }

    public function edit(Micro $micro)
    {
        $micro->load('imgs');

        return view('micros.edit', compact('micro'));
    }

    public function update(Request $request, Micro $micro)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:micros,name,' . $micro->id,
            'type' => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $micro->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
        ]);

        if ($request->hasFile('image')) {
            $previous = $micro->imgs()->where('type', Img::TYPE_ICON)->first();

            $path = $request->file('image')->store('micros', 'public');

            $micro->imgs()->updateOrCreate(
                ['type' => Img::TYPE_ICON],
                ['path' => $path]
            );

            if ($previous) {
                Storage::disk('public')->delete($previous->path);
            }
        }

        return redirect()->route('micro.index')->with('alert-success', 'میکرو با موفقیت ویرایش شد.');
    }

    public function destroy(Micro $micro)
    {
        foreach ($micro->imgs as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }

        $micro->delete();

        return redirect()->route('micro.index')->with('alert-success', 'میکرو حذف شد.');
    }
}
