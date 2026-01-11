<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    function detectLanguage($text)
    {
        if (preg_match('/[àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]/iu', $text)) {
            return 'vi';
        }
        return 'en';
    }

    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $lang = $this->detectLanguage($userMessage);

        $products = Product::with(['brand', 'productComments'])
            ->where('qty', '>', 0) 
            ->get();

        $dataContext = "--- STORE INVENTORY ---\n";
        
        if ($products->count() > 0) {
            foreach ($products as $p) {
                $avgRating = $p->productComments->avg('rating'); 
                $avgRating = $avgRating ? number_format($avgRating, 1) . "/5" : "No ratings yet";
                $reviewCount = $p->productComments->count();

                $brandName = $p->brand ? $p->brand->name : "No Brand";

                $price = number_format($p->price, 2);

                $dataContext .= "Item: {$p->name}\n";
                $dataContext .= "   - Brand: {$brandName}\n";
                $dataContext .= "   - Price: $" . $price . "\n";
                $dataContext .= "   - Rating: {$avgRating} ({$reviewCount} reviews)\n";

                $desc = Str::limit(strip_tags($p->description), 100); 
                $dataContext .= "   - Desc: {$desc}\n\n";
            }
        } else {
            $dataContext .= "Store is currently empty.\n";
        }

        $finalPrompt = 
            "You are a smart sales assistant for 'BrumBrum'.\n" .
            "LANGUAGE: Reply in ($lang).\n" .
            "RULES:\n" .
            "1. Use the DATA provided below to answer.\n" .
            "2. If user asks for suggestions, recommend items with HIGH RATINGS first.\n" .
            "3. Mention the BRAND name to sound professional.\n" .
            "4. If product has no ratings, say it's a 'New Arrival'.\n" .
            "5. NO Markdown tables. Keep it conversational.\n" .
            "6. If you can't find the specific item, recommend a similar one from the same Brand or Category.\n" .
            "\n" .
            $dataContext . 
            "\n----------------\n" .
            "CUSTOMER MESSAGE: " . $userMessage;

        $apiKey = config('services.gemini.key');

        try {
            Log::info('Prompt length: ' . strlen($finalPrompt));
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";
            
            $response = Http::withoutVerifying()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $finalPrompt]
                            ]
                        ]
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $botReply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Empty response.';
                return response()->json(['reply' => $botReply]);
            } else {
                return response()->json([
                    'reply' => "Lỗi API Google: " . $response->status() . " - " . $response->body()
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['reply' => "Lỗi Code Server: " . $e->getMessage()], 500);
        }
    }
}