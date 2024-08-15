<div>
    <h1 class="h3 mb-3 fw-normal">JSON Comments</h1>
    <select class="form-select mb-3" wire:model="postId" wire:change="changePostId($event.target.value)">
        <option value="">Post Id</option>
        @for($i=1;$i<=16;$i++)
            <option value="{{$i}}">{{$i}}</option>
        @endfor
    </select>

    <input type="text" class="form-control mb-3" wire:model="query" wire:keyup.debounce.500ms="changeQuery($event.target.value)">

    <div wire:loading wire:loading.class="w-100">

        <div class="shimmer-container">
            <div class="shimmer-line"></div>
            <div class="shimmer-line"></div>
            <div class="shimmer-line"></div>
        </div>
    </div>
    <div wire:loading.remove>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Post Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Body</th>
            </tr>
            </thead>
            <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td>{{$comment['postId']}}</td>
                    <td class="name">{{$comment['name']}}</td>
                    <td>{{$comment['email']}}</td>
                    <td>{{$comment['body']}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"><em>No record found</em></td>
                </tr>
            @endforelse
            </tbody>
            <tbody>
            <tr>
                <td colspan="4">{{$comments->links()}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
    <script>
        let es = 0;
        setInterval(() => {
            es++
        }, 1500)
        setInterval(() => {
            console.log(es)
        }, 1000)

        // Get all elements with the class 'name'
        const nameElements = document.getElementsByClassName('name');

        // Loop through each element and add an event listener
        for (let i = 0; i < nameElements.length; i++) {
            nameElements[i].addEventListener('click', () => {
                console.log(nameElements[i].innerHTML);
            });
        }

        function removeQueryParam(param) {
            const url = new URL(window.location);
            param.forEach((item, index) => {
                url.searchParams.delete(item);
            });
            window.history.replaceState({}, '', url);
        }

        window.addEventListener('remove-page-query', function (data) {
            console.log(data.__livewire.params)
            removeQueryParam(data.__livewire.params);
        });
    </script>
@endpush
