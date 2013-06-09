<?php

// User class usage examples.
$user = new \Squeeze\Core\User(1); // Load the user with the ID 1
$user->set('metaFieldKey', 'metaValue'); // set a field value.
$user->save(); // Save to the database.

// Add a new post
$myPost = new \Squeeze\Core\Post;
$myPost->set('post_title', 'My Test Post');
$myPost->set('post_content', 'My Content');
echo $myPost->save(); // The new post ID

// Change the value of a stored Option
$myOption = new \Squeeze\Core\Options('storedOption');
$myOption->set('My New Value');
$myOption->save();