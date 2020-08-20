//js-scroll-trigger
$(function () {
  "use strict";

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 56)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });
  $('body').scrollspy({
    target: '#mainNav',
    offset: 56
  });
});

//Extra template functionality
$(function () {
	var w = (1110 - 52 - 114 - 104) / 3;
	var toolbarOptions = [
		['bold', 'italic', 'underline', 'strike'],
		['blockquote', 'code-block', 'link'],
		[{ 'size': 'huge' }, { 'size': 'large' }, { 'size': 'small' }],
		[{ 'list': 'ordered'}, { 'list': 'bullet' }],
		[{ 'script': 'sub'}, { 'script': 'super' }],
		[{ 'indent': '-1'}, { 'indent': '+1' }],
		[{ 'direction': 'rtl' }],
		[{ 'header': [3, 4, 5, 6, false] }],
		[{ 'color': [] }, { 'background': [] }],
		[{ 'align': [] }],
		['clean']
	];
	var quill = new Quill('[id="form_content"]', {
		modules: {
			toolbar: toolbarOptions
		},
		theme: 'snow'
	});
	$('[name="form_submit"]').click(function() {
		var c = $('[class="ql-editor"]').html();
		$('[name="form_content"]').val(c);
	});
	$('[data-toggle="popover"]').popover();
	$('[data-toggle="popover"]').css('cursor', 'pointer');
	$('[data-table="dashboard"]').DataTable({
		"pagingType": "full_numbers",
		"autoWidth": false,
		"columnDefs": [
			{"width": w.toString(), "targets": [1, 2, 3]} //Somehow this fixes the overflow bug.
		],
		"ordering": false,
		"lengthMenu": [5, 10, 25, 50, 100]
	});
	$('.dataTables_length').addClass('bs-select');
	new WOW({
		boxClass:     'wow',
		animateClass: 'animated',
		offset:       0,
		mobile:       true,
		live:         true //This might make some animation issues
	}).init();
})