
			<?php do_action( 'reveal_after_slides' ) ?>
		</div>

		<?php do_action( 'reveal_after_slides_wrapper' ) ?>
	</div>

	<?php wp_footer() ?>
<script>
  var icons = new Skycons({"color": "white"}),
      list  = [
        "clear-day", "clear-night", "partly-cloudy-day",
        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
        "fog"
      ],
      i;

  for(i = list.length; i--; )
    icons.set(list[i], list[i]);

  icons.play();
</script>
</body>
</html>