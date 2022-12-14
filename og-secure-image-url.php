<?php
/**
 * 
 * Plugin Name: OG Secure Image URL
 * Plugin URI:  https://github.com/RenderbitTechnologies/OG-Secure-Image-URL
 * Description: Add secure URLs for Facebook Open Graph image links
 * Version:     1.0.0
 * Author:      Renderbit Technologies
 * Author URI:  https://renderbit.com
 * License:     GPLv2
 * Text Domain: og-secure-image-url
 *
 * @link    https://github.com/RenderbitTechnologies/OG-Secure-Image-URL
 *
 * @package OG_Secure_Image_URL
 * @version 1.0.0
 *
 */

/**
 * 
 * Yoast SEO plugin doesn't handle opengraph image tags properly
 * if they're hosted on a secure server. Luckily they provide lots
 * of useful filters to adjust this value. This function checks to
 * see if the image is on a secure link and if so, adds secure_url
 * onto the og tag so it's properly formatted.
 * 
 * @param  string $image URL for the Open Graph image
 * @return none
 * 
 */
function check_ssl_facebook_opengraph_image($image) { 
    $og = "og:image";
    if (preg_match('/^https/', $image)) {
        echo '<meta property="'. $og .             ':secure_url" content="'. $image . '" />' . "\n";
        $image = preg_replace("/^https/", "http", $image);
    }
    // Chances are the image is also available via http, so let's include
    // to keep the Facebook Linter happy
    echo '<meta property="'. $og .         '" content="'. $image . '" />' . "\n";
}

// Hook into the Yoast plugin's hooks for handling the OG image
add_action('wpseo_opengraph_image', 'check_ssl_facebook_opengraph_image');