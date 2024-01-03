<!-- The text field -->
<input type="text" value="Hello World" id="myInput">

<!-- The button used to copy the text -->
<button onclick="myFunction()">Copy text</button>

<script>
// input 또는 textarea의 값을 클립보드는 복사
function myFunction() {
	// Get the text field
	var copyText = document.getElementById("myInput");

	// Select the text field
	copyText.select();
	copyText.setSelectionRange(0, 99999); // For mobile devices

	// Copy the text inside the text field
	navigator.clipboard.writeText(copyText.value);
}
</script>