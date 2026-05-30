@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<style>
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        display: flex;
        align-items: center;
        gap: 18px;
        border-left: 4px solid transparent;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    .stat-card.blue  { border-left-color: #4a6cf7; }
    .stat-card.green { border-left-color: #10b981; }
    .stat-card.orange{ border-left-color: #f59e0b; }
    .stat-card.red   { border-left-color: #ef4444; }

    .stat-icon {
        width: 52px; height: 52px;
        border-radius: 12px;
        display: flex; align-items: center;
        justify-content: center;
        font-size: 22px; font-weight: bold;
        flex-shrink: 0;
    }

    .stat-card.blue  .stat-icon { background: #eff2ff; color: #4a6cf7; }
    .stat-card.green .stat-icon { background: #d1fae5; color: #10b981; }
    .stat-card.orange .stat-icon{ background: #fef3c7; color: #f59e0b; }
    .stat-card.red   .stat-icon { background: #fee2e2; color: #ef4444; }

    .stat-info h3 {
        font-size: 28px; font-weight: 800;
        color: #1a1f2e; line-height: 1;
    }

    .stat-info p {
        font-size: 13px; color: #6b7280;
        margin-top: 4px;
    }

    /* Table Section */
    .table-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        overflow: hidden;
    }

    .table-header {
        padding: 20px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f0f2f5;
        flex-wrap: wrap;
        gap: 12px;
    }

    .table-header h2 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1f2e;
    }

    .table-controls {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-input {
        padding: 8px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 13px;
        width: 220px;
        outline: none;
        transition: border-color 0.2s;
    }

    .search-input:focus { border-color: #4a6cf7; }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 13px;
        outline: none;
        cursor: pointer;
        background: #fff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead tr {
        background: #f8f9fb;
    }

    th {
        padding: 13px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #f0f2f5;
        white-space: nowrap;
    }

    td {
        padding: 14px 20px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f9fafb;
        vertical-align: middle;
    }

    tbody tr:last-child td { border-bottom: none; }

    tbody tr:hover td { background: #fafbff; }

    .blog-title-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .blog-thumb {
        width: 44px; height: 44px;
        border-radius: 8px;
        object-fit: cover;
        background: #f0f2f5;
        flex-shrink: 0;
    }

    .blog-thumb-placeholder {
        width: 44px; height: 44px;
        border-radius: 8px;
        background: #eff2ff;
        display: flex; align-items: center;
        justify-content: center;
        color: #4a6cf7;
        font-weight: bold;
        font-size: 16px;
        flex-shrink: 0;
    }

    .blog-name {
        font-weight: 600;
        color: #1a1f2e;
        font-size: 14px;
        max-width: 280px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .blog-desc {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 2px;
        max-width: 280px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .category-tag {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: #eff2ff;
        color: #4a6cf7;
        white-space: nowrap;
    }

    .actions-cell {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .action-btn {
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s;
    }

    .action-btn.edit   { background: #fef3c7; color: #d97706; }
    .action-btn.edit:hover { background: #fde68a; }
    .action-btn.delete { background: #fee2e2; color: #dc2626; }
    .action-btn.delete:hover { background: #fecaca; }
    .action-btn.view   { background: #d1fae5; color: #059669; }
    .action-btn.view:hover { background: #a7f3d0; }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }

    .empty-state h3 { font-size: 18px; margin-bottom: 8px; color: #6b7280; }
    .empty-state p  { font-size: 14px; margin-bottom: 20px; }

    .table-footer {
        padding: 15px 25px;
        border-top: 1px solid #f0f2f5;
        font-size: 13px;
        color: #6b7280;
    }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .table-header { flex-direction: column; align-items: flex-start; }
        .search-input { width: 100%; }
        .blog-desc { display: none; }
        th:nth-child(3),
        td:nth-child(3) { display: none; }
    }

    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-icon">B</div>
        <div class="stat-info">
            <h3>{{ $blogs->count() }}</h3>
            <p>Total Blogs</p>
        </div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">C</div>
        <div class="stat-info">
            <h3>{{ \App\Models\Category::count() }}</h3>
            <p>Categories</p>
        </div>
    </div>
    <div class="stat-card orange">
        <div class="stat-icon">R</div>
        <div class="stat-info">
            <h3>{{ $blogs->where('category_id', 2)->count() }}</h3>
            <p>Result Blogs</p>
        </div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon">A</div>
        <div class="stat-info">
            <h3>{{ $blogs->where('category_id', 1)->count() }}</h3>
            <p>Admit Card Blogs</p>
        </div>
    </div>
</div>

<!-- Table -->
<div class="table-section">
    <div class="table-header">
        <h2>All Blogs</h2>
        <div class="table-controls">
            <input
                type="text"
                class="search-input"
                id="table-search"
                placeholder="Search blogs..."
                onkeyup="filterTable()"
            >
            <select class="filter-select" id="cat-filter" onchange="filterTable()">
                <option value="">All Categories</option>
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <a href="/admin/blogs/create" class="btn btn-success">+ Add Blog</a>
        </div>
    </div>

    <table id="blogs-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Blog</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $i => $blog)
            <tr>
                <td style="color:#9ca3af;font-size:13px;">{{ $i + 1 }}</td>
                <td>
                    <div class="blog-title-cell">
                        @if($blog->image)
                            <img
                                src="{{ asset('images/' . $blog->image) }}"
                                class="blog-thumb"
                                alt=""
                            >
                        @else
                            <div class="blog-thumb-placeholder">
                                {{ strtoupper(substr($blog->title, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="blog-name">{{ $blog->title }}</div>
                            <div class="blog-desc">{{ Str::limit($blog->short_description, 60) }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="category-tag">{{ $blog->category->name ?? '-' }}</span>
                </td>
                <td style="white-space:nowrap;color:#6b7280;font-size:13px;">
                    {{ $blog->created_at->format('d M Y') }}
                </td>
                <td>
                    <div class="actions-cell">
                        <a href="/blogs/{{ $blog->id }}"
                           target="_blank"
                           class="action-btn view">View</a>
                        <a href="/admin/blogs/{{ $blog->id }}/edit"
                           class="action-btn edit">Edit</a>
                        <form method="POST"
                              action="/admin/blogs/{{ $blog->id }}"
                              onsubmit="return confirm('Are you sure you want to delete this blog?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="empty-state">
                        <h3>No blogs found</h3>
                        <p>Start by adding your first blog post</p>
                        <a href="/admin/blogs/create" class="btn btn-primary">Add First Blog</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="table-footer">
        Showing {{ $blogs->count() }} blog(s)
    </div>
</div>

<script>
    function filterTable() {
        var search   = document.getElementById('table-search').value.toLowerCase();
        var category = document.getElementById('cat-filter').value.toLowerCase();
        var rows     = document.querySelectorAll('#blogs-table tbody tr');

        rows.forEach(function(row) {
            var title = row.querySelector('.blog-name');
            var cat   = row.querySelector('.category-tag');

            if (!title) return;

            var titleMatch = title.textContent.toLowerCase().includes(search);
            var catMatch   = category === '' || (cat && cat.textContent.toLowerCase().includes(category));

            row.style.display = (titleMatch && catMatch) ? '' : 'none';
        });
    }
</script>
@endsection