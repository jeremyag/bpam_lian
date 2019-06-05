function rowClick(link, varName, id) {
	window.location.href = link + "?" + varName + "=" + id;
}

function isKeyPressNum(which) {
	if (((which >= 48 && which <= 57) || (which >= 96 && which <= 105)) || (which == 110 || which == 190 || which == 8 || which == 46)) {
		return true;
	}
	return false;
}

$(function(){
	$(".gModal-btn").on("click", function () {
		$("#gModal").modal("show");

		let me = $(this);

		let base_url = "";
		let _data = {};
		let type = "get";

		if (me.data("gaction") == "assess") {
			base_url = me.data("base_url")+"Assessments_Controller/assess";

			_data = {
				id : me.data("application")
			};

			// Set action of Gmodal-form
			$("#gModal-form").attr(
				"action",me.data("base_url")+"Assessments_Controller/send_assessment"
			)
		}

		if(base_url !== ""){
			$.ajax({
				url: base_url,
				dataType: "html",
				type: "get",
				data: _data,
				success: function (html) {
					// $(".progress").css("display", "none");
					$("#gModal-body").empty();
					$("#gModal-body").append(html);
				}
			});
		}
	});

	$("#gModal-cancel").on("click", function(){
		$("#gModal-body").empty();
		$('#gModal').modal('hide');
	});

	$(".number-only-textbox").bind({
		keydown: function (e) {
			return isKeyPressNum(e.which);
		}
	});
})