<?php
/**
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kirki_Customize_Control' ) ) {
	class Kirki_Customize_Control extends WP_Customize_Control {

		public $tooltip     = '';
		public $js_vars     = array();
		public $output      = array();
		public $option_type = 'theme_mod';

		public function to_json() {
			parent::to_json();

			if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			} else {
				$this->json['default'] = $this->setting->default;
			}
			$this->json['js_vars'] = $this->js_vars;
			$this->json['output']  = $this->output;
			$this->json['value']   = apply_filters( 'kirki/controls/get_value/' . $this->option_type, $this->value() );
			$this->json['choices'] = $this->choices;
			$this->json['link']    = $this->get_link();
			$this->json['tooltip'] = $this->tooltip;
			$this->json['id']      = $this->id;
			$this->json['i18n']    = Kirki_Toolkit::i18n();
		}

		public function enqueue() {
			Kirki_Styles_Customizer::enqueue_customizer_control_script( 'kirki-' . str_replace( 'kirki-', '', $this->type ), 'controls/' . str_replace( 'kirki-', '', $this->type ), array( 'jquery' ) );
		}

		public function render_content() {}

	}
}
