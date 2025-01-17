var modalWindow = {
	parent:"body",
	windowId:null,
	content:null,
	width:null,
	height:null,
	left:null,
	right:null,
	top:null,
	bigmodal:null,
	close:function()
	{
		jQuery(".guru-modal").remove();
		jQuery(".modal-overlay").remove();
	},
	open:function()
	{
		modal_style = "";
		if(this.width != null && this.width != 0){
			screen_width = window.innerWidth;
			screen_height = window.innerHeight;
	
			modal_style = 'style="display:block;"';
		}
		else{
			screen_width = window.innerWidth;
			screen_height = window.innerHeight;
			
			modal_style = 'style="display:block;"';
		}
		
		var modal = "";
		modal += "<div class=\"modal-overlay\"></div>";
		modal += "<div class=\"guru-modal p_modal\" id=\"" + this.windowId + "\">";
		modal += "<div class=\"guru-modal-header\"></div>";
		modal += "<div class=\"guru-modal-dialog\" "+modal_style+">";
		modal += "<div class=\"guru-modal-content\">";
		modal += this.content;
		modal += "</div>";
		modal += "</div>";
		modal += "</div>";
		jQuery(this.parent).append(modal);


		jQuery(".guru-modal-dialog").append("<a class=\"close-window\" id=\"close-window\"></a>");
		jQuery(".close-window").click(function(){modalWindow.close();});
		jQuery(".modal-overlay").click(function(){modalWindow.close();});
		jQuery(".guru-modal").click(function(){modalWindow.close();});
	}
};

var openMyModal = function(width, height, source){
	modalWindow.windowId = "myModal";

	iframe_style = "";
	
	if(width != 0 && height != 0){
		screen_width = window.innerWidth;
		screen_height = window.innerHeight;
		
		modalWindow.width = width;
		modalWindow.height = height;
		
		iframe_style = 'style="width:'+width+'px; height:'+height+'px;"';
	}
	else{
		modalWindow.width = 0;
		modalWindow.height = 0;
		iframe_style = 'style=""';
	}

	modalWindow.content = "<iframe "+iframe_style+" id='g_preview' class='pub_modal_frame' src='" + source + "'>content</iframe>";
	modalWindow.open();
};

