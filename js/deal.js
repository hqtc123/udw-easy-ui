/**
 * Created with JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-11-18
 * Time: 下午12:26
 * To change this template use File | Settings | File Templates.
 */

function refreshDealData(id) {
    $.ajax({
        url: "service/resources.php?action=deal&id=" + id,
        type: "POST",
        dataType: "json",
        success: function (data) {
            $("#type").html(data.type);
            $("#cluster").html(data.cluster);
            if (data.type.trim() == "存储资源") {
                $("#str_td").html("存储目录：");
                $("#num_td").html("大小(T):")
            }
            $("#req_str").html(data.req_str);
            $("#req_num").html(data.req_num);
            $("#req_time").html(data.req_time);
            $("#state").html(data.state);
            if (data.state.trim() == "待审批") {
                $("tr.view").hide();
            } else {
                $("tr.deal").hide();
            }
            $("#reason").html(data.reason);
            $("#mail").html(data.mail);
            $("#dealer").html(data.dealer);
            $("#deal_time").html(data.deal_time);
            $("#deal_reason").html(data.deal_reason);
        }
    })
}

function dealApply(num, id) {
    if ($("#account").html() != "sunhuali01") {
        alert("你还没有这个操作的权限，，");
        return;
    }
    if ($("#deal_reason_area").val().trim() == "") {
        alert("审批的理由也是要填的啊。。。。");
        return
    }
    $.ajax({
        url: "service/resources.php?action=deal",
        type: "POST",
        dataType: "json",
        data: {
            "id": id,
            "num": num,
            "dealer": $("#account").html(),
            "deal_reason": $("#deal_reason_area").val().trim()
        },
        success: function (data) {
            if (data.success == 1) {
                alert("审批完成。审批理由为：" + $("#deal_reason_area").val().trim())
                window.location.reload();
            }
        }
    })
}
$(function () {
    var applyId = $("#hide_id").html();
    refreshDealData(applyId);
    $("#pass-btn").on("click", function () {
        dealApply(1, applyId)
    });
    $("#no-pass-btn").on("click", function () {
        dealApply(2, applyId)
    });

})