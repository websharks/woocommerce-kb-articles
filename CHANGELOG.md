## v160919.20254

- Article icon more opaque.
- Short slug/var changed to `wp_kb`.

## v160828.49551

- New Facade for developers: `a::articleUrl()` (by slug).
- New Facade for developers: `a::stylesScriptsMayApply()`.
- New Product Endpoint: `/product/kb-article/[slug]` allows for product-specific KBA redirects. This Endpoint, like all others, can be configured from the KB Article options page.

## v160827.7973

- Bug fix. No need to call `stripLeadingIndents()` in product tab content filter.
- Bug fix. Overflow and whitespace styles applied to the `[kb /]` shortcode were inadvertenly hiding excerpts in the list of the articles.
- Adding new `[kb /]` shortcode attribute: `show_excerpts="false"`.
- Adding `title=""` attribute to all category, tag, and titles generated by the `[kb /]` shortcode.
- Enhancing styles applied to list of KBAs produced by the `[kb /]` shortcode.
- New `[kb /]` shortcode attribute: `one_line_titles="true"`.
- Adding `title=""` attribute to default KBA archive template for the Storefront theme.
- Enhancing search box placeholder icon in `[kb /]` shortcode.
- Make it possible to hide the KB product tab by emptying the KB tab content field for any given product.

## v160805.29085

- Adding meta widget that can be used to display article meta instead of forcing it into the content area. Props @raamdev.
- Adding 'For Product' meta details to default singular template for Storefront-based themes for WooCommerce.
- Adding new widget: **KB: Back to Product**, making it easier to reference the product page (for the current product), from any area of the KB.

## v160801.36241

- Fixed `E_NOTICE` error in Authors widget on `$product_id`.
- Enhanced Authors widget; now automatically sorting by article counters.

## v160731.38548

- Initial release.
