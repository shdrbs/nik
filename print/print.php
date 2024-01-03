<HTML>
 <HEAD>
  <title>풀리백출력</title>
  <object id="factory" style="DISPLAY: none" codeBase="https://erpnew.toup.net/nik/print/ActiveX/ScriptX.cab#Version=6,1,429,14" classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814" viewastext>
  </object>

  <script defer>
  {
  factory.printing.header = "d";   // Header에 들어갈 문장
  factory.printing.footer = "d";   // true 면 가로인쇄, false 면 세로 인쇄
  factory.printing.portrait = false;
  factory.printing.leftMargin = 0.4;   // 왼쪽 여백 사이즈
  factory.printing.topMargin =0.2; // 위 여백 사이즈
  factory.printing.rightMargin = 0.0;   // 오른쪽 여백 사이즈
  factory.printing.bottomMargin = 0.0;  // 아래 여백 사이즈
  // factory.printing.SetMarginMeasure(1); 
  // factory.printing.printBackground = true  //배경 및 이미지 인쇄
  }
  </script>
  <script>
 function printDiv () {
 if (document.all && window.print) {
  window.onbeforeprint = beforeDivs;
  window.onafterprint = afterDivs;
  //window.print();
  factory.printing.Print(true);
  }
 }
 function beforeDivs () {
 if (document.all) {
  objContents.style.display = 'none';
  objSelection.innerHTML = document.all['lblPrint'].innerHTML;
 }
 }
 function afterDivs () {
  if (document.all) {
   objContents.style.display = 'block';
   objSelection.innerHTML = "";
  }
 }

function Preview(){
 factory.printing.leftMargin = 0.4; // 왼쪽 여백 사이즈
 factory.printing.topMargin =0.2; // 위 여백 사이즈
 factory.printing.rightMargin = 0.0;  // 오른쪽 여백 사이즈
 factory.printing.bottomMargin = 0.0; // 아래 여백 사이즈

 factory.printing.portrait = false;
 factory.printing.Preview();
 
 }
  </script>
  <STYLE TYPE="text/css"> 
 .break { PAGE-BREAK-AFTER: always } 
  </STYLE>
 </HEAD>
<body>

...

	<table style='Z-INDEX: 100; POSITION: absolute' align='center'>
	 <TR>
	  <TD align="center">
	   <IMG style="CURSOR: hand" onclick='javascript:printDiv()' alt="프린트" src="../../image/print.gif">
	   <IMG style="CURSOR: hand" onclick="javascript:self.close()" alt="창닫기" src="../../image/winclose.gif">
	   <IMG style="CURSOR: hand" onclick="javascript:Preview()" src="../../image/btn_printt.gif"
		alt="프린터 설정">
	  </TD>
	 </TR>
	</table>
   </DIV>
   <DIV id="objSelection"><FONT face="굴림"></FONT></DIV>
</body>
</HTML>