<form action="{{ route('adverts.save_advert') }}" method="{{ FORM_METHOD_POST }}" enctype="multipart/form-data"
    class="adverts-form adverts-form-aligned">
    @csrf
    <fieldset>

        <div class="adverts-control-group adverts-field-header adverts-field-name-_contact_information">

            <div class="adverts-field-header block-title">
                <h3 class="adverts-field-header-title">Contact Information</h3>
            </div>

        </div>
        <div class="adverts-control-group adverts-field-account adverts-field-name-_adverts_account">

            <label for="_adverts_account">
                Account </label>
            <div class="atw-text-base">You are posting as <strong>{{ Auth::user()->username }}</strong>. <br />If you
                want to use a
                different account, please <a href="{{ route('users.logout') }}">logout</a>.
            </div>

        </div>
        <div class="adverts-control-group adverts-field-text adverts-field-name-adverts_person">

            <label for="adverts_person">
                Contact Person <span class="adverts-form-required">*</span>
            </label>
            <input type="text" name="adverts_person" id="adverts_person" value="{{ Auth::user()->username }}" />

        </div>
        <div class="adverts-control-group adverts-field-text adverts-field-name-adverts_email">

            <label for="adverts_email">
                Email <span class="adverts-form-required">*</span>
            </label>
            <input type="text" name="adverts_email" id="adverts_email" value="{{ Auth::user()->email }}" />

        </div>
        <div class="adverts-control-group adverts-field-text adverts-field-name-adverts_phone">

            <label for="adverts_phone">
                Phone Number </label>
            <input type="text" name="adverts_phone" id="adverts_phone" />

        </div>
        <div class="adverts-control-group adverts-field-header adverts-field-name-_item_information">

            <div class="adverts-field-header block-title">
                <h3 class="adverts-field-header-title">Advertisment Information</h3>
            </div>

        </div>
        <div class="adverts-control-group adverts-field-text adverts-field-name-post_title">

            <label for="post_title">
                Title <span class="adverts-form-required">*</span>
            </label>
            <input type="text" name="post_title" id="post_title" />

        </div>
        <div class="adverts-control-group adverts-field-select adverts-field-name-advert_category">

            <label for="advert_category">
                Category </label>
            <select id="advert_category" name="advert_category" class=" adverts-multiselect adverts-max-choices[10]">
                <option value="">Select</option>
                @foreach ($categories as $key => $value)
                    <option value="{{ $value->category_id }}">{{ $value->category_title }}</option>
                @endforeach
            </select>

        </div>

        <div class="adverts-control-group adverts-field-textarea adverts-field-name-post_content">

            <label for="post_content">
                Description <span class="adverts-form-required">*</span>
            </label>
            <div id="wp-post_content-wrap" class="wp-core-ui wp-editor-wrap tmce-active">
                <link rel='stylesheet' id='editor-buttons-css'
                    href='https://www.clientbetalink.xyz/MIGVELv1/wp-includes/css/editor.min.css?ver=6.8.3'
                    type='text/css' media='all' />
                <div id="wp-post_content-editor-container" class="wp-editor-container">
                    <textarea class="wp-editor-area" rows="8" autocomplete="off" cols="40" name="post_content" id="post_content"></textarea>
                </div>
            </div>

        </div>
        <div class="adverts-control-group adverts-field-text adverts-field-name-adverts_price">

            <label for="adverts_price">
                Price </label>
            <input type="text" name="adverts_price" id="adverts_price" class="adverts-filter-money" />

        </div>
        <div class="adverts-control-group adverts-field-text adverts-field-name-adverts_location">

            <label for="adverts_location">
                Location </label>
            <input type="text" name="adverts_location" id="adverts_location" />

        </div>
        <div class="adverts-control-group adverts-field-text adverts-field-name-website_address">

            <label for="website_address">
                Website Address </label>
            <input type="text" name="website_address" id="website_address" autocomplete="off" />

        </div>

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

        <div class="adverts-control-group submit adverts-field-actions">
            <input type="submit" name="submit" value="Submit" class="adverts-cancel-unload medium" />
        </div>

    </fieldset>
</form>

@push("script")
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

<script type="text/javascript">
    var ajaxurl = "/MIGVELv1/wp-admin/admin-ajax.php";
    (function() {
        var initialized = [];
        var initialize = function() {
            var init, id, inPostbox, $wrap;
            var readyState = document.readyState;

            if (readyState !== 'complete' && readyState !== 'interactive') {
                return;
            }

            for (id in tinyMCEPreInit.mceInit) {
                if (initialized.indexOf(id) > -1) {
                    continue;
                }

                init = tinyMCEPreInit.mceInit[id];
                $wrap = tinymce.$('#wp-' + id + '-wrap');
                inPostbox = $wrap.parents('.postbox').length > 0;

                if (
                    !init.wp_skip_init &&
                    ($wrap.hasClass('tmce-active') || !tinyMCEPreInit.qtInit.hasOwnProperty(id)) &&
                    (readyState === 'complete' || (!inPostbox && readyState === 'interactive'))
                ) {
                    tinymce.init(init);
                    initialized.push(id);

                    if (!window.wpActiveEditor) {
                        window.wpActiveEditor = id;
                    }
                }
            }
        }

        if (typeof tinymce !== 'undefined') {
            if (tinymce.Env.ie && tinymce.Env.ie < 11) {
                tinymce.$('.wp-editor-wrap ').removeClass('tmce-active').addClass('html-active');
            } else {
                if (document.readyState === 'complete') {
                    initialize();
                } else {
                    document.addEventListener('readystatechange', initialize);
                }
            }
        }

        if (typeof quicktags !== 'undefined') {
            for (id in tinyMCEPreInit.qtInit) {
                quicktags(tinyMCEPreInit.qtInit[id]);

                if (!window.wpActiveEditor) {
                    window.wpActiveEditor = id;
                }
            }
        }
    }());
</script>

@endpush
