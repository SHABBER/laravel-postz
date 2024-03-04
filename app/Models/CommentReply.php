<?php

namespace App\Models;

use App\Http\Controllers\PostCommentController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable=['comment_id', 'author', 'email', 'body' ,'is_active'];

    public function comment(){
        return $this->belongsTo(Comment::class);
    }

   
    
}
