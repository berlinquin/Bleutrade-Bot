<?php
    /*
     *TRADING BOT for use with Bleutrade API
     *Author: berlinquin
     *Date: March 21, 2016
     */
    
    require 'bleutrade_functions.php';
    require 'market_analysis.php';
    require 'classes/Candle.php';
    
    //Causes program to crash if an assert() fails
    assert_options(ASSERT_BAIL, true);
    
    //Prints current time to console
    date_default_timezone_set("America/Chicago");
    echo date("G:i")."\n";
    
    //The markets this algorithm works with. To add a market, add the Coin's abbreviation to this array
    $markets = array("DCR", "ETH");
    
    //$candle_interval maps intervals of interest to the number of hours needed for 4 full intervals
    //It initializes the array with the intervals passed to the script from the command-line
    //For more details, see Bleutrade documentation on the getcandles function
    $candle_interval = Candle::initialize_candle_interval($argv);
    
    //get my BTC balance
    $b = get_balance("BTC");
    assert($b->success);
    $BTC = $b->result->Available;
    echo "I have $BTC BTC available.\n\n";
    
    //Amount of BTC to spend at once
    $BTC_to_spend = 0.3 * $BTC;
    
    //This outermost loop runs the algorithm on each Coin of interest
    foreach($markets as $market) {
        
        //Get a list of open sell orders for this Coin
        $marketFull = $market."_BTC";
        $ob = get_order_book($marketFull, "SELL", 20);
        assert($ob->success);
        $orders = $ob->result->sell;
        
        //This anonymous function makes a purchase using the available BTC
        $buy = function ($message) use ($market, $orders, $BTC_to_spend) {
            echo "Buying $market...\n";
            $rate = $orders[0]->Rate; //Rate is in BTC/Coin
            $max_rate = 1.005 * $rate;
            $spent = 0.0; //Value is in Coin, not BTC
            $to_buy = round($BTC_to_spend / $rate, 4); //Value is in Coin, not BTC
            echo "Amount $market to buy: $to_buy\n";
            for($i = 0; $spent < $to_buy && $rate < $max_rate; $i++) {
                //Amount of Coin (not BTC) to buy
                $quantity = $to_buy - $spent;
                
                //Update rate and quantity based on the current open orders
                $rate = $orders[$i]->Rate;
                $quantity_available = $orders[$i]->Quantity;
                if ($quantity > $quantity_available)
                    $quantity = $quantity_available;
                
                echo "MAKING PURCHASE!\n";
                $b = buy_limit($market."_BTC", $rate, $quantity, $message);
                var_dump($b);
                assert($b->success);
                $spent += $quantity;
                echo "Bought $quantity $market @ $rate BTC / $market.\n";
            }
            echo "Total spent: $spent\n";
            return $spent;
            
        };
        
        //This inner loop runs the algorithm on each interval from $candle_interval
        foreach($candle_interval as $interval => $lasthours) {
            echo "Analyzing $market market with $interval interval\n";
            
            //The amount of Coin bought so far
            $coin_bought = 0.0;
            
            //Get the candles for this market at the right interval
            $c = get_candles($marketFull, $interval, 4, $lasthours);
            assert($c->success);
            $candles = array();
            foreach($c->result as $candle) {
                $candles[] = new Candle($candle->Open, $candle->High, $candle->Low, $candle->Close);
            }
            
            if(is_kicker($candles)) {
                $msg = 'Candle%20interval:%20'.$interval.',%20Market%20trend:%20Kicker%20pattern';
                $coin_bought += $buy($msg);
            }
            
            if(island_reversal($candles)) {
                $msg = 'Candle%20interval:%20'.$interval.',%20Market%20trend:%20Island%20Reversal%20pattern';
                $coin_bought += $buy($msg);
            }
            
            echo "Coin bought: $coin_bought\n";
            if($coin_bought > 0.0) {
                $sell_rate = round($orders[0]->Rate * 1.05, 7);
                $s = sell_limit($marketFull, $sell_rate, $coin_bought);
                var_dump($s);
                assert($s->success);
                echo "Open order for $coin_bought $market @ $sell_rate BTC / $market.\n";
            }
            else
                echo "Did not buy any $market.\n\n";
            
        }
    }
    
        echo "Algorithm complete.\n";
        
?>