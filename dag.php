<?php include_once('header.php'); ?>
<link rel="stylesheet" type="text/css" href="css/list.css">
<script type="text/javascript" src="js/list.js"></script>
<div class="container">
    <div id="dag-div" class="right-child">
        <table id="dag-dg" class="easyui-datagrid" title="任务列表" style="width: 818px;height: 500px"
               pagination="true" draggable="false"
               pageSize="20"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="dagname" width="80">任务名</th>
                <th field="product" width="80">产品线</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="easyui-panel" title="查询" style="width:818px">
            <form id="ff" method="post">
                <table>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>任务名 :</td>
                        <td><input class="easyui-validatebox" type="text" name="dag-name"></input></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>产品线 :</td>
                        <td><select class="easyui-combobox" value="" name="product">
                                <option value="">不限</option>
                                <option value="map">map</option>
                                <option value="baike">baike</option>
                                <option value="ps">ps</option>
                                <option value="clb">clb</option>
                                <option value="NOVA">NOVA</option>
                                <option value="wenku">wenku</option>
                                <option value="hao123">hao123</option>
                                <option value="pcs">pcs</option>
                                <option value="tieba">tieba</option>
                                <option value="image">image</option>
                                <option value="iknow">iknow</option>
                                <option value="news">news</option>
                                <option value="weibo">weibo</option>
                                <option value="appsearch">appsearch</option>
                                <option value="wise">wise</option>
                                <option value="baiduapp">baiduapp</option>
                                <option value="chunlei">chunlei</option>
                                <option value="uap">uap</option>
                                <option value="bd_input">bd_input</option>
                                <option value="netdisk">netdisk</option>
                                <option value="pcbrowser">pcbrowser</option>
                                <option value="pcime">pcime</option>
                                <option value="fengchao">fengchao</option>
                                <option value="globalps">globalps</option>
                                <option value="browser">browser</option>
                                <option value="music">music</option>
                                <option value="ns">ns</option>
                                <option value="CLOUD">CLOUD</option>
                                <option value="share">share</option>
                                <option value="sobar">sobar</option>
                            </select></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="button" value="查询" id="hq-dag-button"></td>
                    </tr>

                </table>
            </form>
        </div>

    </div>
</div>
<?php include_once("footer.html"); ?>
</body>
</html>