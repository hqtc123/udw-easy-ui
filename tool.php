<html>
<head>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
</head>
<body>

</body>
<script>
    $(function () {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "interface/main.php?action=log",
            success: function (ret) {
                var rows = ret.rows;
                for (var x in rows) {
                    var content = rows[x].logname + " " + rows[x].logtype + " " + rows[x].logpath + " " + rows[x].product;
                    $("body").append($("<div>").html(content));
                }
            }
        })
    })
</script>
</html>