<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// Define the props that will be passed from the Laravel controller
const props = defineProps({
    subLedgers: Object, // Paginated list of sub-ledgers
    chartOfAccounts: Object, // List of all chart of accounts for the dropdown
});

// Initialize the form data for creating/editing a sub-ledger
const form = useForm({
    name: '',
    description: '',
    chart_of_account_id: null, // This will hold the ID of the controlling COA account
});

// Reactive state to control the visibility of the form
const showForm = ref(false);
// Reactive state to hold the sub-ledger being edited (null if creating new)
const editingSubLedger = ref(null);

/**
 * Handles form submission for both creating and updating sub-ledgers.
 */
const submitForm = () => {
    if (editingSubLedger.value) {
        // If editing an existing sub-ledger, use PUT request
        form.put(route('sub-ledgers.update', editingSubLedger.value.id), {
            onSuccess: () => {
                // On successful update, hide form, clear editing state, and reset form fields
                showForm.value = false;
                editingSubLedger.value = null;
                form.reset();
            },
            onError: (errors) => {
                console.error("Error updating sub-ledger:", errors);
            }
        });
    } else {
        // If creating a new sub-ledger, use POST request
        form.post(route('sub-ledgers.store'), {
            onSuccess: () => {
                // On successful creation, hide form and reset form fields
                showForm.value = false;
                form.reset();
            },
            onError: (errors) => {
                console.error("Error creating sub-ledger:", errors);
            }
        });
    }
};

/**
 * Sets up the form for editing an existing sub-ledger.
 * @param {Object} subLedger - The sub-ledger object to be edited.
 */
const editSubLedger = (subLedger) => {
    editingSubLedger.value = subLedger;
    form.name = subLedger.name;
    form.description = subLedger.description;
    form.chart_of_account_id = subLedger.chart_of_account_id;
    showForm.value = true; // Show the form
};

/**
 * Handles the deletion of a sub-ledger.
 * @param {number} id - The ID of the sub-ledger to delete.
 */
const deleteSubLedger = (id) => {
    if (confirm('Are you sure you want to delete this sub-ledger? This action cannot be undone.')) {
        useForm({}).delete(route('sub-ledgers.destroy', id), {
            onError: (errors) => {
                console.error("Error deleting sub-ledger:", errors);
            }
        });
    }
};

/**
 * Cancels the form operation and hides the form.
 */
const cancelForm = () => {
    showForm.value = false;
    editingSubLedger.value = null;
    form.reset(); // Reset form fields
};
</script>

<template>
    <Head title="Sub-Ledgers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sub-Ledgers</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <!-- Button to show the form for adding a new sub-ledger -->
                    <button @click="showForm = true" class="px-4 py-2 bg-indigo-600 text-white rounded-md mb-4 hover:bg-indigo-700 transition duration-150 ease-in-out">
                        Add New Sub-Ledger
                    </button>

                    <!-- Sub-Ledger Form (Create/Edit) -->
                    <div v-if="showForm" class="mb-6 p-4 border border-gray-200 rounded-lg shadow-sm">
                        <h3 class="text-lg font-medium mb-4 text-gray-800">{{ editingSubLedger ? 'Edit Sub-Ledger' : 'Create New Sub-Ledger' }}</h3>
                        <form @submit.prevent="submitForm">
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="name" v-model="form.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" v-model="form.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="chart_of_account_id" class="block text-sm font-medium text-gray-700">Controlling Account</label>
                                <select id="chart_of_account_id" v-model="form.chart_of_account_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option :value="null">-- Select an Account --</option>
                                    <option v-for="account in chartOfAccounts" :key="account.id" :value="account.id">
                                        {{ account.account_name }} ({{ account.account_code }})
                                    </option>
                                </select>
                                <div v-if="form.errors.chart_of_account_id" class="text-red-500 text-sm mt-1">{{ form.errors.chart_of_account_id }}</div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-150 ease-in-out" :disabled="form.processing">
                                    {{ editingSubLedger ? 'Update' : 'Create' }}
                                </button>
                                <button type="button" @click="cancelForm" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition duration-150 ease-in-out">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Sub-Ledgers Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Controlling Account</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-if="subLedgers.data.length === 0">
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        No sub-ledgers found.
                                    </td>
                                </tr>
                                <tr v-for="subLedger in subLedgers.data" :key="subLedger.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ subLedger.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ subLedger.description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ subLedger.chart_of_account.account_name }} ({{ subLedger.chart_of_account.account_code }})
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button @click="editSubLedger(subLedger)" class="text-indigo-600 hover:text-indigo-900 mr-3 transition duration-150 ease-in-out">Edit</button>
                                        <button @click="deleteSubLedger(subLedger.id)" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div v-if="subLedgers.links.length > 3" class="flex justify-center mt-4 space-x-2">
                        <template v-for="(link, key) in subLedgers.links">
                            <div v-if="link.url === null" :key="key" class="px-4 py-2 text-sm text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed">
                                <span v-html="link.label"></span>
                            </div>
                            <Link v-else :key="`link-${key}`"
                                :class="{'bg-indigo-600 text-white': link.active, 'bg-gray-200 text-gray-700': !link.active}"
                                :href="link.url"
                                class="px-4 py-2 text-sm rounded-lg hover:bg-indigo-500 hover:text-white transition duration-150 ease-in-out"
                                v-html="link.label"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>