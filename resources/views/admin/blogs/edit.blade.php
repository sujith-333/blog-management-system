@extends('layouts.admin')

@section('page-title', 'Edit Blog')

@section('content')
<style>
    .create-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 24px;
        align-items: start;
        width: 100%;
    }

    .form-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        overflow: hidden;
    }

    .form-card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #f0f2f5;
    }

    .form-card-header h2 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1f2e;
    }

    .form-card-header p {
        font-size: 13px;
        color: #6b7280;
        margin-top: 3px;
    }

    .form-card-body { padding: 25px; }

    .form-group { margin-bottom: 22px; }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 7px;
    }

    .form-group label span.required { color: #ef4444; margin-left: 2px; }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 11px 15px;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        color: #1a1f2e;
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #fff;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #4a6cf7;
        box-shadow: 0 0 0 3px rgba(74,108,247,0.08);
    }

    .form-group textarea { min-height: 100px; resize: vertical; }

    .error-text { color: #ef4444; font-size: 12px; margin-top: 5px; }

    .char-count {
        font-size: 11px;
        color: #9ca3af;
        text-align: right;
        margin-top: 4px;
    }

    /* File Upload */
    .file-upload-area {
        border: 2px dashed #e5e7eb;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        position: relative;
    }

    .file-upload-area:hover {
        border-color: #4a6cf7;
        background: #f8f9ff;
    }

    .file-upload-area input[type="file"] {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        opacity: 0; cursor: pointer;
        border: none; padding: 0;
    }

    .file-upload-area p { font-size: 13px; color: #6b7280; margin-bottom: 4px; }
    .file-upload-area small { font-size: 11px; color: #9ca3af; }

    .current-image-box {
        margin-bottom: 12px;
    }

    .current-image-box img {
        width: 100%;
        max-height: 160px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .current-image-box p {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 6px;
    }

    #image-preview { display: none; margin-top: 10px; }
    #image-preview img {
        width: 100%;
        max-height: 160px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    /* Editor */
    .editor-wrapper {
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        transition: border-color 0.2s;
    }

    .editor-wrapper:focus-within {
        border-color: #4a6cf7;
        box-shadow: 0 0 0 3px rgba(74,108,247,0.08);
    }

    #editor-toolbar {
        background: #f8f9fb;
        border-bottom: 1px solid #e5e7eb;
        padding: 8px 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 3px;
        align-items: center;
    }

    .toolbar-group {
        display: flex;
        gap: 2px;
        align-items: center;
        padding-right: 8px;
        margin-right: 5px;
        border-right: 1px solid #e5e7eb;
    }

    .toolbar-group:last-child { border-right: none; }

    #editor-toolbar button {
        padding: 5px 9px;
        border: 1px solid transparent;
        background: transparent;
        border-radius: 5px;
        cursor: pointer;
        font-size: 13px;
        min-width: 30px;
        color: #374151;
        transition: all 0.15s;
    }

    #editor-toolbar button:hover { background: #e5e7eb; }

    #editor-toolbar select {
        padding: 4px 7px;
        border: 1px solid #e5e7eb;
        border-radius: 5px;
        font-size: 12px;
        background: #fff;
        cursor: pointer;
        max-width: 115px;
        outline: none;
    }

    #editor-toolbar input[type="color"] {
        width: 28px; height: 26px;
        padding: 2px;
        border: 1px solid #e5e7eb;
        border-radius: 5px;
        cursor: pointer;
    }

    #content-editor {
        width: 100%;
        min-height: 380px;
        padding: 20px;
        font-size: 15px;
        font-family: 'Segoe UI', Arial, sans-serif;
        outline: none;
        line-height: 1.8;
        color: #333;
        background: #fff;
    }

    #content-editor img   { max-width: 100%; height: auto; margin: 8px 0; border-radius: 4px; }
    #content-editor table { border-collapse: collapse; width: 100%; margin: 10px 0; }
    #content-editor table td,
    #content-editor table th { border: 1px solid #ddd; padding: 8px 12px; }
    #content-editor table th  { background: #f8f9fb; font-weight: bold; }
    #content-editor blockquote {
        border-left: 4px solid #4a6cf7;
        margin: 10px 0; padding: 10px 20px;
        background: #f8f9ff; color: #555; font-style: italic;
    }
    #content-editor h1 { font-size: 2em;   margin: 15px 0 10px; }
    #content-editor h2 { font-size: 1.6em; margin: 12px 0 8px; }
    #content-editor h3 { font-size: 1.3em; margin: 10px 0 6px; }
    #content-editor a  { color: #4a6cf7; text-decoration: underline; }
    #content-editor hr { border: none; border-top: 2px solid #e5e7eb; margin: 15px 0; }

    .editor-footer {
        background: #f8f9fb;
        border-top: 1px solid #e5e7eb;
        padding: 7px 15px;
        font-size: 12px;
        color: #9ca3af;
        display: flex;
        justify-content: space-between;
    }

    /* Sidebar */
    .side-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .side-card-header {
        padding: 15px 20px;
        border-bottom: 1px solid #f0f2f5;
        font-size: 14px;
        font-weight: 700;
        color: #1a1f2e;
    }

    .side-card-body { padding: 20px; }

    .publish-btn {
        width: 100%;
        padding: 13px;
        background: #4a6cf7;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.2s, transform 0.1s;
        margin-bottom: 10px;
    }

    .publish-btn:hover {
        background: #3a5ce5;
        transform: translateY(-1px);
    }

    .cancel-btn {
        width: 100%;
        padding: 11px;
        background: #f3f4f6;
        color: #374151;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.2s;
        text-align: center;
        text-decoration: none;
        display: block;
        margin-bottom: 10px;
    }

    .cancel-btn:hover { background: #e5e7eb; }

    .delete-btn {
        width: 100%;
        padding: 11px;
        background: #fee2e2;
        color: #dc2626;
        border: 1.5px solid #fca5a5;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.2s;
    }

    .delete-btn:hover { background: #fecaca; }

    .meta-info {
        font-size: 13px;
        color: #6b7280;
        line-height: 2;
    }

    .meta-info strong { color: #374151; }

    .tips-list { list-style: none; }

    .tips-list li {
        font-size: 13px;
        color: #6b7280;
        padding: 6px 0;
        border-bottom: 1px solid #f9fafb;
        display: flex;
        gap: 8px;
        align-items: flex-start;
    }

    .tips-list li:last-child { border-bottom: none; }

    .tips-list li span.tip-dot {
        color: #4a6cf7;
        font-weight: bold;
        flex-shrink: 0;
    }

    /* Find bar */
    #find-bar {
        display: none;
        background: #fef9c3;
        border-bottom: 1px solid #e5e7eb;
        padding: 8px 12px;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    #find-bar.open { display: flex; }

    #find-bar input {
        padding: 5px 10px;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        font-size: 13px;
        width: 150px;
        outline: none;
    }

    #find-bar button {
        padding: 5px 12px;
        font-size: 12px;
        border: 1px solid #d1d5db;
        background: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Source modal */
    #source-modal {
        display: none;
        position: fixed; top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    #source-modal.open { display: flex; }

    #source-box {
        background: #fff;
        border-radius: 10px;
        padding: 24px;
        width: 90%;
        max-width: 700px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    #source-box h3 { margin-bottom: 12px; color: #1a1f2e; }

    #source-box textarea {
        width: 100%; height: 300px;
        font-family: 'Courier New', monospace;
        font-size: 13px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 10px;
        outline: none;
    }

    #source-box .modal-btns { margin-top: 12px; display: flex; gap: 10px; }

    @media (max-width: 900px) {
        .create-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="create-grid">

    <!-- Left: Main Form -->
    <div>
        <div class="form-card">
            <div class="form-card-header">
                <h2>Edit Blog</h2>
                <p>Update the details below and click Update Blog to save changes</p>
            </div>
            <div class="form-card-body">
                <form method="POST" action="/admin/blogs/{{ $blog->id }}" enctype="multipart/form-data" id="blog-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Title <span class="required">*</span></label>
                        <input
                            type="text"
                            name="title"
                            id="title-input"
                            value="{{ old('title', $blog->title) }}"
                            placeholder="Enter blog title"
                            maxlength="200"
                            onkeyup="updateCharCount('title-input','title-count',200)"
                        >
                        <div class="char-count">
                            <span id="title-count">{{ strlen($blog->title) }}</span> / 200
                        </div>
                        @error('title')<div class="error-text">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Short Description <span class="required">*</span></label>
                        <textarea
                            name="short_description"
                            id="desc-input"
                            placeholder="Brief summary"
                            maxlength="300"
                            style="min-height:80px"
                            onkeyup="updateCharCount('desc-input','desc-count',300)"
                        >{{ old('short_description', $blog->short_description) }}</textarea>
                        <div class="char-count">
                            <span id="desc-count">{{ strlen($blog->short_description) }}</span> / 300
                        </div>
                        @error('short_description')<div class="error-text">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Content <span class="required">*</span></label>

                        <div class="editor-wrapper">

                            <div id="find-bar">
                                <span style="font-size:13px;font-weight:600;color:#374151;">Find & Replace</span>
                                <input type="text" id="find-input" placeholder="Find...">
                                <input type="text" id="replace-input" placeholder="Replace with...">
                                <button type="button" onclick="findText()">Find</button>
                                <button type="button" onclick="replaceText()">Replace</button>
                                <button type="button" onclick="replaceAll()">All</button>
                                <button type="button" onclick="toggleFindBar()">X</button>
                            </div>

                            <div id="editor-toolbar">

                                <div class="toolbar-group">
                                    <select onchange="execCmd('formatBlock', this.value); this.blur();">
                                        <option value="p">Paragraph</option>
                                        <option value="h1">Heading 1</option>
                                        <option value="h2">Heading 2</option>
                                        <option value="h3">Heading 3</option>
                                        <option value="h4">Heading 4</option>
                                        <option value="h5">Heading 5</option>
                                        <option value="pre">Code Block</option>
                                        <option value="blockquote">Blockquote</option>
                                    </select>
                                </div>

                                <div class="toolbar-group">
                                    <select onchange="execCmd('fontName', this.value); this.blur();">
                                        <option value="">Font</option>
                                        <option value="Arial">Arial</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Courier New">Courier New</option>
                                        <option value="Verdana">Verdana</option>
                                        <option value="Segoe UI">Segoe UI</option>
                                        <option value="Tahoma">Tahoma</option>
                                        <option value="Impact">Impact</option>
                                    </select>
                                </div>

                                <div class="toolbar-group">
                                    <select onchange="execCmd('fontSize', this.value); this.blur();">
                                        <option value="">Size</option>
                                        <option value="1">8pt</option>
                                        <option value="2">10pt</option>
                                        <option value="3">12pt</option>
                                        <option value="4">14pt</option>
                                        <option value="5">18pt</option>
                                        <option value="6">24pt</option>
                                        <option value="7">36pt</option>
                                    </select>
                                </div>

                                <div class="toolbar-group">
                                    <button type="button" onclick="execCmd('bold')"          title="Bold"><b>B</b></button>
                                    <button type="button" onclick="execCmd('italic')"        title="Italic"><i>I</i></button>
                                    <button type="button" onclick="execCmd('underline')"     title="Underline"><u>U</u></button>
                                    <button type="button" onclick="execCmd('strikeThrough')" title="Strikethrough"><s>S</s></button>
                                    <button type="button" onclick="execCmd('superscript')"   title="Superscript">X2</button>
                                    <button type="button" onclick="execCmd('subscript')"     title="Subscript">X2</button>
                                </div>

                                <div class="toolbar-group">
                                    <input type="color" title="Text Color"      onchange="execCmd('foreColor',   this.value)" value="#000000">
                                    <input type="color" title="Highlight Color" onchange="execCmd('hiliteColor', this.value)" value="#ffff00">
                                </div>

                                <div class="toolbar-group">
                                    <select onchange="setLineHeight(this.value); this.blur();">
                                        <option value="">Line Height</option>
                                        <option value="1">1.0</option>
                                        <option value="1.2">1.2</option>
                                        <option value="1.5">1.5</option>
                                        <option value="1.8">1.8</option>
                                        <option value="2">2.0</option>
                                        <option value="2.5">2.5</option>
                                    </select>
                                </div>

                                <div class="toolbar-group">
                                    <button type="button" onclick="execCmd('justifyLeft')"   title="Left">L</button>
                                    <button type="button" onclick="execCmd('justifyCenter')" title="Center">C</button>
                                    <button type="button" onclick="execCmd('justifyRight')"  title="Right">R</button>
                                    <button type="button" onclick="execCmd('justifyFull')"   title="Justify">J</button>
                                </div>

                                <div class="toolbar-group">
                                    <button type="button" onclick="execCmd('insertUnorderedList')" title="Bullet">UL</button>
                                    <button type="button" onclick="execCmd('insertOrderedList')"   title="Numbered">OL</button>
                                    <button type="button" onclick="execCmd('indent')"              title="Indent">-></button>
                                    <button type="button" onclick="execCmd('outdent')"             title="Outdent"><-</button>
                                </div>

                                <div class="toolbar-group">
                                    <button type="button" onclick="insertLink()"    title="Link">Link</button>
                                    <button type="button" onclick="removeLink()"    title="Remove Link">-Lnk</button>
                                    <button type="button" onclick="document.getElementById('img-upload').click()" title="Image">Img</button>
                                    <input type="file" id="img-upload" accept="image/*" style="display:none" onchange="insertImage(this)">
                                    <button type="button" onclick="insertTable()"      title="Table">Tbl</button>
                                    <button type="button" onclick="insertHR()"         title="Divider">HR</button>
                                    <button type="button" onclick="insertInlineCode()" title="Code">Code</button>
                                </div>

                                <div class="toolbar-group">
                                    <button type="button" onclick="execCmd('removeFormat')" title="Clear">Clr</button>
                                    <button type="button" onclick="toggleFindBar()"         title="Find">Find</button>
                                    <button type="button" onclick="toggleSource()"          title="Source">HTML</button>
                                    <button type="button" onclick="printContent()"          title="Print">Print</button>
                                </div>

                                <div class="toolbar-group">
                                    <button type="button" onclick="execCmd('undo')" title="Undo">Undo</button>
                                    <button type="button" onclick="execCmd('redo')" title="Redo">Redo</button>
                                </div>

                            </div>

                            <div id="content-editor" contenteditable="true">{!! old('content', $blog->content) !!}</div>

                            <div class="editor-footer">
                                <span id="word-count">Words: 0</span>
                                <span id="char-count">Characters: 0</span>
                            </div>

                        </div>

                        <textarea name="content" id="content-hidden" style="display:none"></textarea>
                        @error('content')<div class="error-text">{{ $message }}</div>@enderror
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Right: Sidebar -->
    <div>

        <!-- Update Card -->
        <div class="side-card">
            <div class="side-card-header">Update</div>
            <div class="side-card-body">
                <button type="submit" form="blog-form" class="publish-btn">Update Blog</button>
                <a href="/admin/dashboard" class="cancel-btn">Cancel</a>
                <form method="POST"
                      action="/admin/blogs/{{ $blog->id }}"
                      onsubmit="return confirm('Are you sure you want to delete this blog?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete Blog</button>
                </form>
            </div>
        </div>

        <!-- Category Card -->
        <div class="side-card">
            <div class="side-card-header">Category <span style="color:#ef4444">*</span></div>
            <div class="side-card-body">
                <div class="form-group" style="margin-bottom:0">
                    <select name="category_id" form="blog-form">
                        <option value="">Select a category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $blog->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="error-text">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <!-- Featured Image Card -->
        <div class="side-card">
            <div class="side-card-header">Featured Image</div>
            <div class="side-card-body">

                @if($blog->image)
                    <div class="current-image-box">
                        <p>Current image:</p>
                        <img src="{{ asset('images/' . $blog->image) }}" alt="current">
                    </div>
                @endif

                <div class="file-upload-area">
                    <input
                        type="file"
                        name="image"
                        form="blog-form"
                        accept="image/*"
                        onchange="previewImage(this)"
                    >
                    <p>Click to replace image</p>
                    <small>JPG, PNG, GIF up to 2MB</small>
                </div>

                <div id="image-preview">
                    <img id="preview-img" src="" alt="New Preview">
                </div>

                @error('image')<div class="error-text">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- Blog Info Card -->
        <div class="side-card">
            <div class="side-card-header">Blog Info</div>
            <div class="side-card-body">
                <div class="meta-info">
                    <div><strong>ID:</strong> #{{ $blog->id }}</div>
                    <div><strong>Created:</strong> {{ $blog->created_at->format('d M Y') }}</div>
                    <div><strong>Updated:</strong> {{ $blog->updated_at->format('d M Y') }}</div>
                    <div><strong>Category:</strong> {{ $blog->category->name ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Tips Card -->
        <div class="side-card">
            <div class="side-card-header">Writing Tips</div>
            <div class="side-card-body">
                <ul class="tips-list">
                    <li><span class="tip-dot">+</span> Keep title under 70 characters</li>
                    <li><span class="tip-dot">+</span> Write a clear short description</li>
                    <li><span class="tip-dot">+</span> Use headings to structure content</li>
                    <li><span class="tip-dot">+</span> Select the correct category</li>
                    <li><span class="tip-dot">+</span> Use Ctrl+B for Bold, Ctrl+I for Italic</li>
                    <li><span class="tip-dot">+</span> Use Ctrl+K to insert a link quickly</li>
                    <li>
                        <span class="tip-dot">+</span>
                        <span>Featured image ideal size is
                        <strong style="color:#4a6cf7">1200 x 630 px</strong>
                        (16:9 ratio)</span>
                    </li>
                    <li><span class="tip-dot">+</span> Max image file size is 2MB</li>
                    <li><span class="tip-dot">+</span> Accepted formats: JPG, PNG, GIF</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<!-- Source Modal -->
<div id="source-modal">
    <div id="source-box">
        <h3>HTML Source Code</h3>
        <textarea id="source-textarea"></textarea>
        <div class="modal-btns">
            <button type="button" class="btn btn-primary" onclick="applySource()">Apply</button>
            <button type="button" class="btn btn-secondary" onclick="closeSource()">Close</button>
        </div>
    </div>
</div>

<script>
    const editor = document.getElementById('content-editor');

    function execCmd(cmd, value = null) {
        editor.focus();
        document.execCommand(cmd, false, value);
        updateCounts();
    }

    function updateCharCount(inputId, countId, max) {
        var len = document.getElementById(inputId).value.length;
        document.getElementById(countId).textContent = len;
    }

    function updateCounts() {
        var text  = editor.innerText.trim();
        var words = text ? text.split(/\s+/).length : 0;
        document.getElementById('word-count').textContent = 'Words: ' + words;
        document.getElementById('char-count').textContent = 'Characters: ' + text.length;
    }

    editor.addEventListener('input', updateCounts);
    updateCounts();

    function insertLink() {
        var url  = prompt('Enter URL:', 'https://');
        if (!url) return;
        var text = window.getSelection().toString();
        if (text) {
            execCmd('createLink', url);
        } else {
            var label = prompt('Link text:', url);
            execCmd('insertHTML', '<a href="' + url + '" target="_blank">' + (label || url) + '</a>');
        }
    }

    function removeLink() { execCmd('unlink'); }

    function insertImage(input) {
        if (!input.files || !input.files[0]) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            editor.focus();
            execCmd('insertHTML',
                '<img src="' + e.target.result + '" style="max-width:100%;height:auto;margin:8px 0;border-radius:4px;">');
        };
        reader.readAsDataURL(input.files[0]);
        input.value = '';
    }

    function insertTable() {
        var rows = prompt('Number of rows:', '3');
        var cols = prompt('Number of columns:', '3');
        if (!rows || !cols) return;
        var html = '<table border="1" style="border-collapse:collapse;width:100%;margin:10px 0;">';
        html += '<tr>';
        for (var j = 0; j < parseInt(cols); j++)
            html += '<th style="padding:8px;border:1px solid #ddd;background:#f8f9fb;">Header ' + (j+1) + '</th>';
        html += '</tr>';
        for (var i = 1; i < parseInt(rows); i++) {
            html += '<tr>';
            for (var j = 0; j < parseInt(cols); j++)
                html += '<td style="padding:8px;border:1px solid #ddd;">&nbsp;</td>';
            html += '</tr>';
        }
        html += '</table><p></p>';
        editor.focus();
        execCmd('insertHTML', html);
    }

    function insertHR() {
        execCmd('insertHTML', '<hr style="border:none;border-top:2px solid #e5e7eb;margin:15px 0;"><p></p>');
    }

    function insertInlineCode() {
        var text = window.getSelection().toString();
        execCmd('insertHTML',
            '<code style="background:#f1f3f5;padding:2px 6px;border-radius:4px;font-family:Courier New,monospace;font-size:13px;color:#ef4444;">'
            + (text || 'code') + '</code>');
    }

    function setLineHeight(value) {
        if (!value) return;
        var text = window.getSelection().toString();
        if (text) {
            execCmd('insertHTML', '<span style="line-height:' + value + '">' + text + '</span>');
        } else {
            editor.style.lineHeight = value;
        }
    }

    function toggleFindBar() {
        document.getElementById('find-bar').classList.toggle('open');
    }

    function findText() {
        var term = document.getElementById('find-input').value;
        if (term) window.find(term);
    }

    function replaceText() {
        var find    = document.getElementById('find-input').value;
        var replace = document.getElementById('replace-input').value;
        if (!find) return;
        var html = editor.innerHTML;
        var idx  = html.indexOf(find);
        if (idx !== -1)
            editor.innerHTML = html.substring(0, idx) + replace + html.substring(idx + find.length);
        updateCounts();
    }

    function replaceAll() {
        var find    = document.getElementById('find-input').value;
        var replace = document.getElementById('replace-input').value;
        if (!find) return;
        editor.innerHTML = editor.innerHTML.split(find).join(replace);
        updateCounts();
    }

    function toggleSource() {
        document.getElementById('source-textarea').value = editor.innerHTML;
        document.getElementById('source-modal').classList.add('open');
    }

    function applySource() {
        editor.innerHTML = document.getElementById('source-textarea').value;
        closeSource();
        updateCounts();
    }

    function closeSource() {
        document.getElementById('source-modal').classList.remove('open');
    }

    function printContent() {
        var w = window.open('', '_blank');
        w.document.write('<html><head><title>Print</title></head><body>' + editor.innerHTML + '</body></html>');
        w.document.close();
        w.print();
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('blog-form').addEventListener('submit', function() {
        document.getElementById('content-hidden').value = editor.innerHTML;
    });

    editor.addEventListener('keydown', function(e) {
        if (e.ctrlKey) {
            switch(e.key.toLowerCase()) {
                case 'b': e.preventDefault(); execCmd('bold');      break;
                case 'i': e.preventDefault(); execCmd('italic');    break;
                case 'u': e.preventDefault(); execCmd('underline'); break;
                case 'k': e.preventDefault(); insertLink();         break;
            }
        }
    });
</script>
@endsection