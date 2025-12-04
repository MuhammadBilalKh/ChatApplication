@extends('layout.master.main')

@section('title', 'Upload Products')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Upload Products',
    ])
@endsection

@push('css')
    <link rel="stylesheet" href="/assets/css/tags.css" />
@endpush

@section('dashboard-content')
    <nav class="nav-component">
        <ul id="menu-shop-menu" class="nav-component-list shop-navbar">
            <li class="menu-item {{ request()->routeIs('shops.list') ? 'current-menu-item current_page_item' : '' }}">
                <a href="{{ route('shops.list') }}">All products</a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/product-categories') }}">Categories</a>
            </li>
            <li class="menu-item {{ request()->routeIs('shops.create') ? 'current-menu-item current_page_item' : '' }}">
                <a href="{{ route('shops.create') }}">Upload Products</a>
            </li>
            <li
                class="menu-item {{ request()->routeIs('shops.manage_orders') ? 'current-menu-item current_page_item' : '' }}">
                <a href="{{ route('shops.manage_orders') }}">Orders</a>
            </li>
        </ul>
    </nav>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $key => $value)
                    <li>{{ $value }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            <span>{{ session()->get('success') }}</span>
        </div>
    @endif

    <form method="{{ FORM_METHOD_POST }}" action="{{ route('shops.submit') }}" enctype="multipart/form-data">
        @csrf
        <div class="shop-filters beehive-filters">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Product Name: </label>
                        <input type="text" name="product_name" class="form-control" placeholder="Product Name" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Price: </label>
                        <input type="number" name="product_price" id="txtProductPrice" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Description: </label>
                        <textarea name="product_description" id="txtProductDescription" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="drop-zone" id="dropZone">
                            <div class="drop-left">
                                <div class="icon" aria-hidden>📁</div>
                                <div class="drop-content">
                                    <div class="title">Drop a file here</div>
                                    <div class="subtitle">or click <strong>Select file</strong> to choose from your device
                                    </div>
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
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Categories</label>
                        <input type="text" name="categories" id="txtProductCategories" />
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-success" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>
    <script src="/assets/js/tags.min.js"></script>

    <script>
        ClassicEditor.create(document.querySelector('#txtProductDescription'), {
            toolbar: [
                'bold', 'italic', 'link', 'undo', 'redo',
                'bulletedList', 'numberedList',
            ]
        }).catch(error => console.error(error));
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

        jQuery(document).ready(function() {
            $('#txtProductCategories').tagsInput({
                'defaultText': 'Add Category',
                'delimiter': [',', ' '],
                'width': '100%',
            });
        });
    </script>
@endpush
