<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";


    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /*
     *
     * --> Action hook examples
     *
     */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
		'opt_name'             => DFD_THEME_SETTINGS_NAME,
		// This is where your data is stored in the database and also becomes your global variable name.
		'display_name'         => $theme->get( 'Name' ),
		// Name that appears at the top of your panel
		'display_version'      => $theme->get( 'Version' ),
		// Version that appears at the top of your panel
		'menu_type'            => 'menu',
		//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
		'allow_sub_menu'       => true,
		// Show the sections below the admin menu item or not
		'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
		'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
		// You will need to generate a Google API key to use this feature.
		// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
		'google_api_key'       => 'AIzaSyAP7HLJmPCd44UnyeSwejW_G1Q9OLMFFMg',
		// Set it you want google fonts to update weekly. A google_api_key value is required.
		'google_update_weekly' => false,
		// Must be defined to add google fonts to the typography module
		'async_typography'     => true,
		// Use a asynchronous font on the front end or font string
		//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
		'admin_bar'            => true,
		// Show the panel pages on the admin bar
		'admin_bar_icon'     => 'dashicons-portfolio',
		// Choose an icon for the admin bar menu
		'admin_bar_priority' => 50,
		// Choose an priority for the admin bar menu
		'global_variable'      => 'dfd_'.DFD_THEME_SETTINGS_NAME,
		// Set a different name for your global variable other than the opt_name
		'dev_mode'             => false,
		// Show the time the page took to load, etc
		'update_notice'        => false,
		// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
		'customizer'           => true,
		// Enable basic customizer support
		//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
		//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

		// OPTIONAL -> Give you extra features
		'page_priority'        => null,
		// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
		'page_parent'          => 'themes.php',
		// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
		'page_permissions'     => 'manage_options',
		// Permissions needed to access the options panel.
		'menu_icon'            => '',
		// Specify a custom URL to an icon
		'last_tab'             => '',
		// Force your panel to always open to a specific tab (by id)
		'page_icon'            => 'icon-themes',
		// Icon displayed in the admin panel next to your menu_title
		'page_slug'            => '_options',
		// Page slug used to denote the panel
		'save_defaults'        => true,
		// On load save the defaults to DB before user clicks save or not
		'default_show'         => false,
		// If true, shows the default value next to each field that is not the default value.
		'default_mark'         => '',
		// What to print by the field's title if the value shown is default. Suggested: *
		'show_import_export'   => true,
		// Shows the Import/Export panel when not used as a field.

		// CAREFUL -> These options are for advanced use only
		'transient_time'       => 60 * MINUTE_IN_SECONDS,
		'output'               => true,
		// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
		'output_tag'           => true,
		// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
		// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

		// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
		'database'             => '',
		// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
		'system_info'          => false,
		// REMOVE

		// HINTS
		'hints'                => array(
			'icon'          => 'icon-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'light',
				'shadow'  => true,
				'rounded' => false,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields

    Redux::setSection( $opt_name, array(
        'title' => __( 'Basic Fields', 'redux-framework-demo' ),
        'id'    => 'basic',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-home'
    ) );

    Redux::setSection( $opt_name, array(
        'icon' => 'crdash-memo',
		// Set the class for this icon.
		// This field is ignored unless $args['icon_type'] = 'iconfont'
		'icon_class' => 'icon-large',
		'title' => __('Getting Started', 'dfd'),
		'desc' => __('', 'dfd'),
		'fields' => array(
			array(
				'id' => 'font_awesome_info',
				'type' => 'info',
				'desc'     => '<h3 style="text-align: center; border-bottom: none;">Welcome to the Options panel of the '.wp_get_theme()->get( 'Name' ).' theme!</h3>
									<h4 style="text-align: center; font-size: 1.3em;">What does this mean to you?</h4>
									<p style="text-align: center;">From here on you will be able to regulate the main options of all the elements of the theme. </p>
									<p style="text-align: center;">Theme documentation you will find in the archive with the theme in the "Documentation" folder. </p>
									<p style="text-align: center;">If you have some questions on the theme, you can send them to our PM on <a href="http://themeforest.net/user/DFDevelopment">Themeforest.net</a>, you can send us email directly to <a href="mailto:dynamicframeworks@gmail.com">dynamicframeworks@gmail.com</a>, or you can post your questions on our <a href="http://support.dfd.name">Support Forum</a>.</p>',
			),/*
			array(
				'id' => 'import_demo_data',
				'type' => 'raw_html',
				'html' => (!$get_sections && is_plugin_active('sb-import/sb-import.php')) ? '<br /><br /><br /><h4 style="text-align: center; font-size: 1.3em;">Import Demo Data</h4>'
						. '<p style="text-align: center; color: red">If you click on this button, all current settings and posts will be removed!</p>'
						. '<p style="text-align: center;"><a onclick="return confirm(\'Continue import demo content?\')" href="admin.php?page=sb-import&action=import&_nonce=' . wp_create_nonce('sb_import_nonce') . '" class="button button-primary">' . __('Import demo content', 'dfd') . '</a></p>' : '',
			),*/
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title' => __('Main Options', 'dfd'),
		//'desc' => __('<p class="description">Main options of site</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-crown',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'scroll_animation',
				'type' => 'button_set',
				'title' => __('Page scroll animation', 'dfd'),
				'desc' => __('Enable or disable page scroll animation', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on'
			),
			array(
				'id' => 'site_preloader_enabled',
				'type' => 'button_set',
				'title' => __('Site Preloader', 'dfd'),
				'desc' => __('Enable or disable site preloader counter', 'dfd'),
				'options' => array('1' => 'On', '0' => 'Off'),
				'default' => '0'
			),
			array(
				'id' => 'custom_js',
				'type' => 'textarea',
				'title' => __('Custom JS', 'dfd'),
				'desc' => __('Place your custom javascript code if you need to customize anything using js', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'custom_css',
				'type' => 'textarea',
				'title' => __('Custom CSS', 'dfd'),
				'desc' => __('You may add any other styles for your theme to this field.', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'mobile_responsive',
				'type' => 'button_set',
				'title' => __('Mobile Responsive', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			/*array(
				'id' => 'enable_default_modules',
				'type' => 'button_set',
				'title' => __('Enable Default Modules for Visual Composer', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),*/
		),
    ) );
    Redux::setSection( $opt_name, array(
        'title' => __('Logos', 'dfd'),
		'icon' => 'crdash-photos',
		'fields' => array(
			array(
				'id' => 'custom_favicon',
				'type' => 'media',
				'title' => __('Favicon', 'dfd'),
				'desc' => __('Select a 16px X 16px image from the file location on your computer and upload it as a favicon of your site', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/favicon/favicon.ico'
					),
			),
			array(
				'id' => 'custom_logo_image',
				'type' => 'media',
				'title' => __('Header Logotype image', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'custom_retina_logo_image',
				'type' => 'media',
				'title' => __('Header Logotype image for retina', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'custom_logo_image_second',
				'type' => 'media',
				'title' => __('Header Logotype second image', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype. If this logo wasn\'t uploaded will be displayed first logo.', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'custom_retina_logo_image_second',
				'type' => 'media',
				'title' => __('Header Logotype second image for retina', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype. If this logo wasn\'t uploaded will be displayed first logo.', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'custom_logo_image_side',
				'type' => 'media',
				'title' => __('Header 5 and 8 Logotype image', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a header logotype. If this logo wasn\'t uploaded will be displayed first logo.', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'custom_retina_logo_image_side',
				'type' => 'media',
				'title' => __('Header 5 and 8 Logotype image for retina', 'dfd'),
				//'desc' => __('Select an image from the file location on your computer and upload it as a header logotype. If this logo wasn\'t uploaded will be displayed first logo.', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'custom_logo_image_third',
				'type' => 'media',
				'title' => __('Logotype for Logo-Widget', 'dfd'),
				'desc' => __('Select the logo that will be displayed in the Logo Widget.', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'custom_logo_fixed_header',
				'type' => 'media',
				'title' => __('Logo for fixed header', 'dfd'),
				'desc' => __('Select an image from the file location on your computer and upload it as a logotype for fixed header', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'mobile_logo_image',
				'type' => 'media',
				'title' => __('Logo for mobile devices', 'dfd'),
				'desc' => __('Select logo to be displayed on mobile devices.', 'dfd'),
				'default' => array(
						'url' => ''
					),
			),
			array(
				'id' => 'small_logo_image',
				'type' => 'media',
				'title' => __('Small logo for header 8', 'dfd'),
				'desc' => __('Select logo to be displayed at the top of Header 8 style side panel.', 'dfd'),
				'default' => array(
						'url' => ''
					),
			),
			/*array(
				'id' => 'preloader_logo_image',
				'type' => 'media',
				'title' => __('Logo for site preloader', 'dfd'),
				'desc' => __('Select the small logo to be displayed while your site is being loaded.', 'dfd'),
				'default' => array(
						'url' => ''
					),
			),*/
			array(
				'id' => 'side_area_title',
				'type' => 'media',
				'title' => __('Side Area logo', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'logo_footer',
				'type' => 'media',
				'title' => __('Logotype in footer', 'dfd'),
				'desc' => __('Will be displayed before footer widgets', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
			array(
				'id' => 'logo_subfooter',
				'type' => 'media',
				'title' => __('Logotype in subfooter', 'dfd'),
				'desc' => __('Will be displayed in subfooter', 'dfd'),
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/logo.png'
					),
			),
		),
    ) );


    Redux::setSection( $opt_name, array(
        'title' => __('Header Options', 'dfd'),
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'top_panel_inner_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Top Panel Inner Page', 'dfd'),
				'desc' => __('Please select Top Panel Inner Page', 'dfd'),
			),
			array(
				'id' => 'top_panel_inner_style',
				'type' => 'select',
				'title' => __('Top inner page style', 'dfd'),
				'desc' => '',
				'options' => array(
					'' => __('Sliding up/down over header', 'dfd'),
					'dfd-panel-animated' => __('Full screen animated', 'dfd')
				),
				'default' => '',
			),
			array(
				'id' => 'top_panel_inner_background',
				'type' => 'color',
				'title' => __('Top inner page background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'top_panel_inner_background_opacity',
				'type' => 'slider',
				'title' => __('Top inner page background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'top_adress_field',
				'type' => 'textarea',
				'title' => __('Top adress panel', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'desc' => __('This is top adress info block.', 'dfd'),
				'validate' => 'html',
				'default' => '<i class="dfd-icon-phone"></i><span class="dfd-top-info-delim-blank"></span>+1234567890<span class="dfd-top-info-delim"></span><i class="dfd-icon-email_2"></i><span class="dfd-top-info-delim-blank"></span>info@yourmail.com',
			),
			array(
				'id' => 'wpml_lang_show',
				'type' => 'button_set',
				'title' => __('WPML language switcher', 'dfd'),
				'desc' => __('WPML plugin must be installed. It is not packed with theme. You can find it here: http://wpml.org/', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'lang_shortcode',
				'type' => 'textarea',
				'title' => __('Language selection shortcode', 'dfd'),
				'desc' => __('You can type shortcode of language select tht your translating plugin provide', 'dfd'),
				'default'  => '<div class="lang-sel sel-dropdown"><a href="#"><span>En</span></a><ul><li><a href="#">En</a></li><li><a href="#">De</a></li><li><a href="#">Fr</a></li></ul></div>',
			),
			array(
				'id' => 'header_logo_width',
				'type' => 'slider',
				'title' => __('Header logo width', 'dfd'),
				'desc' => '',
				'min' => '30',
				'max' => '700',
				'step' => '1',
				'default' => '151',
			),
			array(
				'id' => 'header_logo_height',
				'type' => 'slider',
				'title' => __('Header logo height', 'dfd'),
				'desc' => '',
				'min' => '20',
				'max' => '150',
				'step' => '1',
				'default' => '34',
			),
			array(
				'id' => 'top_menu_height',
				'type' => 'slider',
				'title' => __('Top menu height', 'dfd'),
				'desc' => '',
				'min' => '20',
				'max' => '150',
				'step' => '2',
				'default' => '70',
			),
			array(
				'id' => 'enable_sticky_header',
				'type' => 'button_set',
				'title' => __('Enable sticky header', 'dfd'),
				'desc' => '',
				'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
				'default' => 'on'
			),
			array(
				'id' => 'fixed_header_background_color',
				'type' => 'color',
				'title' => __('Sticky Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
			),
			array(
				'id' => 'fixed_header_background_opacity',
				'type' => 'slider',
				'title' => __('Sticky Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '100',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
			),
			array(
				'id' => 'fixed_header_text_color',
				'type' => 'color',
				'title' => __('Sticky header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'enable_sticky_header', "=", 'on' ),
			),
			array(
				'id' => 'header_layout',
				'type' => 'button_set',
				'title' => __('Boxed Header Layout', 'dfd'),
				'options' => dfd_header_layouts(),
				'default' => 'fullwidth',
			),
			array(
				'id' => 'info_sth',
				'type' => 'info',
				'desc' => __('<h3 class="description">Stunning header options</h3>', 'dfd')
			),
			array(
				'id' => 'stunning_header_min_height',
				'type' => 'slider',
				'title' => __('Stunning header min height', 'dfd'),
				'desc' => '',
				'min' => '100',
				'step' => '5',
				'max' => '600',
				'default' => '400',
			),
			array(
				'id' => 'stan_header',
				'type' => 'button_set',
				'title' => __('Stunning header', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1',
			),
			array(
				'id' => 'stan_header_color',
				'type' => 'color',
				'title' => __('Default background color', 'dfd'),
				'desc' => '#f7f7f7',
				'default' => '#ffffff',
			),
			array(
				'id' => 'stan_header_image',
				'type' => 'media',
				'title' => __('Default background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'stan_header_bg_img_position',
				'type' => 'select',
				'title' => __('Default background position', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => dfd_get_bgposition(),
			),
			array(
				'id' => 'stan_header_fixed',
				'type' => 'button_set',
				'title' => __('Fixed background image position', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd'),),
				'default' => '1',
			),
			array(
				'id' => 'stan_header_bgcheck',
				'type' => 'button_set',
				'title' => __('Please switch to on if dark background is used for stunning header', 'dfd'),
				'options' => array(
					'1' => __('On', 'dfd'),
					'0' => __('Off', 'dfd'),
				),
				'default' => '0',
			),
			array(
				'id' => 'stan_header_text_align',
				'type' => 'select',
				'title' => __('Stunning header text alignment', 'dfd'),
				'options' => array(
					'text-center' => __('Center', 'dfd'),
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => 'text-center',
			),
		),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __('Header Style 1 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_first_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'head_first_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_first_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'head_first_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_first_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'header_first_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_first_top_panel', "=", 'on' ),
				'default' => '4',
			),
			/*array(
				'id' => 'header_first_soc_icons_background',
				'type' => 'color',
				'title' => __('Header social networks section background', 'dfd'),
				'default' => '',
				'required' => array( 'header_first_top_panel', "=", 'on' ),
				'validate' => 'color',
			),*/
			array(
				'id' => 'header_first_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_first_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_first_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_first_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'head_first_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_1',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_first_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_first_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_first_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Header Style 2 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_second_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'head_second_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_second_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'head_second_show_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_second_top_panel', "=", 'on' ),
				'default' => '1'
			),
			/*array(
				'id' => 'header_second_soc_icons_background',
				'type' => 'color',
				'title' => __('Header social networks section background', 'dfd'),
				'default' => '',
				'required' => array( 'header_second_top_panel', "=", 'on' ),
				'validate' => 'color',
			),*/
			array(
				'id' => 'header_second_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_second_top_panel', "=", 'on' ),
				'default' => '4',
			),
			array(
				'id' => 'header_second_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
				'required' => array( 'header_second_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_second_top_panel_background_opacity',
				'type' => 'slider',
				'title' => __('Header top panel background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
				'required' => array( 'header_second_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_second_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_second_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'head_second_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_2',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_second_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_second_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
			),
			array(
				'id' => 'header_second_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
			),
			array(
				'id' => 'header_second_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Header Style 3 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_third_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'head_third_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_third_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'head_third_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_third_top_panel', "=", 'on' ),
				'default' => '1'
			),
			/*array(
				'id' => 'header_third_soc_icons_background',
				'type' => 'color',
				'title' => __('Header social networks section background', 'dfd'),
				'default' => '',
				'required' => array( 'header_third_top_panel', "=", 'on' ),
				'validate' => 'color',
			),*/
			array(
				'id' => 'header_third_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_third_top_panel', "=", 'on' ),
				'default' => '4',
			),
			array(
				'id' => 'header_third_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_third_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_third_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_third_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'head_third_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_3',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_third_enable_buttons', "=", 1 ),
				'default' => '0'
			),
			array(
				'id' => 'header_third_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_third_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Header Style 4 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_fourth_top_panel',
				'type' => 'button_set',
				'title' => __('Header top panel', 'dfd'),
				'options' => array('on' => 'On', 'off' => 'Off'),
				'default' => 'on',
			),
			array(
				'id' => 'head_fourth_enable_top_panel_wishlist_link',
				'type' => 'button_set',
				'title' => __('Enable top panel wishlist link', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
				'default' => '1'
			),
			array(
				'id' => 'head_fourth_show_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
				'default' => '1'
			),
			/*array(
				'id' => 'header_fourth_soc_icons_background',
				'type' => 'color',
				'title' => __('Header social networks section background', 'dfd'),
				'default' => '',
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
				'validate' => 'color',
			),*/
			array(
				'id' => 'header_fourth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
				'default' => '4',
			),
			array(
				'id' => 'header_fourth_top_panel_background_color',
				'type' => 'color',
				'title' => __('Header top panel default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_fourth_top_panel_background_opacity',
				'type' => 'slider',
				'title' => __('Header top panel background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'header_fourth_top_panel_color',
				'type' => 'color',
				'title' => __('Header top panel default text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
				'required' => array( 'header_fourth_top_panel', "=", 'on' ),
			),
			array(
				'id' => 'head_fourth_enable_buttons',
				'type' => 'button_set',
				'title' => __('Enable header buttons and links', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'show_search_form_header_4',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'required' => array( 'head_fourth_enable_buttons', "=", 1 ),
				'default' => '1'
			),
			array(
				'id' => 'header_fourth_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => 'transparent',
				'validate' => 'color',
			),
			array(
				'id' => 'header_fourth_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '0',
			),
			array(
				'id' => 'header_fourth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Header Style 5 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_fifth_copyright',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Please enter the copyright message here.', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'validate' => 'html',
				'default' => '<a href="wpsaloon.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			),
			array(
				'id' => 'header_fifth_alignment',
				'type' => 'select',
				'title' => __('Header Alignment', 'dfd'),
				'options' => array(
					'left' => __('Left','dfd'),
					'right' => __('Right','dfd'),
				),
				'default' => 'left',
			),
			array(
				'id' => 'header_fifth_content_alignment',
				'type' => 'select',
				'title' => __('Header Content Alignment', 'dfd'),
				'options' => dfd_alignment_options(),
				'default' => 'text-left',
			),
			array(
				'id' => 'head_fifth_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_fifth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '4',
			),
			array(
				'id' => 'show_search_form_header_5',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'header_fifth_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_fifth_bg_image',
				'type' => 'media',
				'title' => __('Header background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'header_fifth_bg_img_position',
				'type' => 'select',
				'title' => __('Header background image position', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => dfd_get_bgposition(),
			),
			array(
				'id' => 'header_fifth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Header Style 6 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'show_search_form_header_6',
				'type' => 'button_set',
				'title' => __('Show search form in header (for mobile devices only)', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_sixth_text_color',
				'type' => 'color',
				'title' => __('Header elements color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Header Style 7 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_seventh_copyright',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Please enter the copyright message here.', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'validate' => 'html',
				'default' => '<a href="wpsaloon.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			),
			array(
				'id' => 'header_seventh_content_alignment',
				'type' => 'select',
				'title' => __('Header Content Alignment', 'dfd'),
				'options' => array(
					'text-left' => __('Left', 'dfd'),
					'text-right' => __('Right', 'dfd'),
				),
				'default' => 'text-left',
			),
			array(
				'id' => 'head_seventh_show_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_seventh_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '4',
			),
			array(
				'id' => 'show_search_form_header_7',
				'type' => 'button_set',
				'title' => __('Show search form in header (for mobile devices only)', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_seventh_background_color',
				'type' => 'color',
				'title' => __('Header default background color', 'dfd'),
				'default' => '#000000',
				'validate' => 'color',
			),
			array(
				'id' => 'header_seventh_background_opacity',
				'type' => 'slider',
				'title' => __('Header background opacity ', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'default' => '90',
			),
			array(
				'id' => 'header_seventh_text_color_active',
				'type' => 'color',
				'title' => __('Header Active text color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
			array(
				'id' => 'header_seventh_text_color',
				'type' => 'color',
				'title' => __('Menu button color', 'dfd'),
				'default' => '#ffffff',
				'validate' => 'color',
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Header Style 8 options', 'dfd'),
		'subsection' => true,
		'icon' => 'crdash-panel_show',
		'fields' => array(
			array(
				'id' => 'header_eighth_copyright',
				'type' => 'text',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Please enter the copyright message here.', 'dfd'),
				'sub_desc' => __('Please do not use single quote here', 'dfd'),
				'validate' => 'html',
				'default' => '<a href="wpsaloon.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			),
			array(
				'id' => 'header_eighth_alignment',
				'type' => 'select',
				'title' => __('Header Alignment', 'dfd'),
				'options' => array(
					'left' => __('Left','dfd'),
					'right' => __('Right','dfd'),
				),
				'default' => 'left',
			),
			array(
				'id' => 'header_eighth_content_alignment',
				'type' => 'select',
				'title' => __('Header Content Alignment', 'dfd'),
				'options' => dfd_alignment_options(),
				'default' => 'text-left',
			),
			array(
				'id' => 'head_eighth_show_header_soc_icons',
				'type' => 'button_set',
				'title' => __('Show social icons in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'header_eighth_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Header Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '4',
			),
			array(
				'id' => 'show_search_form_header_8',
				'type' => 'button_set',
				'title' => __('Show search form in header', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'
			),
			array(
				'id' => 'header_eighth_navbutton_color',
				'type' => 'color',
				'title' => __('Button color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_eighth_navbutton_bg',
				'type' => 'color',
				'title' => __('Button bar background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_eighth_background_color',
				'type' => 'color',
				'title' => __('Header background color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'header_eighth_bg_image',
				'type' => 'media',
				'title' => __('Header background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'header_eighth_bg_img_position',
				'type' => 'select',
				'title' => __('Header background image position', 'dfd'),
				'desc' => __('', 'dfd'),
				'default' => '',
				'options' => dfd_get_bgposition(),
			),
			array(
				'id' => 'header_eighth_text_color',
				'type' => 'color',
				'title' => __('Header text color', 'dfd'),
				'default' => '',
				'validate' => 'color',
			),
		),
    ) );
	
	$_menu_options_fields = array();
	$_menu_default_font_family = array(
		1 => 'texgyreadventorregular',//menu titles
		2 => 'Raleway',//menu dropdowns
		3 => 'Droid Serif',//menu dropdown subtitles
	);
	$_menu_default_font_size = array(
		1 => '11px',//menu titles
		2 => '13px',//menu dropdowns
		3 => '11px',//menu dropdown subtitles
	);
	$_menu_default_line_height_increment = array(
		1 => 1.6,//menu titles
		2 => 2,//menu dropdowns
		3 => 1,//menu dropdown subtitles
	);
	$_menu_default_font_weight = array(
		1 => '600',//menu titles
		2 => '400',//menu dropdowns
		3 => '400',//menu dropdown subtitles
	);
	$_menu_default_font_style = array(
		1 => 'normal',//menu titles
		2 => 'normal',//menu dropdowns
		3 => 'italic',//menu dropdown subtitles
	);
	$_menu_default_text_transform = array(
		1 => 'uppercase',//menu titles
		2 => 'none',//menu dropdowns
		3 => 'none',//menu dropdown subtitles
	);
	/*$_menu_default_word_spacing = array(
		1 => '0px',//menu titles
		2 => '0px',//menu dropdowns
		3 => '0px',//menu dropdown subtitles
	);*/
	$_menu_default_letter_spacing = array(
		1 => '2px',//menu titles
		2 => '0px',//menu dropdowns
		3 => '0px',//menu dropdown subtitles
	);
	$_menu_default_option_name = array(
		1 => 'menu_titles',//menu titles
		2 => 'menu_dropdowns',//menu dropdowns
		3 => 'menu_dropdown_subtitles',//menu dropdown subtitles
	);
	$_menu_default_color = array(
		1 => '#28262b',//menu titles
		2 => '#ffffff',//menu dropdowns
		3 => '#bbbbbb',//menu dropdown subtitles
	);
	$_menu_default_option_title = array(
		1 => 'Menu titles',//menu titles
		2 => 'Menu dropdowns',//menu dropdowns
		3 => 'Menu dropdown subtitles',//menu dropdown subtitles
	);

	for ($i=1; $i<=3; $i++) {
		$_menu_options_fields[] = array(
			'id'          => $_menu_default_option_name[$i].'_typography_option',
			'type'        => 'typography',
			'title'       => __( $_menu_default_option_title[$i].' Typography', 'redux-framework-demo' ),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'      => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets'       => false, // Only appears if google is true and subsets not set to false
			'font-size'     => true,
			'text-align'	=> false,
			'line-height'   => true,
			'word-spacing'  => false,  // Defaults to false
			'letter-spacing'=> true,  // Defaults to false
			'text-transform'=> true,
			'color'         => true,
			'preview'       => false, // Disable the previewer
			'all_styles'  => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px',
			// Defaults to px
			'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
			'default'     => array(
				'font-style'  => $_menu_default_font_style[$i],
				'font-weight'  => $_menu_default_font_weight[$i],
				'font-family' => $_menu_default_font_family[$i],
				'google'      => true,
				'font-size'   => $_menu_default_font_size[$i],
				'line-height' => $_menu_default_font_size[$i] * $_menu_default_line_height_increment[$i].'px',
				'text-transform'=> $_menu_default_text_transform[$i],
				//'word-spacing'  => $_menu_default_word_spacing[$i],
				'letter-spacing'=> $_menu_default_letter_spacing[$i],
				'color'	=> $_menu_default_color[$i],
			),
		);
	}
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdowns_opacity',
		'type' => 'slider',
		'title' => __('Menu dropdown items text opacity', 'dfd'),
		'desc' => '',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'default' => '40',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_hover_color',
		'type' => 'color',
		'title' => __('Menu dropdown hover color', 'dfd'),
		'desc' => '',
		'default' => '#8a8f6a',
		'validate' => 'color',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_background',
		'type' => 'color',
		'title' => __('Menu dropdown background color', 'dfd'),
		'desc' => '',
		'default' => '#1b1b1b',
		'validate' => 'color',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_background_opacity',
		'type' => 'slider',
		'title' => __('Menu dropdown background opacity', 'dfd'),
		'desc' => '',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'default' => '100',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_hover_bg',
		'type' => 'color',
		'title' => __('Menu dropdown hover background color', 'dfd'),
		'desc' => '',
		'default' => 'transparent',
		'validate' => 'color',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_dropdown_hover_bg_opacity',
		'type' => 'slider',
		'title' => __('Menu dropdown hover background opacity', 'dfd'),
		'desc' => '',
		'min' => '0',
		'max' => '100',
		'step' => '1',
		'default' => '',
	);
	$_menu_options_fields[] = array(
		'id' => 'menu_alignment',
		'type' => 'select',
		'title' => __('Primary Navigation Alignment', 'dfd'),
		'options' => dfd_alignment_options(),
		'default' => 'text-right'
	);
	
    Redux::setSection( $opt_name, array(
        'title' => __('Menu options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-indent',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => $_menu_options_fields,
    ) );
	$_side_area_options_fields = array();
	/*$_side_area_default_font_family = array(
		1 => 'texgyreadventorregular',//menu titles
		2 => 'Raleway',//menu dropdowns
		3 => 'Droid Serif',//menu dropdown subtitles
	);
	$_side_area_default_font_size = array(
		1 => '11px',//menu titles
		2 => '12px',//menu dropdowns
		3 => '11px',//menu dropdown subtitles
	);
	$_side_area_default_line_height_increment = array(
		1 => 1.6,//menu titles
		2 => 1.57,//menu dropdowns
		3 => 1,//menu dropdown subtitles
	);
	$_side_area_default_font_weight = array(
		1 => '600',//menu titles
		2 => '400',//menu dropdowns
		3 => '400',//menu dropdown subtitles
	);
	$_side_area_default_font_style = array(
		1 => 'normal',//menu titles
		2 => 'normal',//menu dropdowns
		3 => 'italic',//menu dropdown subtitles
	);
	$_side_area_default_text_transform = array(
		1 => 'uppercase',//menu titles
		2 => 'none',//menu dropdowns
		3 => 'none',//menu dropdown subtitles
	);
	$_side_area_default_word_spacing = array(
		1 => '0px',//menu titles
		2 => '0px',//menu dropdowns
		3 => '0px',//menu dropdown subtitles
	);
	$_side_area_default_letter_spacing = array(
		1 => '0px',//menu titles
		2 => '0px',//menu dropdowns
		3 => '0px',//menu dropdown subtitles
	);
	$_side_area_default_option_name = array(
		1 => 'side_area_menu_titles',//menu titles
		2 => 'side_area_menu_dropdowns',//menu dropdowns
		3 => 'side_area_menu_dropdown_subtitles',//menu dropdown subtitles
	);
	$_side_area_default_color = array(
		1 => '',//menu titles
		2 => '',//menu dropdowns
		3 => '',//menu dropdown subtitles
	);
	$_side_area_default_option_title = array(
		1 => 'Side Area Menu titles',//menu titles
		2 => 'Side Area Menu dropdowns',//menu dropdowns
		3 => 'Side Area Menu dropdown subtitles',//menu dropdown subtitles
	);

	for ($i=1; $i<=3; $i++) {
		$_side_area_options_fields[] = array(
			'id'          => $_side_area_default_option_name[$i].'_typography_option',
			'type'        => 'typography',
			'title'       => __( $_side_area_default_option_title[$i].' Typography', 'redux-framework-demo' ),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'      => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets'       => false, // Only appears if google is true and subsets not set to false
			'font-size'     => true,
			'text-align'	=> false,
			'line-height'   => true,
			'word-spacing'  => false,  // Defaults to false
			'letter-spacing'=> true,  // Defaults to false
			'text-transform'=> true,
			'color'         => true,
			'preview'       => false, // Disable the previewer
			'all_styles'  => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px',
			// Defaults to px
			'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
			'default'     => array(
				'font-style'  => $_side_area_default_font_style[$i],
				'font-weight'  => $_side_area_default_font_weight[$i],
				'font-family' => $_side_area_default_font_family[$i],
				'google'      => true,
				'font-size'   => $_side_area_default_font_size[$i],
				'line-height' => $_side_area_default_font_size[$i] * $_side_area_default_line_height_increment[$i].'px',
				'text-transform'=> $_side_area_default_text_transform[$i],
				//'word-spacing'  => $_side_area_default_word_spacing[$i],
				'letter-spacing'=> $_side_area_default_letter_spacing[$i],
				'color'	=> $_side_area_default_color[$i],
			),
		);
	}*/
	$_side_area_options_fields[] = array(
		'id' => 'side_area_alignment',
		'type' => 'select',
		'title' => __('Side Area Elements Alignment', 'dfd'),
		'options' => dfd_alignment_options(),
		'default' => 'text-left'
	);
	/*
	$_side_area_options_fields[] = array(
		'id' => 'side_area_search',
		'type' => 'button_set',
		'title' => __('Enable Side Area Search', 'dfd'),
		'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		'default' => '1'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_cart',
		'type' => 'button_set',
		'title' => __('Enable Side Area Cart', 'dfd'),
		'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		'default' => '1'
	);
	 */
	$_side_area_options_fields[] = array(
		'id' => 'side_area_enable',
		'type' => 'button_set',
		'title' => __('Enable Side Area by default', 'dfd'),
		'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
		'default' => 'on'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_soc_icons',
		'type' => 'button_set',
		'title' => __('Enable Side Area Soc icons', 'dfd'),
		'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		'default' => '1'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_soc_icons_hover_style',
		'type' => 'select',
		'title' => __('Social icons hover style', 'dfd'),
		'options' => dfd_soc_icons_hover_style(),
		'default' => '4',
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_copyright',
		'type' => 'textarea',
		'title' => __('Side Area Copyright', 'dfd'),
		'desc' => __('Place side area copyright text here', 'dfd'),
		'validate' => 'html',
		'default' => '<a href="dfd.name" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
	);
	/*
	$_side_area_options_fields[] = array(
		'id' => 'side_area_width',
		'type' => 'slider',
		'title' => __('Side area width', 'dfd'),
		'desc' => '',
		'min' => '10',
		'max' => '100',
		'step' => '1',
		'default' => '50',
	);
	*/
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_color',
		'type' => 'color',
		'title' => __('Side Area Background Color', 'dfd'),
		'desc' => __('Color of buttons, tabs, links, etc.  For example: #36cfe8', 'dfd'),
		'default' => '#ffffff',
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_image',
		'type' => 'media',
		'title' => __('Side area background image', 'dfd'),
		'desc' => '',
		'default' => array(
			'url' => '',
		),
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_position',
		'type' => 'select',
		'title' => __('Side area background position', 'dfd'),
		'desc' => '',
		'options' => dfd_get_bgposition(),
		'default' => '',
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_repeat',
		'type' => 'select',
		'title' => __('Side area background repeat', 'dfd'),
		'desc' => '',
		'options' => array('no-repeat' => 'no-repeat', 'repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'repeat' => 'both vertically and horizontally',),
		'default' => 'no-repeat'
	);
	$_side_area_options_fields[] = array(
		'id' => 'side_area_bg_dark',
		'type' => 'button_set',
		'title' => __('Please set to Yes if the dark color was chosen as a side background color', 'dfd'),
		'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
		'default' => '0'
	);
    Redux::setSection( $opt_name, array(
        'title' => __('Side Area Options', 'dfd'),
		//'desc' => __('<p class="description">Side area and fixed left and right aligned headers options</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-layout_alt2',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => $_side_area_options_fields
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Footer section options', 'dfd'),
		//'desc' => __('<p class="description">Footer section options</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-panel_close',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'footer_variant',
				'type' => 'select',
				'title' => __('Footer variants', 'dfd'),
				'options' => dfd_footer_values(),
				'default' => '1'
			),
			array(
				'id' => 'enable_footer_logo',
				'type' => 'button_set',
				'title' => __('Enable footer logo', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'enable_footer_soc_icons',
				'type' => 'button_set',
				'title' => __('Enable footer social icons', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'footer_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Footer Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '4',
				'required' => array( 'enable_footer_soc_icons', "=", 1 ),
			),
			array(
				'id' => 'enable_footer_menu',
				'type' => 'button_set',
				'title' => __('Enable footer menu', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'enable_subfooter',
				'type' => 'button_set',
				'title' => __('Enable subfooter', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'footer_page_select',
				'type'     => 'select',
				'data'     => 'pages',
				'title' => __('Footer Section Page', 'dfd'),
				'desc' => __('Please select Footer Section Page', 'dfd'),
				'required' => array( 'footer_variant', "=", 3 ),
			),
			array(
				'id' => 'copyright_footer',
				'type' => 'textarea',
				'title' => __('Copyright message', 'dfd'),
				'desc' => __('Fill in the copyright text.', 'dfd'),
				'validate' => 'html',
				'default' => '© DynamicFrameworks- Elite ThemeForest Author.'
			),
			array(
				'id' => 'footer_copyright_position',
				'type' => 'select',
				'title' => __('Copyright message position', 'dfd'),
				'options' => array(
					'footer' => __('In Footer', 'dfd'),
					'subfooter' => __('In Subfooter', 'dfd'),
				),
				'default' => 'subfooter',
			),
			array(
				'id' => 'info_foot',
				'type' => 'info',
				'desc' => __('<h3 class="description">Footer styling options</h3>', 'dfd')
			),
			array(
				'id' => 'footer_bg_color',
				'type' => 'color',
				'title' => __('Footer background color', 'dfd'),
				'desc' => __('Select footer background color. ', 'dfd'),
				'default' => '#323232'
			),
			array(
				'id' => 'footer_bg_dark',
				'type' => 'button_set',
				'title' => __('Please set to Yes if the dark color was chosen as a footer background color', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'footer_bg_image',
				'type' => 'media',
				'title' => __('Custom footer background image', 'dfd'),
				'desc' => __('Upload your own footer background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'footer_custom_repeat',
				'type' => 'select',
				'title' => __('Footer background image repeat', 'dfd'),
				'desc' => __('Select type background image repeat', 'dfd'),
				'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
				'default' => ''
			),
			array(
				'id' => 'info_sub_foot',
				'type' => 'info',
				'desc' => __('<h3 class="description">Sub footer styling options</h3>', 'dfd')
			),

			array(
				'id' => 'sub_footer_bg_color',
				'type' => 'color',
				'title' => __('Sub footer background color', 'dfd'),
				'desc' => __('Select sub footer background color. ', 'dfd'),
				'default' => '#323232',
			),
			array(
				'id' => 'sub_footer_bg_dark',
				'type' => 'button_set',
				'title' => __('Please set to Yes if the dark color was chosen as a subfooter background color', 'dfd'),
				'desc' => '',
				'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
				'default' => '1'
			),
			array(
				'id' => 'sub_footer_bg_image',
				'type' => 'media',
				'title' => __('Custom sub footer background image', 'dfd'),
				'desc' => __('Upload your own footer background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'sub_footer_custom_repeat',
				'type' => 'select',
				'title' => __('Sub footer background image repeat', 'dfd'),

				'desc' => __('Select type background image repeat', 'dfd'),
				'options' => array('repeat' => 'both vertically and horizontally', 'repeat-y' => 'vertically','repeat-x' => 'horizontally','no-repeat' => 'no-repeat', ),//Must provide key => value pairs for select options
				'default' => 'repeat'
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Social accounts', 'dfd'),
		//'desc' => __('<p class="description">Type links for social accounts</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-share',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Default Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '4',
			),
			/*
			array(
				'id' => 'author_soc_icons_hover_style',
				'type' => 'select',
				'title' => __('Author Box Social icons hover style', 'dfd'),
				'options' => dfd_soc_icons_hover_style(),
				'default' => '4',
			),
			*/
			array(
				'id' => 'de_link',
				'type' => 'text',
				'title' => __('Deviantart link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'de_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'dg_link',
				'type' => 'text',
				'title' => __('Digg link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'dg_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'dr_link',
				'type' => 'text',
				'title' => __('Dribbble link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'http://dribbble.com'
			),
//						array(
//							'id' => 'dr_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '1'// 1 = on | 0 = off
//						),
			array(
				'id' => 'db_link',
				'type' => 'text',
				'title' => __('Dropbox link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'db_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'en_link',
				'type' => 'text',
				'title' => __('Evernote link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'en_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'fb_link',
				'type' => 'text',
				'title' => __('Facebook link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'http://facebook.com'
			),
//						array(
//							'id' => 'fb_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '1'// 1 = on | 0 = off
//						),
			array(
				'id' => 'flk_link',
				'type' => 'text',
				'title' => __('Flickr link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'flk_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'fs_link',
				'type' => 'text',
				'title' => __('Foursquare link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'fs_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'gp_link',
				'type' => 'text',
				'title' => __('Google + link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'gp_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'in_link',
				'type' => 'text',
				'title' => __('Instagram link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'in_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'lf_link',
				'type' => 'text',
				'title' => __('Last FM link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'lf_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'li_link',
				'type' => 'text',
				'title' => __('LinkedIN link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'http://linkedin.com'
			),
//						array(
//							'id' => 'li_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '1'// 1 = on | 0 = off
//						),
			array(
				'id' => 'lj_link',
				'type' => 'text',
				'title' => __('Livejournal link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'lj_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'pi_link',
				'type' => 'text',
				'title' => __('Picasa link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'pi_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'pt_link',
				'type' => 'text',
				'title' => __('Pinterest link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'pt_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'rss_link',
				'type' => 'text',
				'title' => __('RSS', 'dfd'),
				'desc' => __('Paste alternative link to Rss', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'rss_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'tu_link',
				'type' => 'text',
				'title' => __('Tumblr link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'tu_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'tw_link',
				'type' => 'text',
				'title' => __('Twitter link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'http://twitter.com'
			),
//						array(
//							'id' => 'tw_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '1'// 1 = on | 0 = off
//						),
			array(
				'id' => 'vi_link',
				'type' => 'text',
				'title' => __('Vimeo link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'vi_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			/*array(
				'id' => 'vk_link',
				'type' => 'text',
				'title' => __('Vkontakte link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => 'http://vk.com'
			),
			array(
				'id' => 'vk_show',
				'type' => 'checkbox',
				'title' => __('Show in header', 'dfd'),
				'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
				'default' => '0'// 1 = on | 0 = off
			),*/
			array(
				'id' => 'wp_link',
				'type' => 'text',
				'title' => __('Wordpress link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'wp_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
			array(
				'id' => 'yt_link',
				'type' => 'text',
				'title' => __('YouTube link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
			array(
				'id' => '500px',
				'type' => 'text',
				'title' => __('500px link', 'dfd'),
				'desc' => __('Paste link to your account', 'dfd'),
				'default' => ''
			),
//						array(
//							'id' => 'yt_show',
//							'type' => 'checkbox',
//							'title' => __('Show in header', 'dfd'),
//							'sub_desc' => __('If checked - will be display in header of theme ', 'dfd'),
//							'default' => '0'// 1 = on | 0 = off
//						),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Posts list options', 'dfd'),
		//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-thumbnail_list',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => __('<h3 class="description">Inner post page options</h3>', 'dfd')
			),
			array(
				'id' => 'post_share_button',
				'type' => 'button_set',
				'title' => __('Social share buttons', 'dfd'),
				'desc' => __('With this option you may activate or deactivate social share buttons. and date on inner post page', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'custom_share_code',
				'type' => 'textarea',
				'title' => __('Custom share code', 'dfd'),
				'desc' => __('You may add any other social share buttons to this field.', 'dfd'),
				'default' => ''
			),/*
			array(
				'id' => 'autor_box_disp',
				'type' => 'button_set',
				'title' => __('Author Info', 'dfd'),
				'desc' => __('This option enables you to insert information about the author of the post.', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1', // 1 = on | 0 = off
			),
			array(
				'id' => 'thumb_inner_disp',
				'type' => 'button_set', //the field type
				'title' => __('Thumbnail on inner page', 'dfd'),
				'desc' => __('Display featured image on single post', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0', //this should be the key as defined above
			),*/
			array(
				'id' => 'blog_items_disp',
				'type' => 'button_set', //the field type
				'title' => __('Display block under single blog item', 'dfd'),
				'sub_desc' => __('Block with recent news', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'//this should be the key as defined above
			),
			array(
				'id' => 'block_single_blog_item',
				'type' => 'textarea',
				'title' => __('Block shortcode', 'dfd'),
				'desc' => '',
				//'sub_desc' => __('', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => __('<h3 class="description">Archive page options</h3>', 'dfd')
			),
			array(
				'id' => 'thumb_image_crop',
				'type' => 'button_set',
				'title' => __('Crop thumbnails', 'dfd'),
				'desc' => __('Post thumbnails image crop', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1',
			),
			array(
				'id' => 'post_thumbnails_width',
				'type' => 'text',
				'title' => __('Post thumbnail width (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '900',
			),
			array(
				'id' => 'post_thumbnails_height',
				'type' => 'text',
				'title' => __('Post  thumbnail height (in px)', 'dfd'),
				'validate' => 'numeric',
				'default' => '600',
			),
			array(
				'id' => 'post_header',
				'type' => 'button_set',
				'title' => __('Post info', 'dfd'),
				'desc' => __('It is information about the post (time and date of creation, author, comments on the post).', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1', //this should be the key as defined above
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Portfolio Options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-briefcase',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			/*array(
				'id' => 'portfolio_page_select',
				'type' => 'pages_select',
				'title' => __('Portfolio page', 'dfd'),
				'desc' => __('Please select main portfolio page (for proper urls)', 'dfd'),
				'args' => array()//uses get_pages
			),*/
			array(
				'id' => 'portfolio_inner_description_title',
				'type' => 'text',
				'title' => __('Portfolio Inner Page Description Title', 'dfd'),
				'default' => 'Description'
			),
			array(
				'id' => 'folio_sorting',
				'type' => 'button_set', //the field type
				'title' => __('Panel for items sorting ', 'dfd'),
				'sub_desc' => __('Display panel for portfolio isotope items sorting by category', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'entry_meta_display',
				'type' => 'button_set', //the field type
				'title' => __('Display single item meta', 'dfd'),
				'sub_desc' => __('Author info, date, comments, tags', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'recent_items_disp',
				'type' => 'button_set', //the field type
				'title' => __('Display block under single item', 'dfd'),
				'sub_desc' => __('Block with recent items', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'//this should be the key as defined above
			),
			array(
				'id' => 'block_single_folio_item',
				'type' => 'textarea',
				'title' => __('Block shortcode', 'dfd'),
				'desc' => '',
				//'sub_desc' => __('', 'dfd'),
				'required' => array( 'recent_items_disp', "=", '1' ),
				'default' => ''
			),
			array(
				'id' => 'folio_hover_text_color',
				'type' => 'color',
				'title' => __('Portfolio hover text color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'folio_hover_bg',
				'type' => 'color',
				'title' => __('Portfolio hover background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'folio_hover_bg_opacity',
				'type' => 'slider',
				'title' => __('Portfolio hover background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '70',
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Woocomerce Options', 'dfd'),
		'icon' => 'crdash-credit_card',
		'fields' => array(
			array(
				'id' => 'shop_title',
				'type' => 'text',
				'title' => __('Shop Title', 'dfd'),
				'default' => 'Shop'
			),
			/*
			array(
				'id' => 'woocommerce_page_product_bottom',
				'type' => 'select',
				'data' => 'pages',
				'title' => __('Single product bottom', 'dfd'),
				'desc' => __('Please select page to display on product page bottom', 'dfd'),
			),
			array(
				'id' => 'woocommerce_single_image_crop',
				'type' => 'button_set', //the field type
				'title' => __('Crop single product main image', 'dfd'),
				'desc' => __('Main image in single product page will be cropped if this option is on', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '1'
			),
			*/
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Default Button Options', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-coverflow',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id'          => 'default_button_typography_option',
				'type'        => 'typography',
				'title'       => __( 'Default Button Typography', 'redux-framework-demo' ),
				//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
				'google'      => true,
				// Disable google fonts. Won't work if you haven't defined your google api key
				//'font-backup' => true,
				// Select a backup non-google font in addition to a google font
				'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets'       => false, // Only appears if google is true and subsets not set to false
				'font-size'     => true,
				'text-align'	=> false,
				'line-height'   => true,
				'word-spacing'  => false,  // Defaults to false
				'letter-spacing'=> true,  // Defaults to false
				'text-transform'=> true,
				'color'         => true,
				'preview'       => false, // Disable the previewer
				'all_styles'  => true,
				// Enable all Google Font style/weight variations to be added to the page
				//'output'      => array( 'h2.site-description, .entry-title' ),
				// An array of CSS selectors to apply this font style to dynamically
				//'compiler'    => array( 'h2.site-description-compiler' ),
				// An array of CSS selectors to apply this font style to dynamically
				'units'       => 'px',
				// Defaults to px
				'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
				'default'     => array(
					'font-style'  => 'normal',
					'font-weight'  => '',
					'font-family' => 'texgyreadventorregular',
					'google'      => true,
					'font-size'   => '12px',
					'line-height' => '45px',
					'text-transform'=> 'uppercase',
					//'word-spacing'  => '0px',
					'letter-spacing'=> '2px',
					'color'	=> '#ffffff',
				),
			),
			array(
				'id' => 'default_button_hover_color',
				'type' => 'color',
				'title' => __('Default button hover text color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_background',
				'type' => 'color',
				'title' => __('Default button background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_background_opacity',
				'type' => 'slider',
				'title' => __('Default button background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'default_button_hover_bg',
				'type' => 'color',
				'title' => __('Default button hover background color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_hover_bg_opacity',
				'type' => 'slider',
				'title' => __('Default button hover background opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'default_button_border',
				'type' => 'color',
				'title' => __('Default button border color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_border_opacity',
				'type' => 'slider',
				'title' => __('Default button border opacity', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id' => 'default_button_hover_border',
				'type' => 'color',
				'title' => __('Default button border color on hover', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'default_button_hover_border_opacity',
				'type' => 'slider',
				'title' => __('Default button border opacity on hover', 'dfd'),
				'desc' => '',
				'min' => '1',
				'max' => '100',
				'step' => '1',
				'default' => '100',
			),
			array(
				'id'       => 'default_button_border_width',
				'type'     => 'text',
				'title'    => __( 'Default button border width', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => '0',
			),
			array(
				'id' => 'default_button_border_style',
				'type' => 'select',
				'title' => __('Default button border style', 'dfd'),
				'options' => array(
					'solid' => __('Solid', 'dfd'),
					'dashed' => __('Dashed', 'dfd'),
					'dotted' => __('Dotted', 'dfd'),
				),
				'default' => 'solid',
			),
			array(
				'id'       => 'default_button_border_radius',
				'type'     => 'text',
				'title'    => __( 'Default button border radius', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 0,
			),
			array(
				'id'       => 'default_button_padding_left',
				'type'     => 'text',
				'title'    => __( 'Default button left padding', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 80,
			),
			array(
				'id'       => 'default_button_padding_right',
				'type'     => 'text',
				'title'    => __( 'Default button right padding', 'dfd' ),
				'desc'     => '',
				'validate' => 'numeric',
				'default'  => 40,
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Styling Options', 'dfd'),
		//'desc' => __('<p class="description">Style parameters of body and footer</p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-paintbrush',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_msc',
				'type' => 'info',
				'desc' => __('<h3 class="description">Main site colors setup</h3>', 'dfd')
			),
			array(
				'id' => 'main_site_color',
				'type' => 'color',
				'title' => __('Main site color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'secondary_site_color',
				'type' => 'color',
				'title' => __('Second site color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'third_site_color',
				'type' => 'color',
				'title' => __('Third site color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			/*array(
				'id' => 'fourth_site_color',
				'type' => 'color',
				'title' => __('Fourth site color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),*/
			array(
				'id' => 'title_color',
				'type' => 'color',
				'title' => __('Default title color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'subtitle_color',
				'type' => 'color',
				'title' => __('Default subtitle color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'border_color',
				'type' => 'color',
				'title' => __('Border color', 'dfd'),
				'desc' => '',
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'info_sth',
				'type' => 'info',
				'desc' => __('<h3 class="description">Body styling options</h3>', 'dfd'),
			),
			array(
				'id' => 'site_boxed',
				'type' => 'button_set',
				'title' => __('Boxed Body Layout', 'dfd'),
				'options' => array('1' => __('On','dfd'), '0' => __('Off','dfd')),
				'default' => '0',
			),
			//Body wrapper
			array(
				'id' => 'wrapper_bg_color',
				'type' => 'color',
				'title' => __('Content background color', 'dfd'),
				'desc' => __('Select background color.', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'wrapper_bg_image',
				'type' => 'media',
				'title' => __('Content background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'wrapper_custom_repeat',
				'type' => 'select',
				'title' => __('Content bg image repeat', 'dfd'),
				'desc' => __('Select type background image repeat', 'dfd'),
				'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
				'default' => 'repeat'
			),
			array(
				'id' => 'info_bxd',
				'type' => 'info',
				'desc' => __('<h3 class="description">Boxed site options</h3>', 'dfd')
			),
			array(
				'id' => 'body_bg_color',
				'type' => 'color',
				'title' => __('Body background color', 'dfd'),
				'desc' => __('Select background color.', 'dfd'),
				'default' => ''
			),
			array(
				'id' => 'body_bg_image',
				'type' => 'media',
				'title' => __('Custom background image', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'body_custom_repeat',
				'type' => 'select',
				'title' => __('Background image repeat', 'dfd'),
				'desc' => __('Select type background image repeat', 'dfd'),
				'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
				'default' => ''
			),
			array(
				'id' => 'body_bg_fixed',
				'type' => 'button_set',
				'title' => __('Fixed body background', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'// 1 = on | 0 = off
			),
		),
    ) );
	
	$_title_typography_fields = array();

	$_default_font_family = array(
		1 => 'texgyreadventorregular',//h1 title
		2 => 'texgyreadventorregular',//h2 title
		3 => 'texgyreadventorregular',//h3 title
		4 => 'texgyreadventorregular',//h4 title
		5 => 'texgyreadventorregular',//h5 title
		6 => 'texgyreadventorregular',//h6 title
		7 => 'Droid Serif',//h1 subtitle
		8 => 'Droid Serif',//h2 subtitle
		9 => 'Droid Serif',//h3 subtitle
		10 => 'Droid Serif',//h4 subtitle
		11 => 'Droid Serif',//h5 subtitle
		12 => 'Droid Serif',//h6 subtitle
		13 => 'texgyreadventorregular',//standard blog title
		14 => 'texgyreadventorregular',//widget title
		15 => 'texgyreadventorregular',//block title
		16 => 'texgyreadventorregular',//feature title
		17 => 'texgyreadventorregular',//box name
		18 => 'Droid Serif',//subtitle
		19 => 'Raleway',//text
		20 => 'Droid Serif',//entry-meta
	);
	$_default_font_size = array(
		1 => '55px',//h1 title
		2 => '45px',//h2 title
		3 => '35px',//h3 title
		4 => '30px',//h4 title
		5 => '22px',//h5 title
		6 => '18px',//h6 title
		7 => '18px',//h1 subtitle
		8 => '16px',//h2 subtitle
		9 => '14px',//h3 subtitle
		10 => '13px',//h4 subtitle
		11 => '13px',//h5 subtitle
		12 => '12px',//h6 subtitle
		13 => '18px',//standard blog title
		14 => '13px',//widget title
		15 => '15px',//block title
		16 => '15px',//feature title
		17 => '14px',//box name
		18 => '13px',//subtitle
		19 => '14px',//text
		20 => '13px',//entry-meta
	);
	$_default_line_height_increment = array(
		1 => 1.63,//h1 title
		2 => 1.866,//h2 title
		3 => 1.54,//h3 title
		4 => 2,//h4 title
		5 => 2.05,//h5 title
		6 => 1.2,//h6 title
		7 => 2,//h1 subtitle
		8 => 1.875,//h2 subtitle
		9 => 1.43,//h3 subtitle
		10 => 1.38,//h4 subtitle
		11 => 1.38,//h5 subtitle
		12 => 1.25,//h6 subtitle
		13 => 1.6,//standard blog title
		14 => 1.6,//widget title
		15 => 1.92,//block title
		16 => 1.71,//feature title
		17 => 1.37,//box name
		18 => 1.72,//subtitle
		19 => 1.785,//text
		20 => 1.6,//entry-meta
	);
	$_default_font_weight = array(
		1 => '600',//h1 title
		2 => '600',//h2 title
		3 => '600',//h3 title
		4 => '600',//h4 title
		5 => '600',//h5 title
		6 => '600',//h6 title
		7 => '400',//h1 subtitle
		8 => '400',//h2 subtitle
		9 => '400',//h3 subtitle
		10 => '400',//h4 subtitle
		11 => '400',//h5 subtitle
		12 => '400',//h6 subtitle
		13 => '600',//standard blog title
		14 => '600',//widget title
		15 => '600',//block title
		16 => '600',//feature title
		17 => '600',//box name
		18 => '400',//subtitle
		19 => '400',//text
		20 => '300',//entry-meta
	);
	$_default_font_style = array(
		1 => 'normal',//h1 title
		2 => 'normal',//h2 title
		3 => 'normal',//h3 title
		4 => 'normal',//h4 title
		5 => 'normal',//h5 title
		6 => 'normal',//h6 title
		7 => 'italic',//h1 subtitle
		8 => 'italic',//h2 subtitle
		9 => 'italic',//h3 subtitle
		10 => 'italic',//h4 subtitle
		11 => 'italic',//h5 subtitle
		12 => 'italic',//h6 subtitle
		13 => 'normal',//standard blog title
		14 => 'normal',//widget title
		15 => 'normal',//block title
		16 => 'normal',//feature title
		17 => 'normal',//box name
		18 => 'italic',//subtitle
		19 => 'normal',//text
		20 => 'italic',//entry-meta
	);
	$_default_text_transform = array(
		1 => 'none',//h1 title
		2 => 'none',//h2 title
		3 => 'none',//h3 title
		4 => 'none',//h4 title
		5 => 'uppercase',//h5 title
		6 => 'none',//h6 title
		7 => 'none',//h1 subtitle
		8 => 'none',//h2 subtitle
		9 => 'none',//h3 subtitle
		10 => 'none',//h4 subtitle
		11 => 'none',//h5 subtitle
		12 => 'none',//h6 subtitle
		13 => 'none',//standard blog title
		14 => 'uppercase',//widget title
		15 => 'none',//block title
		16 => 'none',//feature title
		17 => 'none',//box name
		18 => 'none',//subtitle
		19 => 'none',//text
		20 => 'none',//entry-meta
	);
	$_default_word_spacing = array(
		1 => '0px',//h1 title
		2 => '0px',//h2 title
		3 => '0px',//h3 title
		4 => '0px',//h4 title
		5 => '0px',//h5 title
		6 => '0px',//h6 title
		7 => '0px',//h1 subtitle
		8 => '0px',//h2 subtitle
		9 => '0px',//h3 subtitle
		10 => '0px',//h4 subtitle
		11 => '0px',//h5 subtitle
		12 => '0px',//h6 subtitle
		13 => '0px',//standard blog title
		14 => '0px',//widget title
		15 => '0px',//block title
		16 => '0px',//feature title
		17 => '0px',//box name
		18 => '0px',//subtitle
		19 => '0px',//text
		20 => '0px',//entry-meta
	);
	$_default_letter_spacing = array(
		1 => '0px',//h1 title
		2 => '4px',//h2 title
		3 => '5px',//h3 title
		4 => '5px',//h4 title
		5 => '5px',//h5 title
		6 => '4px',//h6 title
		7 => '0px',//h1 subtitle
		8 => '0px',//h2 subtitle
		9 => '0px',//h3 subtitle
		10 => '0px',//h4 subtitle
		11 => '0px',//h5 subtitle
		12 => '0px',//h6 subtitle
		13 => '0px',//standard blog title
		14 => '4px',//widget title
		15 => '0px',//block title
		16 => '0px',//feature title
		17 => '0px',//box name
		18 => '0px',//subtitle
		19 => '0px',//text
		20 => '0px',//entry-meta
	);
	$_default_option_name = array(
		1 => 'title_h1',//h1 title
		2 => 'title_h2',//h2 title
		3 => 'title_h3',//h3 title
		4 => 'title_h4',//h4 title
		5 => 'title_h5',//h5 title
		6 => 'title_h6',//h6 title
		7 => 'subtitle_h1',//h1 subtitle
		8 => 'subtitle_h2',//h2 subtitle
		9 => 'subtitle_h3',//h3 subtitle
		10 => 'subtitle_h4',//h4 subtitle
		11 => 'subtitle_h5',//h5 subtitle
		12 => 'subtitle_h6',//h6 subtitle
		13 => 'blog_title',//standard blog title
		14 => 'widget_title',//widget title
		15 => 'block_title',//block title
		16 => 'feature_title',//feature title
		17 => 'box_name',//box name
		18 => 'subtitle',//subtitle
		19 => 'text',//text
		20 => 'entry_meta',//entry-meta
	);
	$_default_color = array(
		1 => '',//h1 title
		2 => '',//h2 title
		3 => '',//h3 title
		4 => '',//h4 title
		5 => '',//h5 title
		6 => '',//h6 title
		7 => '',//h1 subtitle
		8 => '',//h2 subtitle
		9 => '',//h3 subtitle
		10 => '',//h4 subtitle
		11 => '',//h5 subtitle
		12 => '',//h6 subtitle
		13 => '',//standard blog title
		14 => '',//widget title
		15 => '',//block title
		16 => '',//feature title
		17 => '',//box name
		18 => '',//subtitle
		19 => '',//text
		20 => '',//entry-meta
	);
	$_default_option_title = array(
		1 => 'H1 Title',//h1 title
		2 => 'H2 Title',//h2 title
		3 => 'H3 Title',//h3 title
		4 => 'H4 Title',//h4 title
		5 => 'H5 Title',//h5 title
		6 => 'H6 Title',//h6 title
		7 => 'H1 Subtitle',//h1 subtitle
		8 => 'H2 Subtitle',//h2 subtitle
		9 => 'H3 Subtitle',//h3 subtitle
		10 => 'H4 Subtitle',//h4 subtitle
		11 => 'H5 Subtitle',//h5 subtitle
		12 => 'H6 Subtitle',//h6 subtitle
		13 => 'Blog heading',//standard blog title
		14 => 'Widget title',//widget title
		15 => 'Block Title',//block title
		16 => 'Features Title',//feature title
		17 => 'Box Name',//box name
		18 => 'Subtitle',//subtitle
		19 => 'Text',//text
		20 => 'Entry meta',//entry-meta
	);
	for ($i=1; $i<=20; $i++) {
		$_title_typography_fields[] = array(
			'id'          => $_default_option_name[$i].'_typography_option',
			'type'        => 'typography',
			'title'       => __( $_default_option_title[$i].' Typography', 'redux-framework-demo' ),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'      => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets'       => false, // Only appears if google is true and subsets not set to false
			'font-size'     => true,
			'text-align'	=> false,
			'line-height'   => true,
			'word-spacing'  => true,  // Defaults to false
			'letter-spacing'=> true,  // Defaults to false
			'text-transform'=> true,
			'color'         => true,
			'preview'       => false, // Disable the previewer
			'all_styles'  => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units'       => 'px',
			// Defaults to px
			'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
			'default'     => array(
				'font-style'  => $_default_font_style[$i],
				'font-weight'  => $_default_font_weight[$i],
				'font-family' => $_default_font_family[$i],
				'google'      => true,
				'font-size'   => $_default_font_size[$i],
				'line-height' => $_default_font_size[$i] * $_default_line_height_increment[$i].'px',
				'text-transform'=> $_default_text_transform[$i],
				'word-spacing'  => $_default_word_spacing[$i],
				'letter-spacing'=> $_default_letter_spacing[$i],
				'color'	=> $_default_color[$i],
			),
		);
	}
	
    Redux::setSection( $opt_name, array(
        'title' => __('Custom typography', 'dfd'),
//		'desc' => __('<p class="description"></p>', 'dfd'),
		'icon' => 'crdash-keyboard',
		'fields' => $_title_typography_fields,
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Layouts Settings', 'dfd'),
		//'desc' => __('<p class="description">Configure layouts of different pages</p>', 'dfd'),
		'icon' => 'crdash-web_layout',
		'fields' => array(
			array(
				'id' => 'lazy_load_pagination_image',
				'type' => 'media',
				'url'      => true,
				'title' => __('Lazy Load Pagination image', 'dfd'),
				'desc' => '',
				'default' => array(
						'url' => get_template_directory_uri() . '/assets/img/lazy_load.gif'
					),
			),
			array(
				'id' => 'pages_layout',
				'type' => 'image_select',
				'title' => __('Single pages layout', 'dfd'),
				'sub_desc' => __('Select one type of layout for single pages', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '1col-fixed'
			),
			array(
				'id' => 'pages_head_type',
				'type' => 'select',
				'title' => __('Single pages header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => 'archive_layout',
				'type' => 'image_select',
				'title' => __('Archive Pages Layout', 'dfd'),
				'sub_desc' => __('Select one type of layout for archive pages', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '2c-r-fixed'
			),
			array(
				'id' => 'archive_head_type',
				'type' => 'select',
				'title' => __('Archive Pages header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => 'single_layout',
				'type' => 'image_select',
				'title' => __('Single posts layout', 'dfd'),
				'sub_desc' => __('Select one type of layout for single posts', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '2c-r-fixed'
			),
			array(
				'id' => 'single_head_type',
				'type' => 'select',
				'title' => __('Single posts header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => 'search_layout',
				'type' => 'image_select',
				'title' => __('Search results layout', 'dfd'),
				'sub_desc' => __('Select one type of layout for search results', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '1col-fixed'
			),
			array(
				'id' => 'search_head_type',
				'type' => 'select',
				'title' => __('Search results header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => '404_layout',
				'type' => 'image_select',
				'title' => __('404 Page Layout', 'dfd'),
				'sub_desc' => __('Select one of layouts for 404 page', 'dfd'),
				'options' => dfd_page_layouts(),
				'default' => '1col-fixed'
			),
			array(
				'id' => '404_head_type',
				'type' => 'select',
				'title' => __('404 Page header', 'dfd'),
				'options' => dfd_headers_type(),
				'default' => '1',
			),
			array(
				'id' => 'layout_whitespace_size',
				'type' => 'slider',
				'title' => __('Layout whitespace size', 'dfd'),
				'desc' => '',
				'min' => '0',
				'max' => '50',
				'step' => '1',
				'default' => '30',
			),
			array(
				'id' => 'layout_whitespace_color',
				'type' => 'color',
				'title' => __('Layout whitespace color', 'dfd'),
				'default' => '#ffffff'
			),
		),
    ) );
	
    Redux::setSection( $opt_name, array(
        'title' => __('Twitter section options', 'dfd'),
		//'desc' => __('<p class="description">More information about api keys and how to get it you can find in that tutorial <a href="http://dfd.name/twitter-settings">http://dfd.name/twitter-settings/</a></p>', 'dfd'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => 'crdash-share',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			/*
			array(
				'id' => 't_panel_padding',
				'type' => 'button_set',
				'title' => __('Section padding', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'// 1 = on | 0 = off
			),
			array(
				'id' => 't_panel_bg_color',
				'type' => 'color',
				'title' => __('Background color for twitter panel', 'dfd'),
				'default' => '#f7f7f7'
			),
			array(
				'id' => 't_panel_bg_image',
				'type' => 'media',
				'title' => __('Background image for twitter panel', 'dfd'),
				'desc' => __('Upload your own background image or pattern.', 'dfd'),
				'default' => array(
					'url' => ''
				)
			),
			array(
				'id' => 'footer_tw_disp',
				'type' => 'button_set',
				'title' => __('Display twitter statuses before footer', 'dfd'),
				'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
				'default' => '0'// 1 = on | 0 = off
			),
			*/
			array(
				'id' => 'cachetime',
				'type' => 'text',
				'title' => __('Cache Tweets in every:', 'dfd'),
				'sub_desc' => __('In minutes', 'dfd'),
				'default' => '1'
			),
			array(
				'id' => 'numb_lat_tw',
				'type' => 'text',
				'title' => __('Number of latest tweets display:', 'dfd'),
				'default' => '10'
			),
			array(
				'id' => 'username',
				'type' => 'text',
				'title' => __('Username:', 'dfd'),
				'default' => 'Envato'
			),
			array(
				'id' => 'twiiter_consumer',
				'type' => 'text',
				'title' => __('Consumer key:', 'dfd'),
				'default' => '',
			),
			array(
				'id' => 'twiiter_con_s',
				'type' => 'text',
				'title' => __('Consumer secret:', 'dfd'),
				'default' => '',
			),
			array(
				'id' => 'twiiter_acc_t',
				'type' => 'text',
				'title' => __('Access token:', 'dfd'),
				'default' => '',
			),
			array(
				'id' => 'twiiter_acc_t_s',
				'type' => 'text',
				'title' => __('Access token secret:', 'dfd'),
				'default' => '',
			),
		),
    ) );
	
    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
