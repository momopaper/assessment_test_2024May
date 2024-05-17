<?php

namespace App\Services\Player;

use App\Models\Player;
use App\Services\Card\GetCard;
use App\Services\Player\CreatePlayer;
use Illuminate\Support\Str;

class GeneratePlayer
{

    /**
     * Generate players.
     *
     * @param array $data
     * @return Player[]
     */
    public function execute(int $count): array
    {
        $arrPlayer = [];

        $cards = app(GetCard::class)->execute();
        shuffle($cards);
        $cardsPerPlayer = count($cards) / $count;
        $cardsPerPlayer = $cardsPerPlayer < 1 ? 1 : floor($cardsPerPlayer);
        $extraCards = $count < count($cards) ? count($cards) % $count : 0;

        $i = 1;
        while ($i <= $count) {
            $player = app(CreatePlayer::class)->execute($i);
            if ($i <= count($cards)) {
                $totalCards = $cardsPerPlayer + ($i <= $extraCards ? 1 : 0);
                $player->cards = array_slice($cards, (($i - 1) * $cardsPerPlayer), $totalCards);
            }
            $arrPlayer[] = $player;
            $i++;
        }

        return $arrPlayer;
    }
}
