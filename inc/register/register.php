<?php
/**
 * Theme Register Handler Class
 * 
 */

class Theme_Register {

	private static $instance = false;

	public function __construct(){
		add_action( 'admin_menu', array( $this, 'tp_register_theme') );
		add_action( 'admin_enqueue_scripts', array( $this, 'theme_register_scripts' ) );
		add_action( 'admin_notices', array( $this, 'tp_notice_for_activation' ) );
		add_action( 'after_switch_theme', array( $this, 'tp_activate_theme_action' ) );
		add_action( 'theme_activation', array( $this, 'tp_protect_activation' ) );
		add_action(	'admin_footer', array($this, 'tp_prevent_modal'));
		add_action( 'wp_ajax_deactivate_theme', array( $this, 'tp_deactivate_theme' ) );
		add_action( 'wp_ajax_activate_theme', array( $this, 'tp_activate_theme' ) );
		add_action( 'admin_init', array( $this, 'tp_deactivate_core_plugin' ) );

		$tp_tgmpa_prefix = ( defined( 'WP_NETWORK_ADMIN' ) && WP_NETWORK_ADMIN ) ? 'network_admin_' : '';
		add_filter( 'tgmpa_' . $tp_tgmpa_prefix . 'plugin_action_links', array( $this, 'tp_tgmpa_filter_action_links'), 10, 4 );
		add_filter( 'tgmpa_table_data_item', array( $this, 'tp_tgmpa_table_data' ), 10, 2);
		add_filter( 'tgmpa_table_columns', array( $this, 'tp_tgmpa_table_columns' ));
	}


