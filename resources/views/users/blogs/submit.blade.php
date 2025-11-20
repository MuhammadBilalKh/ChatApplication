@extends('layout.master.main')

@section('title', 'Create Blog')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Post Blog',
    ])
@endsection

@section('dashboard-content')
    <nav class="nav-component">
        <ul id="menu-adverts-menu" class="nav-component-list advert-navbar">
            <li id="menu-item-118" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-118">
                <a href="{{ route('blogs.list', ['type' => 'list-blog']) }}">Blogs</a>
            </li>

            <li id="menu-item-119"
                class="menu-item menu-item-type-post_type current-menu-item current_page_item  menu-item-object-page menu-item-119">
                <a href="{{ route('blogs.list', ['type' => 'create-blog']) }}">Submit</a>
            </li>

            @if (Auth::user()->user_type == USER_TYPE_USER)
                <li id="menu-item-119" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                    <a href="{{ route('blogs.list', ['type' => 'mark-approval-blog']) }}">Mark For Approval</a>
                </li>

                <li id="menu-item-119" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                    <a href="{{ route('blogs.list', ['type' => 'manage-blog-approval']) }}">Approve / Reject Blog</a>
                </li>
            @endif

            @if (Auth::user()->user_type == USER_TYPE_ADMIN)
                <li id="menu-item-122" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                    <a type="button">Pending For Approval</a>
                </li>
            @endif
        </ul>
    </nav>

    @if (session()->has('success'))
        <div class="alert alert-success">
            <span>{{ session()->get('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $key => $value)
                    <li>{{ $value }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="{{ FORM_METHOD_POST }}" action="{{ route('blog.save_blog') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Title: </label>
                    <input class="form-control" name="blog_title" value="{{ old('blog_title') }}"
                        placeholder="Please Enter Blog Title" />
                </div>
            </div>

            <div class="col-sm-12">
                <div class="field required-field"> <label>Enter Tags (Seperated By '#')</label>
                            <input type="text" name="hashtags" class="form-control" />
                </div>
            </div>

            <div class="col-sm-12">

                <div class="field required-field">
                    <label>Enter Description: </label>
                    <textarea name="description" rows='12' id="txtDescription">{!! old('description') !!}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-sm-12 mt-3">
                <label>Select Blog Cover Image</label>
                <label class="drop-zone" id="dropZone">
                    <div class="drop-left">
                        <div class="icon" aria-hidden>📁</div>
                        <div class="drop-content">
                            <div class="title">Drop a file here</div>
                            <div class="subtitle">or click <strong>Select file</strong> to choose from your device</div>
                        </div>
                    </div>

                    <div class="drop-actions">
                        <button type="button" class="btn ghost" id="selectBtn">Select file</button>
                        <input id="fileInput" name="media_input[]" type="file" multiple
                            aria-label="Select files to upload" />
                    </div>
                </label>

                <div class="files" id="filesList" aria-live="polite">
                    <div class="empty" id="emptyNote">No file selected.</div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group float-right">
                    <input type="submit" value="Save" class="btn btn-success" />
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>

    <script>
        jQuery(document).ready(function() {
            ClassicEditor.create(document.querySelector('#txtDescription'), {
                toolbar: [
                    'bold', 'italic', 'link', 'undo', 'redo',
                    'bulletedList', 'numberedList', 'underline',
                ]
            }).catch(error => console.error(error));

            jQuery(".alert").delay(2500).fadeOut();
        });
    </script>

    <script>
        (function() {
            const fileInput = document.getElementById('fileInput');
            const dropZone = document.getElementById('dropZone');
            const filesList = document.getElementById('filesList');
            const emptyNote = document.getElementById('emptyNote');
            const selectBtn = document.getElementById('selectBtn');

            let filesArray = [];

            selectBtn.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', (e) => {
                addFiles(e.target.files);
            });

            ['dragenter', 'dragover'].forEach(evt => {
                dropZone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    dropZone.classList.add('dragover');
                });
            });

            ['dragleave', 'dragend', 'mouseout'].forEach(evt => {
                dropZone.addEventListener(evt, () => dropZone.classList.remove('dragover'));
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('dragover');
                const dt = e.dataTransfer;
                if (dt && dt.files && dt.files.length) addFiles(dt.files);
            });

            function addFiles(fileList) {
                const incoming = Array.from(fileList);
                incoming.forEach(file => {
                    // Prevent duplicate files
                    const exists = filesArray.some(f => f.name === file.name && f.size === file.size && f
                        .lastModified === file.lastModified);
                    if (!exists) filesArray.push(file);
                });
                renderFiles();
                // Update actual file input for submission
                const dataTransfer = new DataTransfer();
                filesArray.forEach(f => dataTransfer.items.add(f));
                fileInput.files = dataTransfer.files;
            }

            function renderFiles() {
                filesList.innerHTML = '';
                if (filesArray.length === 0) {
                    filesList.appendChild(emptyNote);
                    return;
                }

                filesArray.forEach((file, index) => {
                    const item = document.createElement('div');
                    item.className = 'file-item';

                    const thumb = document.createElement('div');
                    thumb.className = 'file-thumb';

                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.alt = file.name;
                        img.onload = () => URL.revokeObjectURL(img.src);
                        thumb.appendChild(img);
                    } else {
                        thumb.innerHTML = '<div style="font-size:18px;color:#475569">📄</div>';
                    }

                    const meta = document.createElement('div');
                    meta.className = 'file-meta';
                    const name = document.createElement('div');
                    name.className = 'name';
                    name.textContent = file.name;
                    const info = document.createElement('div');
                    info.className = 'info';
                    info.textContent = humanFileSize(file.size) + ' • ' + (file.type || 'unknown');

                    meta.appendChild(name);
                    meta.appendChild(info);

                    const actions = document.createElement('div');
                    actions.className = 'file-actions';
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'small remove';
                    removeBtn.textContent = 'Remove';
                    removeBtn.addEventListener('click', () => {
                        filesArray.splice(index, 1);
                        renderFiles();
                        // Update file input
                        const dataTransfer = new DataTransfer();
                        filesArray.forEach(f => dataTransfer.items.add(f));
                        fileInput.files = dataTransfer.files;
                    });

                    actions.appendChild(removeBtn);
                    item.appendChild(thumb);
                    item.appendChild(meta);
                    item.appendChild(actions);

                    filesList.appendChild(item);
                });
            }

            function humanFileSize(bytes) {
                const thresh = 1024;
                if (Math.abs(bytes) < thresh) return bytes + ' B';
                const units = ['KB', 'MB', 'GB', 'TB'];
                let u = -1;
                do {
                    bytes /= thresh;
                    ++u;
                } while (Math.abs(bytes) >= thresh && u < units.length - 1);
                return bytes.toFixed(1) + ' ' + units[u];
            }

            renderFiles();
        })();
    </script>
@endpush
