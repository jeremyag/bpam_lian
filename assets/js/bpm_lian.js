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
	let setGmodalTitle = function(title){
		$("#gModal-head").empty();
		$("#gModal-head").html(title);
	};

	let setGmodalFormAction = function(link){
		$("#gModal-form").attr(
			"action", link
		);
	};

	$(".gModal-btn").on("click", function () {
		$("#gModal").modal("show");

		let me = $(this);

		let base_url = "";
		let _data = {open:1};
		let _type = "get";
		let loading = "#loading";

		let gaction = me.data("gaction");

		// Assessment Button
		if (me.data("gaction") == "assess") {
			setGmodalTitle("Assessment");

			base_url = me.data("base_url")+"Assessments_Controller/assess";

			_data = {
				id : me.data("application")
			};

			// Set action of Gmodal-form
			$("#gModal-form").attr(
				"action",me.data("base_url")+"Assessments_Controller/send_assessment"
			);
		}

		if (gaction == "settings_edit_tax"){
			setGmodalTitle("Edit Taxes");

			base_url = me.data("base_url") + "Settings_Controller/settings_assessments_form";

			_data = {
				id: me.data("id"),
				action: "edit"
			};

			$("#gModal-form").attr(
				"action", me.data("base_url") + "Assessments_Controller/send_assessment"
			);

			setGmodalFormAction(me.data("base_url") + "Settings_Controller/submit_assessment_form");
		}

		if(gaction == "settings_delete_tax"){
			setGmodalTitle("Are you sure you want to delete?");

			base_url = me.data("base_url") + "Settings_Controller/settings_assessments_form";

			_data = {
				id: me.data("id"),
				action: "delete"
			};

			setGmodalFormAction(me.data("base_url") + "Settings_Controller/submit_assessment_form");
		}

		if(gaction == "settings_add_tax"){
			setGmodalTitle("Add New Local Tax");

			base_url = me.data("base_url")+"Settings_Controller/settings_assessments_form";

			_data = {
				id: 0,
				action: "add"
			};

			setGmodalFormAction(me.data("base_url") + "Settings_Controller/submit_assessment_form");
		}

		if(base_url !== ""){
			$.ajax({
				url: base_url,
				dataType: "html",
				type: _type,
				data: _data,
				success: function (html) {
					$(loading).css("display", "none");
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