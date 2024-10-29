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
                    Update Document
                </x-breadcrumb>
            </ol>
        </nav>

        <div class="tw-max-w-5xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
            <h2 class="tw-text-3xl tw-font-bold tw-text-gray-800 tw-text-center tw-mb-6">Update Document</h2>

            <!-- Document Upload Form -->
            <form action="{{ route('update.document', $document->id) }}" method="POST" enctype="multipart/form-data" class="tw-space-y-6">
                @csrf
                @method('PATCH')
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                    <!-- Document Title -->
                    <div>
                        <label for="document_type" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Document Title</label>
                        <input type="text" id="document_type" name="document_type" value="{{ $document->document_type }}" required class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm focus:ring-indigo-500 focus:border-indigo-500 tw-sm-text-sm">
                    </div>
                    @error('document_type')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <!-- File Upload -->
                    <div>
                        <label for="file" class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-pb-2">Upload Document</label>
                        <input type="file" id="file" name="file"class="tw-block tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500 tw-sm-text-sm" required>
                    </div>
                    @error('file')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="tw-mt-2 tw-bg-gray-50 tw-p-3 tw-rounded-md">
                            <p class="tw-text-sm tw-text-gray-600">View the uploaded document:
                                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="tw-text-blue-500 hover:tw-text-blue-700 hover:tw-underline">
                                    click here
                                </a>
                            </p>
                        </div>
                <div class="tw-flex tw-justify-center tw-gap-x-4 tw-mt-6">
                    <button type="submit" class="tw-w-1/2 sm:tw-w-auto tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md tw-shadow tw-hover:bg-indigo-700 tw-focus:outline-none tw-focus:ring-2 tw-focus:ring-indigo-500 tw-focus:ring-offset-2">Update Document</button>
                    <button type="submit" form="delete-form" class="tw-w-1/2 sm:tw-w-auto tw-px-4 tw-py-2 tw-bg-red-600 tw-text-white tw-font-semibold tw-rounded-md tw-shadow tw-hover:bg-red-700 tw-focus:outline-none tw-focus:ring-2 tw-focus:ring-red-500 tw-focus:ring-offset-2">Delete Document</button>
                   
                </div>
            </form>
            
            <div class="tw-mt-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">Required Documents</h3>
                <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
                    <p>Please update necessary documents, such as business registrations, certifications, and insurance, that are required for the vendor registration process.</p> <br>
                    <p>To cancel an uploaded document, click <a href="{{ route('view-documents') }}" class="tw-text-indigo-600 tw-underline">here</a>.</p>
                </div>
            </div>

        </div>
        <form action="{{ route('delete.document', $document->id) }}" id="delete-form" class="hidden" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
    </div>
</x-layout>

