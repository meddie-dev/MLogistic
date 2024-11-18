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

        <x-breadcrumb href="/admin/document/storage" :active="false" :isLast="false">
          Document Storage
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          {{$supplier->name}}
        </x-breadcrumb>
      </ol>
    </nav>

    <div class="tw-max-w-7xl tw-mx-auto tw-mt-10 tw-bg-white tw-rounded-lg tw-shadow-lg tw-p-8" data-aos="fade">
      <h2 class="tw-text-3xl tw-font-semibold tw-text-gray-800 tw-text-center tw-mb-6">Document Storage</h2>
      <div class="tw-flex tw-flex-col tw-space-y-6 tw-mt-8">
        @foreach ($supplier->documents->sortBy('document_type') as $document)
        <div class="tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6 tw-flex tw-flex-col tw-space-y-4 document-item">
          <!-- Document Header Section -->
          <div class="tw-flex tw-flex-col tw-space-y-2 tw-border-b tw-pb-4">
            <h4 class="tw-text-xl tw-font-semibold tw-text-gray-800">{{ $document->document_type }}</h4>
            <p class="tw-text-sm tw-text-gray-600">Uploaded on: {{ $document->created_at->format('M d, Y') }}</p>
          </div>

          <!-- Document Preview Section -->
          <div class="tw-flex tw-flex-col tw-space-y-4">
            <!-- Check if file is an image, display preview image if yes -->
            @if(in_array(pathinfo($document->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
            <div class="tw-flex justify-center">
              <img src="{{ asset('storage/' . $document->file_path) }}" width="100%" alt="Document Preview" class="tw-w-full tw-rounded-lg tw-shadow-sm tw-h-72 tw-object-cover">
            </div>
            @else
            <!-- Show document type icon if not an image -->
            <div class="tw-flex justify-center">
              <i class="fa-solid fa-file-alt tw-text-4xl tw-text-gray-600"></i>
            </div>
            @endif

            <!-- Action Links -->
            <div class="tw-flex tw-items-center tw-space-x-4 tw-pt-4">
              <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="tw-text-indigo-600 tw-text-sm tw-font-medium tw-underline">Download File</a>
            </div>

            <div class="tw-border-t tw-pt-4">
              <p class="tw-text-gray-600 tw-text-sm">This is the file uploaded by {{$supplier->name}} on {{ $document->created_at->format('M d, Y') }} . The actual file can be downloaded from the links above.</p>
            </div>
          </div>
        </div>
        @endforeach
        <a href="/admin/document/storage" class="tw-ml-3 tw-text-blue-500 tw-px-3 tw-py-1 tw-rounded-md ">Back</a>
        <hr>
      </div>
      <div class="tw-mt-6" data-aos="fade-up">
        <h3 class="tw-text-xl tw-font-semibold tw-text-gray-700 tw-mt-8 tw-mb-4">View Document Storage</h3>
        <div class="tw-text-sm tw-text-gray-600 tw-mb-4">
          <p>View all the documents uploaded by {{$supplier->name}}. Click on the download button to view the document.</p>
          <br>
          <p>The actual file can be downloaded from the links above.</p>
        </div>
      </div>
    </div>
    
  </div>
</x-layout>