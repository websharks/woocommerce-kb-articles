<?php
/**
 * Authors widget.
 *
 * @author @jaswsinc
 * @copyright WP Sharks™
 */
declare (strict_types = 1);
namespace WebSharks\WpSharks\WooCommerceKBArticles\Classes\Widgets;

use WebSharks\WpSharks\WooCommerceKBArticles\Classes;
use WebSharks\WpSharks\WooCommerceKBArticles\Interfaces;
use WebSharks\WpSharks\WooCommerceKBArticles\Traits;
#
use WebSharks\WpSharks\WooCommerceKBArticles\Classes\AppFacades as a;
use WebSharks\WpSharks\WooCommerceKBArticles\Classes\SCoreFacades as s;
use WebSharks\WpSharks\WooCommerceKBArticles\Classes\CoreFacades as c;
#
use WebSharks\WpSharks\Core\Classes as SCoreClasses;
use WebSharks\WpSharks\Core\Interfaces as SCoreInterfaces;
use WebSharks\WpSharks\Core\Traits as SCoreTraits;
#
use WebSharks\Core\WpSharksCore\Classes as CoreClasses;
use WebSharks\Core\WpSharksCore\Classes\Core\Base\Exception;
use WebSharks\Core\WpSharksCore\Interfaces as CoreInterfaces;
use WebSharks\Core\WpSharksCore\Traits as CoreTraits;
#
use function assert as debug;
use function get_defined_vars as vars;

/**
 * Authors widget.
 *
 * @since 160731.38548 Initial release.
 */
class Authors extends SCoreClasses\SCore\Base\Widget
{
    /**
     * Class constructor.
     *
     * @since 160731.38548 Initial release.
     */
    public function __construct()
    {
        $App  = c::app();
        $args = [
            'slug'        => 'authors',
            'name'        => __('KB: Authors', 'woocommerce-kb-articles'),
            'description' => __('Display a list of KB authors.', 'woocommerce-kb-articles'),
        ];
        $default_options = [
            'show_avatars' => true,
            'show_counts'  => true,
        ];
        parent::__construct($App, $args, $default_options);
    }

    /**
     * Outputs the options form on admin.
     *
     * @since 160731.38548 Initial release.
     *
     * @param SCoreClasses\SCore\WidgetForm $Form    Instance.
     * @param array                         $options Options.
     *
     * @return string Form content markup.
     */
    protected function formContent(SCoreClasses\SCore\WidgetForm $Form, array $options): string
    {
        $markup = $Form->selectRow([
            'name'    => 'show_avatars',
            'label'   => __('Show Avatars?', 'woocommerce-kb-articles'),
            'value'   => $options['show_avatars'],
            'options' => [
                '0' => __('No', 'woocommerce-kb-articles'),
                '1' => __('Yes', 'woocommerce-kb-articles'),
            ],
        ]);
        $markup .= $Form->selectRow([
            'name'    => 'show_counts',
            'label'   => __('Show Article Counts?', 'woocommerce-kb-articles'),
            'value'   => $options['show_counts'],
            'options' => [
                '0' => __('No', 'woocommerce-kb-articles'),
                '1' => __('Yes', 'woocommerce-kb-articles'),
            ],
        ]);
        return $markup;
    }

    /**
     * Widget content markup.
     *
     * @since 160731.38548 Initial release.
     *
     * @param array $options Options.
     *
     * @return string Widget content markup.
     */
    protected function widgetContent(array $options): string
    {
        $WpDb = s::wpDb(); // DB instance.

        if (is_singular('product')) {
            $product_id = (int) get_the_ID();
        } elseif (is_singular('kb_article') || is_post_type_archive('kb_article')) {
            $product_id = s::wcProductIdBySlug((string) get_query_var('kb_product'));
        }
        if (!empty($product_id)) { // Product-specific authors.

            $sql = /* Get all KB authors for this product KB. */ '
                SELECT DISTINCT `posts`.`post_author`, COUNT(`posts`.`ID`) AS `count`
                    FROM `'.esc_sql($WpDb->posts).'` AS `posts`,
                        `'.esc_sql($WpDb->postmeta).'` AS `meta`

                WHERE `posts`.`post_type` = \'kb_article\'
                    AND `posts`.`post_status` = \'publish\'

                    AND `posts`.`ID` = `meta`.`post_id`

                    AND `meta`.`meta_key` = %s
                    AND `meta`.`meta_value` = %s

                GROUP BY `posts`.`post_author`';
            $sql = $WpDb->prepare($sql, s::postMetaKey('_product_id'), $product_id);
            //
        } else { // Not a product-specific query in this default case.

            $sql = /* Get all KB authors (for all KBs). */ '
                SELECT DISTINCT `posts`.`post_author`, COUNT(`posts`.`ID`) AS `count`
                    FROM `'.esc_sql($WpDb->posts).'` AS `posts`

                WHERE `posts`.`post_type` = \'kb_article\'
                    AND `posts`.`post_status` = \'publish\'

                GROUP BY `posts`.`post_author`';
        }
        $authors = $author_counts = $lis = []; // Initialize.

        foreach ((array) $WpDb->get_results($sql) as $_result) {
            $author_counts[$_result->post_author] = (int) $_result->count;
            $authors[$_result->post_author]       = (int) $_result->post_author;
        } // unset($_result); // Housekeeping.

        if (!$authors) {
            return ''; // No authors; nothing to do here.
        }
        arsort($author_counts, SORT_NUMERIC);
        uksort($authors, function ($a, $b) use ($author_counts) {
            return $author_counts[$b] <=> $author_counts[$a];
        });
        $author_args = ['include' => $authors, 'orderby' => 'include'];
        $author_args = s::applyFilters('widget_author_args', $author_args);
        $authors     = get_users($author_args);

        foreach ($authors as $_WP_User) {
            $_li = ''; // New list item.

            $_li .= '<li>'; // New list item.
            $_li .=     $options['show_avatars'] ? '<span class="-avatar">'.get_avatar($_WP_User).'</span>' : '';
            $_li .=     '<a class="-name" href="'.esc_url(get_author_posts_url($_WP_User->ID, $_WP_User->user_nicename)).'">'.esc_html($_WP_User->display_name).'</a>';
            $_li .=     $options['show_counts'] ? '<span class="-count">('.$author_counts[$_WP_User->ID].')</span>' : '';
            $_li .= '</li>';

            $lis[] = $_li;
        } // unset($_WP_User, $_li); // Housekeeping.

        return $markup = '<ul>'.implode($lis).'</ul>';
    }
}
