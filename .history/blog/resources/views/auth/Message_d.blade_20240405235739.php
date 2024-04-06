<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends ('layouts.messagelo')
@extends ('auth.message')

@section ('title','')


@section ('MessageMid')

<main class="content">
    <div class=" p-0">
		<div class="card vh-100 d-flex">
			<div class="row g-0">
				<div class="">
                    <div id="message_head">
                    </div> 
					<div class="position-relative" >
						<div class="chat-messages p-4 " id="message_show_d">
							
                          
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection

@section ('MessageEnd')


@endsection
