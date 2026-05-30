@extends('layouts.app')

@section('content')
<style>
    /* ── Hero ── */
    .hero {
        background: linear-gradient(135deg, #1a1f2e 0%, #2d3561 100%);
        padding: 60px 24px;
        text-align: center;
    }

    .hero-inner {
        max-width: 700px;
        margin: 0 auto;
    }

    .hero h1 {
        font-size: 38px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 14px;
        line-height: 1.3;
    }

    .hero h1 span { color: #4a6cf7; }

    .hero p {
        font-size: 16px;
        color: #8892a4;
        margin-bottom: 30px;
        line-height: 1.7;
    }

    .hero-search {
        display: flex;
        max-width: 500px;
        margin: 0 auto;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .hero-search input {
        flex: 1;
        padding: 14px 20px;
        border: none;
        outline: none;
        font-size: 15px;
        font-family: inherit;
        color: #333;
    }

    .hero-search button {
        padding: 14px 24px;
        background: #4a6cf7;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        font-family: inherit;
        transition: background 0.2s;
    }

    .hero-search button:hover { background: #3a5ce5; }

    /* ── Stats Bar ── */
    .stats-bar {
        background: #fff;
        border-bottom: 1px solid #f0f2f5;
        padding: 16px 24px;
    }

    .stats-bar-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 30px;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #6b7280;
    }

    .stat-item strong { color: #1a1f2e; font-size: 16px; }

    /* ── Filter Section ── */
    .filter-section {
        max-width: 1200px;
        margin: 30px auto 0;
        padding: 0 24px;
    }

    .filter-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .category-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .cat-tab {
        padding: 8px 20px;
        border-radius: 25px;
        border: 1.5px solid #e5e7eb;
        background: #fff;
        color: #6b7280;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-family: inherit;
    }

    .cat-tab:hover {
        border-color: #4a6cf7;
        color: #4a6cf7;
    }

    .cat-tab.active {
        background: #4a6cf7;
        border-color: #4a6cf7;
        color: #fff;
    }

    .filter-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .date-input {
        padding: 9px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        color: #374151;
        transition: border-color 0.2s;
        background: #fff;
    }

    .date-input:focus { border-color: #4a6cf7; }

    .results-count {
        font-size: 13px;
        color: #9ca3af;
        white-space: nowrap;
    }

    /* ── Blog Grid ── */
    .blogs-section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px 50px;
    }

    .blogs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 24px;
    }

    .blog-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }

    .blog-card-image {
        width: 100%;
        height: 210px;
        object-fit: cover;
    }

    .blog-card-no-image {
        width: 100%;
        height: 210px;
        background: linear-gradient(135deg, #eff2ff, #e0e7ff);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #4a6cf7;
        font-weight: 800;
    }

    .blog-card-body {
        padding: 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-card-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        flex-wrap: wrap;
    }

    .category-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-admit  { background: #dbeafe; color: #1d4ed8; }
    .badge-result { background: #d1fae5; color: #065f46; }
    .badge-other  { background: #f3f4f6; color: #374151; }

    .blog-date {
        font-size: 12px;
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .blog-card h3 {
        font-size: 17px;
        font-weight: 700;
        color: #1a1f2e;
        margin-bottom: 10px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-card p {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 18px;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 20px;
        background: #f0f4ff;
        color: #4a6cf7;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
        align-self: flex-start;
    }

    .read-more-btn:hover {
        background: #4a6cf7;
        color: #fff;
    }

    /* ── Loading ── */
    .loading-spinner {
        display: none;
        text-align: center;
        padding: 40px;
        color: #9ca3af;
        font-size: 15px;
    }

    /* ── No Results ── */
    .no-results {
        text-align: center;
        padding: 80px 20px;
        color: #9ca3af;
        grid-column: 1 / -1;
    }

    .no-results h3 {
        font-size: 20px;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .no-results p { font-size: 14px; }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .hero h1 { font-size: 26px; }
        .hero p  { font-size: 14px; }
        .blogs-grid { grid-template-columns: 1fr; }
        .filter-row { flex-direction: column; align-items: flex-start; }
        .filter-right { width: 100%; }
        .date-input { width: 100%; }
        .hero-search { max-width: 100%; }
    }

    @media (max-width: 480px) {
        .hero { padding: 40px 16px; }
        .filter-section { padding: 0 16px; }
        .blogs-section  { padding: 0 16px 40px; }
    }
</style>

<!-- Hero -->
<div class="hero">
    <div class="hero-inner">
        <h1>Latest <span>Exam Updates</span> and Notifications</h1>
        <p>Stay updated with admit cards, results, and government job notifications</p>
        <div class="hero-search">
            <input
                type="text"
                id="search"
                placeholder="Search blogs..."
                autocomplete="off"
            >
            <button type="button">Search</button>
        </div>
    </div>
</div>

<!-- Stats Bar -->
<div class="stats-bar">
    <div class="stats-bar-inner">
        <div class="stat-item">
            <strong>{{ $blogs->count() }}</strong> Total Blogs
        </div>
        @foreach($categories as $cat)
        <div class="stat-item">
            <strong>{{ $blogs->where('category_id', $cat->id)->count() }}</strong> {{ $cat->name }}
        </div>
        @endforeach
    </div>
</div>

<!-- Filter -->
<div class="filter-section">
    <div class="filter-row">
        <div class="category-tabs">
            <button class="cat-tab active" onclick="setCategory('', this)">All</button>
            @foreach($categories as $cat)
                <button class="cat-tab" onclick="setCategory('{{ $cat->id }}', this)">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>
        <div class="filter-right">
            <input type="date" class="date-input" id="date-filter">
            <span class="results-count" id="results-count"></span>
        </div>
    </div>
</div>

<!-- Blog List -->
<div class="blogs-section">
    <div class="loading-spinner" id="loading">Loading...</div>
    <div id="blog-list">
        @include('blogs.partials.blog-list', ['blogs' => $blogs])
    </div>
</div>

<script>
    var activeCategory = '';

    function setCategory(catId, btn) {
        activeCategory = catId;
        document.querySelectorAll('.cat-tab').forEach(function(b) {
            b.classList.remove('active');
        });
        btn.classList.add('active');
        doFilter();
    }

    function doFilter() {
        var search = $('#search').val();
        var date   = $('#date-filter').val();

        $('#loading').show();
        $('#blog-list').hide();

        $.ajax({
            url: '/blogs/filter',
            method: 'POST',
            data: {
                _token:      $('meta[name="csrf-token"]').attr('content'),
                search:      search,
                category_id: activeCategory,
                date:        date,
            },
            success: function(response) {
                $('#loading').hide();
                $('#blog-list').show().html(response);
                updateCount();
            }
        });
    }

    function updateCount() {
        var count = $('#blog-list .blog-card').length;
        $('#results-count').text(count + ' blog(s) found');
    }

    var searchTimer;
    $('#search').on('keyup', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(doFilter, 400);
    });

    $('#date-filter').on('change', doFilter);

    // Set initial count
    $(document).ready(function() {
        updateCount();
    });
</script>
@endsection