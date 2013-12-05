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
	me.log = function(message)
	{
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
		$.post("{{URL::action('WidgetController@update_stats')}}",{
			stat: stat,
			widget_token: me.widget_token
		});
	}
	me.finish_loading = function()
	{
		me.has_opened_yet = false;
		me.trigger_on_click = false;
		me.trigger_on_hover = true;
		me.pinned_open = false;
		me.window_state = CLOSED;

		me.widget_session_token = '{{$session->token}}';
		me.widget_token = '{{$token}}';
		me.start_open = '{{$widget->start_open}}' == true;
		me.set_cookie('wst',me.widget_session_token,1);
		me.update_stats('loaded');

		me.update_stats('widget_requested');
		//jquery is available.
		$("body").append("<iframe src='{{URL::action('WidgetController@iframe',array($token))}}' class='widget_iframe widget_iframe_display_none' id='widget_" + me.widget_token + "'></iframe>");
		$("head").append("<link rel='stylesheet' type='text/css' href='{{URL::action('WidgetController@css',array($token))}}'>");
		me.widget_dom = $("#" + me.widget_token);
		if(me.trigger_on_hover){
			$("#" + me.widget_id).hover(function(){
					open_frame();

			},function(){
				//unhover
				//	close_frame();
			});
		}
		$("body").click(function(){

			if(me.state != c.transitioning){
				close_frame();
			}
		});
	}

	me.open_frame = function()
	{
		if(!has_opened_yet){
			me.update_stats("widget_opened");
			me.has_opened_yet = true;
		}
		me.state = TRANSITIONING;

	}


var jQueryScriptOutputted = false;

function initJQuery() 
{
    
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
            me.finish_loading();
        });
    }
            
}
initJQuery();



})();