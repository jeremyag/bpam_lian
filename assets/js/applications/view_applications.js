$(function(){
    $.ajax({
        url: base_url,
        dataType: "html",
        type: "get",
        data: {
            business_id: business,
            app_id: application
        },
        success: function (html) {
            $("#loading").css("display", "none");
            $("#information").empty();
            $("#information").append(html);
        }
    });

    $("#other-information").on("click", function(){
        $("#loading").css("display", "block");
        $("#information").empty();

        $("#other-information").addClass("active");
        $("#business-activity").removeClass("active");

        $.ajax({
            url: base_url,
            dataType: "html",
            type: "get",
            data: {
                business_id : business,
                app_id: application
            },
            success: function(html){
                $("#loading").css("display", "none");
                $("#information").append(html);
            }
        });
    });

    $("#business-activity").on("click", function(){
        $("#loading").css("display", "block");
        $("#information").empty();

        $("#other-information").removeClass("active");
        $("#business-activity").addClass("active");

        $.ajax({
            url: base_url,
            dataType: "html",
            type: "get",
            data: {
                application_id: application
            },
            success: function (html) {
                $("#loading").css("display", "none");
                $("#information").append(html);
            }
        });
    });
});