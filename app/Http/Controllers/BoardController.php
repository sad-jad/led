<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Img;
use App\Models\Micro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::with('imgs')->latest()->get();

        return view('boards.index', compact('boards'));
    }

    public function create()
    {
        $micros = Micro::orderBy('name')->get();

        return view('boards.create', compact('micros'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:boards,name',
            'type' => 'required|string|max:255',
            'micro_id' => 'required|exists:micros,id',
            'image' => 'required|image|max:4096',
        ]);

        $board = Board::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'micro_id' => $validated['micro_id'],
        ]);

        $path = $request->file('image')->store('boards', 'public');

        $board->imgs()->create([
            'type' => Img::TYPE_ICON,
            'path' => $path,
        ]);

        return redirect()->route('board.index')->with('alert-success', 'برد با موفقیت ایجاد شد.');
    }

    public function edit(Board $board)
    {
        $board->load('imgs');
        $micros = Micro::orderBy('name')->get();

        return view('boards.edit', compact('board', 'micros'));
    }

    public function update(Request $request, Board $board)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:boards,name,' . $board->id,
            'type' => 'required|string|max:255',
            'micro_id' => 'required|exists:micros,id',
            'image' => 'nullable|image|max:4096',
        ]);

        $board->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'micro_id' => $validated['micro_id'],
        ]);

        if ($request->hasFile('image')) {
            $previous = $board->imgs()->where('type', Img::TYPE_ICON)->first();

            $path = $request->file('image')->store('boards', 'public');

            $board->imgs()->updateOrCreate(
                ['type' => Img::TYPE_ICON],
                ['path' => $path]
            );

            if ($previous) {
                Storage::disk('public')->delete($previous->path);
            }
        }

        return redirect()->route('board.index')->with('alert-success', 'برد با موفقیت ویرایش شد.');
    }

    public function destroy(Board $board)
    {
        foreach ($board->imgs as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }

        $board->delete();

        return redirect()->route('board.index')->with('alert-success', 'برد حذف شد.');
    }
}
