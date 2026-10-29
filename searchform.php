<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">
	<div class="row">
		<div class="input-field col s12">
			<input type="search" class="search-form" value="<?php echo get_search_query(); ?>" name="s" id="search-form-s" />
			<label for="search-form-s"><?php esc_html_e( 'Type and hit enter', 'jaiko' ); ?></label>
		</div>
	</div>
</form>
