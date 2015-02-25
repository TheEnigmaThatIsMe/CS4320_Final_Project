// use jQuery to find the DOM elements we care about
var $input = $('#chat-input'); // where the user inputs chat text
var $output = $('#chat-output'); // where output is sent

// start pubnub
var pubnub = PUBNUB.init({

	//publish_key: 'demo',
	//subscribe_key: 'demo'
  
  publish_key: 'pub-c-5cbd35fa-037e-4f72-a70d-ddb5becafdd9',
  subscribe_key: 'sub-c-b14bc026-67d8-11e4-814d-02ee2ddab7fe'
});

var channel = 'riskLobby';

// when the "send message" form is submitted
$('#chat').submit(function() {
    
  // publish input value to channel 
  pubnub.publish({
    channel: channel,
    message: $input.val()
  });
  
  // clear the input field
  $input.val('');
  
   // cancel event bubbling
  return false;
  
});


// when we receive messages
pubnub.subscribe({
  channel: channel, // our channel name
  message: function(text) { // this gets fired when a message comes in
    
    // create a new line for chat text
    var $line = $('<li class="list-group-item" />');
    
    // filter out html from messages
    var $message = $('<span class="text" />').text(text).html();
    
    // build the html elements
    $line.append($message);
    $output.append($line);
    
    // scroll the chat output to the bottom
    $output.scrollTop($output[0].scrollHeight);

  }
});