<?php


?><!-- Begin MailChimp Signup Form -->
<section class="mail-chimp">

	<div class="container">
		<h2 class="mail-chimp-title">
			<?php esc_html_e( 'Join our News Letter', 'jaiko' ) ?>
			<small>
				<?php esc_html_e( 'We send you updates. Not often, no spam.', 'jaiko' ) ?>
			</small>
		</h2>

		<div id="mc_embed_signup">
			<form action="//gianism.us14.list-manage.com/subscribe/post?u=9b5777bb4451fb83373411d34&amp;id=1e82da4148&amp;SINGUP=Gianism"
			      method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
			      target="_blank" novalidate>
				<div id="mc_embed_signup_scroll">
					<div class="row">
						<div class="input-field col s8 l10">
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
							<label for="mce-EMAIL"><?php esc_html_e( 'Email Address', 'jaiko' ) ?></label>
						</div>
						<div class="col s4 l2">
							<input type="submit" value="<?php esc_attr_e( 'Subscribe', 'jaiko' ) ?>"
							       name="subscribe" id="mc-embedded-subscribe"
							       class="waves-effect waves-light btn-large btn-success">
						</div>
					</div>
					<p class="mail-chimp-notice"><?php _e( 'You can enter more detailed information like language. <a href="#mc-form-more" class="toggle-button">Click here</a>.', 'jaiko' ) ?></p>
					<div id="mc-form-more" class="hidden">
						<div class="row">
							<div class="input-field col s6">
								<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
								<label for="mce-FNAME"><?php esc_html_e( 'First Name', 'jaiko' ) ?> </label>
							</div>
							<div class="input-field col s6">
								<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
								<label for="mce-LNAME"><?php esc_html_e( 'Last Name', 'jaiko' ) ?> </label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input class="filled-in" type="checkbox" value="1"
								       name="group[1111][1]" id="mce-group[1111]-1111-0"<?php checked( 'ja' != get_locale() ) ?>>
								<label for="mce-group[1111]-1111-0">English</label>
							</div>
							<div class="input-field col s6">
								<input class="filled-in" type="checkbox" value="2"
								       name="group[1111][2]" id="mce-group[1111]-1111-1"<?php checked( 'ja' == get_locale() ) ?>>
								<label for="mce-group[1111]-1111-1">日本語</label>
							</div>
						</div>
					</div>
					<input type="hidden" name="group[1115]" value="16" />
					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>
					<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
					                                                                          name="b_9b5777bb4451fb83373411d34_1e82da4148"
					                                                                          tabindex="-1" value=""></div>
					<div class="clear"></div>
				</div>
			</form>
		</div>
	</div>
</section>
