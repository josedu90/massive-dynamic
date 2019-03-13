<div class="pixflow-shortcodes-panel hide-panel">
    <div class="shortcode-panel-background"></div>
    <div class="pixflow-content-container">
        <div class="panel-tabs">
            <div class="panel-tab active-tab" data-tab="elements">Elements</div>
            <div class="panel-tab" data-tab="sections">Sections</div>
            <div class="tabs-underline"><hr /></div>
        </div>
        <div class="content elements-tab active-tab">
            <input class="pixflow-search-shortcode" name="qsearch" placeholder="search" value=""/>
            <div class="pixflow-shortcodes-container">

                <div class="search-result"></div>
                <?php if (is_home() || (is_front_page() && is_home()) || function_exists('is_shop') && (is_shop() || is_product_category()) && !is_product()) { ?>
                    <div class="no-shortcode"><div class="tip-image"></div>
                    <div class="heading">You Don't Need Shortcodes</div>There's no need to use shortcodes in blog and shop pages, because they have their own templates. To add contents to these pages, you should use post or product in WordPress dashboard.</div>
                <?php } else {
                        global $mBuilderShortcodes;
                        $category_list= array();
                        foreach ($mBuilderShortcodes as $shortcode => $meta) {
                           if (isset($meta['category'])){
                               /* check if it is visual composer shortcode or not */
                                $base = (isset($meta['base'])) ? $meta['base'] : '';
                                $allowed_shortcodes = array('vc_row', 'vc_empty_space');
                                if ($base == 'vc_column_text' || ( strpos($base,'vc_') === 0  && $base != ''&& !in_array($base,$allowed_shortcodes) )) {
                                    continue;
                                }

                                /* Create shortcodes Category HTML */
                                $category = $meta['category'];
                                $name = (isset($meta['name'])) ? $meta['name']:'';
                                $icon_name = strtolower($name);
                                $icon_name = str_replace(' ', '-', $icon_name);
                                if (!array_key_exists($category,$category_list)){
                                    $category_list[$category] = '<div class="shortcodes active ' . $category . '" id="' . $base . '" data-name="' . strtolower($name) .'"><div class="inner-container" ><div class="icon mdb-'.$icon_name.'"></div><p class="md-shortcode-title">' . $name . '</p></div></div>' ;

                                }else{
                                    $category_list[$category] .= '<div class="shortcodes active ' . $category . '" id="' . $base . '" data-name="' . strtolower($name) .'"><div class="inner-container" ><div class="icon mdb-'.$icon_name.'"></div><p class="md-shortcode-title" >' . $name . '</p></div></div>';
                                }
                           }
                        }
                        /* Echo shortcodes HTML */
                       global $md_allowed_HTML_tags;
                       foreach ($category_list as $category => $items_html ){
                           echo '<div class=" show category-container"><h6>' . esc_attr($category) . '</h6>'. wp_kses($items_html,$md_allowed_HTML_tags).'</div>';
                       }
                    } ?>
            </div>
        </div>
        <div class="content sections-tab">
        <div class="pixflow-sections-container">

            <?php if (is_home() || (is_front_page() && is_home()) || function_exists('is_shop') && (is_shop() || is_product_category()) && !is_product()) { ?>
                <div class="no-shortcode"><div class="tip-image"></div>
                    <div class="heading">You Don't Need Shortcodes</div>There's no need to use shortcodes in blog and shop pages, because they have their own templates. To add contents to these pages, you should use post or product in WordPress dashboard.</div>
            <?php } else {
                global $mbuilder_sections;
                /* Echo sections HTML */
                foreach ($mbuilder_sections as $section_id => $section ) {
                    $section_html = '<img src="'.PIXFLOW_THEME_LIB_URI . '/mbuilder/assets/img/sections/'.$section_id.'.png"'.' />';
                    echo '<div data-section-id="'. $section_id .'" class="section-container active">' . $section_html . '</div>';
                }
            } ?>
        </div>
    </div>
    </div>
</div>
<div class="pixflow-add-element-button">
    <span class="pixflow-element-button-icon"><svg width="20px" height="20px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Master" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <path d="M9,6 L9,0 L6,0 L6,6 L0,6 L0,9 L6,9 L6,15 L9,15 L9,9 L15,9 L15,6 L9,6 Z" id="Combined-Shape" fill="#FFFFFF"></path>
    </g>
</svg></span>
</div>
