<?php
/**
 * Template.
 *
 * @author @jaswsinc
 * @copyright WebSharks™
 */
declare (strict_types = 1);
namespace WebSharks\WpSharks\WooCommerceKBArticles;

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

extract($this->vars); // Template variables.
?>
<p>
    <?= sprintf(__('<strong>%1$s</strong> v%2$s installed successfully.', 'woocommerce-kb-articles'), esc_html($this->App->Config->©brand['©name']), esc_html($this->App::VERSION)) ?><br />
    <?= sprintf(__('~ Start by creating your first KB Article: <a href="%1$s" class="button" style="text-decoration:none;">Create KB Article</a>', 'woocommerce-kb-articles'), esc_url(a::createUrl())) ?>
</p>
