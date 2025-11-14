<div class="widget">
    <h5 class="widget-title">My photos</h5>

    <div id="photos-spinner" class="text-center" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2">Loading photos...</p>
    </div>

    <div id="photos-container">
        <ul class="member-photo-list d-flex flex-wrap gap-3" id="member-photo-list">
        </ul>

        <div id="photos-pagination" class="mt-3">
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentPage = 1;

            loadPhotos(currentPage);

            function loadPhotos(page) {
                const spinner = document.getElementById('photos-spinner');
                const photoList = document.getElementById('member-photo-list');
                const paginationContainer = document.getElementById('photos-pagination');

                spinner.style.display = 'block';
                photoList.innerHTML = '';
                paginationContainer.innerHTML = '';

                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('page', page);

                fetch('{{ route('site.load_profile_pictures') }}', {
                        method: '{{ FORM_METHOD_POST }}',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        spinner.style.display = 'none';

                        if (data.status === 1) {
                            renderPhotos(data.images);
                            renderPagination(data.pagination);
                            currentPage = page;
                        } else {
                            photoList.innerHTML = '<li class="w-100 text-center text-muted">No photos found</li>';
                        }
                    })
                    .catch(error => {
                        console.error('Error loading photos:', error);
                        spinner.style.display = 'none';
                        photoList.innerHTML = '<li class="w-100 text-center text-danger">Error loading photos</li>';
                    });
            }

            function renderPhotos(images) {
                const photoList = document.getElementById('member-photo-list');

                if (images.length === 0) {
                    photoList.innerHTML = '<li class="w-100 text-center text-muted">No photos uploaded yet</li>';
                    return;
                }

                images.forEach(image => {
                    const listItem = document.createElement('li');
                    listItem.classList.add('member-photo-item');
                    // Set styling here to ensure consistency (square image displays, etc)
                    listItem.style.listStyle = "none";
                    listItem.style.flex = "0 0 auto";
                    listItem.style.padding = "0";
                    listItem.style.margin = "0";

                    const imageUrl = image.media_url || image.file_path || '/default-image.jpg';
                    const altText = image.alt_text || 'User photo';

                    listItem.innerHTML = `
                        <a href="${imageUrl}" data-lightbox="user-photos" class="d-block">
                            <img src="${imageUrl}" alt="${altText}" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        </a>
                    `;

                    photoList.appendChild(listItem);
                });
            }

            function renderPagination(pagination) {
                const paginationContainer = document.getElementById('photos-pagination');

                if (pagination.last_page <= 1) {
                    return;
                }

                const paginationHtml = `
            <div class="photo-pagination">
                ${pagination.current_page > 1 ?
                    `<a href="javascript:void(0)" onclick="loadPhotos(${pagination.current_page - 1})"><i class='dashicons dashicons-arrow-right'></i></a>` :
                    `<span class=" disabled"><i class='dashicons dashicons-arrow-right'></i></span>`
                }

                ${generatePageNumbers(pagination.current_page, pagination.last_page)}

                ${pagination.has_more ?
                    `<a href="javascript:void(0)" onclick="loadPhotos(${pagination.current_page + 1})"><i class='dashicons dashicons-arrow-right'></i></a>` :
                    `<span class=" disabled"><i class='dashicons-arrow-right'></i></span>`
                }
                    </div>
                `;

                paginationContainer.innerHTML = paginationHtml;
            }

            function generatePageNumbers(currentPage, lastPage) {
                let pages = '';
                const maxVisiblePages = 5;

                let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(lastPage, startPage + maxVisiblePages - 1);

                if (endPage - startPage + 1 < maxVisiblePages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    if (i === currentPage) {
                        pages += `<span class=" active">${i}</span>`;
                    } else {
                        pages +=
                            `<a href="javascript:void(0)" class="" onclick="loadPhotos(${i})">${i}</a>`;
                    }
                }

                return pages;
            }

            window.loadPhotos = loadPhotos;
        });
    </script>
@endpush
