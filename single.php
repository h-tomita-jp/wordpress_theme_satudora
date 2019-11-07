<?php
if ( in_category('news') ) {
  include(TEMPLATEPATH . '/single-news.php');
} else if ( in_category('column') ) {
  include(TEMPLATEPATH . '/single-column.php');
}
?>
