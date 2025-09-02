<?php

// Test file to verify API registration endpoint
$url = 'http://127.0.0.1:8000/api/auth/register';
$data = [
    'DNI' => '12345678',
    'name' => 'Test',
    'last_name' => 'User',
    'email' => 'test@example.com',
    'password' => 'password123',
    'phone' => '987654321'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: " . $httpCode . "\n";
echo "Response: " . $response . "\n";
if ($error) {
    echo "Error: " . $error . "\n";
}
