<?php

// User class usage examples.
$user = new SQ_User(1); // Load the user with the ID 1
$user->set('metaFieldKey', 'metaValue'); // set a field value.
$user->save(); // Save to the database.

// Add a new post
$post = new SQ_Post;
$post->set('post_title', 'My Test Post');
$post->set('post_content', 'My Content');
echo $post->save(); // The new post ID