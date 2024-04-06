@extends ('layouts.messagelo')

@section ('title','')

@section ('MessageFirst')
<div class="">
    <div class="d-flex m-3 fw-bold align-items-center">
        <div class="">
            <label class="fs-3">聊天室</label>
        </div>
        <button class="circular ui icon button">
            <i class="edit icon"></i>
        </button>
    </div>
    <div class="" style="width: 95%;margin: auto;">
        <div class="ui action input W-100">
            <input type="text" placeholder="搜尋">
            <button class="ui icon button">
                <i class="search icon"></i>
            </button>
        </div>
    </div>
    <div>
        <div class="UserMassageBox">
            <a href="#">
                <div class="d-flex flex-row align-items-center">
                    <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message">
                    <div class="">
                        <div class="d-flex align-items-center fw-bold UserMassageBoxName">
                            <span class="">你的用戶名</span>
                        </div>
                        <div class="d-flex align-items-center UserMassageBoxMessage">
                            <span class="">你: 喂喂喂 </span><span class="">。10小時前</span>
                        </div>
                    </div>

                </div>
                
            </a>
        </div>
    </div>
    <div>
        <div class="UserMassageBox">
            <a href="#">
                <div class="d-flex flex-row align-items-center">
                    <img src="{{ asset('image/head.png') }}" style="width: 90px;" class="user_img_message">
                    <div class="">
                        <div class="d-flex align-items-center fw-bold UserMassageBoxName">
                            <span class="">你的用戶名</span>
                        </div>
                        <div class="d-flex align-items-center UserMassageBoxMessage">
                            <span class="">你: 喂喂喂 </span><span class="">。10小時前</span>
                        </div>
                    </div>

                </div>
                
            </a>
        </div>
    </div>
</div>
@endsection

@section ('MessageMid')

<main class="content">
    <div class="container p-0">
		<div class="card d-flex">
			<div class="row g-0">
				<div class="">
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong>Sharon Lessman</strong>
								<div class="text-muted small"><em>Typing...</em></div>
							</div>
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4">
							<div class="chat-message-right pb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:33 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
								</div>
							</div>

							<div class="chat-message-left pb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:34 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">Sharon Lessman</div>
									Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
								</div>
							</div>

							<div class="chat-message-right mb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:35 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									Cum ea graeci tractatos.
								</div>
							</div>

							<div class="chat-message-left pb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:36 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">Sharon Lessman</div>
									Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna, vitae commodo lectus mauris et velit.
									Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
								</div>
							</div>

							<div class="chat-message-left pb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:37 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">Sharon Lessman</div>
									Cras pulvinar, sapien id vehicula aliquet, diam velit elementum orci.
								</div>
							</div>

							<div class="chat-message-right mb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:38 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
								</div>
							</div>

							<div class="chat-message-left pb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:39 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">Sharon Lessman</div>
									Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
								</div>
							</div>

							<div class="chat-message-right mb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:40 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									Cum ea graeci tractatos.
								</div>
							</div>

							<div class="chat-message-right mb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:41 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									Morbi finibus, lorem id placerat ullamcorper, nunc enim ultrices massa, id dignissim metus urna eget purus.
								</div>
							</div>

							<div class="chat-message-left pb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:42 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">Sharon Lessman</div>
									Sed pulvinar, massa vitae interdum pulvinar, risus lectus porttitor magna, vitae commodo lectus mauris et velit.
									Proin ultricies placerat imperdiet. Morbi varius quam ac venenatis tempus.
								</div>
							</div>

							<div class="chat-message-right mb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:43 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
								</div>
							</div>

							<div class="chat-message-left pb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:44 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1">Sharon Lessman</div>
									Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
								</div>
							</div>

						</div>
					</div>

					

				</div>
			</div><
		</div>div class="flex-grow-0 py-3 px-4 border-top bottom-container d-flex">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Type your message">
							<button class="btn btn-primary">Send</button>
						</div>
					</div>
	</div>
</main>

@endsection

@section ('MessageEnd')


@endsection