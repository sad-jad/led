<?php

namespace App\Http\Controllers;

use App\Models\Micro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PinController extends Controller
{
    public function store(Request $request, Micro $micro)
    {
        $validated = $this->validatePin($request, $micro);

        $pin = $micro->pins()->create($validated);

        return response()->json([
            'id' => $pin->id,
            'name' => $pin->name,
            'x' => $pin->x,
            'y' => $pin->y,
        ]);
    }

    public function update(Request $request, Micro $micro, $pin)
    {
        $pinModel = $micro->pins()->findOrFail($pin);

        $validated = $this->validatePin($request, $micro, $pinModel->id);

        $pinModel->update($validated);

        return response()->json([
            'id' => $pinModel->id,
            'name' => $pinModel->name,
            'x' => $pinModel->x,
            'y' => $pinModel->y,
        ]);
    }

    public function destroy(Micro $micro, $pin)
    {
        $micro->pins()->findOrFail($pin)->delete();

        return response()->noContent();
    }

    private function validatePin(Request $request, Micro $micro, ?int $ignorePinId = null): array
    {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z0-9_-]+$/',
                Rule::unique('pins', 'name')
                    ->where(fn ($query) => $query->where('typeable_id', $micro->id)
                        ->where('typeable_type', Micro::class))
                    ->ignore($ignorePinId),
            ],
            'x' => ['required', 'integer', 'min:0', 'max:255'],
            'y' => ['required', 'integer', 'min:0', 'max:255'],
        ]);
    }
}
