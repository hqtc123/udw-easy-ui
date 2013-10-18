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

$(function () {
    getDagList();
    getLogList();
    getTableList();


})