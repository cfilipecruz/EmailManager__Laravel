<?php 

    // Run the method list which will return the list of messages 
    $list = $gmail->users_messages->listUsersMessages('me');

    // Get the actual list 
    $messageList = $list->getMessages();

    // Create array where we will store our messages
    $messages = array();

    // iterate over all the elements retrieved by the method list
    foreach($messageList as $msg){

        // GET individual message
        $message = $gmail->users_messages->get('me',$msg->id);
        
        // Push the element into our array of messages
        array_push($messages,);
    }

?>