
/*
	유니코드 문자열을 한글로 변환
	'\xed\x95\x9c\xea\xb8\x80' => '한글'
*/
function decodeUnicode(input){
	return decodeURIComponent(escape(input));
}