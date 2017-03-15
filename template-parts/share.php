<div class="share-container container">

	<h2 class="share-title"><?php _e( 'Share This Article', 'jaiko' ); ?></h2>

	<div class="row">
		<div class="col s6 m3 share-sns-facebook">
			<div class="fb-like" data-href="<?php the_permalink() ?>" data-layout="button"
				 data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
		</div>
		<div class="col s6 m3 share-sns-twitter">
			<a href="https://twitter.com/share" class="twitter-share-button"
			   data-url="<?php the_permalink() ?>" data-text="<?php the_title() ?>" data-via="wpGianism">Tweet</a>
		</div>
		<div class="col s6 m3 share-sns-pocket">
			<a data-pocket-label="pocket" class="pocket-btn" data-lang="en" data-pocket-count="none"
			   data-save-url="<?php the_permalink() ?>"></a>
			<script type="text/javascript">!function (d, i) {
                    if (!d.getElementById(i)) {
                        var j = d.createElement("script");
                        j.id = i;
                        j.src = "https://widgets.getpocket.com/v1/j/btn.js?v=1";
                        var w = d.getElementById(i);
                        d.body.appendChild(j);
                    }
                }(document, "pocket-btn-js");</script>
		</div>
		<div class="col s6 m3 share-sns-hatena">
			<a href="http://b.hatena.ne.jp/entry/<?= str_replace( 'https://', '/s/', get_permalink() ); ?>"
			   class="hatena-bookmark-button"
			   data-hatena-bookmark-layout="vertical-normal"
			   data-hatena-bookmark-lang="<?= 'ja' != get_locale() ? 'en' : 'ja' ?>"
			   title="<?php esc_attr_e( 'Add this entry to hatena bookmark.', 'jaiko' ) ?>">
				<img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png"
					 alt="<?php esc_attr_e( 'Add this entry to hatena bookmark.', 'jaiko' ) ?>" width="20"
					 height="20" style="border: none;"/>
			</a>
			<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js"
					charset="utf-8" async="async"></script>
		</div>
	</div>


</div><!-- //.share-container -->
