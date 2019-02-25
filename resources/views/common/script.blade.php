<!-- Latest jQuery -->
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Bootstrap jQuery -->
<script src="/js/bootstrap.min.js"></script>
<script src="/js/parsley.min.js"></script>
 

<!-- Opacity & Other IE fix for older browser -->
<!--[if lte IE 8]>
	<script type="text/javascript" src="js/ie-opacity-polyfill.js"></script>
<![endif]-->
@stack('before-main-js')
<script src="/js/main.js"></script>
@stack('js')