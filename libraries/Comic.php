<?php
// library for re-usable functions related to Cat's Meow Comic functionality
// All methods should be static, accessed like: Comic::method(...);
class Comic {

	/*-------------------------------------------------------------------------------------------------
	Cleans up comic strip html in order to pass html validations when re-displaying to users
	-------------------------------------------------------------------------------------------------*/
	public static function clean_comic_strip($comics)
	{
		$cleaned_comics = array();
		$comic_counter = 1;
		
		# Clean up comic html to pass html validations
		# Get rid of duplicate IDs and fix styles
		# Could probably be done in the original html/js code but quickest method for now
		foreach($comics as $comic)
		{
			$comic['comic_html'] = str_replace("id=\"comic-strip\"","class=\"comic-strip\"",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"comic-title\"","class=\"comic-title\"",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"panel-1\" class=\"","class=\"panel-1 ",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"panel-2\" class=\"","class=\"panel-2 ",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"panel-3\" class=\"","class=\"panel-3 ",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"title\"","",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"author\"","",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"preview-block\"","",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"bubble-text\" class=\"","class=\"bubble-text ",$comic['comic_html']);
			$comic['comic_html'] = str_replace("class=\"\" id=\"bubble-text\"","class=\"bubble-text\"",$comic['comic_html']);
			$comic['comic_html'] = str_replace("class=\"caption-box-text\" id=\"bubble-text\"","class=\"caption-box-text bubble-text\"",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"bubble-text\"","class=\"bubble-text\"",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"bubble-preview\"","",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"character-preview\"","",$comic['comic_html']);
			$comic['comic_html'] = str_replace("id=\"copy\"","class=\"copy\"",$comic['comic_html']);
			$cleaned_comics[] = $comic;
			$comic_counter++;
		}
		return $cleaned_comics;
	}
}
?>