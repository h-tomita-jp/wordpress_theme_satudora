<?php
if ( in_category('news') ) {
  include(TEMPLATEPATH . '/archive-news.php');
} else if ( in_category('column') ) {
  include(TEMPLATEPATH . '/archive-column.php');
}
?>
