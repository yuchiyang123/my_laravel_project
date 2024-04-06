<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends ('layouts.messagelo')

@section ('title','')

@section ('MessageMid')

<main class="content">
    <div class=" p-0">
		<div class="card vh-100 d-flex">
			<div class="row g-0">
				<div class="">
                    <div id="message_head">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="{{ $senderu }}" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>{{ $senderu }}</strong>
                                    <div class="text-muted small"><em></em></div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="position-relative" >
						<div class="chat-messages p-4 " id="message_show_d"></div>
                            
                            
                        
                    </div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // 在页面加载完成后注册点击事件监听器
        $(document).on('click', 'a.message-link', function(event) {
            event.preventDefault(); // 阻止链接的默认行为
            var senderu = $(this).data('senderu'); // 获取链接上的 senderu 数据
            fetchAndRenderMessages(senderu); // 触发获取和渲染消息的函数，传入 senderu
        });
        
        // 其他初始化逻辑可以放在这里
    });

    function Data(){
        function fetchMessages() {
            $.ajax({
                url: '/message-view-show/t/{{ $senderu }}',
                method: 'GET',
                success: function(response) {
                    if (response.messages) {
                        update(response.messages);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        
        function update(messages) {
            var messageContainer = $('#message_show_d');
            messageContainer.html(messages); // 将 HTML 字符串插入到容器中
            // messageContainer.scrollTop(messageContainer[0].scrollHeight); // 滚动到底部
        }

        $(document).ready(function() {
            fetchMessages(); // 页面加载时首次获取消息
            setInterval(fetchMessages, 2000); // 每隔2秒获取一次消息
        });
    }
</script>

@endsection

@section ('MessageEnd')


@endsection
