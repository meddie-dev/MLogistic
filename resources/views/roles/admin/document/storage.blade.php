<x-layout>
    <div class="container-fluid px-4 tw-my-10">
        <!-- Breadcrumb -->
        <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
            <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse">
                <x-breadcrumb href="/admin/dashboard" :active="false" :isLast="false">
                    <div class="sb-nav-link-icon tw-pr-2"><i class="fa-solid fa-table-columns"></i></div>
                    Dashboard
                </x-breadcrumb>

                <x-breadcrumb href="#" :active="true" :isLast="false">
                    Document Management
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Document Storage
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
            <h2 class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">Document Storage</h2>

            <!-- Documents List and Search Input -->
            <div class="tw-flex tw-items-center tw-justify-between tw-mt-6 tw-mb-6 tw-space-x-2">
                <div class="tw-flex tw-items-center">
                    <h3 class="tw-text-xl tw-font-medium tw-text-gray-700">{{ $documents->count() }} Documents Uploaded</h3>
                </div>
                <div class="tw-relative tw-w-full tw-max-w-xs">
                    <input type="text" id="search-documents" class="tw-w-full tw-px-4 tw-py-2 tw-pl-10 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm-text-sm" placeholder="Search accounts...">
                    <div class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3">
                        <i class="fa-solid fa-search tw-text-gray-500"></i>
                    </div>
                </div>
            </div>

            <ul class="tw-list-disc tw-pl-4 tw-space-y-4 document-list">
                @foreach ($suppliers as $supplier)
                <li class="tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-4 tw-flex tw-flex-col tw-space-y-4 document-item">
                    <div class="tw-flex tw-items-center tw-justify-between tw-border-b tw-pb-2">
                        <h4 class="tw-text-lg tw-font-semibold tw-text-gray-800">{{ $supplier->name }} <span class="tw-text-sm tw-text-gray-300">({{ $supplier->documents->count() }} Uploaded Documents)</span></h4>
                        <div class="tw-flex tw-items-center tw-space-x-2">
                            <a href="{{ route('view-storage', $supplier->id) }}" class="tw-text-indigo-600 tw-text-sm tw-font-medium tw-underline">View Documents</a>
                        </div>
                    </div>
                    <p class="tw-text-sm tw-text-gray-600">Uploaded on: {{ $supplier->created_at->format('M d, Y') }}</p>
                </li>
                @endforeach
            </ul>
            <p class="tw-text-center tw-text-gray-300 tw-font-medium tw-mt-4 no-results" style="display: none;">No account found. Try searching with a different keyword.</p>
        </div>
    </div>
</x-layout>

<script>
    document.getElementById('search-documents').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const documentItems = document.querySelectorAll('.document-item');
        let visibleDocuments = 0;

        documentItems.forEach(function(item) {
            const title = item.querySelector('.tw-text-lg.tw-font-semibold').textContent.toLowerCase();
            if (title.includes(searchValue)) {
                item.style.display = '';
                visibleDocuments++;
            } else {
                item.style.display = 'none';
            }
        });

        const noResultsNote = document.querySelector('.no-results');
        if (visibleDocuments === 0) {
            noResultsNote.style.display = '';
        } else {
            noResultsNote.style.display = 'none';
        }
    });
</script>
