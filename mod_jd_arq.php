<?php
defined('_JEXEC') or die;

include_once __DIR__ . '/helper.php';

// Instantiate global document object
$doc = JFactory::getDocument();

$js = <<<JS
(function ($) {
	
    $(document).on('click', 'input[type=submit]', function () {
		var value   = $('input[name=data]').val(),
            request = {
                    'option' : 'com_ajax',
                    'module' : 'ajax_search',
                    'data'   : value,
                    'format' : 'raw'
                };
        $.ajax({
            type   : 'POST',
            data   : request,
			beforeSend: function () {
				$(".search-results").append("Procesando, espere por favor...<br>");
			},
			error:  function (response) {
                $(".search-results").append('Error ajax: '+response.statusText );
			},
            success: function (response) {
                $('.search-results').html(response);
            }
        });
        return false;
    });
})(jQuery)
JS;

$doc->addScriptDeclaration($js);

require JModuleHelper::getLayoutPath('mod_jd_arq');