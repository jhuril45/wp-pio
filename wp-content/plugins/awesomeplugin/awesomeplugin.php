<?php
   /*
   Plugin Name: Awesomeness Creator
   Plugin URI: https://my-awesomeness-emporium.com
   description: a plugin to create awesomeness and spread joy
   Version: 1.2
   Author: Mr. Awesome
   Author URI: https://mrtotallyawesome.com
   License: GPL2
   */

  add_action( 'the_content', 'my_thank_you_text' );

  function my_thank_you_text ( $content ) {
      return $content .= '<p>Thank you for reading!</p>';
  }
?>