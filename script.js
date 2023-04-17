function generateCaptcha() {
	const chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	let captcha = '';
	for (let i = 0; i < 6; i++) {
	  captcha += chars.charAt(Math.floor(Math.random() * chars.length));
	}
	return captcha;
  }
  
  function createCaptchaImage(captcha) {
	const canvas = document.createElement('canvas');
	const ctx = canvas.getContext('2d');
	canvas.width = 400;
	canvas.height = 50;
  
	
	ctx.fillStyle = '#222';
	ctx.fillRect(0, 0, canvas.width, canvas.height);
  
	// Add the characters of the captcha to the canvas
	ctx.font = 'bold 30px Arial';
	for (let i = 0; i < captcha.length; i++) {
	  const character = captcha.charAt(i);
	  
	  const x = 120 + i * 25;
	  const y = 30;
	  const angle = 0;
  
	  // Save the current state of the context before transforming it
	  ctx.save();
  
	  // Translate and rotate the context
	  ctx.translate(x, y);
	  ctx.rotate(angle);
  
	  // Add the character to the canvas
	  ctx.fillStyle = '#fff';
	  ctx.fillText(character, 0, 0);
  
	  // Restore the previous state of the context
	  ctx.restore();
	}
  

	return canvas.toDataURL();
  }
  
  const captcha = generateCaptcha();
  const captchaImage = document.getElementById('captcha-image');
  const captchaInput = document.getElementById('captcha-input');
  captchaImage.src = createCaptchaImage(captcha);
  let answer = captcha.toLowerCase();

  function validateCaptcha() {
	if (captchaInput.value.toLowerCase() === answer) {
	//  document.body.style.backgroundColor = '#0f0';
	  setTimeout(function() {
	//	document.body.style.backgroundColor = '#444';
		const newCaptcha = generateCaptcha();
		captchaImage.src = createCaptchaImage(newCaptcha);
		answer = newCaptcha.toLowerCase();

	
		captchaInput.value = '';
		// redirect to the new page
		window.location.href = 'login_form.php';
	  }, 1000);
	} else {
	  captchaInput.value = '';
	}
  }
