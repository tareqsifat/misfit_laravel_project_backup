<style>
	.otp-form {
		background-color: #ffffff;
		border-radius: 8px;
		padding: 20px;
		/* box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); */
		text-align: center;
		max-width: 400px;
		width: 100%;
	}

	h2 {
		margin-bottom: 20px;
		color: #333;
	}

	/* OTP input styles */
	.otp-container,
	.email-otp-container {
		display: flex;
		justify-content: center;
		margin-top: 20px;
	}

	.otp-input,
	.email-otp-input {
		width: 40px;
		height: 40px;
		text-align: center;
		font-size: 18px;
		margin: 0 5px;
		border: 1px solid #c3c1c1;
		border-radius: 4px;
		outline: none;
		transition: border-color 0.3s;
	}

	.otp-input:focus,
	.email-otp-input:focus {
		border-color: #007bff;
	}

	#verificationCode,
	#emailverificationCode {
		width: 100%;
		margin-top: 15px;
		padding: 10px;
		font-size: 14px;
		border: 1px solid #ccc;
		border-radius: 4px;
		outline: none;
		transition: border-color 0.3s;
	}

	#verificationCode:focus,
	#emailverificationCode:focus {
		border-color: #007bff;
	}
	.email-otp {
		margin-top: 25px;
	}
	/* Button styles */
	button {
		margin-top: 15px;
		background-color: #007bff;
		color: #fff;
		border: none;
		border-radius: 4px;
		padding: 10px 20px;
		font-size: 16px;
		cursor: pointer;
		transition: background-color 0.3s;
	}

	button:hover {
		background-color: #0056b3;
	}
	.mobile-otp .otp-container .otp-input{
		border: 1px solid #c3c1c1!important;
	}
</style>

<div class="modal fade" id="Otp_submit_modal" tabindex="-1" role="dialog" aria-labelledby="Otp_submit_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Otp_submit_modalLabel">Submit Your Otp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="otp-form">
                    <!-- Mobile OTP Form -->
                    <form class="mobile-otp Otp_submit_form" action="{{ route('otp_verification') }}" method="POST">
						@csrf
                        <h2>OTP Verification</h2>
                        <div class="otp-container">
                            <!-- Six input fields for OTP digits -->
                            <input type="text" class="otp-input" pattern="\d" maxlength="1" />
                            <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled />
                            <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled />
                            <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled />
                            <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled />
                            <input type="text" class="otp-input" pattern="\d" maxlength="1" disabled />
                        </div>

                        <!-- Field to display entered OTP -->
                        <input type="text" id="verificationCode" class="d-none" name="otp" placeholder="Enter verification code" readonly />

                        <!-- Button to verify OTP -->
                        <button type="submit" id="verifyMobileOTP">VERIFY &amp; PROCEED</button>
                    </form>

                    {{-- <!-- Email OTP Form -->
                    <form class="email-otp">
                        <h2>Email OTP</h2>
                        <div class="email-otp-container">
                            <!-- Six input fields for OTP digits -->
                            <input type="text" class="email-otp-input" pattern="\d" maxlength="1" />
                            <input type="text" class="email-otp-input" pattern="\d" maxlength="1" disabled />
                            <input type="text" class="email-otp-input" pattern="\d" maxlength="1" disabled />
                            <input type="text" class="email-otp-input" pattern="\d" maxlength="1" disabled />
                            <input type="text" class="email-otp-input" pattern="\d" maxlength="1" disabled />
                            <input type="text" class="email-otp-input" pattern="\d" maxlength="1" disabled />
                        </div>

                        <!-- Field to display entered OTP -->
                        <input type="text" id="emailverificationCode" placeholder="Enter verification code" readonly />

                        <!-- Button to verify OTP -->
                        <button type="button" id="verifyEmailOTP">VERIFY &amp; PROCEED</button>
                    </form> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>




<script>
	document.addEventListener("DOMContentLoaded", function () {
		var otpInputs = document.querySelectorAll(".otp-input");
		var emailOtpInputs = document.querySelectorAll(".email-otp-input");

		function setupOtpInputListeners(inputs) {
			inputs.forEach(function (input, index) {
				input.addEventListener("paste", function (ev) {
					var clip = ev.clipboardData.getData("text").trim();
					if (!/^\d{6}$/.test(clip)) {
						ev.preventDefault();
						return;
					}

					var characters = clip.split("");
					inputs.forEach(function (otpInput, i) {
						otpInput.value = characters[i] || "";
					});

					enableNextBox(inputs[0], 0);
					inputs[5].removeAttribute("disabled");
					inputs[5].focus();
					updateOTPValue(inputs);
				});

				input.addEventListener("input", function () {
					var currentIndex = Array.from(inputs).indexOf(this);
					var inputValue = this.value.trim();

					if (!/^\d$/.test(inputValue)) {
						this.value = "";
						return;
					}

					if (inputValue && currentIndex < 5) {
						inputs[currentIndex + 1].removeAttribute("disabled");
						inputs[currentIndex + 1].focus();
					}

					if (currentIndex === 4 && inputValue) {
						inputs[5].removeAttribute("disabled");
						inputs[5].focus();
					}

					updateOTPValue(inputs);
				});

				input.addEventListener("keydown", function (ev) {
					var currentIndex = Array.from(inputs).indexOf(this);

					if (!this.value && ev.key === "Backspace" && currentIndex > 0) {
						inputs[currentIndex - 1].focus();
					}
				});
			});
		}

		function enableNextBox(input, currentIndex) {
			var inputValue = input.value;

			if (inputValue === "") {
				return;
			}

			var nextIndex = currentIndex + 1;
			var nextBox = otpInputs[nextIndex] || emailOtpInputs[nextIndex];

			if (nextBox) {
				nextBox.removeAttribute("disabled");
			}
		}

		function updateOTPValue(inputs) {
			var otpValue = "";

			inputs.forEach(function (input) {
				otpValue += input.value;
			});

			if (inputs === otpInputs) {
				document.getElementById("verificationCode").value = otpValue;
			} else if (inputs === emailOtpInputs) {
				document.getElementById("emailverificationCode").value = otpValue;
			}
		}

		setupOtpInputListeners(otpInputs);
		setupOtpInputListeners(emailOtpInputs);

		otpInputs[0].focus(); // Set focus on the first OTP input field
		emailOtpInputs[0].focus(); // Set focus on the first email OTP input field

		otpInputs[5].addEventListener("input", function () {
			updateOTPValue(otpInputs);
		});

		emailOtpInputs[5].addEventListener("input", function () {
			updateOTPValue(emailOtpInputs);
		});
	});
</script>