<?php

namespace App\Services\Player;

use App\Models\Player;
use Illuminate\Support\Str;

class CreatePlayer
{
    /**
     * Create a Player.
     *
     * @param array $data
     * @return Player
     */
    public function execute(int $number): Player
    {
        // $player = Player::create([
        //     'number' => $number,
        //     'uuid' => Str::uuid()->toString()
        // ]);
        $player = new Player();
        $player->number = $number;
        $player->uuid = Str::uuid()->toString();

        return $player;
    }
}
