<div class="pixflow-builder-toolbar">
    <div class="pixflow-builder-left" >
        <div class="builder-menu">
            <ul>
                <li class="builder-brand">
                    <a href="http://pixflow.net/products/massive-dynamic/" target="_blank" >
                        <img src="<?php echo esc_url(PIXFLOW_THEME_LIB_URI.'/assets/img/builder-logo.png'); ?>">
                    </a>
                </li>
                <li class="builder-customizer">
                    <a class="site-setting" href="<?php echo admin_url('customize.php?url='.urlencode(get_permalink(get_the_ID()))) . '/#open-demo'; ?>">
                        <?php echo esc_attr__('Import Template', 'massive-dynamic' ) ?>
                    </a>
                </li>
                <li class="builder-sitesetting">
                    <a class="dashboard" href="<?php echo admin_url('customize.php?url='.urlencode(get_permalink(get_the_ID()))); ?>">
                        <?php echo esc_attr__('Site Setting', 'massive-dynamic' ) ?>
					</a>
                </li>
                <li class="builder-dashboard">
                    <a class="preview" href="<?php echo admin_url(); ?>"> <?php echo esc_attr__('Dashboard ', 'massive-dynamic' ) ?> </a>
                </li>
                <li class="builder-help">
                    <a href="https://help.pixflow.net" target="_blank" > <?php echo esc_attr__('Help', 'massive-dynamic' ) ?> </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="pixflow-builder-right" >
        <div class="builder-controls">
            <ul>
                <li class="builder-preview">
                    <a class="preview" href="#"> <?php echo esc_attr__('Preview', 'massive-dynamic' ) ?> </a>
                </li>
                <li class="builder-save">
                    <a class="save" href="#"> <?php echo esc_attr__('Publish', 'massive-dynamic' ) ?> </a>
                    <div class="save-loading"></div>
                </li>
                <li class="builder-close">
                    <a href="<?php echo esc_url(render_close_button()); ?>" />
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 14 15" style="enable-background:new 0 0 14 15;" xml:space="preserve"><style type="text/css">.st0{fill:#FFFFFF ;}</style><polygon class="st0" points="14,0.7 13.2,0 7,6.7 0.8,0 0,0.7 6.3,7.5 0,14.3 0.8,15 7,8.3 13.2,15 14,14.3 7.7,7.5 "></polygon></svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>