<x-layout>

  <div class="container tw-my-10">
    <!-- Breadcrumb -->
    <nav class="tw-flex tw-mb-5 max-sm:justify-center" aria-label="Breadcrumb">
      <ol class="tw-inline-flex tw-items-center tw-space-x-1 md:tw-space-x-2 rtl:tw-space-x-reverse ">
        <x-breadcrumb href="/" :active="false" :isLast="false">
          <div class="sb-nav-link-icon"><i class="fa-solid fa-table-columns"></i></div>
          Dashboard
        </x-breadcrumb>

        <x-breadcrumb href="#" :active="true" :isLast="false">
          Vendor
        </x-breadcrumb>

        <x-breadcrumb :active="true" :isLast="true">
          Order Review
        </x-breadcrumb>
      </ol>
    </nav>

    <!-- Vendor Order Review Section -->
    <div class="tw-max-w-5xl tw-mx-auto tw-bg-white tw-rounded-lg tw-shadow-md tw-p-8">
      <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Vendor Order Review</h2>
      <p class="tw-text-gray-600 tw-text-center tw-mt-2">Review purchase orders and approve payments</p>


      <!-- Vendor Order List -->
      <div id="orderContainer" class="tw-mt-8">
        <h3 class="tw-text-lg tw-font-semibold tw-text-gray-700">Vendor Order List</h3>
        <table class="tw-w-full tw-mt-4 tw-border tw-rounded-lg tw-border-gray-300 tw-shadow-sm">
          <thead>
            <tr class="tw-bg-gray-200">
              <th class="tw-px-4 tw-py-2 tw-text-left tw-font-semibold">Vendor</th>
              <th class="tw-px-4 tw-py-2 tw-text-left tw-font-semibold">Order ID</th>
              <th class="tw-px-4 tw-py-2 tw-text-left tw-font-semibold">Order Date</th>
              <th class="tw-px-4 tw-py-2 tw-text-left tw-font-semibold">Total Amount</th>
              <th class="tw-px-4 tw-py-2 tw-text-center tw-font-semibold">Action</th>
            </tr>
          </thead>
          <tbody id="vendorOrderList" class="tw-bg-white">
            <!-- Example Row - Dynamic Data will replace this -->
            <tr>
              <td class="tw-px-4 tw-py-2">ABC Vendor</td>
              <td class="tw-px-4 tw-py-2">PO123456</td>
              <td class="tw-px-4 tw-py-2">2023-11-05</td>
              <td class="tw-px-4 tw-py-2">$2,500</td>
              <td class="tw-px-4 tw-py-2 tw-text-center">
                <button class="tw-bg-green-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-md hover:tw-bg-green-600">Approve</button>
                <button class="tw-bg-yellow-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-md hover:tw-bg-yellow-600">Review</button>
              </td>
            </tr>
            <!-- Repeat similar rows dynamically for each vendor order -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

</x-layout>