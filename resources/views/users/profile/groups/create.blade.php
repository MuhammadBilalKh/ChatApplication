@extends('layout.profile.profile-main')

@section('title', 'Create Group')

@section('profile-content')

    <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Groups menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">

            <li id="groups-my-groups-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="my-groups">
                <a href="{{ route('groups.create') }}" id="groups-my-groups">
                    Create Group
                </a>
            </li>

            <li id="groups-my-groups-personal-li" class="bp-personal-sub-tab current selected"
                data-bp-user-scope="my-groups">
                <a href="{{ route('groups.index') }}" id="groups-my-groups">
                    Memberships
                </a>
            </li>

            <li id="invites-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="invites">
                <a href="{{ route('groups.invitation') }}" id="invites">
                    Invitations
                </a>
            </li>

        </ul>

    </nav>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
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

    <div class="groups mygroups">

        <form method="POST" enctype="multipart/form-data" action="{{ route('groups.store') }}">
            @csrf

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select Group Cover Image</label>

                        <label class="drop-zone" id="coverDropZone">
                            <div class="drop-left">
                                <div class="icon">📁</div>
                                <div class="drop-content">
                                    <div class="title">Drop a file here</div>
                                    <div class="subtitle">or click <strong>Select file</strong></div>
                                </div>
                            </div>

                            <div class="drop-actions">
                                <button type="button" class="btn ghost" id="coverSelectBtn">Select file</button>
                                <input id="coverFileInput" name="cover_image" type="file" accept="image/*" />
                            </div>
                        </label>

                        <div class="files" id="coverFilesList">
                            <div class="empty">No file selected.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select Group Profile Image</label>

                        <label class="drop-zone" id="profileDropZone">
                            <div class="drop-left">
                                <div class="icon">📁</div>
                                <div class="drop-content">
                                    <div class="title">Drop a file here</div>
                                    <div class="subtitle">or click <strong>Select file</strong></div>
                                </div>
                            </div>

                            <div class="drop-actions">
                                <button type="button" class="btn ghost" id="profileSelectBtn">Select file</button>
                                <input id="profileFileInput" name="profile_image" type="file" accept="image/*" />
                            </div>
                        </label>

                        <div class="files" id="profileFilesList">
                            <div class="empty">No file selected.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Group Name:</label>
                        <input type="text" name="group_name" class="form-control" value="{{ old('group_name') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Group Description:</label>
                        <textarea name="group_description" class="form-control" rows="5" style="resize:none;">
                {{ old('group_description') }}
            </textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <fieldset class="radio group_status-type">
                        <legend>Privacy Options</legend>

                        <label for="group_status-public">
                            <input type="radio" name="group_status" id="group_status-public" value="public" checked>
                            This is a public group
                        </label>

                        <ul>
                            <li>Any site member can join this group.</li>
                            <li>This group will be listed in directories.</li>
                            <li>Content visible to any member.</li>
                        </ul>

                        <label for="group_status-private">
                            <input type="radio" name="group_status" id="group_status-private" value="private">
                            This is a private group
                        </label>

                        <ul>
                            <li>Only accepted members can join.</li>
                            <li>Group is listed publicly.</li>
                            <li>Content visible only to members.</li>
                        </ul>

                        <label for="group_status-hidden">
                            <input type="radio" name="group_status" id="group_status-hidden" value="hidden" />
                            This is a hidden group
                        </label>

                        <ul>
                            <li>Only invited people can join.</li>
                            <li>Group is not listed.</li>
                            <li>Content visible only to members.</li>
                        </ul>

                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <fieldset class="radio group-invitations">
                        <legend>Group Invitations</legend>

                        <p>Which members can invite others?</p>

                        <label><input type="radio" name="group_invite_status" value="members" checked> All
                            members</label>
                        <label><input type="radio" name="group_invite_status" value="admins"> Admins only</label>
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h2>Group Forum</h2>
                    <p>Create a discussion forum for structured communication.</p>

                    <label>
                        <input type="checkbox" name="bbp-create-group-forum" value="1">
                        Yes, create a forum for this group.
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success float-right">Create Group</button>
                </div>
            </div>

        </form>
    </div>
@endsection


@push('script')
    <script>
        function initUploader(dropZoneId, fileInputId, selectBtnId, filesListId) {

            const dropZone = document.getElementById(dropZoneId);
            const fileInput = document.getElementById(fileInputId);
            const selectBtn = document.getElementById(selectBtnId);
            const filesList = document.getElementById(filesListId);

            let fileObj = null;

            selectBtn.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', (e) => handleFile(e.target.files[0]));

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
                if (e.dataTransfer.files.length) {
                    handleFile(e.dataTransfer.files[0]);
                }
            });

            function handleFile(file) {
                fileObj = file;
                const dt = new DataTransfer();
                dt.items.add(file);
                fileInput.files = dt.files;
                renderFile();
            }

            function renderFile() {
                filesList.innerHTML = '';

                if (!fileObj) {
                    filesList.innerHTML = '<div class="empty">No file selected.</div>';
                    return;
                }

                const item = document.createElement('div');
                item.className = 'file-item';

                const thumb = document.createElement('div');
                thumb.className = 'file-thumb';

                const img = document.createElement('img');
                img.src = URL.createObjectURL(fileObj);
                img.onload = () => URL.revokeObjectURL(img.src);
                thumb.appendChild(img);

                const meta = document.createElement('div');
                meta.className = 'file-meta';
                meta.innerHTML = `<div class="name">${fileObj.name}</div>
                              <div class="info">${(fileObj.size / 1024).toFixed(1)} KB</div>`;

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'small remove';
                removeBtn.textContent = 'Remove';
                removeBtn.addEventListener('click', () => {
                    fileObj = null;
                    fileInput.value = '';
                    renderFile();
                });

                const actions = document.createElement('div');
                actions.className = 'file-actions';
                actions.appendChild(removeBtn);

                item.appendChild(thumb);
                item.appendChild(meta);
                item.appendChild(actions);

                filesList.appendChild(item);
            }
        }

        initUploader("coverDropZone", "coverFileInput", "coverSelectBtn", "coverFilesList");
        initUploader("profileDropZone", "profileFileInput", "profileSelectBtn", "profileFilesList");
    </script>
@endpush
