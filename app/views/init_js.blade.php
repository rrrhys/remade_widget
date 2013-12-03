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
	me.widget_token = '{{$widget_token}}';
	me.start_open = {{$widget_properties->start_open}};
});