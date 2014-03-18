/**
 * Created with JetBrains PhpStorm.
 * User: heqing02
 * Date: 14-2-27
 * Time: 下午3:30
 * 依赖jQuery easyui
 */
(function ($) {
    $.fn.heDatagrid = function (url) {
        if (arguments.length > 1 && (!arguments[1])) {
            $(this).datagrid({
                pagination: "false",
                draggable: "false",
                width: "100%",
                rownumbers: "true",
                fitColumns: "true",
                singleSelect: "true",
                url: url
            });
        } else {
            $(this).datagrid({
                pagination: "true",
                draggable: "false",
                pageSize: "10",
                width: "100%",
                rownumbers: "true",
                fitColumns: "true",
                singleSelect: "true",
                url: url
            });
        }
    }
    $.fn.rowSpan = function (colIdx) { //封装的一个JQuery小插件
        return this.each(function () {
            var that;
            $('tr', this).each(function (row) {
                $('td:eq(' + colIdx + ')', this).filter(':visible').each(function (col) {
                    if (that != null && $(this).html() == $(that).html()) {
                        var rowSpan = $(that).attr("rowspan");
                        if (rowSpan == undefined) {
                            $(that).attr("rowSpan", 1);
                            rowSpan = $(that).attr("rowspan");
                        }
                        rowSpan = Number(rowSpan) + 1;
                        $(that).attr("rowspan", rowSpan);
                        $(this).hide();
                    } else {
                        that = this;
                    }
                });
            });
        });
    }

})(jQuery);