<?php
// Script tải ảnh sản phẩm - Version 2 sử dụng nhiều nguồn
$uploadDir = __DIR__ . '/public/uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

$ctx = stream_context_create([
    'http' => ['timeout' => 20, 'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'follow_location' => true],
    'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
]);

// Apple - thử nhiều slug
$apple = [
    'iphone16promax.png' => [
        'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-16-pro-max-desert-titanium-select?wid=400&hei=400&fmt=png-alpha',
        'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-16-pro-max-finish-select-202409-6-9inch-deserttitanium?wid=400&hei=400&fmt=png-alpha',
    ],
    'iphone15promax.png' => [
        'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-15-pro-max-black-titanium-select?wid=400&hei=400&fmt=png-alpha',
        'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-15-pro-max-finish-select-202309-6-7inch-naturaltitanium?wid=400&hei=400&fmt=png-alpha',
    ],
    'iphonese.png' => [
        'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-se-finish-select-202502-6-1inch-midnight?wid=400&hei=400&fmt=png-alpha',
        'https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-se-select-2022-midnight?wid=400&hei=400&fmt=png-alpha',
    ],
];

foreach ($apple as $filename => $urls) {
    $path = $uploadDir . $filename;
    if (file_exists($path) && filesize($path) > 1000) { echo "SKIP $filename (exists)\n"; continue; }
    foreach ($urls as $url) {
        echo "Trying $filename... ";
        $data = @file_get_contents($url, false, $ctx);
        if ($data && strlen($data) > 1000) {
            file_put_contents($path, $data);
            echo "OK (" . round(strlen($data)/1024) . "KB)\n";
            break;
        } else {
            echo "next... ";
        }
    }
    if (!file_exists($path) || filesize($path) < 1000) echo "ALL FAILED\n";
}

// Samsung - dùng Samsung Vietnam CDN
$samsung_urls = [
    'galaxys24ultra.png' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/2401/gallery/vn-galaxy-s24-ultra-s928-sm-s928bztdxxv-thumb-539573067',
    'galaxys24plus.png' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/2401/gallery/vn-galaxy-s24-plus-s926-sm-s926bzvdxxv-thumb-539573177',
    'galaxys24.png' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/2401/gallery/vn-galaxy-s24-s921-sm-s921bzyaxxv-thumb-539573209',
    'galaxyzfold5.png' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/2307/gallery/vn-galaxy-z-fold5-f946-sm-f946bzkdxxv-thumb-537229764',
    'galaxyzflip5.png' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/2307/gallery/vn-galaxy-z-flip5-f731-sm-f731blgdxxv-thumb-537212788',
    'galaxya55.png' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/2403/gallery/vn-galaxy-a55-5g-sm-a556elbdxxv-thumb-539526498',
    'galaxya35.png' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/2403/gallery/vn-galaxy-a35-5g-sm-a356elbdxxv-thumb-539526282',
    'galaxya15.png' => 'https://images.samsung.com/is/image/samsung/p6pim/vn/2310/gallery/vn-galaxy-a15-sm-a155fzkdxxv-thumb-538867186',
];

foreach ($samsung_urls as $filename => $url) {
    $path = $uploadDir . $filename;
    if (file_exists($path) && filesize($path) > 1000) { echo "SKIP $filename (exists)\n"; continue; }
    // Try with different size params
    foreach (['', '?$400_400_PNG$', '?$344_344_PNG$', '?$252_252_PNG$'] as $suffix) {
        echo "Trying $filename... ";
        $data = @file_get_contents($url . $suffix, false, $ctx);
        if ($data && strlen($data) > 1000) {
            file_put_contents($path, $data);
            echo "OK (" . round(strlen($data)/1024) . "KB)\n";
            break;
        } else { echo "next... "; }
    }
    if (!file_exists($path) || filesize($path) < 1000) echo "ALL FAILED\n";
}

// Cho OPPO/Vivo/Xiaomi - không tải được từ CDN, sẽ tạo ảnh placeholder chuyên nghiệp bằng GD
$brandColors = [
    'xm' => ['bg' => [255, 108, 0], 'fg' => [255, 255, 255]],
    'op' => ['bg' => [0, 100, 70], 'fg' => [255, 255, 255]],
    'vv' => ['bg' => [65, 95, 255], 'fg' => [255, 255, 255]],
];

$otherPhones = [
    'xiaomi14ultra.png' => ['xm', 'Xiaomi 14 Ultra'],
    'xiaomi14pro.png' => ['xm', 'Xiaomi 14 Pro'],
    'xiaomi14.png' => ['xm', 'Xiaomi 14'],
    'pocof6pro.png' => ['xm', 'POCO F6 Pro'],
    'redminote13proplus.png' => ['xm', 'Redmi Note 13 Pro+'],
    'redminote13.png' => ['xm', 'Redmi Note 13'],
    'pocox6.png' => ['xm', 'POCO X6'],
    'redmi13c.png' => ['xm', 'Redmi 13C'],
    'findx7ultra.png' => ['op', 'OPPO Find X7 Ultra'],
    'findn3flip.png' => ['op', 'OPPO Find N3 Flip'],
    'reno11pro.png' => ['op', 'Reno 11 Pro 5G'],
    'reno11.png' => ['op', 'Reno 11 5G'],
    'oppoa79.png' => ['op', 'OPPO A79 5G'],
    'oppoa58.png' => ['op', 'OPPO A58'],
    'oppoa18.png' => ['op', 'OPPO A18'],
    'oppoa38.png' => ['op', 'OPPO A38'],
    'vivox100pro.png' => ['vv', 'Vivo X100 Pro'],
    'vivov30pro.png' => ['vv', 'Vivo V30 Pro'],
    'vivov30.png' => ['vv', 'Vivo V30'],
    'vivov29e.png' => ['vv', 'Vivo V29e'],
    'vivoy36.png' => ['vv', 'Vivo Y36'],
    'vivoy27.png' => ['vv', 'Vivo Y27'],
    'vivoy17s.png' => ['vv', 'Vivo Y17s'],
    'vivot2x.png' => ['vv', 'Vivo T2x 5G'],
];

if (function_exists('imagecreatetruecolor')) {
    foreach ($otherPhones as $filename => $info) {
        $path = $uploadDir . $filename;
        if (file_exists($path) && filesize($path) > 1000) { echo "SKIP $filename (exists)\n"; continue; }

        [$brand, $name] = $info;
        $colors = $brandColors[$brand];

        $w = 400; $h = 400;
        $img = imagecreatetruecolor($w, $h);
        imagesavealpha($img, true);

        // Background gradient
        $bg = imagecolorallocate($img, $colors['bg'][0], $colors['bg'][1], $colors['bg'][2]);
        imagefilledrectangle($img, 0, 0, $w, $h, $bg);

        // Lighter gradient overlay
        $lighter = imagecolorallocatealpha($img, 255, 255, 255, 100);
        imagefilledellipse($img, $w * 0.7, $h * 0.3, $w, $w, $lighter);

        // Phone outline (rectangle with rounded look)
        $phoneColor = imagecolorallocatealpha($img, 255, 255, 255, 40);
        $px = $w/2 - 55; $py = 60; $pw = 110; $ph = 200;
        imagefilledrectangle($img, (int)$px, (int)$py, (int)($px+$pw), (int)($py+$ph), $phoneColor);
        // Screen
        $screenColor = imagecolorallocatealpha($img, $colors['bg'][0], $colors['bg'][1], $colors['bg'][2], 60);
        imagefilledrectangle($img, (int)($px+8), (int)($py+15), (int)($px+$pw-8), (int)($py+$ph-15), $screenColor);

        // Text
        $fg = imagecolorallocate($img, $colors['fg'][0], $colors['fg'][1], $colors['fg'][2]);
        $fontFile = 'C:/Windows/Fonts/arial.ttf';
        if (file_exists($fontFile)) {
            // Product name
            $lines = explode(' ', $name);
            $y = $h - 100;
            $fontSize = 18;
            foreach (array_chunk($lines, 2) as $chunk) {
                $text = implode(' ', $chunk);
                $bbox = imagettfbbox($fontSize, 0, $fontFile, $text);
                $textW = $bbox[2] - $bbox[0];
                imagettftext($img, $fontSize, 0, (int)(($w - $textW) / 2), (int)$y, $fg, $fontFile, $text);
                $y += 28;
            }
        } else {
            $textLen = strlen($name) * 5;
            imagestring($img, 5, (int)(($w - $textLen) / 2), (int)($h - 60), $name, $fg);
        }

        imagepng($img, $path);
        imagedestroy($img);
        echo "Generated $filename (GD)\n";
    }
} else {
    echo "GD not available for generating images\n";
}

echo "\nImage download complete!\n";
