<?php
require_once('vendor/autoload.php');

$env_name = (empty($_POST['env_name']) ? 'stage' : $_POST['env_name']); // stage or prod
$rail_type = (empty($_POST['rail_type']) ? 'us' : $_POST['rail_type']); // us or us_int

$app_id = 'test_598cb2d2f13a9'; // DO NOT SHARE !!!
$api_key = 'f299b8fce2dd3e9ffa6665ac610bff3fb91caa4f80d2beeef726a7fae4bb'; // DO NOT SHARE !!!

\Due\Due::setEnvName($env_name);
\Due\Due::setApiKey($api_key);
\Due\Due::setAppId($app_id);
\Due\Due::setRailType($rail_type);

$card_data = (empty($_POST['card_data']) ? array() : $_POST['card_data']);
$amount = (empty($_POST['total']) ? '' : $_POST['total']);
$currency = (empty($_POST['currency']) ? '' : $_POST['currency']);
$card_id = (empty($card_data['card_id']) ? '' : $card_data['card_id']);
$card_hash = (empty($card_data['card_hash']) ? '' : $card_data['card_hash']);
$unique_id = ''; // searchable unique id
$customer_ip = (empty($card_data['customer_ip']) ? '' : $card_data['customer_ip']);  // your user's ip. ex: 111.11.11.111
$risk_token = (empty($card_data['risk_token']) ? '' : $card_data['risk_token']); // optional risk token from Due.js
$risk_url = (empty($card_data['current_url']) ? '' : $card_data['current_url']); // optional url where payment was made
$customer = (empty($_POST['customer']) ? array() : $_POST['customer']);

// customer data is optional
$customer_data = array(
    'first_name' => '',
    'last_name' => '',
    'street_1' => '',
    'street_2' => '',
    'city' => '',
    'state' => '',
    'zip' => (empty($customer['postal_code']) ? '' : $customer['postal_code']),
    'country' => '',
    'phone' => '',
    'email' => (empty($customer['email']) ? '' : $customer['email']),
);

// shipping data is optional
$shipping_data = array(
    'first_name' => '',
    'last_name' => '',
    'street_1' => '',
    'street_2' => '',
    'city' => '',
    'state' => '',
    'zip' => '',
    'country' => '',
);

$transaction = \Due\Charge::card( array(
    'amount'      => $amount,
    'currency'    => $currency,
    'card_id'     => $card_id,
    'card_hash'   => $card_hash,
    'unique_id'   => $unique_id,
    'customer_ip' => $customer_ip,
    'rtoken'      => $risk_token,
    'source'      => $risk_url,
    'customer'    => $customer_data,
    'shipping'    => $shipping_data
) );

// var_dump('Transaction Id: '.$transaction->id);
echo json_encode($transaction, JSON_PRETTY_PRINT);