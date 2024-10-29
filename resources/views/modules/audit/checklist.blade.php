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
                    Audit
                </x-breadcrumb>

                <x-breadcrumb :active="true" :isLast="true">
                    Checklist
                </x-breadcrumb>
            </ol>
        </nav>

        <!-- Checklist -->
        <div class="tw-max-w-5xl tw-mx-auto tw-bg-white tw-rounded-lg tw-shadow-md tw-p-6">
        <h2 class="tw-text-2xl tw-font-bold tw-text-gray-800 tw-text-center">Audit Checklist</h2>
        <p class="tw-text-gray-600 tw-text-center tw-mt-2">Manage your checklist items</p>

        <form id="checklistForm" class="tw-my-5">
            <input type="text" id="checklistInput" placeholder="Enter checklist item" class="tw-w-full tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-focus:ring-indigo-500 tw-focus:border-indigo-500" required>
            <div class="tw-flex tw-space-x-2 tw-mt-4">
                <button type="submit" class="tw-flex-1 tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-font-semibold tw-rounded-md hover:tw:bg-indigo-700">Add Item</button>
                <button type="button" id="updateButton" class="tw-flex-1 tw-px-4 tw-py-2 tw-bg-blue-600 tw-text-white tw-font-semibold tw-rounded-md hover:tw:bg-blue-700 hidden">Update Item</button>
            </div>
        </form>

        <div id="checklistContainer" class="tw-mt-5">
            <h3 class="tw-text-lg tw-font-semibold tw-text-gray-700">Checklist Items</h3>
            <ul id="checklist" class="tw-list-disc tw-pl-5 tw-space-y-2"></ul>
        </div>
    </div>

    <script>
        let checklistItems = [];
        let editIndex = -1;

        const checklistForm = document.getElementById('checklistForm');
        const checklistInput = document.getElementById('checklistInput');
        const checklist = document.getElementById('checklist');
        const updateButton = document.getElementById('updateButton');

        checklistForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const itemValue = checklistInput.value.trim();

            if (editIndex > -1) {
                // Update existing item
                checklistItems[editIndex].item = itemValue;
                editIndex = -1;
                updateButton.classList.add('hidden');
            } else {
                // Add new item with default status
                checklistItems.push({ item: itemValue, status: 'Pending' });
            }

            renderChecklist();
            checklistInput.value = ''; // Clear input field
        });

        function renderChecklist() {
            checklist.innerHTML = ''; // Clear existing items

            checklistItems.forEach((checklistItem, index) => {
                const li = document.createElement('li');
                li.className = 'tw-flex tw-items-center tw-justify-between tw-py-2';
                li.innerHTML = `
                    <span class="tw-flex-1">${checklistItem.item}</span>
                    <div class="tw-flex items-center">
                        <select class="tw-px-2 tw-mr-3 tw-py-1  tw-border tw-border-gray-300 tw-rounded-md" onchange="updateStatus(${index}, this.value)">
                            <option value="Pending" ${checklistItem.status === 'Pending' ? 'selected' : ''}>Pending</option>
                            <option value="Done" ${checklistItem.status === 'Done' ? 'selected' : ''}>Done</option>
                            <option value="Not Done" ${checklistItem.status === 'Not Done' ? 'selected' : ''}>Not Done</option>
                        </select>
                       <div>
                            <button class="tw-px-2 tw-py-1 tw-bg-blue-600 tw-text-white tw-font-semibold tw-rounded-md hover:tw-bg-blue-700" onclick="editItem(${index})">Edit</button>
                            <button class="tw-px-2 tw-py-1 tw-bg-red-600 tw-text-white tw-font-semibold tw-rounded-md hover:tw-bg-red-700" onclick="deleteItem(${index})">Delete</button>
                        </div>
                    </div>
                `;
                checklist.appendChild(li);
            });
        }

        function updateStatus(index, status) {
            checklistItems[index].status = status; // Update the status of the item
        }

        function editItem(index) {
            editIndex = index; // Set the edit index
            checklistInput.value = checklistItems[index].item; // Populate input with the item
            updateButton.classList.remove('hidden'); // Show update button
        }

        function deleteItem(index) {
            if (confirm("Are you sure you want to delete this item?")) {
                checklistItems.splice(index, 1); // Remove item from the array
                renderChecklist(); // Re-render checklist
            }
        }
    </script>

</x-layout>