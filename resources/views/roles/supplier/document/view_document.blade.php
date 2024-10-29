<x-layout>
    <div class="container tw-my-10">
        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse ">
                <x-breadcrumb href="/supplier/dashboard" :active="false" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
                    Dashboard
                </x-breadcrumb>

                <x-breadcrumb href="#" :active="true" :isLast="false">
                    Document Management
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Contract view
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
            <h2 class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">Uploaded Document</h2>

            <!-- Documents List and Search Input -->
            <div class="tw-flex tw-items-center tw-justify-between tw-mb-16 tw-mt-4 tw-space-x-2">
                <div class="tw-relative tw-w-full tw-max-w-xs"><input type="text" id="search-documents" class="tw-w-full tw-px-4 tw-py-2 tw-pl-10 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm-text-sm" placeholder="Search documents...">
                    <div class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3"><i class="fa-solid fa-search tw-text-gray-500"></i></div>
                </div>
                <div>
                    <button id="list-view-btn" class="tw-bg-gray-100 tw-p-2 tw-rounded-md tw-text-gray-700 tw-text-sm tw-font-medium tw-mr-2"><i class="fa-solid fa-list tw-mr-2"></i>List View</button>

                    <button id="tile-view-btn" class="tw-bg-gray-100 tw-p-2 tw-rounded-md tw-text-gray-700 tw-text-sm tw-font-medium"><i class="fa-solid fa-th tw-mr-2"></i>Tiles View</button>
                </div>
            </div>

            <div class="tw-flex tw-items-center tw-mb-4">
                <h3 class="tw-text-lg tw-font-medium tw-text-gray-700">Total Documents: {{ $supplier->documents->count() }}</h3>
            </div>

            <div class="tw-flex tw-flex-col tw-space-y-4" data-aos="fade-up" id="document-list">
                @foreach ($supplier->documents->sortBy('document_type') as $document)

                <div class="tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-4 tw-flex tw-flex-col tw-space-y-4 document-item">
                    <div class="tw-flex tw-items-center tw-justify-between tw-border-b tw-pb-2">
                        <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">{{ $document->document_type }}</h4>
                        <div class="tw-flex tw-items-center tw-space-x-2">
                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="tw-text-indigo-600 tw-text-sm tw-font-medium tw-underline">View File</a>
                            <a href="{{ route('edit.document', $document->id) }}" class="tw-text-indigo-600 tw-text-sm tw-font-medium tw-underline">Edit Document</a>
                        </div>
                    </div>
                    <p class="tw-text-sm tw-text-gray-600">Uploaded on: {{ $document->created_at->format('M d, Y') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-documents').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const documentItems = document.querySelectorAll('.document-item');
            const visibleDocuments = Array.from(documentItems).filter(function(item) {
                const title = item.querySelector('.document-title').textContent.toLowerCase();
                return title.includes(searchValue);
            });

            const documentList = document.getElementById('document-list');
            const noResultNote = document.querySelector('#document-list .no-results');

            if (visibleDocuments.length === 0) {
                if (!noResultNote) {
                    const note = document.createElement('p');
                    note.classList.add('tw-text-center', 'tw-text-gray-600', 'tw-font-medium', 'tw-mt-4', 'no-results');
                    note.textContent = 'No documents found. Try searching with a different keyword.';
                    documentList.appendChild(note);
                }
            } else {
                if (noResultNote) {
                    noResultNote.remove();
                }
            }

            visibleDocuments.forEach(function(item) {
                item.style.display = '';
            });

            documentItems.forEach(function(item) {
                if (!visibleDocuments.includes(item)) {
                    item.style.display = 'none';
                }
            });
        });

        // Toggle to tiles view
        document.getElementById('tile-view-btn').addEventListener('click', function() {
            document.getElementById('document-list').classList.remove('tw-flex-col', 'tw-space-y-4');
            document.getElementById('document-list').classList.add('tw-grid', 'tw-grid-cols-2', 'tw-gap-4');
            document.getElementById('tile-view-btn').classList.add('tw-bg-indigo-600', 'tw-text-white');
            document.getElementById('list-view-btn').classList.remove('tw-bg-indigo-600', 'tw-text-white');
        });
        // Toggle to list view
        document.getElementById('list-view-btn').addEventListener('click', function() {
            document.getElementById('document-list').classList.remove('tw-grid', 'tw-grid-cols-2', 'tw-gap-4');
            document.getElementById('document-list').classList.add('tw-flex-col', 'tw-space-y-4');
            document.getElementById('list-view-btn').classList.add('tw-bg-indigo-600', 'tw-text-white');
            document.getElementById('tile-view-btn').classList.remove('tw-bg-indigo-600', 'tw-text-white');
        });
        document.getElementById('list-view-btn').click();
    </script>
</x-layout>