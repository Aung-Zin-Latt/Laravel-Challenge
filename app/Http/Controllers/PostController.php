<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostResource;
use App\Http\Requests\ToggleReactionRequest;

class PostController extends Controller
{
    public function list()
    {
        $posts = Post::withCount('likes')->get();

        return PostResource::collection($posts);
    }

    public function toggleReaction(ToggleReactionRequest $request): JsonResponse
    {
        try {
            $post = Post::find($request->post_id);
        } catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }

        if ($post->user_id === auth()->id()) {
            return response()->json(['error' => 'You cannot like your own post'], Response::HTTP_BAD_REQUEST);
        }
    
        $like = $post->likes()->where('user_id', auth()->id())->first();
    
        if ($request->like && $like) {
            return response()->json(['error' => 'You already liked this post'], Response::HTTP_BAD_REQUEST);
        }
    
        if (!$request->like && !$like) {
            return response()->json(['error' => 'You have not liked this post yet'], Response::HTTP_BAD_REQUEST);
        }
    
        $likeExists = $like ? true : false;
    
        if ($request->like && !$likeExists) {
            $post->likes()->create(['user_id' => auth()->id()]);
            $message = 'You liked this post successfully';
        } else {
            $like->delete();
            $message = 'You unliked this post successfully';
        }
    
        return response()->json(['message' => $message], Response::HTTP_OK);
    }
}
