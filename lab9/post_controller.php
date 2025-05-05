<?php

include_once "post_model.php";
include_once "post_view.php";

$posts = getPosts();
renderPosts($posts);
