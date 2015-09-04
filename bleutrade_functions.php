<?php

// Author: beefviper
// Date: Nov. 11, 2014

// Bleutrade API Reference = 'https://bleutrade.com/help/API'
// Bleutrade API Base URL = 'https://bleutrade.com/api/v2/'

// Set your API Key and Secret
$apikey    = '';
$apisecret = '';

// public/getcurrencies - Get a list of all coins traded
// params: null
// return: ?		

function get_currencies() {
  $command = 'public/getcurrencies';
  $params = '';
  $query = $command . $params;
  $result = make_public_api_call($query);
  
  return $result;
}

/*
  public/getmarkets - Get the list of all pairs traded
  params: null
  return: ?
*/
function get_markets() {
  $command = 'public/getmarkets';
  $params = '';
  $query = $command . $params;
  $result = make_public_api_call($query);
  
  return $result;
}

/*
  public/getticker - Used to get the current tick values for a market.
  params:	market - string - "BLEU_BTC"
  return: ?
*/
function get_ticker($market) {
  $command = 'public/getticker';
  $params = '?market=' . $market;
  $query = $command . $params;
  $result = make_public_api_call($query);
  
  return $result;
}

/*
  public/getmarketsummaries - Used to get the last 24 hour summary of all active markets
  params: null
  return: ?
*/
function get_market_summaries() {
  $command = 'public/getmarketsummaries';
  $params = '';
  $query = $command . $params;
  $result = make_public_api_call($query);
  
  return $result;
}

/*
  public/getmarketsummary - Used to get the last 24 hour summary of specific market
  params: market - string - "BLEU_BTC"
  return: ?	
*/
function get_market_summary($market) {
  $command = 'public/getmarketsummary';
  $params = '?market=' . $market;
  $query = $command . $params;
  $result = make_public_api_call($query);
  
  return $result;
}

/*
  public/getorderbook - Loads the book offers specific market.
  params: market - string - "BLEU_BTC"
          type - string - (BUY|SELL|ALL)
          depth - (optional, default is 20)
*/
function get_order_book($market, $type='ALL', $depth=20) {
  $command = 'public/getorderbook';
  $params = '?market=' . $market;
  $params .= '&type=' . $type;
  $params .= '&depth=' . $depth;
  $query = $command . $params;
  $result = make_public_api_call($query);
  
  return $result;
}

/*
  public/getmarkethistory - Obtains historical trades of a specific market
  params:	market - string - "BLEU_BTC"
          count - (optional, default: 20, max: 200)
  return: ?	
*/
function get_market_history($market, $count=20) {
  $command = 'public/getmarkethistory';
  $params = '?market=' . $market;
  $params .= '&count=' . $count;
  $query = $command . $params;
  $result = make_public_api_call($query);
  
  return $result;
}

/*
  public/getcandles - Obtains candles format historical trades of a specific market
  params:	market - string - "BLEU_BTC"
          period(1m, 2m, 3m, 4m, 5m, 6m, 10m, 12m, 15m, 20m, 30m, 1h, 2h, 3h, 4h, 6h, 8h, 12h, 1d) 
          count (default: 1000, max: 999999
          last_hours (default: 24, max: 720)
  return:	?
*/
function get_candles($market, $period='30m', $count=1000, $last_hours=24) {
  $command = 'public/getcandles';
  $params = '?market=' . $market;
  $params .= '&period=' . $period;
  $params .= '&count=' . $count;
  $params .= '&last_hours=' . $last_hours;
  $query = $command . $params;
  $result = make_public_api_call($query);
  
  return $result;
}

