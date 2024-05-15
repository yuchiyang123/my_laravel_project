
@extends('admin.layout.layout')

@section('main_content')
<div class="cut">
    <div class="grid-item">
        <div class="limt">
            <div class="text-container">
                <div class="title">
                    <h3>{{ $userarkworksolo->title }}</h3>
                </div>
            </div>
            <?php $imageDataUri = 'data:' . $userarkworksolo->image_type  . ';base64,' . base64_encode( $userarkworksolo->image_data ); ?>
                    <div id="imageContainer" class="mb-2" style="border: 1px solid #000; width: 150px; height: 150px;">
                        @if ($userarkworksolo->image_data)
                            <img src="{{ $imageDataUri }}" style="width: 100%; height: 100%;" alt="Current Image">
                        @endif
                    </div>
            <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                <label class="flex-fill ps-3">創作者:{{ $userarkworksolo->username }}</label>
                <label class="flex-fill">創作日期:{{ $userarkworksolo->created_at }}</label>
                <label class="flex-fill">分類:{{ $userarkworksolo->class }}</label>
            </div>
            <div class="clearfix"></div>
            <div class="image-container">
                <div class="d-block mb-3 mt-3 text-start text-break">
                    {!! $userarkworksolo->main !!}
                </div>
            </div>
            <div class="container">
                <div class="respond">

                    <a href="#">👍🏽</a>
                        <div>
                            <a href="#">
                                <span class="goodcount_{{ $userarkworksolo->id }}"></span>
                            </a>
                        </div>
                </div>
                <div class="messagecount" id="messagecount_{{ $userarkworksolo->id }}">

                </div>
            </div>
        </div>
        <div><h4>回復</h4></div>
        <div class="ShowAllMessage" id="">
            @if($userartworkreplys!=null)
                @foreach($userartworkreplys as $userartworkreply)
                <div class="LeaveMessage">
                    <div>
                        <div class="LeaveMessageimgdiv">
                            <a href="/user-profile/index/d/'.$mjoin_reply->name_u.' ">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                            </a>
                        </div>
                        <div class="LeaveMessageall">
                            <div class="LeaveMessageUsername">
                                <a href="/user-profile/index/d/'.$mjoin_reply->name_u.'">{{ $userartworkreply->name_u }}</a>
                            </div>
                            <div class="LeaveMessageMain">
                                {{ $userartworkreply->main }}
                            </div>
                            <div class="LeaveMessageAction">
                                <a href="#">{{ $userartworkreply->created_at }}</a>&emsp;
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="LeaveMessage" style="text-align:center;width:auto;display:inline-block;">
                    <h2>無留言</h2>
                </div>
            @endif
            
        </div>
    </div>
    </div>
</div>
<div><button class="btn btn-primary" href="">編輯</button></div>
<script>
    $(document).ready(function() {
       art_post_countgood({{ $userarkworksolo->id }});

       

       var link = $('.like-button');

       var article_id = {{ $userarkworksolo->id }};
       Echo.channel('article_id_' + article_id)
           .listen('PostGoodCountUDARK', (e) => {
               $('.goodcount_' + e.article_id).text(e.goodcount);
           });
           $.ajax({
                   type: 'GET',
                   url: '/art_post_posts/checkgood/' + article_id,
                   success: function(response) {
                       if (response.status === 'true') {
                           // 如果用户已经点赞，添加 liked 类来改变按钮的样式
                           link.addClass('liked');
                           link.find('.material-icons').text('thumb_up');
                           link.find('.fs-6').text('讚');
                       } else {
                           link.removeClass('liked');
                           link.find('.material-icons').text('thumb_up_off_alt');
                           link.find('.fs-6').text('讚');
                       }
                   },
                   error: function(xhr, status, error) {
                       console.error(xhr.responseText);
                   }
               });
               link.click(function(event) {
                   event.preventDefault(); // 阻止默认行为

                   // 检查超链接是否已经被喜欢
                   if (link.hasClass('liked')) {
                       // 調用取消喜歡的函數
                       ungood(article_id, link);
                   } else {
                       // 調用喜歡的函數
                       good(article_id, link);
                   }
                  
               });
   });

   function art_post_countgood(article_id) {
                           $.ajax({
                               url: "/art_post_posts/countgood/" + article_id,
                               type: "GET",
                               success: function(response) {
                                   $('.goodcount_' + article_id).html(response.count);
                                   $('.goodcount_' + article_id).show();
                               },
                               error: function(xhr, status, error) {
                                   console.error(xhr.responseText);
                               }
                           });
                       }


       //收藏
       /*
       function collect(article_id){
           $.ajax({
               url:"/collect_artwork/collect/" + article_id,
               type: "GET",
               success: function(response) {
                   if(response.status == 'NO') {
                       $('#collect_' + article_id).text('收藏');
                   } else {
                       $('#collect_' + article_id).text('取消收藏');
                   }

               }
           })
       }*/
   
</script>
@endsection