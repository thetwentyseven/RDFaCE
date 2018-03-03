<?php
// TODO:We must put the require in settings.php
require_once('TextRazor.php');


// Handler function - More information: https://codex.wordpress.org/Plugin_API/Action_Reference/wp_ajax_(action)
add_action( 'wp_ajax_send_text', 'send_text' );
function send_text() {
  global $wpdb;

  // Insert API key
  TextRazorSettings::setApiKey("6e3a64e825ce0eab60fe3801e190d41ea2794f245a61b4df315aa6b1");

  // Testing account before a call
  $accountManager = new AccountManager();
  // print_r($accountManager->getAccount());


  // New instance of TextRazor
  $textrazor = new TextRazor();

  // Add an extractor
  $textrazor->addExtractor('entities');

  // Get the content from the post or page edit via AJAX - POST
  $tinymce_before = $_POST['content'];

  // Get the confident level from the user via AJAX - POST
  $confidence = 1.0;


  // We do not want to search words that already have a link <a href=''></a> or , <span class=''></span>
  // More info: http://php.net/manual/en/function.strip-tags.php Author: mariusz.tarnaski@wp.pl
  // We get a copy of the content to extract all the html tags and content inside them
  $text = $tinymce_before;
  $invert = TRUE;
  // Without placing any tag, it replace all of them
  $tags =  '<span><a>';

  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
  $tags = array_unique($tags[1]);

  if(is_array($tags) AND count($tags) > 0) {
    if($invert == FALSE) {
      $text =  preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    else {
      $text =  preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
    }
  }
  elseif($invert == FALSE) {
    $text = preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
  }


  // Analyze and extract the entities from the text which we extract all the html tags and content inside them
  $response = $textrazor->analyze($text);

  if (isset($response['response']['entities'])) {
      foreach ($response['response']['entities'] as $entity) {
        if ($entity['confidenceScore'] >= $confidence) {
          // Replace the actual text from TinyMCE with those words found with TextRazor and make a link
          $tinymce_after = str_replace($entity['matchedText'], "<span class='wpLinkedToolTip tooltip-effect-1'><span class='wpLinkedToolTipItem'>{$entity['matchedText']}</span><span class='wpLinkedToolTipContent clearfix'><span class='wpLinkedToolTipImage'><img src='img/none.png'></span><span class='wpLinkedToolTipItemText'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<span class='wpLinkedToolTipItemFooter'><span class='wpLinkedToolTipItemSource'>Source: <a target='_blank' href='https://www.wikidata.org/wiki/{$entity['wikidataId']}'>Wikidata</a></span> <span class='wpLinkedToolTipItemConfidence'>Confidence: {$entity['confidenceScore']}</span></span></span></span></span>", $tinymce_before);
        }
      }
  }
  // Return the text clean, Un-quotes a quoted string - More info http://php.net/manual/en/function.stripslashes.php
  print(stripslashes($tinymce_after));

	wp_die();
}
