<?php
/**
 * Function and hooks
 */

// Load all hooks
foreach ( [ 'functions', 'hooks' ] as $dir ) {
	foreach ( scandir( __DIR__.'/'.$dir ) as $file ) {
		if ( preg_match( '#^[^.].*\.php$#', $file ) ) {
			require __DIR__.'/'.$dir.'/'.$file;
		}
	}
}








