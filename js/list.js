/**
 * Created with JetBrains PhpStorm.
 * User: heqing02
 * Date: 13-10-18
 * Time: 上午10:35
 * To change this template use File | Settings | File Templates.
 */
function getDagList() {
    $("#dag-dg").datagrid({
        url: "service/main.php?action=dag"
    })
}
function getLogList() {
    $("#log-dg").datagrid({
        url: "service/main.php?action=log"
    })
}
function getTableList() {
    $("#table-dg").datagrid({
        url: "service/main.php?action=table"
    })
}

function getLogDataAjax(urlStr) {
    $("#log-dg").datagrid({
        url: urlStr
    })
}
function getDagDataAjax(urlStr) {
    $("#dag-dg").datagrid({
        url: urlStr
    })
}
function getTableDataAjax(urlStr) {
    $("#table-dg").datagrid({
        url: urlStr
    })
}

$(function () {
    getDagList();
    getLogList();
    getTableList();

    $("#hq-log-button").on("click", function () {
        var logName = $("input[name='log-name']").val().trim();
        var product = $("input[name='product']").val().trim();
        var suffix = "";
        suffix += "&log-name=" + logName;
        suffix += "&product=" + product;
        getLogDataAjax("service/query.php?action=log" + suffix);
    })

    $("#hq-dag-button").on("click", function () {
        var dagName = $("input[name='dag-name']").val().trim();
        var product = $("input[name='product']").val().trim();
        var suffix = "";
        suffix += "&dag-name=" + dagName;
        suffix += "&product=" + product;
        getDagDataAjax("service/query.php?action=dag" + suffix);
    })

    $("#hq-table-button").on("click", function () {
        var tableName = $("input[name='table-name']").val().trim();
        var product = $("input[name='product']").val().trim();
        var suffix = "";
        suffix += "&table-name=" + tableName;
        suffix += "&product=" + product;
        getTableDataAjax("service/query.php?action=table" + suffix);
    })
})