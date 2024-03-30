<link rel="stylesheet" href="{{ asset('css/frontpagestyles.css') }}">
<!-- popup.blade.php -->
<div class="popup">
    <div class="popup-content">
        <!-- 在後端嵌入彈出視窗的內容 -->
        {{ $popupContent }}
    </div>
</div>
<script>
    function showPopup(mjoinId) {
                        var popup = $('.popup');
                        var overlay = $('.overlay');
                        var header = $('.header');

                        popup.css('display', 'block');
                        overlay.css('display', 'block');
                        popup.css('border', '1px solid gray');
                        popup.css('box-shadow', '0px 0px 15px rgba(0, 0, 0, 0.7)');
                        header.css('background-color', 'rgba(0, 0, 0, 0.000001)');

                        $.ajax({
                            url: "/showallmjoin/" + mjoinId,
                            type: "GET",
                            success: function(response){
                                // 在彈出的視窗中顯示留言
                                $('.popup-content').html(response);
                                $('.popup').show();
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
</script>