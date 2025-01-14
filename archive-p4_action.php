<?php

/**
 * The template for displaying P4 Action pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package  WordPress
 * @subpackage  Timber
 */

use P4\MasterTheme\Post;
use Timber\Timber;

$templates = [ 'all-actions.twig', 'archive.twig', 'index.twig' ];

$context = Timber::get_context();

$context['custom_body_classes'] = 'tax-p4-page-type';
$context['header_title'] = post_type_archive_title('', false);

if (!empty(planet4_get_option('new_ia'))) {
    $template = file_get_contents(get_template_directory() . "/parts/action/query-listing-page.html");
    $content = do_blocks($template);
    $context['listing_page_content'] = $content;
    Timber::render($templates, $context);
    exit();
}

// Only applied to the "Load More" feature.
if (null !== get_query_var('page_num')) {
    $wp_query->query_vars['page'] = get_query_var('page_num');
}

$post_args = [
    'posts_per_page' => 10,
    'post_type' => 'p4_action',
    'paged' => 1,
    'has_password' => false, // Skip password protected content.
];

if (get_query_var('page')) {
    $templates = [ 'tease-taxonomy-action.twig' ];
    $post_args['paged'] = get_query_var('page');
    $pagetype_posts = new \Timber\PostQuery($post_args, Post::class);
    foreach ($pagetype_posts as $pagetype_post) {
        $context['post'] = $pagetype_post;
    }
} else {
    $pagetype_posts = new \Timber\PostQuery($post_args, Post::class);
    $context['posts'] = $pagetype_posts;
    $context['url'] = home_url($wp->request);
}

Timber::render($templates, $context);
exit();
