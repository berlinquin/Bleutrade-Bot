<?php
    //Author: berlinquin
    
    //This class represents a candle taken from a market
    //For more info see:
    //http://www.investopedia.com/terms/c/candlestick.asp
    
    class Candle {
        private $open;
        private $high;
        private $low;
        private $close;
                
        function __construct($o, $h, $l, $c) {
            $this->open = $o;
            $this->high = $h;
            $this->low = $l;
            $this->close = $c;
        }
        
        public function get_open() {
            return $this->open;
        }
        
        public function get_close() {
            return $this->close;
        }
        
        public function get_low() {
            return $this->low;
        }

        public function is_decrease() {
            return ($this->close < $this->open) ? 1 : 0;
        }
        
        //Takes an array of intervals and returns an array mapping these intervals
        public static function initialize_candle_interval($args) {
            $candle_interval = array();
            for($i = 1; $i < count($args); $i++) {
                $arg = $args[$i];
                switch($arg) {
                    case "1m": $candle_interval["1m"] = 1; break;
                    case "2m": $candle_interval["2m"] = 1; break;
                    case "3m": $candle_interval["3m"] = 1; break;
                    case "4m": $candle_interval["4m"] = 1; break;
                    case "5m": $candle_interval["5m"] = 1; break;
                    case "6m": $candle_interval["6m"] = 1; break;
                    case "10m": $candle_interval["10m"] = 1; break;
                    case "12m": $candle_interval["12m"] = 1; break;
                    case "15m": $candle_interval["15m"] = 1; break;
                    case "20m": $candle_interval["20m"] = 2; break;
                    case "30m": $candle_interval["30m"] = 2; break;
                    case "1h": $candle_interval["1h"] = 4; break;
                    case "2h": $candle_interval["2h"] = 8; break;
                    case "3h": $candle_interval["3h"] = 12; break;
                    case "4h": $candle_interval["4h"] = 16; break;
                    case "6h": $candle_interval["6h"] = 24; break;
                    case "8h": $candle_interval["8h"] = 32; break;
                    case "12h": $candle_interval["12h"] = 48; break;
                    case "1d": $candle_interval["1d"] = 96; break;
                }
            }
            return $candle_interval;
        }
        
    }
?>