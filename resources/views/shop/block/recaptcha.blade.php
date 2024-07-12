<script src="https://www.google.com/recaptcha/api.js?render={{config('app.recaptcha_key')}}"></script>
<script>
grecaptcha.ready(function ()
{
	grecaptcha.execute('{{config('app.recaptcha_key')}}', { action:   'register' }).then(function (token)
	{
		var recaptchaResponse = document.getElementById('recaptchaResponse');
		recaptchaResponse.value = token;
	});
});
</script>