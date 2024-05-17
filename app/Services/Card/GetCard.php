<?php

namespace App\Services\Card;

use App\Models\Card;

class GetCard
{
    /**
     * Get Cards.
     *
     * @return Card[]
     */
    public function execute(): array
    {
        $cards = [];
        $config_symbols = config('constant.symbols');
        $config_cards = config('constant.cards');
        foreach ($config_symbols as $_key_symbol => $_value_symbol) {
            foreach ($config_cards as $_key_card => $_value_card) {
                $card = new Card();
                $card->long_symbol = $_value_symbol;
                $card->short_symbol = $_key_symbol;
                $card->card_number = $_key_card;
                $card->card_text = $_value_card;
                $cards[] = $card;
            }
        }

        return $cards;
    }
}