(function( window, $ ) {

	var $html = $('html');
	var $win = $( window );
	var $doc = $( document.body );
	var $modal;
	var cache, params;

	function createModal(source) {
		var html = '';
		var shownav = 'shownav';
		var fontello_right_open = 'fontello-right-open';
		
		if (window.matchMedia("(max-width: 700px)").matches) {
			// small device
			shownav = "";
			fontello_right_open = 'fontello-left-open';
		}
		
		// wrapper (start)
		html += '<div class="guru-lesson ' + shownav + '">';
		// header
		html += '<div class=guru-lesson-header>';
		html += '<div class=guru-lesson-header-l>';
		html += '<div class=guru-lesson-header-label></div>';
		html += '</div>';
		html += '<div class=guru-lesson-header-r>';
		html += '<a href="javascript:" class=guru-lesson-home><i class=fontello-cancel></i></a>';
		html += '<a href="javascript:" class=guru-lesson-togglenav><i class=' + fontello_right_open + '></i></a>';
		html += '</div>';
		html += '</div>';
		// content
		html += '<div class=guru-lesson-content>';
		html += '<iframe id=frame-lesson-content webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder=0 style="width:100%;height:100%;"></iframe>';
		html += '<div class=guru-lesson-loading><div class=guru-lesson-spinner></div></div>';
		html += '</div>';
		// footer
		html += '<div id=guru-lesson-footer class=guru-lesson-footer>';
		html += '<div class=guru-lesson-footer-nav>';
		html += '<button class=guru-lesson-footer-prev style="display:none"><i class=fontello-left-open></i> '+prev_lang+'</button> ';
		html += '<button class=guru-lesson-footer-next style="display:none">'+next_lang+' <i class=fontello-right-open></i></button>';
		html += '</div>';
		html += '</div>';
		// sidebar
		html += '<div class=guru-lesson-nav>';
		html += '<div class=guru-lesson-nav-tab>';
		html += '<a href="javascript:" data-id=lessons class="guru-lesson-nav-tabitem active"><i class=fontello-th-list></i></a>';
		html += '<a href="javascript:" data-id=description class="guru-lesson-nav-tabitem"><i class=fontello-doc-text-inv></i></a>';
		
		html += '<a id="comments-button" style="display:none;" href="javascript:" data-id=comments class="guru-lesson-nav-tabitem"><i class=fontello-chat></i></a>';
		
		html += '</div>';
		html += '<div class="guru-lesson-nav-content guru-lesson-nav-lessons"></div>';
		html += '<div class="guru-lesson-nav-content guru-lesson-nav-description"></div>';
		html += '<div class="guru-lesson-nav-content guru-lesson-nav-comments"></div>';
		html += '</div>';
		// wrapper (end)
		html += '</div>';

		$modal = $( html );
		$modal.find('.guru-lesson-home').on('click', destroyWindow );
		$modal.find('.guru-lesson-togglenav').on('click', toggleNav );
		$modal.find('.guru-lesson-footer-prev').on('click', prevLesson );
		$modal.find('.guru-lesson-footer-next').on('click', nextLesson );
		$modal.find('.guru-lesson-nav-tab a').on('click', toggleNavTab );
		$modal.on('click', '.guru-lesson-nav-lesson', showLesson );
		$html.css('overflow', 'hidden');

		var isIOS = ( /iphone|ipad|ipod/i ).test( navigator.userAgent );

		// Fix iOS issue
		// http://stackoverflow.com/questions/35879449/iframe-cannot-scroll-because-of-setting-height-in-css
		if ( isIOS ) {
			$modal.find('.guru-lesson-content').css({
				'overflow-x': 'auto',
				'-webkit-overflow-scrolling': 'touch'
			});
		}

		$doc.append( $modal );

		var isGetSidebar;

		// loading
		isIOS && $html.css('position', 'fixed');
		$modal.find('iframe').one('load', function() {
			$modal.find('.guru-lesson-loading').fadeOut();
			if ( !isGetSidebar ) {
				getSidebarContent();
				getComments( params.cid );
				isGetSidebar = true;
			}
			moveJumpButtons();
			isIOS && $html.css('position', '');

			setTimeout(function() {
				lessons_not_viewed = document.getElementsByClassName("not-view");
			
				if(lessons_not_viewed.length == 0){
					$(".redirect-lesson").show();
				}
			}, 2000 );

		}).attr('src', source );

		setTimeout(function() {
			if ( !isGetSidebar ) {
				getSidebarContent();
				getComments( params.cid );
				isGetSidebar = true;
			}
		}, 5000 );
	}

	function destroyWindow() {
		$html.css('overflow', '');
		$win.off('resize.guru-lesson');
		$modal.remove();
		$modal = null;
	}

	function toggleNav( e ) {
		var $btn = $( e.currentTarget );

		if ( $modal.hasClass('shownav') ) {
			$modal.removeClass('shownav');
			$btn.find('i').attr('class', 'fontello-left-open');
		} else {
			$modal.addClass('shownav');
			$btn.find('i').attr('class', 'fontello-right-open');
		}
	}

	function prevLesson() {
		if ( !cache ) {
			return;
		}

		var $lessons = $modal.find('.guru-lesson-nav-lessons'),
			$current = $lessons.find('.guru-lesson-nav-current'),
			$accessible, index;

		if ( !$current.length ) {
			return;
		}

		$accessible = $lessons.find('.guru-lesson-nav-accessible');
		index = $accessible.index( $current );

		if ( index > 0 ) {
			$accessible.eq( index - 1 ).click();
		}
	}

	function nextLesson() {
		if ( !cache ) {
			return;
		}

		var $lessons = $modal.find('.guru-lesson-nav-lessons'),
			$current = $lessons.find('.guru-lesson-nav-current'),
			$accessible;

		if ( !$current.length ) {
			return;
		}

		$accessible = $lessons.find('.guru-lesson-nav-accessible');
		index = $accessible.index( $current );
		
		if ( index < $accessible.length - 1 ) {
			$accessible.eq( index + 1 ).click();
		}
	}

	function updateLessonNav(index, max) {
		if ( index <= 0 ) {
			$modal.find('.guru-lesson-footer-prev').hide();
		} else {
			$modal.find('.guru-lesson-footer-prev').show();
		}

		if ( index >= max - 1 ) {
			$modal.find('.guru-lesson-footer-next').hide();
		} else {
			$modal.find('.guru-lesson-footer-next').show();
		}
	}

	function toggleNavTab( e ) {
		var $btn = $( e.currentTarget ),
			id = $btn.data('id'),
			$content = $('.guru-lesson-nav-' + id ),
			$siblings = $content.siblings('.guru-lesson-nav-content');

		$siblings.hide();
		$content.show();
		$btn.addClass('active').siblings('.active').removeClass('active');
	}

	function getSidebarContent() {
		var url = params.uri + 'index.php?option=com_guru&controller=guruTasks&pid=' + params.pid + '&cid=' + params.pid + '&task=get_lessons&ajax=1&Itemid=' + params.item_id;
		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			success: function( resp ) {
				printSidebar( resp );
			}
		});
	}

	function printSidebar( json ) {

		var $lessons = $modal.find('.guru-lesson-nav-lessons'),
			$description = $modal.find('.guru-lesson-nav-description'),
			html = '',
			accessible = 0,
 			index = 0,
			info, module, lessons, lesson, media, text, type, duration, i, j;

		cache = json = json || {};
		info = json.info || {};
		
		if(cache.kunena.allow_stud == "1"){
			document.getElementById("comments-button").style.display = "none";
		}
		else if(cache.kunena.allow_stud == "0"){
			document.getElementById("comments-button").style.display = "block";
		}
		
		// update lessons
		html += '<ul>';
		for ( i = 0; i < json.modules.length; i++ ) {
			module = json.modules[i];
			lessons = module.lessons;
			html += '<li>';
			
			if(module.can_open_module == '1'){
				html += '<span class=guru-lesson-nav-module><a class="guru-lesson-nav-lesson guru-lesson-nav-accessible" href="javascript:" data-mindexm="' + i + '">' + module.title + '</a></span>';
			}
			else{
				html += '<span class=guru-lesson-nav-module><a class="guru-lesson-nav-lesson" href="javascript:">' + module.title + '</a></span>';
			}
			
			html += '<ul class="guru-lesson-nav-list">';
			
			for ( j = 0; j < lessons.length; j++ ) {
				lesson = lessons[j];
				media = lesson.data && lesson.data.media || [];
				text = lesson.data && lesson.data.text || [];
				type = lesson.data && lesson.data.type || [];

				if(parseInt(lesson.id) > 0){
					html += '<li><a id="id-lesson-'+lesson.id+'" class="guru-lesson-nav-lesson';
				}
				else{
					html += '<li class="redirect-lesson"><a id="id-lesson-'+lesson.id+'" class="guru-lesson-nav-lesson';
				}
				
				if ( params.cid == lesson.id ) {
					lessons_viewed = document.getElementsByClassName("viewed-"+lesson.id);
					lessons_viewed[0].style.visibility = "visible";
					lessons_viewed[1].style.visibility = "visible";
					
					params.current_lesson = lesson.id;
					
					html += ' guru-lesson-nav-current';
					index = accessible;
					
					var url = params.uri + 'index.php?option=com_guru&controller=guruTasks&task=get_lesson_description&ajax=1&lesson_id=' + lesson.id;
					$.ajax({
						url: url,
						type: 'get',
						dataType: 'json',
						success: function( resp ) {
							json = resp || {};
							$description.html( json.description || '' );
						}
					});
				}
				if ( +lesson.can_open_lesson ) {
					if(parseInt(lesson.id) > 0){
						html += ' guru-lesson-nav-accessible" href="javascript:" data-mindex="' + i + '" data-cindex="' + j;
					}
					else{
						html += ' guru-lesson-nav-accessible" href="#" onclick="javascript:redirectCourseAfterComplete(\''+lesson.url+'\')" data-mindex="' + i + '" data-cindex="' + j;
					}

					accessible++;
				}
				html += '">' + lesson.name;
				
				if ( !+lesson.can_open_lesson ) {
					if(typeof lesson.available_div != "undefined"){
						available_language = window.parent.document.getElementById("available_language").value;
						html += '<br /> <div class="clearfix"><div class="pull-left">' + available_language + ":&nbsp;</div>" + lesson.available_div + '</div>';
					}
				}
				
				/*console.log(lesson.data);
				
				if ( lesson.data && lesson.data.layout == 5 ) {
					html += '<br><span><i class=fontello-doc-text-inv></i>Text';
				}
				else if ( lesson.data && lesson.data.layout == 12 ) {
					html += '<br><span><i class=fontello-check></i>Quiz';
				}
				else if ( media.length ) {
					if ( type.indexOf('docs') >= 0 ) {
						html += '<br><span><i class=fontello-doc-text-inv></i>Document';
					}
					else {
						html += '<br><span><i class=fontello-play-circled></i>';
						
						if ( lesson.duration ) {
							duration = lesson.duration.split('x');
							html += ( +duration[0] < 10 ? '0' : '' ) + duration[0] + ':';
							html += ( +duration[1] < 10 ? '0' : '' ) + ( +duration[1] );
						}
						else {
							html += media.length > 1 ? 'Videos' : 'Video';
						}
					}
				}*/
				
				if ( lesson.data && lesson.data.layout == 12 ) {
					html += '<br><span><i class=fontello-check></i>'+quiz_lesson_lang;
				}
				else {
					if(type.length > 0){
						if ( type.indexOf('video') >= 0 ) {
							html += '<br><span><i class=fontello-play-circled></i>'+video_lesson_lang;
						}
						else if ( type.indexOf('audio') >= 0 ) {
							html += '<br><span><i class=icon-volume-up></i>'+audio_lesson_lang;
						}
						else if ( type.indexOf('docs') >= 0 ) {
							html += '<br><span><i class=fontello-doc-text-inv></i>'+document_lesson_lang;
						}
						else if ( type.indexOf('url') >= 0 ) {
							html += '<br><span><i class=icon-link-ext></i>'+url_lesson_lang;
						}
						else if ( type.indexOf('Article') >= 0 ) {
							html += '<br><span><i class=icon-pencil></i>'+article_lesson_lang;
						}
						else if ( type.indexOf('image') >= 0 ) {
							html += '<br><span><i class=icon-picture></i>'+image_lesson_lang;
						}
						else if ( type.indexOf('text') >= 0 ) {
							html += '<br><span><i class=fontello-doc-text-inv></i>'+text_lesson_lang;
						}
						else if ( type.indexOf('file') >= 0 ) {
							html += '<br><span><i class=icon-folder-empty></i>'+file_lesson_lang;
						}
					}
				}
				
				var class_not_view = (lesson.viewed || params.cid == lesson.id) ? '' : 'not-view';

				html += '</span>';
				html += '<span class="guru-lesson-nav-check ' + class_not_view + '"';
				html += (lesson.viewed || params.cid == lesson.id) ? 'style="background:rgba(61, 225, 0, 0.34)"' : '';
				html += '>';
				html += '<span class=guru-lesson-nav-check-circle><i class=fontello-ok ';
				html += (lesson.viewed || params.cid == lesson.id) ? 'style="color:rgb(84, 181, 81)"' : '';
				html += '></i></span>';
				html += '</span>';

				html += '</a></li>';

				// update lesson header
				if ( params.cid == lesson.id ) {
					$modal.find('.guru-lesson-header-label').html( lesson.name || '' );
				}
			}
			html += '</ul>';
			html += '</li>';
		}
		html += '</ul>';
		$lessons.html( html );
		updateLessonNav( index, accessible );
	}

	function showLesson( e ) {
		var $btn = $( e.currentTarget ),
			data, lesson, media, text, html;

		if ( $btn.hasClass('guru-lesson-nav-current') ) {
			return;
		}
		
		if ( $btn.hasClass('guru-lesson-nav-accessible') ) {
			data = $btn.data();
			
			if(data.mindex !== undefined){
				lesson = cache.modules[ data.mindex ].lessons[ data.cindex ] || {};
			}
			else{
				lesson = cache.modules[ data.mindexm ] || {};
			}

			$("#id-lesson-"+lesson.id+" .guru-lesson-nav-check").css("background", "rgba(61, 225, 0, 0.34)");
			

			$("#id-lesson-"+lesson.id+" .guru-lesson-nav-check").removeClass("not-view");
			lessons_not_viewed = document.getElementsByClassName("not-view");
			
			if(lessons_not_viewed.length == 0){
				$(".redirect-lesson").show();
			}

			lessons_viewed = document.getElementsByClassName("viewed-"+lesson.id);
			
			if(lessons_viewed[0] !== undefined){
				lessons_viewed[0].style.visibility = "visible";
				lessons_viewed[1].style.visibility = "visible";
			}
			
			params.current_lesson = lesson.id;
			getComments( lesson.id );
			
			html = '<iframe id=frame-lesson-content webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder=0 style="width:100%;height:100%;"></iframe>';
			$modal.find('.guru-lesson-nav-current').removeClass('guru-lesson-nav-current');
			$btn.addClass('guru-lesson-nav-current').find('.guru-lesson-nav-check-circle i').show();
			setModalActiveIfIsCurrent();
			$modal.find('.guru-lesson-header-label').html( lesson.name || '' );
			$modal.find('.guru-lesson-content iframe').replaceWith( html );

			var isIOS = ( /iphone|ipad|ipod/i ).test( navigator.userAgent );

			// loading
			isIOS && $html.css('position', 'fixed');
			$modal.find('.guru-lesson-loading').show();
			$modal.find('iframe').one('load', function() {
				$modal.find('.guru-lesson-loading').fadeOut();
				moveJumpButtons();
				isIOS && $html.css('position', '');
			}).attr('src', lesson.url );

			// update button
			var $accessible = $modal.find('.guru-lesson-nav-accessible');
			var index = $accessible.index( $btn );
			updateLessonNav( index, $accessible.length );

			// get description
			var url = params.uri + 'index.php?option=com_guru&controller=guruTasks&task=get_lesson_description&ajax=1&lesson_url=' + encodeURIComponent(lesson.url);
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
				success: function( resp ) {
					var $description = $modal.find('.guru-lesson-nav-description');
					json = resp || {};
					$description.html( json.description);
				}
			});
		}
	}

	function moveJumpButtons(){
		if($("#frame-lesson-content").contents().find("#g_jump_button_ref_1").length || $("#frame-lesson-content").contents().find("#g_jump_button_ref_2").length){
			$("#guru-lesson-footer #g_jump_button_ref_1").remove();
			$("#guru-lesson-footer #g_jump_button_ref_2").remove();
			
			$("#frame-lesson-content").contents().find("#g_jump_button_ref_1").appendTo('#guru-lesson-footer');
			$("#frame-lesson-content").contents().find("#g_jump_button_ref_2").detach().appendTo('#guru-lesson-footer');
		}
		else{
			$("#guru-lesson-footer #g_jump_button_ref_1").remove();
			$("#guru-lesson-footer #g_jump_button_ref_2").remove();
		}
	}

	function getComments( lesson_id ) {
		var url = params.uri + 'index.php?option=com_guru&controller=guruTasks&lesson_id=' + lesson_id + '&task=get_comments&ajax=1&Itemid=' + params.item_id;
		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			success: function( resp ) {
				printComments( resp );
			}
		});
	}

	function printComments( json ) {
		var $comments = $modal.find('.guru-lesson-nav-comments');
		json = json || {};
		$comments.html( json.commentbox + json.commentlist );
		$comments.find('textarea').on('keydown', commentOnKeydown );
		$comments.find('textarea').on('input', commentOnInput );
		$comments.find('button').on('click', commentOnSubmit );
		$comments.on('click', '.guru-comment-edit', commentOnEdit );
		$comments.on('click', '.guru-comment-save', commentOnEditSave );
		$comments.on('click', '.guru-comment-delete', commentOnDelete );
	}

	function commentOnKeydown( e ) {
		var $comments;
		if ( e.keyCode === 13 && !e.shiftKey ) {
			e.preventDefault();
			e.stopPropagation();
			$comments = $modal.find('.guru-lesson-nav-comments');
			$comments.find('button').click();
			return false;
		}
	}

	function commentOnInput( e ) {
		var value = ( e.target.value || '' ).replace(/^\s+|\s+$/g, '');
		var $button = $( e.target ).siblings('button');
		if ( value.length ) {
			$button.removeAttr('disabled');
		} else {
			$button.attr('disabled', 'disabled');
		}
	}

	function commentOnSubmit( e ) {
		e.preventDefault();
		e.stopPropagation();
		var $button = $( e.currentTarget );
		var $textarea = $button.siblings('textarea');
		var message = $textarea.val();
		var id = $textarea.data('id');
		var url = params.uri + 'index.php?option=com_guru&controller=guruTasks&task=insert_comment&lessonid=' + id + '&message=' + encodeURIComponent( message ) + '&ajax=1&Itemid=' + params.item_id;

		var uniq = 'message-' + (new Date()).getTime() + '-' + Math.floor( Math.random() * 1000 );

		var html = [
			'<div id="', uniq, '" class="guru-lesson-comment my-message">',
				'<div class="guru-lesson-comment-wrap">',
					'<div class="guru-lesson-comment-avatar"><span></span></div>',
					'<div class="guru-lesson-comment-body guru-reply-body">',
						'<a class="guru-lesson-comment-name" href="javascript:">You</a> ',
						'<span class="guru-text">', message, '</span>',
						'<div class="guru-lesson-comment-meta">',
							'<span class="guru-lesson-comment-time">a few seconds ago</span>',
						'</div>',
					'</div>',
				'</div>',
			'</div>'
		].join('');

		$textarea.closest('.guru-lesson-comments-form').after( html );
		$textarea.val('');
		$button.attr('disabled', 'disabled');

		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			success: function( json ) {
				if ( json && json.html ) {
					$('#' + uniq ).replaceWith( json.html );	
				}				
			}
		});
	}

	function commentOnEdit( e ) {
		var $button = $( e.currentTarget ),
			$ct = $button.closest('.guru-reply-body'),
			$text = $ct.find('.guru-text'),
			$textarea = $ct.find('textarea');

		$text.hide();
		$textarea.show();
		$ct.find('.guru-comment-edit').hide();
		$ct.find('.guru-comment-delete').hide();
		$ct.find('.guru-comment-save').show();
	}

	function commentOnEditSave( e ) {
		var $button = $( e.currentTarget ),
			$ct = $button.closest('.guru-reply-body'),
			$text = $ct.find('.guru-text'),
			$textarea = $ct.find('textarea'),
			data = $button.data(),
			message = $textarea.val(),
			url;

		// optimistic update
		$text.html( message ).show();
		$textarea.hide();
		$ct.find('.guru-comment-edit').show();
		$ct.find('.guru-comment-delete').show();
		$ct.find('.guru-comment-save').hide();

		message = encodeURIComponent( message );
		url = params.uri + 'index.php?option=com_guru&controller=guruTasks&task=edit_comment&lessonid=' + data.id + '&comid=' + data.resultId + '&message=' + message + '&ajax=1&Itemid=' + params.item_id;

		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			success: function() {}
		});
	}

	function commentOnDelete( e ) {
		var $button = $( e.currentTarget ),
			data = $button.data(),
			url;

		$button.closest('.guru-lesson-comment').remove();
		url = params.uri + 'index.php?option=com_guru&controller=guruTasks&task=delete_comment&lessonid=' + data.id + '&uid=' + data.resultUser + '&comid=' + data.resultId + '&ajax=1&Itemid=' + params.item_id;

		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			success: function() {}
		});
	}
	
	function setModalActiveIfIsCurrent(){
		var parent_class = $(".guru-lesson-nav-current").parent().attr('class');

		$( ".active-module" ).removeClass("active-module");

		if(parent_class == "guru-lesson-nav-module"){
			parent = $(".guru-lesson-nav-current").parent();
			//parent.attr('class', "guru-lesson-nav-module active-module");
		}
		else{
			$( ".guru-lesson-nav-module" ).removeClass("active-module");
		}
	}

	window.openMyModalNew = function(width, height, source, _params) {
		params = _params;
		createModal(source);
	};
	
	window.reloadCourseLessonsBarJS = function() {
		params.cid = params.current_lesson;
		getSidebarContent();
	};

})( window, jQuery );

function redirectCourseAfterComplete(redirect_url){
	lessons_not_viewed = document.getElementsByClassName("not-view");
			
	if(lessons_not_viewed.length == 0){
		window.parent.location.href = redirect_url;
	}
	else{
		alert(course_not_completed_lang);
		return false;
	}
}