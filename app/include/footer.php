<footer class="footer">
  <div class="container">
    <span class="copyright">© 2023 Unico</span>
    <div class="rights-wrapper">
      <a href="#" class="privacy-policy">Privacy Policy</a>
      <a href="#" class="terms-n-conditions">Terms and Conditions</a>
    </div>
  </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>

<script>
let inputs = document.querySelectorAll('.input__file');
Array.prototype.forEach.call(inputs, function(input) {
  let label = input.nextElementSibling,
    labelVal = label.querySelector('.input__file-button-text').innerText;

  input.addEventListener('change', function(e) {
    let countFiles = '';
    if (this.files && this.files.length >= 1)
      countFiles = this.files.length;

    if (countFiles)
      label.querySelector('.input__file-button-text').innerText = 'Number of files:' + countFiles;
    else
      label.querySelector('.input__file-button-text').innerText = labelVal;
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="assets/js/nouislider.min.js"></script>
<script src="assets/js/calendar.js"></script>

<script src="assets/js/wow.min.js"></script>
<script>
new WOW().init();
</script>
<script src='assets/js/script.js'></script>
<script src="assets/js/main.js"></script>
</body>

</html>