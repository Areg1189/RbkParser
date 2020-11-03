<?php

namespace App\Controllers;

use App\Models\Post;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class PostController extends \Core\Controller
{

    public function indexAction()
    {
        $post = new Post();
        $posts = $post->getAll();
        $this->view->render('posts/index', compact('posts'));
    }

    public function showAction()
    {
        if (!$slug = $this->route_params['slug']) return false;
        $post = new Post();
        $post = $post->first(['slug' => $slug]);
        $this->view->render('posts/show', compact('post'));
    }
}
