$(function(){
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

    $("#other-information").on("click", function(){
        $(".progress").css("display", "block");

        $("#other-information").addClass("active");
        $("#business-activity").removeClass("active");

        $.ajax({
            url: base_url,
            dataType: "html",
            type: "get",
            data: {
                business_id : business
            },
            success: function(html){
                $(".progress").css("display", "none");
                $("#information").empty();
                $("#information").append(html);
            }
        });
    });

    $("#business-activity").on("click", function(){
        $(".progress").css("display", "block");

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
                $(".progress").css("display", "none");
                $("#information").empty();
                $("#information").append(html);
            }
        });
    });
});