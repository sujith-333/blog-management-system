@if($blogs->count() > 0)
    <div class="blogs-grid">
        @foreach($blogs as $blog)
        <div class="blog-card">

            @if($blog->image)
                <img
                    src="{{ asset('images/' . $blog->image) }}"
                    alt="{{ $blog->title }}"
                    class="blog-card-image"
                >
            @else
                <div class="blog-card-no-image">
                    {{ strtoupper(substr($blog->title, 0, 1)) }}
                </div>
            @endif

            <div class="blog-card-body">
                <div class="blog-card-meta">
                    @if($blog->category)
                        @php
                            $badgeClass = 'badge-other';
                            if(stripos($blog->category->name, 'admit') !== false) $badgeClass = 'badge-admit';
                            if(stripos($blog->category->name, 'result') !== false) $badgeClass = 'badge-result';
                        @endphp
                        <span class="category-badge {{ $badgeClass }}">
                            {{ $blog->category->name }}
                        </span>
                    @endif
                    <span class="blog-date">
                        {{ $blog->created_at->format('d M Y') }}
                    </span>
                </div>

                <h3>{{ $blog->title }}</h3>
                <p>{{ Str::limit(strip_tags($blog->short_description), 120) }}</p>

                <a href="/blogs/{{ $blog->id }}" class="read-more-btn">
                    Read More &#8594;
                </a>
            </div>

        </div>
        @endforeach
    </div>
@else
    <div class="no-results">
        <h3>No blogs found</h3>
        <p>Try changing your search or filter to find what you are looking for</p>
    </div>
@endif