<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    protected $queryString = [
        'postId' => ['except' => 1],
        'query' => '',
    ];
    public $postId = null;
    public string $query = '';

    public function changePostId($value): void
    {
        $this->postId = $value;
    }

    public function changeQuery($query): void
    {
        $this->query = trim($query);
        $params = [
            'page', 'postId'
        ];
        if ($this->query == '') $params[] = 'query';
        $this->dispatch('remove-page-query', ...$params);
    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        /*$response = Http::get('https://jsonplaceholder.typicode.com/comments?postId=' . $this->postId);
        // Decode JSON and map to Comment model instances
        $commentsCollection = collect($response->json())->map(fn($item) => new Comment($item));

        // Example usage: Access properties or save to the database
        $commentsCollection->each(fn($comment) => $comment->save()); // If you want to save them to the database*/

        $comments = Comment::when($this->postId, fn(Builder $query) => $query->where('postId', $this->postId))
            ->when($this->query, fn(Builder $query) => $query->where('name', 'like', "%$this->query%"))
            ->paginate(5);
        return view('livewire.search-component')
            ->with([
                'comments' => $comments
            ]);
    }
}
