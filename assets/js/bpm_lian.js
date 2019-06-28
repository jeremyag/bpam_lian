function rowClick(link, varName, id) {
	window.location.href = link + "?" + varName + "=" + id;
}

function isKeyPressNum(which) {
	if (((which >= 48 && which <= 57) || (which >= 96 && which <= 105)) || (which == 110 || which == 190 || which == 8 || which == 46)) {
		return true;
	}
	return false;
}

function compute_pagination(total_results, per_page){
	pages = total_results / per_page;

	if(total_results % per_page){
		pages++;
	}

	return pages;
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

	let setGmodalMessage = function(message){
		$("#gModal-body").empty();
		$("#gModal-body").html(message);
	}

	$(".gModal-btn").on("click", function () {
		$("#gModal").modal("show");

		let me = $(this);

		let base_url = "";
		let _data = {open:1};
		let _type = "get";
		let loading = "#g-loading";

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

		if (gaction == "edit_application_main") {
			setGmodalTitle("Edit Application");

			base_url = me.data("base_url")+"Application_Controller/basic_information_form";

			_data = {
				id: me.data("id"),
				action: "edit"
			}

			setGmodalFormAction(me.data("base_url") + "Application_Controller/submit_basic_information_form");
		}

		if(gaction == "delete_application_main"){
			setGmodalTitle("Delete Application");
			$(loading).css("display", "none");
			let app_id = me.data("id");
			setGmodalMessage("Are you sure you want to delete this application? (This cannot be undone once deleted.) <input type='hidden' value='" + app_id + "' name='application_id'>");

			setGmodalFormAction(me.data("base_url") + "Application_Controller/delete_application");
		}

		if(gaction == "edit_other_information"){
			setGmodalTitle("Edit Other Information");

			base_url = me.data("base_url")+"Application_Controller/other_information_form";

			_data = {
				id: me.data("id"),
				app_id: me.data("app_id"),
				action: "edit"
			}

			setGmodalFormAction(me.data("base_url") + "Application_Controller/submit_other_information_form");
		}

		if(gaction == "delete_business_activity"){
			setGmodalTitle("Delete Business Activity");
			$(loading).css("display", "none");
			let id = me.data("id");
			let app_id = me.data("app_id");
			setGmodalMessage("Are you sure you want to delete this Business Activity? (This cannot be undone once deleted.)  <input type='hidden' value='" + app_id + "' name='application_id'> <input type='hidden' value='" + id + "' name='id'>");

			setGmodalFormAction(me.data("base_url") + "Application_Controller/delete_business_activity");
		}

		if(gaction == "edit_business_activity"){
			setGmodalTitle("Edit Business Activity");
			
			base_url = me.data("base_url") + "Application_Controller/business_activity_form";

			_data = {
				id: me.data("id"),
				app_id: me.data("app_id"),
				isNew: me.data("isnew"),
				action: "edit"
			}

			setGmodalFormAction(me.data("base_url") + "Application_Controller/submit_business_activity_form");
		}

		if(gaction == "add_business_activity"){
			setGmodalTitle("Add Business Activity");

			base_url = me.data("base_url")+ "Application_Controller/business_activity_form";

			_data = {
				app_id: me.data("app_id"),
				isNew: me.data("isnew"),
				action: "add"
			}

			setGmodalFormAction(me.data("base_url") + "Application_Controller/add_business_activity");
		}

		if(gaction == "add_license"){
			setGmodalTitle("Add License");

			base_url = me.data("base_url") + "Application_Controller/license_form";

			_data = {
				b_id: me.data("business_id"),
				a_id: me.data("application_id"),
				action: "add"
			};

			setGmodalFormAction(me.data("base_url") + "Application_Controller/add_license_form");
		}

		if(gaction == "settings_edit_general"){
			setGmodalTitle("Edit Settings");

			base_url = me.data("base_url")+"Settings_Controller/general_settings_form";

			_data = {
				id: me.data("id")
			};

			setGmodalFormAction(me.data("base_url") + "Settings_Controller/submit_general_settings");
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