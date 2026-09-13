<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::with('images')->latest()->get();

        return view('boards.index', compact('boards'));
    }

    public function create()
    {
        return view('boards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:boards,name',
            'type' => 'required|string|max:255',
            'image' => 'required|image|max:4096',
        ]);

        $board = Board::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
        ]);

        $path = $request->file('image')->store('boards', 'public');

        $board->images()->create([
            'type' => Image::TYPE_FEATURED,
            'path' => $path,
        ]);

        return redirect()->route('boards.index')->with('status', 'برد با موفقیت ایجاد شد.');
    }

    public function edit(Board $board)
    {
        $board->load('images');

        return view('boards.edit', compact('board'));
    }

    public function update(Request $request, Board $board)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:boards,name,' . $board->id,
            'type' => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $board->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
        ]);

        if ($request->hasFile('image')) {
            $previous = $board->images()->where('type', Image::TYPE_FEATURED)->first();

            $path = $request->file('image')->store('boards', 'public');

            $board->images()->updateOrCreate(
                ['type' => Image::TYPE_FEATURED],
                ['path' => $path]
            );

            if ($previous) {
                Storage::disk('public')->delete($previous->path);
            }
        }

        return redirect()->route('boards.index')->with('status', 'برد با موفقیت ویرایش شد.');
    }

    public function destroy(Board $board)
    {
        foreach ($board->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $board->delete();

        return redirect()->route('boards.index')->with('status', 'برد حذف شد.');
    }
}
