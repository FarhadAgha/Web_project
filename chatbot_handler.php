<?php
header('Content-Type: application/json');
include 'includes/chatbot_config.php';

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = trim($input['message'] ?? '');

if (!$userMessage) {
    echo json_encode(['reply' => 'Please type a message.']);
    exit;
}

$systemPrompt = "You are a friendly assistant for Gull Boutique, an online women's clothing store with categories: Wedding Guest, Graduation, Eid Special, Office Wear, Party Night, and Casual Home. Answer questions about the store helpfully and briefly (2-3 sentences max). If asked about specific stock, prices, or orders, politely say you'd recommend checking the Products page or contacting the store directly. Keep responses warm and on-brand for a boutique.";

$url = "https://generativelanguage.googleapis.com/v1beta/interactions";

$data = [
    "model" => "gemini-3.6-flash",
    "system_instruction" => $systemPrompt,
    "input" => $userMessage
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'x-goog-api-key: ' . GEMINI_API_KEY
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$result = json_decode($response, true);

$reply = null;
if ($httpCode === 200 && isset($result['steps']) && is_array($result['steps'])) {
    foreach ($result['steps'] as $step) {
        if ($step['type'] === 'model_output' && isset($step['content'][0]['text'])) {
            $reply = $step['content'][0]['text'];
            break;
        }
    }
}

if (!$reply) {
    echo json_encode(['reply' => 'DEBUG: ' . $response]);
    exit;
}

echo json_encode(['reply' => $reply]);
?>