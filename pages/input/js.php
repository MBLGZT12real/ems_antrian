<script type="text/javascript">
	function pilihtype(e) {
		var type = document.getElementById("typeantri").value;
		
		if (type=="B") {
			document.getElementById("kirimvia").value = "FOTO LANGSUNG";
			document.getElementById("total").focus();
		} else {
			document.getElementById("kirimvia").value = "";
			document.getElementById("kirimvia").focus();
		}
	}
	
	function extractword(str, start, end) {
		let string = str.substring(
			str.indexOf(start) + 1,
			str.lastIndexOf(end)
		);
		return string;
	}
	
	$(document).on("submit", "#saveData", function(e) {
		e.preventDefault();
		var formData = new FormData(this);
		formData.append('type', 'save');

		$.ajax({
			url: 'pages/input/action.php',
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				if (result.success === true) {
					Swal.fire({
						title: 'Screenshot Ya!',
						icon: 'success',
						html: result.message,
						showCancelButton: false,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						confirmButtonText: "Sudah!"
					}).then((result) => {
						setTimeout(function(){
						   window.location.reload();
						}, 500);
					});
					
					//alert("Data antrian berhasil disimpan");
					//alert(result.message);
				} else {
					alert(result.message);
				}
			},
		});
	});
</script>