<script>
(function($){
	$(function(){
		var custom_uploder = wp.media({
			title: "画像選択",
			library: {
				type: "image"
			},
			button: {
				text: "選択"
			},
			multipule: false
		});

		$("#media-upload").on("click", function(e){
			e.preventDefault();
			custom_uploder.open();
		});

		custom_uploder.on("select", function(){
			var images = custom_uploder.state().get("selection");

			images.each(function(file){
				console.log(file.toJSON());
				$("#banner-image-url").val(file.toJSON().url);
				$("#banner-image-alt").val(file.toJSON().alt);
				$("#banner-image-view").attr("src",toJSON().url);
			})
		});

	});
})(jQuery);

</script>
