<?php
/**
 * Template part for displaying page content.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

?>

<?php get_header(); ?>
<!-- <script type="text/javascript">
    $(document).prop('title', 'Patient Experience form');
</script> -->
<?php
	$form_user_role = get_query_var( 'form_user_role' );
	$form_username = get_query_var( 'form_username' );
	$form_action = get_query_var( 'form_action' );

	if ($form_action == "form_entries"){
	   get_template_part( 'template-parts/content', 'formEntries' );	
	}

  if ($form_action == "form"){
     get_template_part( 'template-parts/content', 'form' );  
  }

  if ($form_action == "edit_entry"){
     get_template_part( 'template-parts/content', 'formEdit' );  
  }
  if ($form_action == "add_account"){
     get_template_part( 'template-parts/content', 'formAccount' );  
  }
?>

<?php get_footer(); ?>
