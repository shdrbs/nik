<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>웹 알림 테스트</title>

	<!-- 화면 오른쪽 하단에 개발자도구 버튼 생성 -->
	<script src="//cdn.jsdelivr.net/npm/eruda"></script>
	<script>eruda.init();</script>

</head>

<body>
	<button type="button" id="notification" onclick="defulatShowNotification();">notification</button>

		 <script>
			navigator.serviceWorker.register('./service-worker.js');
			function showNotification(title, message, url, icon) {
				Notification.requestPermission(function(result) {
					console.log(result);
					if (result === 'granted') {
						navigator.serviceWorker.ready.then(function(registration) {
							registration.showNotification(title, {
								tag: "mirae_noti",
								body: message,
								icon: icon,
								//vibrate: [200, 100, 200, 100, 200, 100, 200],
								data : url,
								renotify: true,
								requireInteraction: true,
							});
						});
					}
				});
			};
			
			function defulatShowNotification(){
				showNotification('Vibration Sample', 'test!', 'http://www.naver.com', '');
			}
		</script>
</body>
</html>