/*
  market/buylimit - Use to send BUY orders
  params:	market - string - "BLEU_BTC"
          rate
          quantity
          comments - (optional, up to 128 characters
  return:	?
*/
function buy_limit($market, $rate, $quantity, $comments='') {
  $command = 'market/buylimit';
  $params = '?market=' . $market;
  $params .= '&rate=' . $rate;
  $params .= '&quantity=' . $quantity;
  $params .= '&comments=' . $comments;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  market/selllimit - Use to send SELL orders
  params:	market - string - "BLEU_BTC"
          rate
          quantity
          comments - (optional, up to 128 characters
  return:	order_id - int
*/
function sell_limit($market, $rate, $quantity, $comments='') {
  $command = 'market/selllimit';
  $params = '?market=' . $market;
  $params .= '&rate=' . $rate;
  $params .= '&quantity=' . $quantity;
  $params .= '&comments=' . $comments;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  market/cancel - Use to cancel an order
  params:	orderid - int
  return:	result - bool
*/
function cancel($order_id) {
  $command = 'market/cancel';
  $params = '?orderid=' . $order_id;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  market/getopenorders - Use to list your open orders
  params:	null
  return:	?
*/
function get_open_orders() {
  $command = 'market/getopenorders';
  $params = '';
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  account/getbalances - Use to get the balance of all your coins
  params:	currencies (optional, default=ALL) eg.: /account/getbalances?currencies=DOGE;BTC 
  return:	?
*/
function get_balances() {
  $command = 'account/getbalances';
  $params = '';
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  account/getbalance - Use to get the balance of a specific currency 
  params:	currency
  return:	?
*/
function get_balance($currency) {
  $command = 'account/getbalance';
  $params = '?currency=' . $currency;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  account/getdepositaddress - Use to get the deposit address of specific coin
  params:	currency
  return:	?
*/
function get_deposit_address($currency) {
  $command = 'account/getdepositaddress';
  $params = '?currency=' . $currency;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  account/withdraw - Use to withdraw their currencies to another wallet
  params:	currency
          quantity
          address
  return:	?
*/
function withdraw($currency, $quanity, $address) {
  $command = 'account/withdraw';
  $params = '?currency=' . $currency;
  $params .= '&quantity=' . $quantity;
  $params .= '&adress=' . $address;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  account/transfer - Use to direct transfer their currencies to another user, without fees
  params:	currency
          quanitity
          touser - (username, supplied by the user, also seen in chat) 
  return:	?
*/
function transfer($currency, $quantity, $username) {
  $command = 'account/transfer';
  $params = '?currency=' . $currency;
  $params .= '&quantity=' . $quantity;
  $params .= '&touser=' . $username;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  account/getorder - Use to get the data given order
  params:	orderid
  return:	?
*/
function get_order($order_id) {
  $command = 'account/getorder';
  $params = '?orderid=' . $order_id;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  account/getorders - Use to list your orders
  params:	market
          order_status - (ALL, OK, OPEN, CANCELED) 
  return:	?
*/
function get_orders($market, $order_status) {
  $command = 'account/getorders';
  $params = '?market=' . $market;
  $params .= '&orderstatus=' . $order_status;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  account/getorderhistory - Use for historical trades of a given order.
  params:	orderid
  return:	?
*/
function get_order_history($order_id) {
  $command = "account/getorderhistory";
  $params = "?orderid=" . $order_id;
  $query = $command . $params;
  $result = make_private_api_call($query);
  
  return $result;
}

/*
  make the actual call to the Bleutrade API
  params: $query
  return: $result	
*/
function make_public_api_call($query) {
  $base_url = 'https://bleutrade.com/api/v2/';
  $uri = $base_url . $query;
  $ch = curl_init($uri);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
  $execResult = curl_exec($ch);
  $result = json_decode($execResult);

  return $result;
}

/*
  make the actual call to the Bleutrade API
  params: $query
  return: $result	
*/
function make_private_api_call($query) {
  global $apikey, $apisecret;
  $nonce = time();
  $base_url = "https://bleutrade.com/api/v2/";
  $uri = $base_url . $query . '&apikey=' . $apikey . '&nonce=' . $nonce;
  $sign = hash_hmac('sha512',$uri,$apisecret);
  $ch = curl_init($uri);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	//stop curl from echoing to screen
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
  $execResult = curl_exec($ch);
  $result = json_decode($execResult);
  
  usleep(1025000); // cheap hack to make sure $nonce is different each time()

  return $result;
}

?>
