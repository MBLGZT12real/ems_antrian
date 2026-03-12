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
	
	$(document).ready(function () {
		// ==== REGEX ====
		const regexText = /^[A-Za-z0-9\s.,\/-]+$/;
		const regexNumber = /^[0-9]+$/;
		const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

		// ==== UNIVERSAL VALIDATOR ====
		function validateInput($input, condition, message) {
			const isSelect2 = $input.hasClass('select2');
			const $feedback = isSelect2
				? $input.nextAll('.invalid-feedback')
				: $input.next('.invalid-feedback');
			
			if (!condition) {
				if (isSelect2) {
					$input.next('.select2-container').css('border', '1px solid #dc3545');
					if ($feedback.length === 0) {
						$input.next('.select2-container').after(`<div class="invalid-feedback">${message}</div>`);
					} else {
						$feedback.text(message);
					}
				} else {
					$input.addClass("is-invalid");
					if ($feedback.length === 0) {
						$input.after(`<div class="invalid-feedback">${message}</div>`);
					} else {
						$feedback.text(message);
					}
				}
				return false;
			} else {
				if (isSelect2) {
					$input.next('.select2-container').css('border', '');
					$input.nextAll('.invalid-feedback').remove();
				} else {
					$input.removeClass("is-invalid");
					$input.next(".invalid-feedback").remove();
				}
				return true;
			}
		}

		// ==== REAL-TIME VALIDATION ====
		$("#panggilan, #fullname, #company").on("input blur", function () {
			validateInput($(this), regexText.test(this.value), "Only letters, numbers, space, dot, comma, slash or dash allowed.");
		});
		$("#email").on("input blur", function () {
			validateInput($(this), regexEmail.test(this.value), "Please enter a valid email address.");
		});
		$("#telepon").on("input blur", function () {
			validateInput($(this), regexNumber.test(this.value) && this.value.length <= 20, "Numeric only, max 20 digits.");
		});
		$("#total").on("input blur", function () {
			validateInput($(this), regexNumber.test(this.value) && this.value.length <= 4, "Numeric only, max 4 digits.");
		});
		
		// ==== REAL-TIME UNTUK SELECT ====
		$(document).on('change', '.select2', function () {
			const $el = $(this);
			let msg = "This field is required.";
			if ($el.attr("id") === "typeantri") msg = "Please select your type antrian.";
			if ($el.attr("id") === "kirimvia") msg = "Please select your kirim via.";

			let valid = $el.val() && $el.val().length > 0;
			validateInput($el, valid, msg);
		});

		// ==== FINAL VALIDATION ON SUBMIT ====
		$("#formRegister").on("submit", function (e) {
			let valid = true;

			// Text inputs
			valid &= validateInput($("#panggilan"), regexText.test($("#panggilan").val()), "Only letters, numbers, space, dot, comma, slash or dash allowed.");
			valid &= validateInput($("#fullname"), regexText.test($("#fullname").val()), "Only letters, numbers, space, dot, comma, slash or dash allowed.");
			valid &= validateInput($("#company"), regexText.test($("#company").val()), "Only letters, numbers, space, dot, comma, slash or dash allowed.");
			valid &= validateInput($("#email"), regexEmail.test($("#email").val()), "Please enter a valid email address.");
			valid &= validateInput($("#telepon"), regexNumber.test($("#telepon").val()) && $("#telepon").val().length <= 20, "Numeric only, max 20 digits.");
			valid &= validateInput($("#total"), regexNumber.test($("#total").val()) && $("#total").val().length <= 4, "Numeric only, max 20 digits.");
			
			// Selects
			valid &= validateInput($("#typeantri"), $("#typeantri").val() !== "", "Please select your type antrian.");
			valid &= validateInput($("#kirimvia"), $("#kirimvia").val() !== "", "Please select your kirim via.");

			// Jika error
			if (!valid) { 
				e.preventDefault();
				Swal.fire("Check your input!", "Some fields are invalid or incomplete.", "warning");
			}
		});
	});

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