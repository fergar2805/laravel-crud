<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Get the list of comments based on the select post
     */
    public function getComments(int $postId)
    {
        $comments['data'] = Comment::where('post_id', $postId)
            ->orderBy('id', 'desc')
            ->get();

        echo json_encode($comments);
    }

    /**
     * Adds a new comment on the select post
     *
     * @param Request $request
     */
    public function addComment(Request $request)
    {
        $postId = $request->input('postId');
        $comment = $request->input('comment');

        if ($comment != '' ) {
            $comments = new Comment();
            $comments->user_id = Auth::user()->id;
            $comments->post_id = $postId;
            $comments->comment = $comment;
            $comments->save();

            if ($comments) {
                echo $comments;
            }
        }
    }

    /**
     * Update the select comment
     *
     * @param Request $request
     */
    public function updateComment(Request $request)
    {
        $editId = $request->input('editId');
        $comment = $request->input('comment');

        if ($comment != '') {
            $comments = Comment::find($editId);
            $comments->comment = $comment;
            $comments->update();

            echo 'Update successfully.';
        }
    }

    /**
     * Deletes the comment
     *
     * @param int $id
     */
    public function deleteComment(int $id)
    {
        Comment::destroy($id);

        echo "Delete successfully";
    }
}
