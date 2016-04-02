<?php
    //Author: berlinquin
    
    //These functions all take arrays of Candle objects and perform some analysis on them
    //See this article on Investopedia for more info:
    //http://www.investopedia.com/articles/trading/06/advcandlesticks.asp
    
    //Returns true if the three most recent candles make a "Kicker Pattern"
    function is_kicker($candles) {
        $decreases = $candles[0]->is_decrease();
        $consecutive = 0;
        for($i = 1; $i < 3; $i++) {
            if($candles[$i-1]->get_open() <= $candles[$i]->get_close())
                $consecutive++;
            $decreases += $candles[$i]->is_decrease();
        }
        echo "Kicker pattern: $decreases decreases and $consecutive consecutive decreases\n";
        return $decreases == 3 && $consecutive == 2;
    }
    
    //Returns true if the most recent two candles indicate an "Island Reversal" is about to happen
    function island_reversal($candles) {
        echo "Testing Island Reversal\n";
        return $candles[0]->get_open() < 0.97*$candles[1]->get_low();
    }
    
    //Returns the Simple Moving Average of the given candles
    function sma($candles) {
        $sma = 0.0;
        $count = count($candles);
        for($i = 0; $i < $count; $i++) {
            $sma += $candles[$i]->get_close();
        }
        return $sma / $count;
    }

?>