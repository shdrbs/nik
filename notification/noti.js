var noti_close = "";
var niti_show = "";
var notification = null
//askNotificationPermission();
function makeNoti() {
	var ls_val = localStorage.getItem("noti_tag_val");
	if ( notification !=  null && noti_close == ''  ) {
		//return;
	}

	// 사용자 응답에 따라 단추를 보이거나 숨기도록 설정
	if (Notification.permission === "denied" || Notification.permission === "default") {
		alert("알림이 차단된 상태입니다. 알림 권한을 허용해주세요.");
	} else {

		notification = new Notification("윤리강령", { // "test" => 제목
			tag:"mirae_noti1",				// notification 구분 값?                                  
			body: "윤리강령 게시글 작성!!",	// 메세지                                                 
			//icon: "noti_image.png",			// 아이콘                                                 
			requireInteraction: true,		// 닫기 버튼 누르기 전까지 안사라짐                       
			renotify: true,					// 알림이 보여지고 있는 경우 새 알림으로 대체(덮어씌우기?)
		});
		noti_close = '';

		// 알림 클릭 시 이벤트
		notification.addEventListener("click", () => {
			//window.open('http://106.10.49.216:3000/board/shop/list?btype=new');
			location.href = 'https://erpnew.toup.net/basicinfo/board/businessNotice_Write.php';
		});

		// 알림 닫기 버튼 클릭 시
		notification.addEventListener("close", (event) => {
			noti_close = "Y";
		});

		//notification.addEventListener("error",function(event){
			//console.log("err");
		//});

		//console.log(notification);


		//document.addEventListener("visibilitychange", () => {
			//console.log(document.visibilityState)
			//if ("visible",document.visibilityState === "hidden") {
				//// The tab has become visible so clear the now-stale Notification.
				//notification.close();
			//}
		//});

	}
}

function askNotificationPermission() {
	
	// 브라우저가 알림을 지원하는지 확인
	if (!("Notification" in window)) {
		console.log("이 브라우저는 알림을 지원하지 않습니다.");
	} else {
		if (checkNotificationPromise()) {
			Notification.requestPermission().then((permission) => {
				handlePermission(permission);
			});
		} else {
			Notification.requestPermission(function (permission) {
				handlePermission(permission);
			});
		}
	}

	// 권한을 실제로 요구하는 함수
	function handlePermission(permission) {
		// 사용자의 응답에 관계 없이 정보를 저장할 수 있도록 함
		if (!("permission" in Notification)) {
			Notification.permission = permission;
		}
	}
}

function checkNotificationPromise() {
	try {
		Notification.requestPermission().then();
	} catch (e) {
		return false;
	}
	return true;
}