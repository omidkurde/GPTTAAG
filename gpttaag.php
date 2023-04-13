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
