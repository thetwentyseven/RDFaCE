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

          // Call the Wikidata API to get the description and the image if it has one - More info: https://www.mediawiki.org/wiki/Wikibase/API#wbgetentities
          $wikidataid = $entity['wikidataId'];
          $request = wp_remote_get( "https://www.wikidata.org/w/api.php?action=wbgetentities&ids={$wikidataid}&languages=en&format=json" );

          if( !is_wp_error( $request ) ) {
            // Get simply the body of the call
            $body = wp_remote_retrieve_body( $request );
            // Transform it in json code or object
            $data = json_decode( $body );
            // Get only the description of the wikidata entity
            $description = $data->entities->$wikidataid->descriptions->en->value;
            // Make a string's first character uppercase
            $description = ucfirst($description);
            // Get only the image name of the wikidata entity
            $imagename = $data->entities->$wikidataid->claims->P18[0]->mainsnak->datavalue->value;
            // Convert spaces in string into +
            $imagename = str_replace(' ', '+', $imagename);
            // Call the Wikidata API: Imageinfo - More info: https://www.mediawiki.org/wiki/API:Imageinfo
            $request_image = wp_remote_get( "https://commons.wikimedia.org/w/api.php?action=query&titles=File%3A{$imagename}&prop=imageinfo&iiprop=url&iiurlwidth=130&format=json" );

            // If there is no image, use the predetermined
            if( !is_wp_error( $request_image ) ) {
              // Get simply the body of the call
              $body = wp_remote_retrieve_body( $request_image );
              // Transform it in json code or object
              $data = json_decode( $body );
              // Get image url
              // More info: https://stackoverflow.com/questions/49119476/getting-first-object-from-a-json-file/49120012#49120012
              // Because we do not know the 'pageid' element, we get the first element of 'pages'
              $props = array_values(get_object_vars($data->query->pages));
              $imageurl = $props[0]->imageinfo[0]->thumburl;

            }

            if (empty($imageurl)) {
              $imageurl = plugins_url( 'linked/public/images/image-not-available.jpg' );
            }

            // Replace the actual text from TinyMCE with those words found with TextRazor and make a link
            $tinymce_after = str_replace($entity['matchedText'], "<span class='wpLinkedToolTip tooltip-effect-1'><span class='wpLinkedToolTipItem'>{$entity['matchedText']}</span><span class='wpLinkedToolTipContent clearfix'><span class='wpLinkedToolTipImage'><img src='{$imageurl}'></span><span class='wpLinkedToolTipItemText'>{$description}<span class='wpLinkedToolTipItemFooter'><span class='wpLinkedToolTipItemSource'>Source: <a target='_blank' href='https://www.wikidata.org/wiki/{$wikidataid}'>Wikidata</a></span> <span class='wpLinkedToolTipItemConfidence'>Confidence: {$entity['confidenceScore']}</span></span></span></span></span>", $tinymce_before);
          } // if $request

        } // if $entity['confidenceScore']
      } // foreach
  } // if $response['response']['entities']

  // Return the text clean, Un-quotes a quoted string - More info http://php.net/manual/en/function.stripslashes.php
  // Checking size of the string
  // print(strlen($tinymce_after));
  print(stripslashes($tinymce_after));

	wp_die();
}
