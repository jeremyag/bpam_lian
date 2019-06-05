function rowClick(link, varName, id) {
	window.location.href = link + "?" + varName + "=" + id;
}

$(function(){
	$(".gModal-btn").on("click", function () {
		$("#gModal").modal("show");

		let me = $(this);

		let base_url = "";
		let data = {};
		let type = "get";

		if (me.data("gaction") == "assess") {
			base_url = "";
		}

		if(base_url !== ""){
			$.ajax({
				url: base_url,
				dataType: "html",
				type: "get",
				data: {
					business_id: business
				},
				success: function (html) {
					$(".progress").css("display", "none");
					$("#information").empty();
					$("#information").append(html);
				}
			});
		}
	});

	$("#gModal-cancel").on("click", function(){
		$("#gModal").modal("hide");
	})
})