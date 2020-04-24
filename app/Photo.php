<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $user_uploads = 'images/users/';
    protected $post_uploads = 'images/posts/';

    protected $fillable = ['file'];

    // defining an accessor
    public function getFileAttribute($photo){

        // there are two directories for images:
        // one is users images & another is posts images
        // so we should check where the image is located to return the correct path to display it.
        if(file_exists('images/users/' . $photo)) {
            return $this->user_uploads . $photo;
        } elseif(file_exists('images/posts/' . $photo)) {
            return $this->post_uploads . $photo;
        } else {
            return $this->user_uploads . 'default-user.jpg';
        }

    }

}