	// activate theme
	public function tp_activate_theme(){
		check_ajax_referer('activate_theme', 'security');

		$item_id = isset($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : '';
		$code = isset($_POST['code']) ? sanitize_text_field($_POST['code']) : '';
		update_option( 'tp_envato_purchase_code', $code );
        update_option( 'tp_envato_purchase_item_id', $item_id );

		wp_send_json(array('success' => true), 200);
	}

	public function tp_deactivate_theme(){
		check_ajax_referer('deactivate_theme', 'security');
		update_option( 'tp_envato_purchase_code', '' );
        update_option( 'tp_envato_purchase_item_id', '' );

		wp_send_json(array('success' => true), 200);
	}

	public function theme_register_scripts(){
		wp_enqueue_style('theme-register', get_parent_theme_file_uri().'/inc/register/css/theme-register.css', null, '1.0.0', 'all');
		if(!self::tp_is_theme_registered()){
			$theme_object = wp_get_theme();
			$theme = $theme_object->get('Name');
			$version = $theme_object->get('Version');
			$author = $theme_object->get('Author');
			
			$reg_url = "https://api.themepure.net/wp-json/tp-api/v1/test-code";
			$theme_reg_data = array(
    		    'url'   => $reg_url,
    		    'theme'  => $theme,
    		    'version'	=> $version,
    		    'author'    => $author,
    		    'domain'    => $_SERVER['HTTP_HOST'],
				'nonce'		=> wp_create_nonce('activate_theme'),
				'ajax_url'	=> admin_url('admin-ajax.php'),
    		    'admin_url' => admin_url('themes.php?page=register-theme')
    		);
			
			wp_enqueue_script('theme-register', get_parent_theme_file_uri(). '/inc/register/js/theme-register.js', array('jquery'), '1.0.0', true);
			wp_localize_script('theme-register', 'theme_reg_data', $theme_reg_data);
		}else{
		    $license_code = get_option('tp_envato_purchase_code');
    		$deactivate_url = "https://api.themepure.net/wp-json/tp-api/v1/deactivate";
    		
    		$theme_data = array(
    		    'url'   => $deactivate_url,
    		    'code'  => $license_code,
    		    'domain'	=> $_SERVER['HTTP_HOST'],
				'ajax_url'	=> admin_url('admin-ajax.php'),
				'nonce'		=> wp_create_nonce('deactivate_theme'),
    		    'admin_url' => admin_url('themes.php?page=register-theme')
    		);
    		
    		wp_enqueue_script('theme-deregister', get_parent_theme_file_uri(). '/inc/register/js/theme-deregister.js', array('jquery'), '1.0.0', true);
    		wp_localize_script('theme-deregister', 'theme_data', $theme_data);
		}
		
		
	}

	public function tp_register_theme() {
		add_submenu_page( 'themes.php', 'Register Theme', 'Register Theme', 'manage_options', 'register-theme', array( $this, 'tp_register_theme_options' ) );
	}

	public function tp_register_theme_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
	
		if(empty(self::tp_get_registered_purchase_code()) || isset($_GET['success'], $_GET['deactivate']) && !isset($_GET['item_id'], $_GET['code']) && $_GET['deactivate'] == true):
		?>
		<?php if(!isset($_GET['code'], $_GET['item_id'])) : ?>
		<form id="purchase_code_form" class="notice notice-info">
			<div class="theme-register-wrapper">
				<div class="theme-register-left">
					<div class="theme-register-header">
						<h2 class="hndle ui-sortable-handle"><?php esc_html_e('Register Theme','tp-api'); ?></h2>
					</div>
					<p class="theme-register-msg"><?php esc_html_e('You\'re almost done. Just one more step. In order to gain full access to all demos, premium plugins and support, please register your theme\'s purchase code.','tp-api'); ?></p>
	
					<div class="theme-register-warnings">
						<h4 class="theme-register-warnings-heading">
							<svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M7.69066 1.73723L1.20522 12.5642C1.07151 12.7957 1.00075 13.0583 1.00001 13.3257C0.999257 13.5931 1.06854 13.856 1.20095 14.0883C1.33337 14.3206 1.52431 14.5142 1.75477 14.6498C1.98523 14.7854 2.24718 14.8583 2.51456 14.8612H15.4854C15.7528 14.8583 16.0148 14.7854 16.2452 14.6498C16.4757 14.5142 16.6666 14.3206 16.799 14.0883C16.9315 13.856 17.0007 13.5931 17 13.3257C16.9992 13.0583 16.9285 12.7957 16.7948 12.5642L10.3093 1.73723C10.1728 1.5122 9.98064 1.32614 9.7513 1.19702C9.52195 1.0679 9.2632 1.00006 9 1.00006C8.7368 1.00006 8.47805 1.0679 8.2487 1.19702C8.01936 1.32614 7.82716 1.5122 7.69066 1.73723V1.73723Z" stroke="#FF8E0E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M9 5.67291V8.73569" stroke="#FF8E0E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M9 11.7985H9.00766" stroke="#FF8E0E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
							Please Read Carefully
						</h4>
						<ul>
							<li>You can active only one theme using your license key.</li>
							<li>You need to deactive license before active it on another domain.</li>
							<li>If you active theme on a <b>local server</b>, you need to deactivate the license there also.</li>
							<li>Facing issues? Drop a message to our support center <a href="https://help.themepure.net/login" target="_blank">Themepure Support</a></li>
						</ul>
					</div>
	
					<div class="theme-register-input-form">
						<div class="theme-register-input-label">
							<label for="purchase_code"><?php esc_html_e('Enter your purchase code','tp-api'); ?></label>
							<a class="theme-register-where-code" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank"><?php esc_html_e('Where to find the code?','tp-api'); ?></a>
						</div>
						<div class="theme-register-input-field">
							<input class="regular-text code" type="text" name="purchase_code" id="purchase_code" value="">
							<div id="theme-register-input-error"></div>
						</div>

						<div class="theme-register-input-agree">
							<input type="checkbox" id="confirm_activation" name="confirm_activation">
							<label for="confirm_activation">
								<?php esc_html_e('I confirm that, according to the Envato
								License Terms, I am licensed to use the purchase code for a single project. Using it on multiple
								installations is a copyright violation.','tp-api'); ?>
								<a href="https://themeforest.net/licenses/terms/regular" target="_blank"><?php esc_html_e('License details.','tp-api'); ?></a>
							</label>
						</div>

						<button class="pure-welcome-btn" id="register" name="register_theme"><?php esc_html_e('Register Theme','tp-api'); ?></button>
						
					</div>
	
					<div id="error"></div>
				</div>
				<div class="theme-register-right">
					<div class="theme-register-thumb">
						<img src="<?php echo get_template_directory_uri(); ?>/inc/register/man.png" alt="">
					</div>
				</div>
			</div>
		</form>
		<?php endif; ?>
		
		<?php else: 
		    if(!isset($_GET['success']) && !isset($_GET['deactivate'])):
		?>
		
		<div class="pure-welcome-panel">
			<div class="pure-welcome-panel-content">
				<div class="pure-welcome-panel-header" >
					<div class="pure-welcome-panel-header-image" style="background: url('<?php echo get_template_directory_uri(); ?>/inc/register/background.jpg');"></div>
					<h2>Welcome to <?php echo wp_get_theme()->Name; ?></h2>
					<p>Version <?php echo wp_get_theme()->Version; ?></p>
				</div>
				<div class="pure-welcome-panel-container">

					<div class="pure-welcome-services-wrapper">
						<a href="https://themeforest.net/user/theme_pure" rel="nofollow" target="_blank">
							<img src="https://html.aqlova.com/desc/01_en_follow.png">
						</a>
						<a href="https://wp.aqlova.com/agntix/docs/" rel="nofollow" target="_blank">
							<img src="https://html.aqlova.com/desc/03_en_docs.png">
						</a>

						<a href="https://www.youtube.com/watch?v=O3F5p8b82Ek&list=PLpB6tlkQRw6cNG1xbYAejnCfGTiKhN7-h" rel="nofollow" target="_blank">
							<img src="https://html.aqlova.com/desc/02_en_video.png">
						</a>

						<a href="https://help.themepure.net/" rel="nofollow" target="_blank">
							<img src="https://html.aqlova.com/desc/04_en_support.png">
						</a>
					</div>
					<button class="pure-deactive-btn pure-welcome-btn" id="deactivate"><?php esc_html_e('Deactivate License Key', 'tp-api'); ?></button>
				</div>
			</div>
			
		</div>
		
		<?php endif; endif;
	}
	
	/**
	 * Validate the code
	 * 
	 */
	 public static function is_purchase_code_exists($code){
		if(preg_match("/^(themepure)-(([dmy0-9]{4})-){3}([a-e0-9]{12})$/i", $code)){
			return true;
		}else{
			$url = "https://api.themepure.net/wp-json/wp/v2/purchase/?meta_key=purchase_code&meta_value={$code}&_fields=acf";
			$response = wp_remote_get($url);
			if(!is_wp_error($response)){
				$data = json_decode( wp_remote_retrieve_body( $response ), true);
				if( !empty($data) ){
					$metas =  $data[0]['acf'];
					if( $metas['purchase_code'] == $code && $metas['client_domain'] == $_SERVER['HTTP_HOST'] ){
						return true;
					}
				}
			}
		}
		
		return false;
	 }
	/**
	 * Get theme purchase code
	 */
	public static function tp_get_registered_purchase_code() {
		return get_option( 'tp_envato_purchase_code' );
	}

	/**
	 * Check if the theme already registered
	 */
	public static function tp_is_theme_registered() {
		$purchase_code =  self::tp_get_registered_purchase_code();
		$registered_by_purchase_code =  ! empty( $purchase_code );

		// Purchase code entered correctly.
		if ( !$registered_by_purchase_code ) {
			return false;
		}

		return true;
	}

	/**
	 * Filter TGMPA action links.
	 */

	public function tp_tgmpa_filter_action_links( $action_links, $item_slug, $item, $view_context ) {
		$source = !empty( $item['source'] ) ? $item['source'] : '';

		// Prevent installing theme's premium plugins.
		if ( 'External Source' === $source && !self::tp_is_theme_registered() ) {
			$item['plugin'] = '';
			$item['plugin']	= $item['sanitized_plugin'];
			$action_links = array(
				'tp_registration_required' => sprintf( __( '<a style="color: red;" href="%s">Register Theme To Unlock It</a>', 'tp-api' ), esc_url( admin_url( 'themes.php?page=register-theme' ) ) ),
			);
		}

		return $action_links;
	}

	/**
	 * TGMpa Table data
	 */
	public function tp_tgmpa_table_data($table_data, $plugin){
		if(!self::tp_is_theme_registered()){
			unset($table_data['plugin']);
			$table_data['plugin']	= $plugin['name'];
		}

		return $table_data;
	}

	/**
	 * Deactivate core plugin
	 */
	public function tp_deactivate_core_plugin(){
		if(!self::tp_is_theme_registered()){
			deactivate_plugins( 'agntix-core/agntix-core.php' );
		}
	}

	/**
	 * TGMPA table columns
	 */
	public function tp_tgmpa_table_columns( $columns ){
		return $columns;
	} 

	/**
	 * Admin Notice
	 */

	public function tp_notice_for_activation() {
		if(empty(self::tp_get_registered_purchase_code())){
			echo '<div class="notice notice-warning">
				<p>' . sprintf(
				esc_html__( 'Enter your Envato Purchase Code to receive Theme and plugin updates %s', 'tp-api' ),
				'<a href="' . admin_url('themes.php?page=register-theme') . '">' . esc_html__( 'Enter Purchase Code', 'tp-api' ) . '</a>') . '</p>
			</div>';
		}
	}

	/**
	 * While activating the theme
	 */
	public function tp_activate_theme_action(){
		wp_redirect( admin_url('themes.php?page=register-theme') );
	}

	/**
	 * If license deactive try not to run the theme
	 */

	public function tp_protect_activation(){
		if(empty(self::tp_get_registered_purchase_code())){
			wp_die('Your theme is not activate!');
		}
	}

	public function tp_prevent_modal(){
		?>
		<!-- The Modal -->
		<div id="register-modal" class="tp-modal">
	
			<!-- Modal content -->
			<div class="tp-modal-content">
				<span class="tp-modal-close">&times;</span>
				<p><?php esc_html_e('Please register theme with your evato purchase code to activate this plugin.', 'agntix-core'); ?> <a href="<?php echo esc_url( admin_url( 'themes.php?page=register-theme' ) ); ?>"><?php esc_html_e('Register Theme', 'agntix-core'); ?></a></p>
			</div>
	
		</div>
		<?php
	}

	/**
	 * Singleton
	 */
	public static function run(){
		if(!self::$instance){
			self::$instance = new self();
		}

		return self::$instance;
	}


}
Theme_Register::run();

