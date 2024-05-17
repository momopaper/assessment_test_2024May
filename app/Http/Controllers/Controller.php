<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerResource;
use App\Services\Player\GeneratePlayer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const httpSuccessStatusCode = 200;
    const httpErrorStatusCode = 500;

    /**
     * Display homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Submit and generate result.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Request $request)
    {
        $players = app(GeneratePlayer::class)->execute($request->get('num_of_players'));

        return response()->json(PlayerResource::collection($players), self::httpSuccessStatusCode);
    }
}
