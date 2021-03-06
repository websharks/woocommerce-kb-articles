<?php
/**
 * Title utils.
 *
 * @author @jaswsinc
 * @copyright WP Sharks™
 */
declare (strict_types = 1);
namespace WebSharks\WpSharks\WooCommerceKBArticles\Traits\Facades;

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
 * Title utils.
 *
 * @since 160731.38548
 */
trait Title
{
    /**
     * @since 160731.38548 Initial release.
     *
     * @param mixed ...$args Variadic args to underlying utility.
     *
     * @see Classes\Utils\Title::forSingle()
     */
    public static function singleTitle(...$args)
    {
        return $GLOBALS[static::class]->Utils->Title->forSingle(...$args);
    }

    /**
     * @since 160731.38548 Initial release.
     *
     * @param mixed ...$args Variadic args to underlying utility.
     *
     * @see Classes\Utils\Title::forArchive()
     */
    public static function archiveTitle(...$args)
    {
        return $GLOBALS[static::class]->Utils->Title->forArchive(...$args);
    }

    /**
     * @since 160731.38548 Initial release.
     *
     * @param mixed ...$args Variadic args to underlying utility.
     *
     * @see Classes\Utils\Title::singleParts()
     */
    public static function singleTitleParts(...$args)
    {
        return $GLOBALS[static::class]->Utils->Title->singleParts(...$args);
    }

    /**
     * @since 160731.38548 Initial release.
     *
     * @param mixed ...$args Variadic args to underlying utility.
     *
     * @see Classes\Utils\Title::archiveParts()
     */
    public static function archiveTitleParts(...$args)
    {
        return $GLOBALS[static::class]->Utils->Title->archiveParts(...$args);
    }
}
