<?=$temp['header_up']?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?=$temp['header_down']?>

<?=form_open_multipart("test/post") ?>
<div class="g-recaptcha" data-sitekey="6LcXlggTAAAAAI2saLwZojE3JlQJGkAxG28b19Kx"></div>
<input type="submit">
</form>

<?=$temp['footer']?>