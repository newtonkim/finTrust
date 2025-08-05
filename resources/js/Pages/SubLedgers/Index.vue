<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    subLedgers: Object,
    chartOfAccounts: Object,
});

const form = useForm({
    name: '',
    description: '',
    chart_of_account_id: null,
});

const showForm = ref(false);
const editingSubLedger = ref(null);

const submitForm = () => {
    if (editingSubLedger.value) {
        form.put(route('sub-ledgers.update', editingSubLedger.value.id), {
            onSuccess: () => {
                showForm.value = false;
                editingSubLedger.value = null;
                form.reset();
            },
        });
    } else {
        form.post(route('sub-ledgers.store'), {
            onSuccess: () => {
                showForm.value = false;
                form.reset();
            },
        });
    }
};

const editSubLedger = (subLedger) => {
    editingSubLedger.value = subLedger;
    form.name = subLedger.name;
    form.description = subLedger.description;
    form.chart_of_account_id = subLedger.chart_of_account_id;
    showForm.value = true;
};

const deleteSubLedger = (id) => {
    if (confirm('Are you sure you want to delete this sub-ledger?')) {
        useForm({}).delete(route('sub-ledgers.destroy', id));
    }
};

const cancelForm = () => {
    showForm.value = false;
    editingSubLedger.value = null;
    form.reset();
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
                    <button @click="showForm = true" class="px-4 py-2 bg-indigo-600 text-white rounded-md mb-4">
                        Add New Sub-Ledger
                    </button>

                    <div v-if="showForm" class="mb-6 p-4 border rounded-md">
                        <h3 class="text-lg font-medium mb-4">{{ editingSubLedger ? 'Edit Sub-Ledger' : 'Create New Sub-Ledger' }}</h3>
                        <form @submit.prevent="submitForm">
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="name" v-model="form.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                                <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" v-model="form.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                <div v-if="form.errors.description" class="text-red-500 text-sm">{{ form.errors.description }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="chart_of_account_id" class="block text-sm font-medium text-gray-700">Controlling Account</label>
                                <select id="chart_of_account_id" v-model="form.chart_of_account_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option :value="null">-- Select an Account --</option>
                                    <option v-for="account in chartOfAccounts" :key="account.id" :value="account.id">
                                        {{ account.account_name }} ({{ account.account_code }})
                                    </option>
                                </select>
                                <div v-if="form.errors.chart_of_account_id" class="text-red-500 text-sm">{{ form.errors.chart_of_account_id }}</div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">{{ editingSubLedger ? 'Update' : 'Create' }}</button>
                                <button type="button" @click="cancelForm" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Cancel</button>
                            </div>
                        </form>
                    </div>

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
                            <tr v-for="subLedger in subLedgers.data" :key="subLedger.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ subLedger.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ subLedger.description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ subLedger.chart_of_account.account_name }} ({{ subLedger.chart_of_account.account_code }})
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button @click="editSubLedger(subLedger)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                    <button @click="deleteSubLedger(subLedger.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <Link v-for="link in subLedgers.links" :key="link.label" :href="link.url"
                            :class="{ 'font-bold': link.active }"
                            class="px-3 py-1 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring focus:border-blue-300 mx-1"
                            v-html="link.label"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>