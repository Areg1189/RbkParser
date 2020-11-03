<?php

namespace App\Models;

use Core\Model;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Post extends Model
{
    protected $table = 'posts';


    public function getAll()
    {
        return $this->db->selectJoin([
            'posts' => [
                '*'
            ],
            'post_images' => [
                'name AS image_name',
                'details AS image_details'
            ]
        ], [
            'post_images' => [
                'posts.id', 'post_images.post_id'
            ]
        ], [], null, null, ['id' => 'DESC']);
    }

    public function first($data)
    {
        return $this->db->selectJoin([
            'posts' => [
                '*'
            ],
            'post_images' => [
                'name AS image_name',
                'details AS image_details'
            ]
        ], [
            'post_images' => [
                'posts.id', 'post_images.post_id'
            ]
        ], $data, 1);
    }

}
