<html>
<head>
	<title></title>
	<link href='http://fonts.googleapis.com/css?family=Oxygen:700' rel='stylesheet' type='text/css'>
	<style>
        .widget {
            height: 100px;
        }
        .chat_text {
            height: 100px;
        }

	</style>

</head>
<body>
<div class="widget_outer">
    <div class="widget">
         <h1>Title</h1>
        <div id="chat">
        </div>
        <div class="chat_text_wrapper">
            <div class="chat_text">

                <div class="sentence hidden message_template">

                        <span class="name">You: </span>
                        <span class="text"></span></div>
                </div>
            <div class="my_name" style="display:none;">
                <span>What is your name?</span>
                <input type="text" name="my_name_is" id="my_name_is" value="">
                <a id="save_my_name">Save</a>
            </div>
            <div class="say_something" style="display:none;"><span class="name">You: </span><input type="text" name="message_body" id="message_body"><a id="send">Send</a></div>
        </div>
        <div class="logo">
            Powered by <a href="#">Project Name</a>
        </div>
        
    </div>
</div>
</body>
</html>

