<link rel="stylesheet" href="{{ asset('css/frontpagestyles.css') }}">
<!-- popup.blade.php -->

        <!-- 在後端嵌入彈出視窗的內容 -->
        {{ $popupContent }}
<script>
    overlay.addEventListener('click', function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        popup.style.display = 'none';
                        overlay.style.display = 'none';
                        popup.style.boxShadow = 'none';
                        header.style.backgroundColor = '#ffffff';
                    });
</script>