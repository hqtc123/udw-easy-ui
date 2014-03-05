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
})(jQuery);