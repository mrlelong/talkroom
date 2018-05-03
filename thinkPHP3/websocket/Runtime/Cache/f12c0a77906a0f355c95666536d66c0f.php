<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>websocket聊天室</title>
    <script src="__ROOT__/Public/style/js/jquery.js"></script>
    <link rel="stylesheet" href="__ROOT__/Public/style/css/bootstrap.min.css">
    <link rel="stylesheet" href="__ROOT__/Public/style/css/index.css">
    


</head>

<body>

    <div class="container wrap">
        <div class="fl lcon col-sm-8">
            <div class="talk"></div>
            <div>
                <select name="who" id="who">
                    <option value="">所有人</option>
                    <option value="">jack</option>
                    <option value="">tom</option>
                </select>
            </div>
            <div>
                <textarea name="text" id="content" cols="69" rows="5"></textarea>
            </div>
            <div class="clearfix">
                <a href="javascript:;" class="btn btn-info fl">表情</a>
                <a href="javascript:;" class="btn btn-info fr" onclick="sendMsg();">发送</a>
            </div>
            <div class="room">
                <h4>房间列表：(当前在房间 <span class="room_num">1</span> )</h4>
                <a href="javascript:;" onclick="changeroom(1);">房间1</a>
                <a href="javascript:;" onclick="changeroom(2);">房间2</a>
                <a href="javascript:;" onclick="changeroom(3);">房间3</a>
                <a href="javascript:;" onclick="changeroom(4);">房间4</a>
            </div>
        </div>

        <div class="fr rcon col-sm-3">
            <h2>当前房间人员</h2>
            <ul class="man">

                <?php if(is_array($user)): foreach($user as $key=>$vo): ?><li><?php echo ($vo["name"]); ?></li><?php endforeach; endif; ?>


            </ul>
        </div>
    </div>

    <footer>底部脚</footer>

    <div class="media hide talk-left">
        <div class="media-left">
            <a href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNjMwMDYxMjE1NyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE2MzAwNjEyMTU3Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi41IiB5PSIzNi44Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg=="
                    data-holder-rendered="true">
            </a>
        </div>
        <div class="media-body media-body-left">
            <h4 class="media-heading">对话标题</h4>
            <p>对话内容</p>
        </div>
    </div>

    <div class="media hide talk-right">
        <div class="media-body media-body-right">
            <h4 class="media-heading ">对话标题</h4>
            <p>对话内容</p>
        </div>
        <div class="media-right">
            <a href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNjMwMDYxMmQ5ZiB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE2MzAwNjEyZDlmIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi41IiB5PSIzNi44Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg=="
                    data-holder-rendered="true">
            </a>
        </div>
    </div>
 
</body>
<script>
    
        var name = window.prompt('请输入名称');
    
    
    var ws = new WebSocket('ws://websocket.cmx:9996?name=' + name);
    

    ws.onopen = function (e) {
        console.log('连接成功');
        // ws.send(name);
    }

    ws.onmessage = function (e) {
        console.log('收到服务端返回消息start');
        console.log(e);
        console.log(e.data);
        console.log('收到服务端返回消息end');
        // obj = eval('(' + e.data + ')');
        obj=JSON.parse(e.data);
        console.log(obj);

        if(obj.mark == 'first'){
            // 第一次进来
            addname(obj.name);
            welcome(obj);
        }else if(obj.mark == 'other'){
            otherSay(obj);
        }else if(obj.mark == 'self'){
            selfSay(obj);
        }else if(obj.mark == 'out'){
            outSay(obj);
        }else if(obj.mark == 'selfchange'){
            // 换房间自己受到消息
            clearMsg();
            welcome(obj);
        }else if(obj.mark == 'changefirst'){
            // 其他人受到换房间消息
            welcome(obj);
            addname(obj.name);
        }

    }

    ws.onclose = function (e) {
        
        console.log('链接关闭');

    }

    function sendMsg() {
        var text_val = $('#content').val();
        console.log(text_val);
        
        ws.send('{"msg":"' + text_val + '","mark":"going"}');
        $('#content').val('');
    }
</script>

<script>
    // 右侧添加人名
    function addname(name) {
        var oli = $('<li></li>').html(name);
        $('.man').append(oli);

    }
    // 自己的消息
    function selfSay(obj){

        var R_box=$('.talk-right').clone().removeClass('hide talk-right');
        R_box.find('.media-body p').html(obj.msg);
        R_box.find('.media-body h4').html('我是'+obj.name);
        $('.talk').append(R_box).scrollTop($('.talk')[0].scrollHeight);
        $('textarea').val('');
    }
    // 别人的消息
    function otherSay(obj){
        var R_box = $('.talk-left').clone().removeClass('hide talk-left');
        R_box.find('.media-body p').html(obj.msg);
        R_box.find('.media-body h4').html('他是'+obj.name);
        $('.talk').append(R_box).scrollTop($('.talk')[0].scrollHeight);
        
    }
    // 欢迎消息
    function welcome(obj) {
            var R_box = $('.talk-left').clone().removeClass('hide talk-left');
            R_box.find('.media-body p').html("欢迎<b> "+ obj.name +"</b> 加入房间");
            R_box.find('.media-body h4').html('系统');
            $('.talk').append(R_box).scrollTop($('.talk')[0].scrollHeight);
        }
    // 离开消息
    function outSay(obj) {
            var R_box = $('.talk-left').clone().removeClass('hide talk-left');
            R_box.find('.media-body p').html(obj.name+"已退出群聊");
            R_box.find('.media-body h4').html('系统');
            $('.talk').append(R_box).scrollTop($('.talk')[0].scrollHeight);
            // 去掉离开人的名字
            var liList=$('.man li');
            console.log(liList);
            liList.each(function () {
                if($(this).text() == obj.name){
                    $(this).remove();
                }
            })
            
        }
    // 换房间
    function changeroom(room_id) {
        var right_room=$('.room_num').html();
        if(right_room == room_id){
            return false;
        }else{
            $('.room_num').html(room_id);
        }

        ws.send('{"room_id":"' + room_id + '","mark":"changeroom"}');
        // 刷新新的房间人员列表
        $.ajax({
            url:'__APP__/Index/ajaxChangeRoom',
            data:{'room_id':room_id},
            success:function(data){
                console.log(data);
                data=JSON.parse(data);
                console.log(data);
                $('.man').html('');
                for(i=0;i<data.length;i++){
                    console.log(data[i]);
                    item=$('<li></li>').html(data[i].name);
                    $('.man').append(item);
                }
            }
        });
    }
    // 换房间 清空对话消息
    function clearMsg() {
        $('.talk').html('');
    }


    
</script>

</html>