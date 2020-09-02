<?php
/*
Plugin Name: WP Prefix Change
Plugin URI: http://sousatg.github.io/wp_prefix_changer
Description: Change the Wordpress prefix
Version: 0.1.0
Author: Tiago Sousa
Author URI: http://sousatg.io/
Text Domain: prefix-changer
*/

/**
 * Prefix Changer Class
 */
class WPPrefixChanger {
	
	public $table_old_prefix;
	public $table_new_prefix;
	
	public function __construct(){
		
		add_action( 'admin_menu', array($this, 'admin_actions') );
		
	}
	
	/**
	 *	Creates the admin menu pages
	 */
	public function admin_actions(){
		add_options_page(
			__('Change Tables Prefix'),
			__('Change Tables Prefix'),
			'manage_options',
			'chpr_options',
			array( $this, 'chpr_options_form')
		);
	}
	
	/**
	 *	Table Prefix Changer Options Pages
	 */ 
	public function chpr_options_form(){
		global $table_prefix;
		?>
		<div class='wrap'>
			<h2><?php echo __('Change Tables Prefix Settings'); ?></h2>
			<p>Mare sure your <strong>wp-config.php</strong> file is writable</p>
			<p><strong><?php echo __('You current table prefix is:'); ?></strong> <?php echo $table_prefix; ?></p>
			
			
			<form id="option-form" method="post" name="change-prefix" action="">
				
				<input type='text' id='table_new_prefix' name='table_new_prefix'>
				
				<?php wp_nonce_field('change_table_prefix','name_of_nonce_field'); ?>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
		
		if( isset( $_POST['submit'] ) && wp_verify_nonce( $_POST['name_of_nonce_field'], 'change_table_prefix' ) ){
			$table_old_prefix = $table_prefix;
			$table_new_prefix = filter_input(INPUT_POST, 'table_new_prefix');
			
			$this->edit_wp_config( $table_new_prefix );
			$this->rename_table_names( $table_old_prefix, $table_new_prefix );
			
			$table_name = $table_new_prefix . 'options';
			$this->update_table_values($table_name, 'option_name', $table_old_prefix, $table_new_prefix);
			
			$table_name = $table_new_prefix . 'usermeta';
			$this->update_table_values($table_name, 'meta_key', $table_old_prefix, $table_new_prefix);
		}
	}
	
	/**
	*	Edit the wp-config.php file
	*	@param	String 	$table_new_prefix	The name of the new prefix
	*	@return	void
	*/
	private function edit_wp_config($table_new_prefix){
		$path = '../wp-config.php';
		$wp_config = file( $path );
		
		$key = array_keys($wp_config);
		$size = sizeOf($key);		
		for ($i=0; $i<$size; $i++){
			$line = $wp_config[$key[$i]];
			if( substr( $line, 0, 16 ) === '$table_prefix  =' ){
				$wp_config[$key[$i]] = "\$table_prefix  = '$table_new_prefix';\n";
			}
		}

		@chmod( $path, 0777 );
		
		if ( ! is_writeable( $path ) ) {
			echo '<p>Error changing prefix</p>';
			return void;
		}
		

		$handle = fopen( $path, 'w' );
		foreach ( $wp_config as $line ) {
			fwrite( $handle, $line );
		}
		fclose( $handle );
		
		@chmod( $path, 0644 );
		
		echo '<p class="success">' . __('wp-config.php file updated successfully.') . '</p>';
	}
	
	/**
	*	Rename all the table names
	*	@param	String	$table_old_prefix	The old prefix of the database table names
	*	@param	String	$table_new_prefix	The new database prefix name
	*	@return	void
	*/
	private function rename_table_names($table_old_prefix, $table_new_prefix){
		global $wpdb;
		
		$sql = "SHOW TABLES LIKE '%'";
		$results = $wpdb->get_results( $sql, ARRAY_N );
		$queries = array();
		foreach( $results as $result ){
			
			$table_old_name = $result[0];
			$table_new_name = $table_old_name;

			if ( strpos( $table_old_name, $table_old_prefix ) === 0 ){
				$table_new_name = $table_new_prefix . substr( $table_old_name, strlen( $table_old_prefix ) );
			}
			
			$sql = "RENAME TABLE $table_old_name TO $table_new_name";
			$queries[] = false === $wpdb->query( $sql );
		}
	}
	/**
	 *	Update a table column with the new prefix
	 *	@param	string	$table_name	the table that is going to be update
	 *	@param	string	$field	the table column that is going to be updated
	 *	@param	string	$table_old_prefix	The previous table prefix name
	 *	@param	string	$table_new_prefix	The new table prefix name
	 */
	private function update_table_values( $table_name, $field, $table_old_prefix, $table_new_prefix ){
		global $wpdb;
		
		$sql = "SELECT $field FROM $table_name WHERE $field LIKE '%$table_old_prefix%'";
		$results = $wpdb->get_results( $sql, ARRAY_N );

		
		foreach( $results as $result ){
			$old_value = $result[0];
			
			if( strpos(  $old_value, $table_old_prefix ) === 0 ){
				$new_value = $table_new_prefix . substr( $old_value, strlen( $table_old_prefix ) );
				$sql = "UPDATE $table_name SET $field='$new_value' WHERE $field='$old_value'";
				$wpdb->query( $sql );
			}
		}
	}
}

$prefixChanger = new WPPrefixChanger();