<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pin;

class PinController extends Controller
{
    public function index()
    {
        $pins = Pin::with(['user' => function($query) {
            $query->select([
                'id', 'avatar', 'name'
            ]);
        }])
            ->withCount('comments')->paginate();

        return response()->json($pins);
    }

    public function user($id)
    {
        $pins = Pin::with(['user' => function($query) {
            $query->select([
                'id', 'avatar', 'name'
            ]);
        }])->where('user_id', $id)
            ->withCount('comments')->paginate();

        return response()->json($pins);
    }

    public function view($id)
    {
        $pins = Pin::with(['user' => function($query) {
            $query->select([
                'id', 'avatar', 'name'
            ]);
        }, 'comments' => function($query) {
            $query->orderBy('id', 'desc')
                ->with(['user' => function($query) {
                    $query->select([
                        'id', 'avatar', 'name'
                    ]);
                }]);
        }])
            ->withCount('comments')->findOrFail($id);

        return response()->json($pins);
    }
}
