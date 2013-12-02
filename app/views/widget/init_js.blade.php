alert('test');
var support_widget = {};
support_widget.finished_loading = null;
(function(){
	var OPEN = 1;
	var CLOSED = 0;
	var TRANSITIONING = 2;
	var me = {}; //container object holding properties.
	me.has_opened_yet = false;
	me.trigger_on_click = false;
	me.trigger_on_hover = true;
	me.pinned_open = false;
	me.window_state = CLOSED;

	me.session_identifier = '{{$session_identifier}}';
	me.widget_token = '{{$widget_token}}';
	me.start_open = '{{$user->widget->start_open}}' == true;

	me.update_stats = function(stat){
		$.post("{{URL::action('WidgetController@update_stats',array('widget_token',$widget_token))}}",{
			stat: stat,
			session_identifier: me.session_identifier
		});
	}


})();