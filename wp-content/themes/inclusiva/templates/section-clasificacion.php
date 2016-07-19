<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo $term->taxonomy . '<br>';
echo $term->name;
?>