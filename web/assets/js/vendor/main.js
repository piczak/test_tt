function fnEditableText(e) {

}

//Add working conditions
$(document).on('click', '#add-work', function() {
    for(var i=0; i<1; i++) {
            $('.work-empty tr').last().clone().appendTo('.work-empty');
    }





    //change increment number in the string
//    var ngshow = $('.work-empty tr').last().find('.overlay-show').attr('ng-show').replace(/\d/, function(n){ return ++n });
//
//    $('.work-empty tr').last().find('.overlay-show').removeClass('ng-hide').attr('ng-show', ngshow);

//    var id = $('.work-empty tr').last().find('.form-control').attr('id').replace(/\d/, function(n){ return ++n });
//
//    $('.work-empty tr').last().find('.form-control').attr('id', id);

//    var name = $('.work-empty tr').last().find('.form-control').attr('name').replace(/\d/, function(n){ return ++n });
//
//    $('.work-empty tr').last().find('.form-control').attr('name', name);

//    $('.work-empty tr').last().find('.only-text').attr('ng-click', ngshow+' = !'+ngshow);

    //alert(string+number);
//    var ng = $.element.find('.overlay-show').attr('ng-show');
//    alert(ng);

});

$(document).ready(function() {
	$('[data-toggle="popover"]').popover();
	//switch html text to input form
	$('.text-input').click(fnEditableText);

	var trigger = $('.hamburger'),
	  overlay = $('.overlay'),
	 isClosed = false;

	trigger.click(function () {
	  hamburger_cross();
	});

	function hamburger_cross() {

	  if (isClosed == true) {
		overlay.hide();
		trigger.removeClass('is-open');
		trigger.addClass('is-closed');
		isClosed = false;
	  } else {
		overlay.show();
		trigger.removeClass('is-closed');
		trigger.addClass('is-open');
		isClosed = true;
	  }
  }

  $('[data-toggle="offcanvas"]').click(function () {
		$('.wrapper').toggleClass('toggled');
  });

	var adjustment;

	$("ul.productlist").sortable({
	  group: 'productlist',
	  handle: '.drag-handle',
	  itemSelector: 'a',
	  isValidTarget: function  ($item, container) {
		if($item.is(".make-default"))
		  return true;
		else
		  return $item.parent(".productlist")[0] == container.el[0];
	  },
	  onDrop: function ($item, container, _super) {
		$item.removeClass("make-default");
    	_super($item, container);
	  },
	  // set $item relative to cursor position
	  onDragStart: function ($item, container, _super) {
		var offset = $item.offset(),
			pointer = container.rootGroup.pointer;

		adjustment = {
		  left: pointer.left - offset.left,
		  top: pointer.top - offset.top
		};

		_super($item, container);
	  },
	  onDrag: function ($item, position) {
		$item.css({
		  left: position.left - adjustment.left,
		  top: position.top - adjustment.top
		});
	  }
	});

	$("ul.modellist").sortable({
	  group: 'modellist',
	  handle: '.drag-handle',
	  itemSelector: 'a',
	  isValidTarget: function  ($item, container) {
		if($item.is(".make-default"))
		  return true;
		else
		  return $item.parent(".modellist")[0] == container.el[0];
	  },
	  onDrop: function ($item, container, _super) {
		$item.removeClass("make-default");
    	_super($item, container);
	  },
	  // set $item relative to cursor position
	  onDragStart: function ($item, container, _super) {
		var offset = $item.offset(),
			pointer = container.rootGroup.pointer;

		adjustment = {
		  left: pointer.left - offset.left,
		  top: pointer.top - offset.top
		};

		_super($item, container);
	  },
	  onDrag: function ($item, position) {
		$item.css({
		  left: position.left - adjustment.left,
		  top: position.top - adjustment.top
		});
	  }
	});

	$("ul.tierlist").sortable({
	  group: 'tierlist',
	  handle: '.drag-handle',
	  itemSelector: 'a',
	  isValidTarget: function  ($item, container) {
		if($item.is(".make-default"))
		  return true;
		else
		  return $item.parent(".tierlist")[0] == container.el[0];
	  },
	  onDrop: function ($item, container, _super) {
		$item.removeClass("make-default");
    	_super($item, container);
	  },
	  // set $item relative to cursor position
	  onDragStart: function ($item, container, _super) {
		var offset = $item.offset(),
			pointer = container.rootGroup.pointer;

		adjustment = {
		  left: pointer.left - offset.left,
		  top: pointer.top - offset.top
		};

		_super($item, container);
	  },
	  onDrag: function ($item, position) {
		$item.css({
		  left: position.left - adjustment.left,
		  top: position.top - adjustment.top
		});
	  }
	});

	//Add new model
	$('#addModel').click(function() {
		for(var i=0; i<1; i++) {
			$('.modellist .list-group-item').first().clone().appendTo('.modellist-wrap').css('display','block');
		}

		$('.modellist .list-group-item').find('.form-control').keypress(function(e) {
			if(e.which == 13) {
				var objTxt = $(this).parent();
				objTxt.html($(this).val());
				objTxt.click(fnEditableText);
			}
		});
		$('.form-control').focus();
		$('.list-group-item span.slide-swipe').on('click', function(event) {
			event.preventDefault();
			$(this).parent('a.list-group-item').toggleClass('open');
		});
	});
});

Ladda.bind( '.btn.ladda-button', {
	callback: function( instance ) {
		var progress = 0;
		var interval = setInterval( function() {
			progress = Math.min( progress + Math.random() * 0.1, 1 );
			instance.setProgress( progress );

			if( progress === 1 ) {
				instance.stop();
				window.location.reload();
				clearInterval( interval );
			}
		}, 200 );
	}
} );

Ladda.bind( '.cache.ladda-button', {
	callback: function( instance ) {
		var progress = 0;
		var interval = setInterval( function() {
			progress = Math.min( progress + Math.random() * 0.1, 1 );
			instance.setProgress( progress );
			$('.ladda-label i').addClass('fa-spin');

			if( progress === 1 ) {
				instance.stop();
				$('.ladda-label i').removeClass('fa-spin');
				window.location.reload();
				clearInterval( interval );
			}
		}, 200 );
	}
} );

Ladda.bind( '#map-btn.ladda-button', {
	callback: function( instance ) {
		var progress = 0;
		var interval = setInterval( function() {
			progress = Math.min( progress + Math.random() * 0.1, 1 );
			instance.setProgress( progress );

			if( progress === 1 ) {
				instance.stop();
				$('#map-alert').modal();
				clearInterval( interval );
			}
		}, 200 );
	}
} );

Ladda.bind( '#alert-publish.ladda-button', {
	callback: function( instance ) {
		var progress = 0;
		var interval = setInterval( function() {
			progress = Math.min( progress + Math.random() * 0.1, 1 );
			instance.setProgress( progress );

			if( progress === 1 ) {
				instance.stop();
				$('#publish-success').modal('show');
				$('#publish-alert').modal('hide');
				clearInterval( interval );
			}
		}, 200 );
	}
} );