<?php

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Extended_Skin_Classic extends ElementorPro\Modules\Posts\Skins\Skin_Classic {
	public function get_id() {
		return 'extended-classic';
	}

	public function get_title() {
		return __( 'Classic Extended', 'elementor-pro' );
	}

	protected function register_meta_data_controls() {
		$this->add_control(
			'meta_data',
			[
				'label' => __( 'Meta Data', 'elementor-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT2,
				'default' => [ 'date', 'comments' ],
				'multiple' => true,
				'options' => [
					'author' => __( 'Author', 'elementor-pro' ),
					'category' => __( 'Category', 'elementor-pro' ),
					'date' => __( 'Date', 'elementor-pro' ),
					'time' => __( 'Time', 'elementor-pro' ),
					'comments' => __( 'Comments', 'elementor-pro' ),
					'modified' => __( 'Date Modified', 'elementor-pro' ),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'meta_separator',
			[
				'label' => __( 'Separator Between', 'elementor-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => '///',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta-data span + span:before' => 'content: "{{VALUE}}"',
				],
				'condition' => [
					$this->get_control_id( 'meta_data!' ) => [],
				],
			]
		);
	}

	protected function render_meta_data() {
		/** @var array $settings e.g. [ 'author', 'date', ... ] */
		$settings = $this->get_instance_value( 'meta_data' );
		if ( empty( $settings ) ) {
			return;
		}
		?>
<div class="elementor-post__meta-data">
  <?php
			if ( in_array( 'author', $settings ) ) {
				$this->render_author();
			}

			if ( in_array( 'category', $settings ) ) {
				$this->render_category();
			}

			if ( in_array( 'date', $settings ) ) {
				$this->render_date_by_type();
			}

			if ( in_array( 'time', $settings ) ) {
				$this->render_time();
			}

			if ( in_array( 'comments', $settings ) ) {
				$this->render_comments();
			}
			
			if ( in_array( 'modified', $settings ) ) {
				$this->render_date_by_type( 'modified' );
			}
			?>
</div>
<?php
	}

	protected function render_category() {
		?>
<span class="elementor-post-categories">
  <?php
	
		$categories = [];
		foreach(get_the_category() as $category):
				$categories[] = "<a href=". get_category_link( $category->term_id ) ." title='{$category->name}'>{$category->name}</a>"; 
		endforeach;

		echo implode(' • ', $categories);
	 ?>
</span>
<?php
	}

	public function get_container_class() {
		return 'elementor-has-item-ratio elementor-posts--skin-' . $this->get_id();
	}
}