alert('where is my jquery');
var support_widget = {};
support_widget.finished_loading = null;
(function(){



	var OPEN = 1;
	var CLOSED = 0;
	var TRANSITIONING = 2;
	var me = {}; //container object holding properties.


	me.set_cookie = function(c_name,value,exdays)
	{
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
	}
	me.log = function(message){
		if(typeof(console) != "undefined"){
			console.log(message);
		}else{
			alert(message);
		}
	}
	me.get_cookie = function (c_name)
	{
		var c_value = document.cookie;
		var c_start = c_value.indexOf(" " + c_name + "=");
		if (c_start == -1){
			c_start = c_value.indexOf(c_name + "=");
		}
		if (c_start == -1){
			c_value = null;
		}
		else
		{
			c_start = c_value.indexOf("=", c_start) + 1;
			var c_end = c_value.indexOf(";", c_start);
			if (c_end == -1){
				c_end = c_value.length;
			}
			c_value = unescape(c_value.substring(c_start,c_end));
		}
		return c_value;
	}

	me.update_stats = function(stat)
	{
		$.post("{{URL::action('WidgetController@update_stats',array($token))}}",{
			stat: stat,
			session_identifier: me.session_identifier
		});
	}
	finish_loading = function(){
		me.has_opened_yet = false;
		me.trigger_on_click = false;
		me.trigger_on_hover = true;
		me.pinned_open = false;
		me.window_state = CLOSED;

		me.widget_session_token = '{{$session->token}}';
		me.widget_token = '{{$widget->token}}';
		me.start_open = '{{$widget->start_open}}' == true;
		me.set_cookie('wst',me.widget_session_token,1);
		alert('Here is my jquery');
		me.update_stats('loaded');
	}

var jQueryScriptOutputted = false;

function initJQuery() {
    
    //if the jQuery object isn't available
    if (typeof(jQuery) == 'undefined') {
    
        if (! jQueryScriptOutputted) {
            //only output the script once..
            jQueryScriptOutputted = true;
            
            //output the script (load it from google api)
            document.write("<scr" + "ipt type='text/javascript' src='{{$jquery_url}}'></scr" + "ipt>");
        }
        setTimeout(initJQuery, 50);
    } else {
                        
        $(function() {  
            me.log('got jquery');
            finish_loading();
        });
    }
            
}
initJQuery();



})();