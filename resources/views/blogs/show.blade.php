@extends('layouts.app')

@section('content')
<style>
    /* ── Hero Image ── */
    .blog-hero {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
    }

    .blog-hero-placeholder {
        width: 100%;
        height: 280px;
        background: linear-gradient(135deg, #1a1f2e, #2d3561);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        font-weight: 800;
        color: rgba(255,255,255,0.15);
    }

    /* ── Page Layout ── */
    .blog-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 24px 60px;
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 30px;
        align-items: start;
    }

    /* ── Main Article ── */
    .article-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        overflow: hidden;
    }

    .article-body { padding: 35px; }

    .article-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 13px;
        color: #9ca3af;
        flex-wrap: wrap;
    }

    .article-breadcrumb a {
        color: #4a6cf7;
        text-decoration: none;
    }

    .article-breadcrumb a:hover { text-decoration: underline; }

    .article-breadcrumb span { color: #d1d5db; }

    .article-category {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
    }

    .badge-admit  { background: #dbeafe; color: #1d4ed8; }
    .badge-result { background: #d1fae5; color: #065f46; }
    .badge-other  { background: #f3f4f6; color: #374151; }

    .article-title {
        font-size: 28px;
        font-weight: 800;
        color: #1a1f2e;
        line-height: 1.4;
        margin-bottom: 16px;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 16px 0;
        border-top: 1px solid #f0f2f5;
        border-bottom: 1px solid #f0f2f5;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #6b7280;
    }

    .meta-item strong { color: #374151; }

    /* ── Article Content ── */
    .article-content {
        font-size: 16px;
        line-height: 1.9;
        color: #374151;
    }

    .article-content h1,
    .article-content h2,
    .article-content h3,
    .article-content h4 {
        color: #1a1f2e;
        margin: 25px 0 12px;
        line-height: 1.4;
    }

    .article-content h1 { font-size: 26px; }
    .article-content h2 { font-size: 22px; }
    .article-content h3 { font-size: 18px; }
    .article-content h4 { font-size: 16px; }

    .article-content p { margin-bottom: 16px; }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin: 16px 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .article-content a {
        color: #4a6cf7;
        text-decoration: underline;
    }

    .article-content ul,
    .article-content ol {
        padding-left: 24px;
        margin-bottom: 16px;
    }

    .article-content li { margin-bottom: 6px; }

    .article-content blockquote {
        border-left: 4px solid #4a6cf7;
        background: #f0f4ff;
        padding: 16px 20px;
        margin: 20px 0;
        border-radius: 0 8px 8px 0;
        font-style: italic;
        color: #4b5563;
    }

    .article-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
    }

    .article-content table th {
        background: #1a1f2e;
        color: #fff;
        padding: 12px 16px;
        text-align: left;
        font-size: 14px;
    }

    .article-content table td {
        padding: 11px 16px;
        border-bottom: 1px solid #f0f2f5;
        font-size: 14px;
    }

    .article-content table tr:last-child td { border-bottom: none; }
    .article-content table tr:hover td { background: #f8f9fb; }

    .article-content pre {
        background: #1a1f2e;
        color: #e2e8f0;
        padding: 20px;
        border-radius: 8px;
        overflow-x: auto;
        font-family: 'Courier New', monospace;
        font-size: 14px;
        margin: 16px 0;
    }

    .article-content code {
        background: #f1f3f5;
        padding: 2px 6px;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
        font-size: 13px;
        color: #ef4444;
    }

    .article-content hr {
        border: none;
        border-top: 2px solid #f0f2f5;
        margin: 25px 0;
    }

    /* ── Share Bar ── */
    .share-bar {
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid #f0f2f5;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .share-label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .share-btn {
        padding: 8px 18px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .share-copy {
        background: #f3f4f6;
        color: #374151;
    }

    .share-copy:hover { background: #e5e7eb; }

    /* ── Sidebar ── */
    .blog-sidebar { position: sticky; top: 84px; }

    .side-widget {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .side-widget-header {
        padding: 16px 20px;
        border-bottom: 1px solid #f0f2f5;
        font-size: 15px;
        font-weight: 700;
        color: #1a1f2e;
    }

    .side-widget-body { padding: 20px; }

    /* Search Widget */
    .search-widget {
        display: flex;
        gap: 8px;
    }

    .search-widget input {
        flex: 1;
        padding: 10px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 7px;
        font-size: 14px;
        outline: none;
        font-family: inherit;
        transition: border-color 0.2s;
    }

    .search-widget input:focus { border-color: #4a6cf7; }

    .search-widget button {
        padding: 10px 16px;
        background: #4a6cf7;
        color: #fff;
        border: none;
        border-radius: 7px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.2s;
    }

    .search-widget button:hover { background: #3a5ce5; }

    /* Category Widget */
    .cat-list { list-style: none; }

    .cat-list li {
        border-bottom: 1px solid #f9fafb;
    }

    .cat-list li:last-child { border-bottom: none; }

    .cat-list a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 11px 0;
        color: #374151;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
    }

    .cat-list a:hover { color: #4a6cf7; }

    .cat-count {
        background: #f0f4ff;
        color: #4a6cf7;
        font-size: 12px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 10px;
    }

    /* Related Blogs Widget */
    .related-item {
        display: flex;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f9fafb;
        text-decoration: none;
        transition: all 0.2s;
    }

    .related-item:last-child { border-bottom: none; }

    .related-item:hover .related-title { color: #4a6cf7; }

    .related-thumb {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .related-thumb-placeholder {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        background: #eff2ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4a6cf7;
        font-weight: 800;
        font-size: 20px;
        flex-shrink: 0;
    }

    .related-info { flex: 1; }

    .related-title {
        font-size: 13px;
        font-weight: 600;
        color: #1a1f2e;
        line-height: 1.4;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s;
    }

    .related-date {
        font-size: 12px;
        color: #9ca3af;
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #4a6cf7;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        transition: gap 0.2s;
    }

    .back-link:hover { gap: 10px; }

    @media (max-width: 900px) {
        .blog-page {
            grid-template-columns: 1fr;
        }
        .blog-sidebar { position: static; }
        .blog-hero { height: 260px; }
    }

    @media (max-width: 600px) {
        .article-title { font-size: 22px; }
        .article-body  { padding: 20px; }
        .blog-page     { padding: 20px 16px 40px; }
    }
</style>

{{-- Hero Image --}}
@if($blog->image)
    <img
        src="{{ asset('images/' . $blog->image) }}"
        alt="{{ $blog->title }}"
        class="blog-hero"
    >
@else
    <div class="blog-hero-placeholder">
        {{ strtoupper(substr($blog->title, 0, 1)) }}
    </div>
@endif

<div class="blog-page">

    {{-- Main Article --}}
    <div>
        <a href="/blogs" class="back-link">&#8592; Back to Blogs</a>

        <div class="article-card">
            <div class="article-body">

                {{-- Breadcrumb --}}
                <div class="article-breadcrumb">
                    <a href="/blogs">Home</a>
                    <span>/</span>
                    @if($blog->category)
                        <a href="/blogs">{{ $blog->category->name }}</a>
                        <span>/</span>
                    @endif
                    <span style="color:#6b7280">{{ Str::limit($blog->title, 40) }}</span>
                </div>

                {{-- Category Badge --}}
                @if($blog->category)
                    @php
                        $badgeClass = 'badge-other';
                        if(stripos($blog->category->name, 'admit') !== false) $badgeClass = 'badge-admit';
                        if(stripos($blog->category->name, 'result') !== false) $badgeClass = 'badge-result';
                    @endphp
                    <span class="article-category {{ $badgeClass }}">
                        {{ $blog->category->name }}
                    </span>
                @endif

                {{-- Title --}}
                <h1 class="article-title">{{ $blog->title }}</h1>

                {{-- Meta --}}
                <div class="article-meta">
                    <div class="meta-item">
                        <span>Published:</span>
                        <strong>{{ $blog->created_at->format('d M Y') }}</strong>
                    </div>
                    @if($blog->updated_at != $blog->created_at)
                    <div class="meta-item">
                        <span>Updated:</span>
                        <strong>{{ $blog->updated_at->format('d M Y') }}</strong>
                    </div>
                    @endif
                    <div class="meta-item">
                        <span>Category:</span>
                        <strong>{{ $blog->category->name ?? 'General' }}</strong>
                    </div>
                </div>

                {{-- Content --}}
                <div class="article-content">
                    {!! $blog->content !!}
                </div>

                {{-- Share Bar --}}
                <div class="share-bar">
                    <span class="share-label">Share this article:</span>
                    <button
                        class="share-btn share-copy"
                        onclick="copyLink()"
                        id="copy-btn"
                    >Copy Link</button>
                </div>

            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <aside class="blog-sidebar">

        {{-- Search Widget --}}
        <div class="side-widget">
            <div class="side-widget-header">Search Blogs</div>
            <div class="side-widget-body">
                <div class="search-widget">
                    <input
                        type="text"
                        id="sidebar-search"
                        placeholder="Search..."
                        onkeydown="if(event.key==='Enter') goSearch()"
                    >
                    <button onclick="goSearch()">Go</button>
                </div>
            </div>
        </div>

        {{-- Categories Widget --}}
        <div class="side-widget">
            <div class="side-widget-header">Categories</div>
            <div class="side-widget-body">
                <ul class="cat-list">
                    <li>
                        <a href="/blogs">
                            All Blogs
                            <span class="cat-count">{{ \App\Models\Blog::count() }}</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                    <li>
                        <a href="/blogs">
                            {{ $cat->name }}
                            <span class="cat-count">{{ \App\Models\Blog::where('category_id', $cat->id)->count() }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Related Blogs Widget --}}
        @php
            $related = \App\Models\Blog::with('category')
                ->where('id', '!=', $blog->id)
                ->where('category_id', $blog->category_id)
                ->latest()
                ->take(4)
                ->get();
        @endphp

        @if($related->count() > 0)
        <div class="side-widget">
            <div class="side-widget-header">Related Blogs</div>
            <div class="side-widget-body">
                @foreach($related as $rel)
                <a href="/blogs/{{ $rel->id }}" class="related-item">
                    @if($rel->image)
                        <img
                            src="{{ asset('images/' . $rel->image) }}"
                            alt="{{ $rel->title }}"
                            class="related-thumb"
                        >
                    @else
                        <div class="related-thumb-placeholder">
                            {{ strtoupper(substr($rel->title, 0, 1)) }}
                        </div>
                    @endif
                    <div class="related-info">
                        <div class="related-title">{{ $rel->title }}</div>
                        <div class="related-date">{{ $rel->created_at->format('d M Y') }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </aside>
</div>

<script>
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(function() {
            var btn = document.getElementById('copy-btn');
            btn.textContent = 'Copied!';
            btn.style.background = '#d1fae5';
            btn.style.color = '#065f46';
            setTimeout(function() {
                btn.textContent = 'Copy Link';
                btn.style.background = '';
                btn.style.color = '';
            }, 2000);
        });
    }

    function goSearch() {
        var q = document.getElementById('sidebar-search').value.trim();
        if (q) {
            window.location.href = '/blogs?search=' + encodeURIComponent(q);
        }
    }
</script>
@endsection