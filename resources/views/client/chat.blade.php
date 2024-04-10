<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
	#content {
		width: 100%;
		border: 1px solid black;
		min-height: 30px;
		padding: 5px;
		outline: none;
		/* loại bỏ đường viền khi được focus */
		overflow-y: auto;
		/* hiển thị thanh cuộn khi nội dung vượt quá kích thước */
	}

	#content:focus {
		border-color: blue;
		/* thay đổi màu viền khi được focus */
	}
</style>

<body>
	@php
	$user= Auth::user();
	@endphp
	<div class="chat-container">
		<div class="msg">
		</div>
	</div>
	<form id="chatForm">
		@csrf
		<div>
			<label id="name">{{$user->name}}</label>
			Content:
			<div name="content" id="content" rows="5" style="width: 100%;border: 1px solid black; height: 30px;" contenteditable=""></div>
		</div>
		<button type="submit">Send</button>
	</form>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
	<script>
		$(function() {
			let ip_address = '127.0.0.1';
			let socket_port = '3000';
			let socket = io(ip_address + ':' + socket_port);
			let chatForm = $('#chatForm');
			let ChatInput = $('#content');
			let name = $('#name')

			chatForm.submit(function(e) {
				e.preventDefault();
				let message = ChatInput.html();
				let nameUser = name.html();
				console.log(message);
				socket.emit('sendChatToServer',
					message, nameUser
				);
				ChatInput.html('');
				return false;
			});

			socket.on('sendChatToClient', (message, nameUser) => {
				$('.msg').append(`<label>${nameUser}</label><p>${message}</p>`);
			});
		})
	</script>

	</div>
</body>

</html>