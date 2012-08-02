// JavaScript Document
$(document).ready(function(){
	prepareFormSubmits();					   
});

function prepareFormSubmits() {
	// button clicks are programatically captured as form submits...apparently
	$('button.btn-primary').click(function(){
		var curform=$(this).closest('form');
		//alert(''+$(curform).attr('name')+' submitted');
		$.post($(curform).attr('action'), $(curform).serialize(), function(r) {
			// ensuring idempotence
			$('.help-inline').remove();
			$('.control-group').removeClass('error success');
			// current control will pass the name of next control (function) if successful
			if (!r.nextControl) {
				// handle errors
				$.each(r, function(inputname,errmsg) {
					// :input gets inputs, buttons, selects
					var curinput = $(":input[name='"+inputname+"']",$(curform));
					$(curinput).after("<span class='help-inline'>"+errmsg+"</span>")
						.parent().parent().addClass('error');
				});
				if (r.nonValidationError) {
					$('button',$(curform)).removeClass('btn-primary btn-success').addClass('btn-danger').text('Connection Failed, Adjust Values and Try Again');
				}
			}
			// display successes
			$('.control-group', $(curform)).not('.error').each(function() {
				$(this).addClass('success');
				$(this).find(':input')
					.after("<span class='help-inline'><strong>VALID</strong></span>");
			});
			
			// fire next Controller
			if (r.nextControl) {
				$('button',$(curform)).removeClass('btn-primary btn-danger').addClass('btn-success');	
				fireNextController(r.nextControl, r.nextSection, r.resubmit);
			}
		}, "json");
	});
	$('form').submit(function(){ 
		return false;
	});
}

function fireNextController(nextControl, nextSection, resubmit) {
	// display the next Section
	// $('section').addClass('hidden');
	// $('#'+nextSection+'').removeClass('hidden');
	// call function defined here by name from controller
	var ncfn = window[nextControl]; // ncfn = nextControlFunctioN
	if (typeof ncfn === 'function') {
		ncfn(resubmit);	
	}
}

/* ----------------------- intermediate functions ------------------------ */

function populateSelectDB(option) {
	var prevform	=	$('form[name="attemptDBConnection"]');
	var curform		=	$('form[name="populateSelectDB"]');
	var nextform	= 	$('form[name="specifyCDU"]');
	$.post($(curform).attr('action'), $(prevform).serialize(), function(r) {
		var dbselect = $('select[name="dbselect"]', $(nextform));
		$(dbselect).empty();
		$.each(r, function(i,db) {
			$(dbselect).append('<option>'+db+'</option>');
		});
		activateDatabaseOptions($(dbselect));
	}, "json");
}

function activateDatabaseOptions(select) {
	var prevform	=	$('form[name="attemptDBConnection"]');
	var curform		= 	$('form[name="specifyCDU"]');
	var nextform	= 	$('form[name="populateSelectTable"]');
	$(select).unbind('change').change(function() {
		var database = $(this).val();
		$.post($(nextform).attr('action'), ''+$(prevform).serialize()+'&dbselect='+database+'', function(r) {
			var tableselect = $('select[name="tableselect"]', $(curform));
			$(tableselect).empty();
			$.each(r, function(i,table) {
				$(tableselect).append('<option>'+table+'</option>');
			});
			activateTableOptions($(tableselect));			
		}, "json");
	});
}

function activateTableOptions(select) {
	var prevform	=	$('form[name="attemptDBConnection"]');
	var curform		= 	$('form[name="specifyCDU"]');
	var nextform	= 	$('form[name="populateSelectColumn"]');
	$(select).unbind('change').change(function() {
		var database 	= $('select[name="dbselect"]',$(curform)).val();
		var table 		= $(this).val();
		
		$.post($(nextform).attr('action'), ''+$(prevform).serialize()+'&dbselect='+database+'&tableselect='+table+'', function(r) {
			var columnselect = $('select[name="columnselect"]', $(curform));
			$(columnselect).empty();
			$.each(r, function(i,column) {
				$(columnselect).append('<option>'+column.name+'</option>');
			});			
		}, "json");
	});
}

/* -------------------------- utility functions -------------------------- */

function enableKeyCode(obj, f, actionKeyCode) {
	$(obj).bind('keydown', function(e) {
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == actionKeyCode) {
			f();
		}
	}); // that...is nice.
}