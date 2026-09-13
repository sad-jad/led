<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::withCount('boards')->latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $project = Project::create([
            'title' => $validated['title'],
            'user_id' => auth()->id() ?? User::first()?->id ?? User::factory()->create()->id,
        ]);

        return redirect()->route('projects.edit', $project)->with('status', 'پروژه ایجاد شد. حالا می‌توانید بردها را اضافه کنید.');
    }

    public function edit(Project $project)
    {
        $project->load('boards.images');

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('status', 'پروژه ویرایش شد.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('status', 'پروژه حذف شد.');
    }

    public function searchBoards(Project $project, Request $request)
    {
        $query = trim((string) $request->query('q'));
        $attachedIds = $project->boards()->pluck('boards.id');

        $boards = Board::with('images')
            ->whereNotIn('id', $attachedIds)
            ->when($query !== '', fn ($q) => $q->where('name', 'like', "%{$query}%"))
            ->orderBy('name')
            ->limit(20)
            ->get();

        return response()->json($boards->map(fn (Board $board) => [
            'id' => $board->id,
            'name' => $board->name,
            'type' => $board->type,
            'image_url' => $board->featuredImage() ? Storage::url($board->featuredImage()->path) : null,
        ]));
    }

    public function attachBoard(Project $project, Board $board)
    {
        $project->boards()->syncWithoutDetaching([$board->id]);

        return response()->json([
            'id' => $board->id,
            'name' => $board->name,
            'type' => $board->type,
            'image_url' => $board->featuredImage() ? Storage::url($board->featuredImage()->path) : null,
        ]);
    }

    public function detachBoard(Project $project, Board $board)
    {
        $project->boards()->detach($board->id);

        return response()->noContent();
    }
}
