<?php
// Include the database connection file
include '../php/db_connect.php';

// PayPal API credentials
$clientId = 'AXbsTU-BrVrrvJ7hcWlm1IPoE4iJ634XLyElDUjv8AL9EPAw3mNO0fJmm90H9VsQPym7ulMbzfsqQi_R';
$clientSecret = 'EIlDUu1Eksh1YEmf2Za14A26uDfR2I0EeqwvePhv2d0WeybdhN_2hwg7KMTm9Drp0lyVL3-GLDniVILE';

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);
$subtotal = $data['subtotal'] ?? 0;

if ($subtotal <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid subtotal']);
    exit;
}

// PayPal API endpoints
$apiUrl = "https://api-m.paypal.com";

// Get PayPal access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$apiUrl/v1/oauth2/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$clientSecret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$headers = [];
$headers[] = 'Accept: application/json';
$headers[] = 'Accept-Language: en_US';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    exit;
}

curl_close($ch);

$accessTokenResponse = json_decode($result, true);
$accessToken = $accessTokenResponse['access_token'] ?? null;

if (!$accessToken) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to obtain PayPal access token', 'details' => $accessTokenResponse]);
    exit;
}

// Create PayPal order
$orderData = [
    'intent' => 'CAPTURE',
    'purchase_units' => [[
        'amount' => [
            'currency_code' => 'USD',
            'value' => number_format($subtotal, 2, '.', '')
        ]
    ]]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$apiUrl/v2/checkout/orders");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));

$headers = [];
$headers[] = 'Content-Type: application/json';
$headers[] = "Authorization: Bearer $accessToken";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    exit;
}

$orderResponse = json_decode($result, true);

curl_close($ch);

if (isset($orderResponse['id'])) {
    echo json_encode(['id' => $orderResponse['id']]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create PayPal order', 'details' => $orderResponse]);
}
?>
