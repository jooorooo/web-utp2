<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePinRequest;
use App\Models\Pin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinController extends Controller
{
    public function index()
    {
        $pins = Pin::with(['user' => function($query) {
            $query->select([
                'id', 'avatar', 'name'
            ]);
        }])
            ->withCount('comments')->orderBy('id', 'desc')->paginate();

        return response()->json($pins);
    }

    public function user($id)
    {
        $pins = Pin::with(['user' => function($query) {
            $query->select([
                'id', 'avatar', 'name'
            ]);
        }])->where('user_id', $id)
            ->withCount('comments')->orderBy('id', 'desc')->paginate();

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

    public function create(CreatePinRequest $request)
    {

        try {
            $pin = Auth::user()->pins()->create($request->all());
            $success = true;
            $message = 'Pin created successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
