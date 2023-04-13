<?php
/**
 * Plugin Name: تگ گذاری هوش مصنوعی
 * Plugin URI: http://seller1.co/gpttaag
 * Description: یک افزونه برای تگ گذاری هوش مصنوعی محتوای سایت شما
 * Version: 1.0
 * Author: omid.kamangar
 * Author URI: http://seller1.co
 * License: GPL2
 */

// اضافه کردن تگ‌های هوش مصنوعی به محتوای سایت
function gpttaag_add_tags_to_content($content) {
    // کد خود را در این قسمت پیاده‌سازی کنید
    return $content;
}
add_filter('the_content', 'gpttaag_add_tags_to_content');

// اضافه کردن تگ‌های هوش مصنوعی به عنوان متا توضیحات محصول
function gpttaag_add_tags_to_product_meta($description) {
    // کد خود را در این قسمت پیاده‌سازی کنید
    return $description;
}
add_filter('woocommerce_short_description', 'gpttaag_add_tags_to_product_meta');
add_filter('woocommerce_product_description_heading', 'gpttaag_add_tags_to_product_meta');

// اضافه کردن تگ‌های هوش مصنوعی به ALT تصاویر محصول
function gpttaag_add_tags_to_product_image_alt($alt, $attachment_id) {
    // کد خود را در این قسمت پیاده‌سازی کنید
    return $alt;
}
add_filter('wp_get_attachment_image_attributes', 'gpttaag_add_tags_to_product_image_alt', 10, 2);
function get_tags_from_text($text) {
    // Load OpenAI API key from config file
    $config = include('config.php');
    $api_key = $config['openai_api_key'];

    // Set up API request data
    $url = 'https://api.openai.com/v1/models/davinci-codex/completions';
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key,
    );
    $data = array(
        'prompt' => 'Generate tags for product: ' . $text,
        'temperature' => 0.7,
        'max_tokens' => 5,
    );

    // Send API request and decode response
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);

    // Extract tags from response
    $tags = array();
    foreach ($response['choices'][0]['text'] as $tag) {
        $tags[] = trim($tag);
    }

    return $tags;
}

