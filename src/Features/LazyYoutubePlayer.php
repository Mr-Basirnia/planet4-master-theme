<?php

namespace P4\MasterTheme\Features;

use P4\MasterTheme\Feature;

/**
 * @see description().
 */
class LazyYoutubePlayer extends Feature {

	/**
	 * @inheritDoc
	 */
	public static function id(): string {
		return 'lazy_youtube_player';
	}

	/**
	 * @inheritDoc
	 */
	protected static function name(): string {
		return __( 'Lazy YouTube player', 'planet4-master-theme-backend' );
	}

	/**
	 * @inheritDoc
	 */
	protected static function description(): string {
		return __(
			'Only load the YouTube player after clicking a video.',
			'planet4-master-theme-backend'
		);
	}

	/**
	 * @inheritDoc
	 */
	public static function show_toggle_production(): bool {
		return true;
	}
}