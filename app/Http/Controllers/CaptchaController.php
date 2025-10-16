<?php
     namespace App\Http\Controllers;

     use Illuminate\Http\Request;
     use Illuminate\Support\Facades\Session;

     class CaptchaController extends Controller
     {
public function generateCaptcha()
{
    $code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4);
    Session::put('captcha_code', $code);
    Session::put('captcha_time', now());

    $width = 140;
    $height = 40;
    $image = imagecreatetruecolor($width, $height);

    $bgColor = imagecolorallocate($image, 230, 247, 250); // #E6F7FA
    $textColor = imagecolorallocate($image, 0, 0, 0);
    $borderColor = imagecolorallocate($image, 0, 175, 212); // #00AFD4
    $noiseColor = imagecolorallocate($image, 200, 210, 215);

    imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

    // Add noise
    for ($i = 0; $i < 100; $i++) {
        imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
    }

    // Draw border
    imagerectangle($image, 0, 0, $width - 1, $height - 1, $borderColor);

    $font = public_path('fonts/Super Rugged.ttf');
    if (!file_exists($font)) {
        $font = null;
    }

    // Draw text
    $x = 15;
    foreach (str_split($code) as $char) {
        $fontSize = 20;
        $angle = rand(-15, 15);

        if ($font) {
            // Get bounding box to calculate proper Y position
            $bbox = imagettfbbox($fontSize, $angle, $font, $char);
            $textHeight = abs($bbox[5] - $bbox[1]);
            $y = ($height / 2) + ($textHeight / 2);

            imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $font, $char);
        } else {
            imagestring($image, 5, $x, 12, $char, $textColor);
        }

        $x += 30;
    }

    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
}


         public function validateCaptcha(Request $request)
         {
             $request->validate([
                 'captcha' => ['required', function ($attribute, $value, $fail) {
                     $stored = Session::pull('captcha_code');
                     $generatedAt = Session::pull('captcha_time');

                     if (!$stored || strtolower($value) !== strtolower($stored)) {
                         $fail('The CAPTCHA is incorrect.');
                         return;
                     }

                     if (!$generatedAt || now()->diffInSeconds($generatedAt) > 120) {
                         $fail('The CAPTCHA has expired. Please refresh and try again.');
                     }
                 }],
             ]);

             return response()->json(['success' => true]);
         }
     }
